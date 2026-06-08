<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SiteSetting extends Model
{
    public const DEFAULTS = [
        'site_name' => 'Eymen Optik',
        'phone' => '0542 763 99 75',
        'email' => 'info@eymenoptiklens.com',
        'address' => 'Örtülüpınar, İnönü Blv. 42 C, 58030 Merkez/Sivas',
        'facebook' => 'https://www.facebook.com/people/Eymen-Optik/100054312439127/#',
        'instagram' => 'https://www.instagram.com/eymenoptik_sivas/',
        'shipping_free_threshold' => 3000,
        'shipping_cost' => 59.99,
    ];

    protected $fillable = [
        'site_name',
        'logo',
        'favicon',
        'phone',
        'email',
        'address',
        'instagram',
        'facebook',
        'whatsapp',
        'about_text',
        'shipping_free_threshold',
        'shipping_cost',
    ];

    protected $casts = [
        'shipping_free_threshold' => 'decimal:2',
        'shipping_cost' => 'decimal:2',
    ];

    public static function defaults(): array
    {
        return self::DEFAULTS;
    }

    public function getSiteNameAttribute($value): string
    {
        return $value ?: self::DEFAULTS['site_name'];
    }

    public function getPhoneAttribute($value): string
    {
        return $value ?: self::DEFAULTS['phone'];
    }

    public function getEmailAttribute($value): string
    {
        return $value ?: self::DEFAULTS['email'];
    }

    public function getAddressAttribute($value): string
    {
        return $value ?: self::DEFAULTS['address'];
    }

    public function getFacebookAttribute($value): string
    {
        return $value ?: self::DEFAULTS['facebook'];
    }

    public function getInstagramAttribute($value): string
    {
        return $value ?: self::DEFAULTS['instagram'];
    }

    public function getShippingFreeThresholdAttribute($value): float
    {
        return (float) ($value ?: self::DEFAULTS['shipping_free_threshold']);
    }

    public function getShippingCostAttribute($value): float
    {
        return (float) ($value ?: self::DEFAULTS['shipping_cost']);
    }
}
