<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Pet extends Model implements Searchable
{
    use HasFactory, SoftDeletes;

    public $table = 'pets';
    public $primaryKey = 'pet_id';
    public $timestamps = true;

    protected $guarded = ['pet_id','img_path'];
    protected $fillable = ['customer_id', 'petb_id', 'pname', 'gender', 'age', 'img_path'];

    public static $rules = [
        'customer_id' =>'required',
        'pname'=>'required',
        'petb_id'=>'required',
        'gender'=>'required',
        'age'=>'numeric',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id')->withTrashed();
    }

    public function breed()
    {
        return $this->belongsTo('App\Models\Breed', 'petb_id');
    }

    public function consults()
    {
        return $this->hasMany('App\Models\Consultation', 'pet_id');
    }

    public function transacts()
    {
        return $this->hasMany('App\Models\Transaction', 'pet_id');
    }

    public function getSearchResult(): SearchResult
    {
        $url = $this->pet_id;
        return new SearchResult(
            $this,
            $this->pname,
            $url
        );
    }
}

