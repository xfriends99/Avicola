<?php

namespace App\Http\Controllers;

use App\Product;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use Session;

class ProductController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::paginate(15);
        return view('products.list_all')->with('data',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAddProduct()
    {
        $data = Product::paginate(15);
        return view('products.addservice')->with('data',$data->last());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function postAddProduct(Request $request)
    {
        $rules = array(
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'price' => 'required|max:255',
            'price_sales' => 'required|max:255',
            'type_calculation' => 'required|max:255',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('addproduct')
                ->withErrors($validator)
                ->withInput();
        } else {
            // return $request->all();

            $product = new Product();

            $product->code = $request->code;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->price_sales = $request->price_sales;
            $product->type_calculation = $request->type_calculation;

            if($product->save()){
                Session::flash('message', 'Producto creado correctamente!!');
                return Redirect::to('products');
            }

        }
    }


    public function searchProduct(Request $request)
    {
        $data = Product::where('name', 'like', "%$request->search%")->orWhere('code', 'like', "%$request->search%")->paginate(15);

        return view('products.list_all')->with('data',$data);

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function getEditProduct($id)
    {
        $data = Product::find($id);
        return view('products.editservice')->with('data',$data);
    }

    public function getEditProductapi($id)
    {
        $data = Product::find($id);
        return $data;
    }
    public function postEditProductapi(Request $request)
    {
        $data = Product::find($request->id);
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
    public function postUpdateProduct(Request $request)
    {
        // return $request->all();
        $rules = array(
            'name' => 'required|max:255',
            'code' => 'required|max:255',
            'price' => 'required|max:255',
            'price_sales' => 'required|max:255',
            'type_calculation' => 'required|max:255',
        );

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return Redirect::to('products')
                ->withErrors($validator)
                ->withInput();
        } else {
            // return $request->all();

            $product = Product::find($request->id);

            $product->code = $request->code;
            $product->name = $request->name;
            $product->price = $request->price;
            $product->price_sales = $request->price_sales;
            $product->type_calculation = $request->type_calculation ;

            if($product->save()){
                Session::flash('message', 'Producto editado correctamente!!');
                return Redirect::to('products');
            }

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Services  $services
     * @return \Illuminate\Http\Response
     */
    public function deleteProduct(Request $request)
    {
        $product = Product::find($request->id);
        if($product->delete()){
            Session::flash('message', 'Producto eliminado correctamente!!');
            return Redirect::to('products');
        }
    }
}
