<?php

namespace CodePub\Http\Controllers;

use Illuminate\Http\Request;
use CodePub\Models\Book;
use CodePub\Http\Requests\BookRequest;
use CodePub\Http\Requests\BookUpdateRequest;
use CodePub\Repositories\BookRepository;
use CodePub\Criteria\FindByTitle;
use CodePub\Criteria\FindByAuthorCriteria;
use CodePub\Criteria\FindByTitleCriteria;
use CodePub\Repositories\CategoryRepository;

class BooksController extends Controller
{
	private $repository;
	private $categoryRepository;
	
	public function __construct(BookRepository $repository, CategoryRepository $categoryRepository){
		$this->repository = $repository;
		$this->categoryRepository = $categoryRepository;
	}
	
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
    	$search= $request->get('search');
        $books = $this->repository->paginate(10);
        return view('books.index',compact('books','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$categories = $this->categoryRepository->all();
        return view('books.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookRequest $request)
    {
    	$data = $request->all();
    	$data['user_id'] = \Auth::user()->id;
        Book::create($data);
        $url = $request->get('redirect_to',route('books.index'));
        $request->session()->flash('message','Livro cadastrado com sucesso.');
        return redirect()->to($url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Book $book)
    {
        return view('books.edit',compact('book'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookUpdateRequest $request, Book $book)
    {
        $book->fill($request->all());
    	$book->save();
    	$url = $request->get('redirect_to',route('books.index'));
    	$request->session()->flash('message','Livro atualizado com sucesso.');
    	return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Book $book)
    {
        $book->delete();
		return redirect()->route('books.index');
    }
}
