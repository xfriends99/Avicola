<?php

namespace App\Http\Controllers;

use App\Provider;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Session;

class ProviderController extends Controller
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
    public function listProviders()
    {

        $providers = Provider::all();

        return view('providers.list')->with('providers',$providers);

    }

    public function getAddProvider()
    {

        return view('providers.add');

    }

    public function postAddProvider(){
        $rules = array(
            'cedula_ruc' => 'required|max:20|unique:providers',
            'name' => 'required|max:255',
            'phone' => 'required|max:30',
            'email' => 'required|email|max:100|unique:providers',
            'direction' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('addprovider')
                ->withErrors($validator)
                ->withInput();
        } else {

            $provider = new Provider();

            $provider->name = Input::get('name');
            $provider->cedula_ruc = Input::get('cedula_ruc');
            $provider->email = Input::get('email');
            $provider->phone = Input::get('phone');
            $provider->direction = Input::get('direction');

            if($provider->save()){
                Session::flash('message', 'Proveedor creado correctamente!!');
                return Redirect::to('providers');
            }

        }
    }

    public function getEditProvider($id = null){

        $provider = Provider::find($id);

        if($provider!=null){
            return view('providers.edit', compact('provider'));
        }else{
            return view('home');
        }

    }

    public function postEditProvider(){

        $id = Input::get('provider_id');

        $rules = array(
            'cedula_ruc' => 'required|max:20',
            'name' => 'required|max:255',
            'phone' => 'required|max:30',
            'email' => 'required|email|max:100',
            'direction' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('providers')
                ->withErrors($validator);
        } else {

            $provider = Provider::find($id);

            $provider->name = Input::get('name');
            $provider->cedula_ruc = Input::get('cedula_ruc');
            $provider->email = Input::get('email');
            $provider->phone = Input::get('phone');
            $provider->direction = Input::get('direction');

            if($provider->save()){
                Session::flash('message', 'Proveedor actualizado correctamente!');
                return Redirect::to('providers');
            }


        }

    }


    public function deleteClient($id = null){

        $provider = Provider::find($id);
        if($provider->save()) {
            Session::flash('message', 'Proveedor eliminado correctamente!');
            return Redirect::to('providers');
        }else{
            return view('home');
        }

    }
}
