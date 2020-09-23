<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationalSubject extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    public static function boot()
	{
		parent::boot();

        static::creating(function($category) {
            $category->uuid = generate_uuid();
        });
    }

    public function donations()
    {
        return $this->hasMany(\App\Models\EducationalRequest::class, 'subject_id');
    }
}