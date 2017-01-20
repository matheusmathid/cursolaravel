<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = [
		'title','subtitle','price'
	];
    
    public function getPriceAttribute($value)
    {
    	return  "R$ ".number_format($value,2,",",".");
    }
}
