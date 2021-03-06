<?php

namespace CodeEduBook\Http\Controllers;

use Illuminate\Http\Request;
use CodeEduBook\Models\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use CodeEduBook\Http\Requests\CategoryRequest;
use CodeEduBook\Repositories\CategoryRepository;

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
    public function index(Request $request)
    {
    	$search= $request->get('search');
		$categories = $this->repository->paginate(10);
		return view('codeedubook::categories.index',compact('categories','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeedubook::categories.create');
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
		return view('codeedubook::categories.edit',compact('category'));
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
