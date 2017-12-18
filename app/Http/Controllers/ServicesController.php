<?php

namespace App\Http\Controllers;

use App\Services;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Session;

class ServicesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Services::paginate(15);
        return view('services.list_all')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAddService()
    {
        $data = Services::paginate(15);
        return view('services.addservice')->with('data',$data->last());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postAddService(Request $request)
    {
        $rules = array(
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'price' => 'required|max:255',
            'type_calculation' => 'required|max:255',
            );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('addservice')
            ->withErrors($validator)
            ->withInput();
        } else {
        // return $request->all();
        
            $serice = new Services;

            $serice->code = $request->code;
            $serice->name = $request->name;
            $serice->price = $request->price;
            $serice->type_calculation = $request->type_calculation;

            if($serice->save()){
                Session::flash('message', 'Servicio creado correctamente!!');
                return Redirect::to('services');
            }

        }
    }


    public function searchService(Request $request)
    {
        // return "hola";
        $data = Services::where('name', 'like', "%$request->search%")->orWhere('code', 'like', "%$request->search%")->paginate(15);

        return view('services.list_all')->with('data',$data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function getEditService($id)
    {
        $data = Services::find($id);
        return view('services.editservice')->with('data',$data);
    }

    public function getEditServiceapi($id)
    {
        $data = Services::find($id);
        return $data;
    }
    public function postEditServiceapi(Request $request)
    {
        $data = Services::find($request->id);
        $data->price = $request->price;
        $data->save();
        return $data;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function postUpdateService(Request $request)
    {
        // return $request->all();
            $rules = array(
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'price' => 'required|max:255',
            'type_calculation' => 'required|max:255',
            );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('addservice')
            ->withErrors($validator)
            ->withInput();
        } else {
        // return $request->all();
        
            $serice = Services::find($request->id);

            $serice->code = $request->code;
            $serice->name = $request->name;
            $serice->price = $request->price;
            $serice->type_calculation = $request->type_calculation;

            if($serice->save()){
                Session::flash('message', 'Servicio editado correctamente!!');
                return Redirect::to('services');
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function deleteService(Request $request)
    {
        $serice = Services::find($request->id);
        if($serice->delete()){
            Session::flash('message', 'Servicio eliminado correctamente!!');
            return Redirect::to('services');
        }
    }
}
