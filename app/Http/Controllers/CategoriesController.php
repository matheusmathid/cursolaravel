<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Http\Requests\CategoryRequest;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$categories = Category::query()->paginate(10);
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
        Category::create($request->all());
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
    public function update(CategoryRequest $request,Category $category)
    {
    	$category->fill($request->all());
    	$category->save();
    	$url = $request->get('redirect_to',route('categories.index'));
    	$request->session()->flash('message','Categoria atualizada com sucesso.');
    	return redirect()->to($url);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  Category $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
		$category->delete();
		\Session::flash('message','Categoria excluida com sucesso.');
		return redirect()->to(\URL::previous());
    }
}
