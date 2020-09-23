<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class DonationCategory extends Model implements HasMedia
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

        static::creating(function($category) {
            $category->uuid = generate_uuid();
        });
    }

    public function getCategoryIconUrlAttribute()
    {
        $media = $this->getFirstMedia('category_icon');

        if ($media) {
            return $media->getUrl();
        }
        return asset('img/defaults/default_asset.svg');
    }

    public function donations()
    {
        return $this->hasMany(\App\Models\Donation::class, 'donation_category_id');
    }

}