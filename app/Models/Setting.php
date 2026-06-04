<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable = ['key', 'value'];

    public static function get($key, $default = null)
    {
        $setting = self::where('key', $key)->first();
        return $setting ? $setting->value : $default;
    }

    public static function set($key, $value)
    {
        return self::updateOrCreate(['key' => $key], ['value' => $value]);
    }

    public static function getYoutubeId($url)
    {
        if (empty($url)) {
            return null;
        }
        $pattern = '/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/ ]{11})/i';
        if (preg_match($pattern, $url, $match)) {
            return $match[1];
        }
        return null;
    }

    public static function getMapEmbedUrl()
    {
        $url = self::get('contact_map_embed');
        if (empty($url)) {
            return null;
        }

        // If it's already a valid embed URL, return it
        if (str_contains($url, 'output=embed') || str_contains($url, '/embed') || str_contains($url, 'google.com/maps/embed')) {
            return $url;
        }

        // If it contains /place/..., we can extract the place name
        if (preg_match('/\/maps\/place\/([^\/\?]+)/', $url, $matches)) {
            return "https://maps.google.com/maps?q=" . $matches[1] . "&t=&z=14&ie=UTF8&iwloc=B&output=embed";
        }

        // Fallback: Use contact_address if available
        $address = self::get('contact_address');
        if (!empty($address)) {
            return "https://maps.google.com/maps?q=" . urlencode($address) . "&t=&z=14&ie=UTF8&iwloc=B&output=embed";
        }

        // Last fallback: return the original URL
        return $url;
    }
}
