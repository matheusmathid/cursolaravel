<?php

namespace CodePub\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use CodePub\Repositories\BookRepository;

class BookUpdateRequest extends BookRequest
{
	private $repository;
	
	public function __construct(BookRepository $repository){
		$this->repository = $repository;
	}
	
	
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
    	$id = (int) $this->route('book');
    	if($id == 0)
    		return false;
    	
    	$book = $this->repository->find($id);
    	return $book->user_id == Auth::user()->id;
        
    }

}
