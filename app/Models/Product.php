<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Product extends Model implements HasMedia
{
    use InteractsWithMedia;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id',
    ];

    public static function boot()
	{
		parent::boot();

        static::creating(function($product) {
            $product->uuid = generate_uuid();
        });
    }

    public function shop_interests()
    {
        return $this->hasMany(\App\Models\ProductInterest::class, 'product_id');
    }

    public function interested_users()
    {
        return $this->belongsToMany(\App\Models\User::class, 'product_interests');
    }

}