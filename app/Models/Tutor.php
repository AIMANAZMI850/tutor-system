<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','name', 'email', 'phone'];

    public function tutor()
    {
        return $this->hasMany(Tutor::class);
    }
}
