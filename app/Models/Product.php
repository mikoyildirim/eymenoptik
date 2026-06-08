<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $fillable = ['category_id', 'brand_id', 'name', 'slug', 'gender', 'model_code', 'frame_color', 'glass_color', 'frame_material', 'glass_type', 'lens_degree', 'lens_type', 'lens_usage', 'lens_package_content', 'lens_water_content', 'lens_base_curve', 'lens_diameter', 'lens_material', 'lens_center_thickness', 'lens_oxygen_permeability', 'price', 'discount_price', 'stock', 'image', 'short_description', 'description', 'is_featured', 'is_active'];

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    public function images(): HasMany
    {
        return $this->hasMany(ProductImage::class)->orderBy('sort_order')->orderBy('id');
    }
    public function getFinalPriceAttribute()
    {
        return $this->discount_price ?: $this->price;
    }

    public function getGalleryImagesAttribute()
    {
        $images = collect();

        if ($this->image) {
            $images->push($this->image);
        }

        if ($this->relationLoaded('images')) {
            $images = $images->merge($this->images->pluck('image'));
        }

        return $images->filter()->values();
    }

    public function getImageUrlAttribute()
    {
        if (!$this->image) {
            $firstGalleryImage = $this->relationLoaded('images') ? $this->images->first()?->image : null;

            if ($firstGalleryImage) {
                return asset('storage/' . $firstGalleryImage);
            }

            return 'https://images.unsplash.com/photo-1511499767150-a48a237f0083?auto=format&fit=crop&w=700&q=80';
        }

        if (filter_var($this->image, FILTER_VALIDATE_URL)) {
            return $this->image;
        }

        return asset('storage/' . $this->image);
    }
}
