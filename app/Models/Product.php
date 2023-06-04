<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';
    protected $guarded = false;



    const SMALL = 0;
    const MEDIUM = 1;
    const LARGE = 2;

    /**
     * метод для получения размеров
     */
    public static function getSizes()
    {
        return [
            self::SMALL => 'S',
            self::MEDIUM => 'M',
            self::LARGE => 'L',
        ];
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }
}
