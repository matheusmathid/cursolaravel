<?php

namespace CodeEduUser\Http\Controllers;

use CodeEduUser\Models\User;
use Illuminate\Http\Request;
use CodeEduUser\Http\Requests\UserRequest;
use CodeEduUser\Repositories\UserRepository;

class UsersController extends Controller
{
	private $repository;
	
	public function __construct(UserRepository $repository){
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
		$users = $this->repository->paginate(10);
		return view('codeeduuser::users.index',compact('users','search'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('codeeduuser::users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->repository->create($request->all());
        $url = $request->get('redirect_to',route('codeeduuser.users.index'));
        $request->session()->flash('message','Usuário cadastrado com sucesso.');
    	return redirect()->to($url);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
		return view('codeeduuser::users.edit',compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request,$id)
    {
    	$this->repository->update($request->all(), $id);
    	$url = $request->get('redirect_to',route('codeeduuser.users.index'));
    	$request->session()->flash('message','Usuário atualizado com sucesso.');
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
		\Session::flash('message','Usuário excluido com sucesso.');
		return redirect()->to(\URL::previous());
    }
}
