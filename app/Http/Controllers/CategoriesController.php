<?php

namespace CodePub\Http\Controllers;

use Illuminate\Http\Request;
use CodePub\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use CodePub\Http\Requests\CategoryRequest;
use CodePub\Repositories\CategoryRepository;

class CategoriesController extends Controller
{
	private $repository;
	
	public function __construct(CategoryRepository $repository){
		$this->repository = $repository;
	}
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	
		$categories = $this->repository->paginate(10);
		#$categories = Category::query()->paginate(10);
		#$categories = Category::query()->simplePaginate(15);
		return view('categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to',route('categories.index'));
        $request->session()->flash('message','Categoria cadastrada com sucesso.');
    	return redirect()->to($url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
		return view('categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request,$id)
    {
    	$this->repository->update($request->all(), $id);
    	$url = $request->get('redirect_to',route('categories.index'));
    	$request->session()->flash('message','Categoria atualizada com sucesso.');
    	return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
		$this->repository->delete($id);
		\Session::flash('message','Categoria excluida com sucesso.');
		return redirect()->to(\URL::previous());
    }
}
