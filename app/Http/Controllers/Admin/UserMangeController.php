<?php

namespace App\Http\Controllers\Admin;

use App\Models\Info;
use App\Models\Role;
use App\Models\User;
use App\Models\AppConst;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserReqeust;
use App\Http\Requests\UpdateUserRequest;

class UserMangeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::where('id', "!=", auth()->user()->id)->orderBy('id', 'desc')->paginate(AppConst::DEFAULT_PER_PAGE);
        return view('admin.user_manage')->with('users',$users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('admin.create_account')->with('roles',$roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUserReqeust $request)
    {
        $user = new User;
        $user->fill($request->all());
        $user->save();
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('admin.create_account')->with('user',$user)->with('roles',$roles);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::orderBy('id', 'DESC')->get();
        return view('admin.edit_user')->with('user',$user)->with('roles',$roles);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->fill($request->all());
        $user->update();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->back();
    }
    public function blockUser(User $user){
        $user->blocked =true;
        $user->save();
    }
    public function unBlockUser(User $user){
        $user->blocked =false;
        $user->save();
    }
    public function employees(){
        $employees = Info::orderBy('id', 'desc')->paginate(AppConst::DEFAULT_PER_PAGE);
        $employees->load('user');
        return view('admin.list_employee')->with('employees', $employees);
    }
}
