<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Bootstrapper\Interfaces\TableInterface;

class Book extends Model implements TableInterface
{
    protected $fillable = [
		'title','subtitle','price','user_id'
	];
    
    public function user()
    {
    	return $this->belongsTo(User::class);
    }
    
    public function getTableHeaders()
    {
    	return ['#','Titulo','Subtitulo','Valor'];
    }
    
    public function getValueForHeader($header){
    	switch ($header){
    		case '#' :
    			return $this->id;
    		case 'Titulo':
    			return $this->title;
    		case 'Subtitulo':
    			return $this->subtitle;
    		case 'Valor':
    			return $this->price;
    	}
    }
}
