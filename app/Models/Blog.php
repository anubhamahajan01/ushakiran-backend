<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Blog extends Model 
{
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

        static::creating(function($blog) {
            $blog->uuid = generate_uuid();
        });
    }

}