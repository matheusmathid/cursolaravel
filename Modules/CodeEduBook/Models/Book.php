<?php

namespace CodeEduBook\Models;

use Illuminate\Database\Eloquent\Model;
use Bootstrapper\Interfaces\TableInterface;
use Collective\Html\Eloquent\FormAccessible;
use Illuminate\Database\Eloquent\SoftDeletes;
use CodeEduUser\Models\User;

class Book extends Model implements TableInterface
{
	
	use FormAccessible;
	use SoftDeletes;
	
    protected $fillable = [
		'title','subtitle','price','user_id'
	];
    
    public function user()
    {
    	return $this->belongsTo(\CodeEduUser\Models\User::class);
    }
    
    public function categories(){
    	return $this->belongsToMany(Category::class)->withTrashed();
    }
    
    public function formCategoriesAttribute(){
    	return $this->categories->pluck('id')->all();
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
