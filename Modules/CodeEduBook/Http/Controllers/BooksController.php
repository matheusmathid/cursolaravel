<?php

namespace CodeEduBook\Http\Controllers;

use Illuminate\Http\Request;
use CodeEduBook\Models\Book;
use CodeEduBook\Http\Requests\BookRequest;
use CodeEduBook\Http\Requests\BookUpdateRequest;
use CodeEduBook\Repositories\BookRepository;
use CodeEduBook\Repositories\CategoryRepository;

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
        return view('codeedubook::books.index',compact('books','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
    	$categories = $this->categoryRepository->lists('name','id'); // pluck -> trait
        return view('codeedubook::books.create',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BookUpdateRequest $request)
    {
    	
    	$data = $request->all();
    	$data['user_id'] = \Auth::user()->id;
    	$this->repository->create($data);
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
    public function edit($id)
    {
    	$book = $this->repository->find($id);
    	$this->categoryRepository->withTrashed();
    	$categories = $this->categoryRepository->listsWithMutators('name_trashed','id'); // pluck -> trait
    	#dd($categories);
        return view('codeedubook::books.edit',compact('book','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BookUpdateRequest $request, $id)
    {
        $this->repository->update($request->all(), $id);
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
    public function destroy($id)
    {
        $this->repository->delete($id);
		\Session::flash('message','Livro removido com sucesso.');
		return redirect()->to(\URL::previous());
    }
}
