<?php

namespace App\Http\Controllers;

use DateTime;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $data = Product::paginate(3);
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $validatedData = $request->validate([
            'inputName' => 'required|unique:products,name',
            'inputQuantity' => 'required|numeric|digits_between:1,4',
            'inputCompany' => 'required',
            'inputType' => 'required',
            'inputPrice' => 'required|numeric',
            'inputLabel' => 'required',
            'inputPurchaseDate' => 'required|date|date_format:Y/m/d',
            'inputDescription' => 'required'
        ]);

        $product = new Product;
        $product->name = $request->inputName;
        $product->quantity = $request->inputQuantity;
        $product->company = $request->inputCompany;
        $product->type = $request->inputType;
        $product->price = $request->inputPrice;
        $product->label = $request->inputLabel;
        $product->purchase_date = $request->inputPurchaseDate;
        $product->description = $request->inputDescription;
        $product->created_at = new DateTime();

        if(! $product->save()){
            return redirect()->route('addProduct')->with('error','Product not saved....');
        }
        return redirect()->route('addProduct')->with('success','Product added successfully....');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
        return view('pages.listProducts');

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
