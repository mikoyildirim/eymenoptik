<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\Category;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    public function index()
    {
        return view('admin.products.index', ['products' => Product::with('category', 'brand')->latest()->paginate(20)]);
    }
    public function create()
    {
        return view('admin.products.form', ['product' => new Product, 'categories' => Category::all(), 'brands' => Brand::all()]);
    }
    public function store(Request $r)
    {
        $d = $this->valid($r, false);
        $imageFiles = $r->file('images', []);

        DB::transaction(function () use ($d, $imageFiles, $r) {
            $storedImages = $this->storeProductImages($imageFiles);

            $d['image'] = $storedImages[0] ?? null;
            $d['slug'] = Str::slug($d['name']) . '-' . uniqid();
            $d['is_active'] = $r->boolean('is_active');
            $d['is_featured'] = $r->boolean('is_featured');

            $product = Product::create($d);

            $this->saveProductGallery($product, $storedImages);
        });

        return redirect()->route('admin.products.index')->with('success', 'Ürün eklendi.');
    }
    public function edit(Product $product)
    {
        $product->load('images');

        return view('admin.products.form', ['product' => $product, 'categories' => Category::all(), 'brands' => Brand::all()]);
    }
    public function update(Request $r, Product $product)
    {
        $d = $this->valid($r, true);
        $imageFiles = $r->file('images', []);
        $removedImageIds = collect($r->input('removed_image_ids', []))
            ->map(fn ($id) => (int) $id)
            ->filter()
            ->unique()
            ->values();
        $removeMainImage = $r->boolean('removed_main_image');

        $product->loadMissing('images');

        $currentImageCount = ($product->image ? 1 : 0) + $product->images->count();
        $finalImageCount = $currentImageCount - $removedImageIds->count() - ($removeMainImage ? 1 : 0) + count($imageFiles);

        if ($finalImageCount < 1) {
            throw ValidationException::withMessages([
                'images' => 'Bir ürünün en az 1 görseli olmalıdır.',
            ]);
        }

        if ($finalImageCount > 4) {
            throw ValidationException::withMessages([
                'images' => 'Bir ürün en fazla 4 görsele sahip olabilir.',
            ]);
        }

        DB::transaction(function () use ($d, $imageFiles, $r, $product, $removedImageIds, $removeMainImage) {
            $product->loadMissing('images');

            $galleryImages = $product->images->sortBy('sort_order')->values();
            $remainingGalleryImages = $galleryImages->reject(function ($image) use ($removedImageIds) {
                return $removedImageIds->contains((int) $image->id);
            })->values();

            foreach ($galleryImages as $image) {
                if ($removedImageIds->contains((int) $image->id)) {
                    $this->deleteStoredImage($image->image);
                    $image->delete();
                }
            }

            $mainImagePath = $product->image;

            if ($removeMainImage && $mainImagePath) {
                $this->deleteStoredImage($mainImagePath);
                $mainImagePath = null;
            }

            if (!$mainImagePath) {
                $replacement = $remainingGalleryImages->shift();

                if ($replacement) {
                    $mainImagePath = $replacement->image;
                    $replacement->delete();
                }
            }

            $storedImages = $this->storeProductImages($imageFiles);

            if (!$mainImagePath) {
                $mainImagePath = array_shift($storedImages);
            }

            if (!$mainImagePath) {
                throw ValidationException::withMessages([
                    'images' => 'Bir ürünün en az 1 görseli olmalıdır.',
                ]);
            }

            $product->fill([
                'category_id' => $d['category_id'],
                'brand_id' => $d['brand_id'],
                'name' => $d['name'],
                'gender' => $d['gender'],
                'model_code' => $d['model_code'],
                'frame_color' => $d['frame_color'],
                'glass_color' => $d['glass_color'],
                'frame_material' => $d['frame_material'],
                'glass_type' => $d['glass_type'],
                'price' => $d['price'],
                'discount_price' => $d['discount_price'],
                'stock' => $d['stock'],
                'image' => $mainImagePath,
                'short_description' => $d['short_description'],
                'description' => $d['description'],
                'is_active' => $r->boolean('is_active'),
                'is_featured' => $r->boolean('is_featured'),
            ]);
            $product->save();

            $sortOrder = 1;

            foreach ($remainingGalleryImages as $image) {
                $image->update(['sort_order' => $sortOrder++]);
            }

            foreach ($storedImages as $imagePath) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $imagePath,
                    'sort_order' => $sortOrder++,
                ]);
            }
        });

        return redirect()->route('admin.products.index')->with('success', 'Ürün güncellendi.');
    }
    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Ürün silindi.');
    }
    public function show(Product $product)
    {
        return redirect()->route('admin.products.edit', $product);
    }
    private function valid(Request $r, bool $isUpdate = false)
    {
        return $r->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'name' => 'required|max:255',
            'gender' => 'required|in:erkek,kadin,unisex,cocuk',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'images' => [$isUpdate ? 'nullable' : 'required', 'array', 'min:1', 'max:4'],
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',
            'short_description' => 'nullable',
            'description' => 'nullable',
            'model_code' => 'nullable',
            'frame_color' => 'nullable|in:siyah,beyaz,kahverengi,fume,saydam,altin,gumus,kirmizi,mavi,yesil,karisik',
            'glass_color' => 'nullable|in:siyah,beyaz,kahverengi,fume,saydam,altin,gumus,kirmizi,mavi,yesil,karisik',
            'frame_material' => 'nullable',
            'glass_type' => 'nullable',
        ]);
    }

    private function storeProductImages(array $imageFiles): array
    {
        return collect($imageFiles)
            ->filter()
            ->take(4)
            ->map(function ($file) {
                return $file->store('products', 'public');
            })
            ->values()
            ->all();
    }

    private function saveProductGallery(Product $product, array $storedImages): void
    {
        foreach (array_slice($storedImages, 1) as $index => $imagePath) {
            ProductImage::create([
                'product_id' => $product->id,
                'image' => $imagePath,
                'sort_order' => $index + 1,
            ]);
        }
    }

    private function deleteProductImages(Product $product): void
    {
        $product->loadMissing('images');

        if ($product->image) {
            $this->deleteStoredImage($product->image);
        }

        foreach ($product->images as $image) {
            $this->deleteStoredImage($image->image);
            $image->delete();
        }
    }

    private function deleteStoredImage(?string $imagePath): void
    {
        if (!$imagePath || filter_var($imagePath, FILTER_VALIDATE_URL)) {
            return;
        }

        Storage::disk('public')->delete($imagePath);
    }
}
