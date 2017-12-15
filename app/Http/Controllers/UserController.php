<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Session;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function listUsers()
    {

        $users = \App\User::where('is_active','=','1')
        ->get();

        return view('users.list')->with('users',$users);

    }

    public function getAddUser()
    {


       $roles = \App\Role::all();

       return view('users.add')
       ->with('roles',$roles);

    }

    public function postAddUser(){
        $rules = array(
            'name' => 'required|max:255',
            'surname' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:8',
            );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('adduser')
            ->withErrors($validator)
            ->withInput();
        } else {
        
            $user = new \App\User;

            $user->name = Input::get('name');
            $user->surname = Input::get('surname');
            $user->email = Input::get('email');
            $user->password = bcrypt(Input::get('password'));
            $user->roles_id = Input::get('roles_id');
            if (Input::hasFile('logo')){
            $imageName = Input::file('logo')->getClientOriginalName();
            Input::file('logo')->move('logos', $imageName);
            $user->logo = $imageName;               
            }

            if($user->save()){
                Session::flash('message', 'Usuario creado correctamente!!');
                return Redirect::to('users');
            }

        }
    }

    public function getEditUser($id = null){

        $user = \App\User::find($id);
        
        if($user!=null){

            if(Auth::user()->roles_id == 1){

                $roles = \App\Role::all();

                return view('users.edit')
                ->with('roles',$roles)
                ->with('user',$user);
            }else{
                return view('home');
            }
        }else{
            return view('home');
        }

    }


    public function postEditUser(){

        $id = Input::get('user_id');
        
        $rules = array(
                'name' => 'required|max:255',
                'surname' => 'required|max:255',
                'email' => 'required|email|max:255',
                );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('profile/'.$id)
            ->withErrors($validator);
        } else {

            $user = \App\User::find($id);
        
            $user->name = Input::get('name');
            $user->surname = Input::get('surname');
            $user->email = Input::get('email');
            $password = Input::get('password');
            $user->roles_id = Input::get('roles_id');
            if(!empty($password)){
                $user->password = bcrypt($password);
            }
            if (Input::hasFile('logo')){
            $imageName = Input::file('logo')->getClientOriginalName();
            Input::file('logo')->move('logos', $imageName);
            $user->logo = $imageName;               
            }
            
            if($user->save()){
                Session::flash('message', 'Usuario actualizado correctamente!');
                return Redirect::to('profile/'.$id);
            }


        }

    }


    public function deleteUser($id = null){

        $user = \App\User::find($id);
                
        if($user!=null){

            if(Auth::user()->roles_id==1){ 
                $user->is_active = 0;           
                if($user->save()) {
                    Session::flash('message', 'Usuario eliminado correctamente!');
                    return Redirect::to('users');
                }
            }else{
                return view('home');
            }

        }else{
            return view('home');
        }

    }

}
