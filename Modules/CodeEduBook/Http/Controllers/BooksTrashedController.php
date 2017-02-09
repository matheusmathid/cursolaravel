<?php

namespace CodeEduBook\Http\Controllers;

use Illuminate\Http\Request;
use CodeEduBook\Models\Book;
use CodeEduBook\Repositories\BookRepository;

class BooksTrashedController extends Controller
{
	private $repository;
	
	public function __construct(BookRepository $repository){
		$this->repository = $repository;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$search= $request->get('search');
    	$books = $this->repository->onlyTrashed()->paginate(10);
    	
        return view('codeedubook::trashed.books.index',compact('books','search'));
    }
    
    public function show($id)
    {
    	$book = $this->repository->onlyTrashed()->find($id);
    	return view('codeedubook::trashed.books.show',compact('book'));
    }
    
    public function update(Request $request,$id){
    	$this->repository->onlyTrashed();
    	$this->repository->restore($id);
    	
    	$url = $request->get('redirect_to',route('trashed.books.index'));
    	$request->session()->flash('message','Livro restaurado com sucesso.');
    	
    	return redirect($url);
    }
    
}
