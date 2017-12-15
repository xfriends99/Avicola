<?php

namespace App\Http\Controllers;

use App\Sales;
use App\Services;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Session;

class SalesController extends Controller
{
   /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Sales::paginate(15);
        return view('sales.list_all')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAddSales()
    {
        $dataService = Services::all();
        $data = Sales::paginate(15);
        return view('Sales.addsales')->with('data',$data->last())->with('services', $dataService);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postAddSales(Request $request)
    {
        $rules = array(
            'quantity' => 'required|max:255',
            'code' => 'required|max:255',
            'price_unity' => 'required|max:255',
            'type_product' => 'required|max:255',
            );

        $validator = Validator::make($request->all(), $rules);

        // return $request->all();
        if ($validator->fails()) {
            return Redirect::to('addsales')
            ->withErrors($validator)
            ->withInput();
        } else {
        	// return  date('Y-m-d', strtotime($request->date_credit));
            $sales = new Sales;

            $sales->code = $request->code;
            $sales->type_product = $request->type_product;
            $sales->quantity = $request->quantity;
            $sales->price_unity = $request->price_unity;
            $sales->price_total = $request->quantity * $request->price_unity;
            $sales->date_credit =date('Y-m-d', strtotime($request->date_credit));
            $sales->status_payment = 0;
            $sales->service =$request->services;
            $sales->status = $request->status;
            $sales->price_buy_zoo = $request->price_buy_zoo;
            $sales->merma_weight = $request->merma_weight;
            $sales->quantity_dead = $request->quantity_dead;

            if($sales->save()){
                Session::flash('message', 'Venta creada correctamente!!');
                return Redirect::to('sales');
            }

        }
    }

    public function searchSales(Request $request)
    {
        $data = Sales::where('code', 'like', "%$request->search%")->paginate(15);
        return view('sales.list_all')->with('data',$data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Buy  $Buy
     * @return \Illuminate\Http\Response
     */
    public function getEditSales($id)
    {
    	  $dataService = Services::all();
        $data = Sales::find($id);
        return view('sales.editsales')->with('data',$data)->with('services', $dataService);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Buy  $Buy
     * @return \Illuminate\Http\Response
     */
    public function postUpdateSales(Request $request)
    {   

  		$rules = array(
            'quantity' => 'required|max:255',
            'code' => 'required|max:255',
            'price_unity' => 'required|max:255',
            'type_product' => 'required|max:255',
            );

        $validator = Validator::make($request->all(), $rules);

        // return $request->all();
        if ($validator->fails()) {
            return Redirect::to('addsales')
            ->withErrors($validator)
            ->withInput();
        } else {
        	// return $request->id;
            $sales = Sales::find($request->id);

            $sales->code = $request->code;
            $sales->type_product = $request->type_product;
            $sales->quantity = $request->quantity;
            $sales->price_unity = $request->price_unity;
            $sales->price_total = $request->quantity * $request->price_unity;
            $sales->date_credit =date('Y-m-d', strtotime($request->date_credit));
            $sales->status_payment = 0;
            $sales->service =$request->services;
            $sales->status = $request->status;
            $sales->price_buy_zoo = $request->price_buy_zoo;
            $sales->merma_weight = $request->merma_weight;
            $sales->quantity_dead = $request->quantity_dead;

            if($sales->save()){
                Session::flash('message', 'Venta modificada correctamente!!');
                return Redirect::to('sales');
            }

        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Buy  $Buy
     * @return \Illuminate\Http\Response
     */
    public function deleteSales(Request $request)
    {
        $sales = Sales::find($request->id);
        if($sales->delete()){
            Session::flash('message', 'Servicio elinimado correctamente!!');
            return Redirect::to('sales');
        }
    }
    public function postUpdateStatus(Request $request)
    {
        $sales = Sales::find($request->id);
        $sales->status_payment = $request->status;
        $sales->date_payment = date('Y-m-d');

        if($sales->save()){
            Session::flash('message', 'Servicio editado correctamente!!');
            return Redirect::to('buy');
        }
    }
}
