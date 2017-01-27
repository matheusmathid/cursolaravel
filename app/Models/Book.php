<?php

namespace CodePub\Models;

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
    
    public function categories(){
    	return $this->belongsToMany(Category::class);
    }
    
    public function getTableHeaders()
    {
    	return ['#','Titulo','Subtitulo','Valor','Autor'];
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
    		case 'Autor':
    				return $this->user->name;
    	}
    }
    
    
}
