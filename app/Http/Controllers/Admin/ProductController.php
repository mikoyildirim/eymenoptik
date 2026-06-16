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
            ->map(fn($id) => (int) $id)
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
                'category_id' => $d['category_id'] ?? null,
                'brand_id' => $d['brand_id'] ?? null,
                'name' => $d['name'] ?? null,
                'gender' => $d['gender'] ?? null,
                'model_code' => $d['model_code'] ?? null,
                'frame_color' => $d['frame_color'] ?? null,
                'glass_color' => $d['glass_color'] ?? null,
                'frame_material' => $d['frame_material'] ?? null,
                'glass_type' => $d['glass_type'] ?? null,
                'lens_degree' => $d['lens_degree'] ?? null,
                'lens_type' => $d['lens_type'] ?? null,
                'lens_usage' => $d['lens_usage'] ?? null,
                'lens_package_content' => $d['lens_package_content'] ?? null,
                'lens_water_content' => $d['lens_water_content'] ?? null,
                'lens_base_curve' => $d['lens_base_curve'] ?? null,
                'lens_diameter' => $d['lens_diameter'] ?? null,
                'lens_material' => $d['lens_material'] ?? null,
                'lens_center_thickness' => $d['lens_center_thickness'] ?? null,
                'lens_oxygen_permeability' => $d['lens_oxygen_permeability'] ?? null,
                'price' => $d['price'] ?? null,
                'discount_price' => $d['discount_price'] ?? null,
                'stock' => $d['stock'] ?? null,
                'image' => $mainImagePath,
                'short_description' => $d['short_description'] ?? null,
                'description' => $d['description'] ?? null,
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

    public function duplicate(Request $request, Product $product)
    {
        $data = $request->validate([
            'degree_rows' => 'required|string',
        ]);

        $product->loadMissing('images');

        $rows = collect(preg_split('/\r\n|\r|\n/', (string) $data['degree_rows']))
            ->map(fn($row) => trim((string) $row))
            ->filter();

        if ($rows->isEmpty()) {
            throw ValidationException::withMessages([
                'degree_rows' => 'En az 1 derece satırı eklemelisiniz.',
            ]);
        }

        DB::transaction(function () use ($rows, $product) {
            foreach ($rows as $row) {
                $parts = preg_split('/\s*[\|,;]\s*/', $row, 2);
                $degree = trim((string) ($parts[0] ?? ''));
                $stock = isset($parts[1]) ? trim((string) $parts[1]) : null;

                if ($degree === '') {
                    throw ValidationException::withMessages([
                        'degree_rows' => 'Her satırda derece bulunmalıdır. Örnek: -0.50|10',
                    ]);
                }

                if ($stock === null || $stock === '') {
                    $stock = $product->stock;
                }

                // build a clean base name by removing any existing degree suffix
                // $baseName = preg_replace('/\s*(Numarasiz|Numarasız|[+-]?\d+[\.,]?\d*)$/iu', '', $product->name);
                // $baseName = trim($baseName);

                $clone = $product->replicate();
                $clone->name = $product->name;
                $clone->slug = Str::slug($clone->name) . '-' . uniqid();
                $clone->lens_degree = $degree;
                $clone->stock = (int) $stock;
                $clone->save();

                foreach ($product->images as $image) {
                    ProductImage::create([
                        'product_id' => $clone->id,
                        'image' => $image->image,
                        'sort_order' => $image->sort_order,
                    ]);
                }
            }
        });

        return redirect()->route('admin.products.index')->with('success', 'Derece ürünleri oluşturuldu.');
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
        $selectedCategory = Category::find($r->input('category_id'));
        $isLensCategory = $selectedCategory && str_contains(mb_strtolower((string) ($selectedCategory->slug ?? $selectedCategory->name)), 'lens');

        return $r->validate([
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'name' => 'required|max:255',
            'gender' => 'required|in:erkek,kadin,unisex,cocuk',
            'price' => 'required|numeric|min:0',
            'discount_price' => 'nullable|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'frame_color' => $isLensCategory ? 'nullable|in:siyah,beyaz,kahverengi,fume,saydam,altin,gumus,kirmizi,mavi,yesil,metalik,havana,pudra,rose_gold,bordo,enjeksiyon,titanyum,gri,pembe,leopar_deseni,kaplumbaga_kabugu,seffaf_bej,siyah_sari_mermer,col_kaplumbaga_kabugu,acik_pembe,opak_kum,karisik' : 'nullable|in:siyah,beyaz,kahverengi,fume,saydam,altin,gumus,kirmizi,mavi,yesil,metalik,havana,pudra,rose_gold,bordo,enjeksiyon,titanyum,gri,pembe,leopar_deseni,kaplumbaga_kabugu,seffaf_bej,siyah_sari_mermer,col_kaplumbaga_kabugu,acik_pembe,opak_kum,karisik',
            'glass_color' => $isLensCategory
                ? 'nullable|in:seffaf,gumus gri,parlak mavi,zumrut yesil,mavi,yesil,gri,bal rengi,ela,kahverengi'
                : 'nullable|in:siyah,beyaz,kahverengi,fume,saydam,altin,gumus,kirmizi,mavi,yesil,pembe,sari,kahverengi_degrade,bordo,turuncu,mavi_degrade,mavi_aynali,karisik',
            'frame_material' => $isLensCategory ? 'nullable' : 'required',
            'glass_type' => 'nullable',
            'lens_degree' => $isLensCategory ? 'required|string|max:50' : 'nullable|string|max:50',
            'lens_type' => $isLensCategory ? 'required|string|max:255' : 'nullable|string|max:255',
            'lens_usage' => 'nullable|string|max:255',
            'lens_package_content' => 'nullable|string|max:255',
            'lens_water_content' => 'nullable|string|max:255',
            'lens_base_curve' => 'nullable|string|max:255',
            'lens_diameter' => 'nullable|string|max:255',
            'lens_material' => 'nullable|string|max:255',
            'lens_center_thickness' => 'nullable|string|max:255',
            'lens_oxygen_permeability' => 'nullable|string|max:255',
            'images' => [$isUpdate ? 'nullable' : 'required', 'array', 'min:1', 'max:4'],
            'images.*' => 'image|mimes:jpg,jpeg,png,webp|max:4096',
            'short_description' => 'nullable',
            'description' => 'nullable',
            'model_code' => 'nullable',
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
