<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Bootstrapper\Interfaces\TableInterface;

class Category extends Model implements TableInterface
{ 
	protected $fillable = [
		'name'	
	];
	
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
