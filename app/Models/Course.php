<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'tutor_id', 'rating','total_learn_hours'];

    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
