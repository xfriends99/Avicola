<?php

namespace App\Http\Controllers;

use App\Buy;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Session;

class BuyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Buy::paginate(15);
        return view('Buy.list_all')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAddBuy()
    {
        $data = Buy::paginate(15);
        return view('Buy.addbuy')->with('data',$data->last());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postAddBuy(Request $request)
    {
        $rules = array(
            'quantity' => 'required|max:255',
            'code' => 'required|max:255',
            'price_unity' => 'required|max:255',
            'quantity_weight' => 'required|max:255',
            'type_product' => 'required|max:255',
            );

        $validator = Validator::make($request->all(), $rules);

        // return $request->all();
        if ($validator->fails()) {
            return Redirect::to('addbuy')
            ->withErrors($validator)
            ->withInput();
        } else {
        	// return  date('Y-m-d', strtotime($request->date_credit));
            $buy = new Buy;

            $buy->code = $request->code;
            $buy->type_product = $request->type_product;
            $buy->type_price = $request->type_price;
            $buy->quantity = $request->quantity;
            $buy->quantity_weight = $request->quantity_weight;
            $buy->price_unity = $request->price_unity;
            $buy->price_total = $request->quantity * $request->price_unity;
            $buy->date_credit =date('Y-m-d', strtotime($request->date_credit));
            $buy->status_pay = 0;

            if($buy->save()){
                Session::flash('message', 'Compra creada correctamente!!');
                return Redirect::to('buy');
            }

        }
    }

    public function searchBuy(Request $request)
    {
        $data = Buy::where('code', 'like', "%$request->search%")->paginate(15);
        return view('buy.list_all')->with('data',$data);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Buy  $Buy
     * @return \Illuminate\Http\Response
     */
    public function getEditBuy($id)
    {
        $data = Buy::find($id);
        return view('Buy.editbuy')->with('data',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Buy  $Buy
     * @return \Illuminate\Http\Response
     */
    public function postUpdateBuy(Request $request)
    {    $rules = array(
            'quantity' => 'required|max:255',
            'code' => 'required|max:255',
            'price_unity' => 'required|max:255',
            'quantity_weight' => 'required|max:255',
            'type_product' => 'required|max:255',
            );

        $validator = Validator::make($request->all(), $rules);

        // return $request->all();
        if ($validator->fails()) {
            return Redirect::to('addbuy')
            ->withErrors($validator)
            ->withInput();
        } else {
        	// return  date('Y-m-d', strtotime($request->date_credit));
            $buy =  Buy::find($request->id);

            $buy->code = $request->code;
            $buy->type_product = $request->type_product;
            $buy->type_price = $request->type_price;
            $buy->quantity = $request->quantity;
            $buy->quantity_weight = $request->quantity_weight;
            $buy->price_unity = $request->price_unity;
            $buy->price_total = $request->quantity * $request->price_unity;
            $buy->date_credit =date('Y-m-d', strtotime($request->date_credit));
            $buy->status_pay = 0;

            if($buy->save()){
                Session::flash('message', 'Compra editada correctamente!!');
                return Redirect::to('buy');
            }

        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Buy  $Buy
     * @return \Illuminate\Http\Response
     */
    public function deleteBuy(Request $request)
    {
        $Buy = Buy::find($request->id);
        if($Buy->delete()){
            Session::flash('message', 'Servicio editado correctamente!!');
            return Redirect::to('buy');
        }
    }
    public function postUpdateStatus(Request $request)
    {
        $buy = Buy::find($request->id);
        $buy->status_pay = $request->status;
        $buy->date_pay = date('Y-m-d');

        if($buy->save()){
            Session::flash('message', 'Servicio editado correctamente!!');
            return Redirect::to('buy');
        }
    }


}
