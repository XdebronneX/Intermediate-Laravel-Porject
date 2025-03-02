<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Breed extends Model
{
    use HasFactory;
    
    public $primaryKey = 'petb_id';
    public $table = 'pet_breed';
    public $timestamps = true;
    protected $fillable = ['pbreed'];

    public function pets()
    {
        return $this->hasMany('App\Models\Pet', 'petb_id', 'petb_id');
    }
}
