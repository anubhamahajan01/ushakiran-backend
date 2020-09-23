<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\ForHumanParsers\EducationalRequest as ForHuman;

class EducationalRequest extends Model
{
    use ForHuman;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'meta' => 'array',
    ];

    public function user()
    {
        return $this->belongsTo(\App\Models\User::class, 'user_id');
    }

    public function educational_subjects()
    {
        return $this->belongsTo(\App\Models\EducationalSubject::class, 'subject_id');
    }

}