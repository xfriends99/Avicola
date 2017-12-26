<?php

namespace App\Http\Controllers;

use App\Client;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Session;

class ClientController extends Controller
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
    public function listClients()
    {

        $clients = Client::all();

        return view('clients.list')->with('clients',$clients);

    }

    public function getAddClient()
    {

        return view('clients.add');

    }

    public function postAddClient(){
        $rules = array(
            'cedula_ruc' => 'required|max:20|unique:clients',
            'name' => 'required|max:255',
            'phone' => 'required|max:30',
            'email' => 'required|email|max:100|unique:clients',
            'direction' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('addclient')
                ->withErrors($validator)
                ->withInput();
        } else {

            $client = new Client();

            $client->name = Input::get('name');
            $client->cedula_ruc = Input::get('cedula_ruc');
            $client->email = Input::get('email');
            $client->phone = Input::get('phone');
            $client->direction = Input::get('direction');

            if($client->save()){
                Session::flash('message', 'Cliente creado correctamente!!');
                return Redirect::to('clients');
            }

        }
    }

    public function getEditClient($id = null){

        $client = Client::find($id);

        if($client!=null){
            return view('clients.edit', compact('client'));
        }else{
            return view('home');
        }

    }

    public function postEditClient(){

        $id = Input::get('client_id');

        $rules = array(
            'cedula_ruc' => 'required|max:20',
            'name' => 'required|max:255',
            'phone' => 'required|max:30',
            'email' => 'required|email|max:100',
            'direction' => 'required',
        );

        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('clients')
                ->withErrors($validator);
        } else {

            $client = Client::find($id);

            $client->name = Input::get('name');
            $client->cedula_ruc = Input::get('cedula_ruc');
            $client->email = Input::get('email');
            $client->phone = Input::get('phone');
            $client->direction = Input::get('direction');

            if($client->save()){
                Session::flash('message', 'Cliente actualizado correctamente!');
                return Redirect::to('clients');
            }


        }

    }


    public function deleteClient($id = null){

        $client = Client::find($id);
        if($client->save()) {
            Session::flash('message', 'Cliente eliminado correctamente!');
            return Redirect::to('clients');
        }else{
            return view('home');
        }

    }

}
