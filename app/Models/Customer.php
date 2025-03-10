<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Searchable\Searchable;
use Spatie\Searchable\SearchResult;

class Customer extends Model implements Searchable
{
    use HasFactory;
    use SoftDeletes;

    public $table = 'customers';
    public $primaryKey = 'customer_id';
    public $timestamps = true;

    protected $guarded = ['customer_id','img_path'];
    protected $fillable = ['fname','lname','user_id',
        'title','addressline','zipcode',
        'phone','img_path'
    ];

   public static $rules = [
               'title' =>'required|min:3',
               'lname'=>'required|alpha',
               'fname'=>'required',
                'addressline'=>'required',
                'phone'=>'numeric',
                'zipcode'=>'required',
                'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg'
             ];

    public function pets()
    {
        return $this->hasMany('App\Models\Pet', 'customer_id')->withTrashed();
    }

    public function users()
    {
        return $this->belongsTo('App\Models\User', 'user_id')->withTrashed();
    }

    public function transacts()
    {
        return $this->hasMany('App\Models\Transaction', 'customer_id');
    }

    public function getSearchResult(): SearchResult
    {
        $url = $this->customer_id;
        return new SearchResult(
            $this,
            $this->fname.' '.$this->lname,
            $url
        );
    }

}
