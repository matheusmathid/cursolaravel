<?php

namespace CodeEduBook\Models;

use Illuminate\Database\Eloquent\Model;
use Bootstrapper\Interfaces\TableInterface;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model implements TableInterface
{ 
	use SoftDeletes;
	
	protected $dates = ['deleted_at'];
	protected $fillable = [
		'name'	
	];
	
	public function getNameTrashedAttribute(){
		return $this->trashed() ? "{$this->name} (Inativa)" : $this->name;
	}
	
	public function books(){
		return $this->belongsToMany(Book::class);
	}
	
	public function getTableHeaders()
	{
		return ['#','Nome'];
	}
	
	public function getValueForHeader($header){
		switch ($header){
			case '#' :
				return $this->id;
			case 'Nome':
				return $this->name;
		}
	}
}
