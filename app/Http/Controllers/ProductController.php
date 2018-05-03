<?php

namespace App\Http\Controllers;

use DB;
use DateTime;
use App\Models\Product;
use App\Models\ProductEntry;
use App\Models\Consumer;
use App\Models\IssueProduct;
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

        DB::transaction(function() use ($request) {
            $product = new Product;
            $product->name = $request->inputName;
            $product->avl_quantity = $request->inputQuantity;
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

            $productEntry = new ProductEntry;
            $productEntry->productId = $product->id;
            $productEntry->quantity = $request->inputQuantity;
            $productEntry->added_date = date("Y-m-d");

            if(! $productEntry->save()){
                return redirect()->route('addProduct')->with('error','Product Entry not saved....');
            }
        });

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

    /**
     * Return the product list for autosuggestion
     *
     * @param  searchQuery
     * @return JSON Response
     */
    public function searchProducts(Request $request)
    {
        $query = $request->input('query');
        $data = Product::where('name','like','%'.$query.'%')->get();
        return response()->json($data);
    }

    /*
    * Save the issue product data
    *
    *
    *
    */
    public function issueProducts(Request $request)
    {
        $validatedData = $request->validate([
            'inputProductName' => 'required',
            'inputName' => 'required',
            'inputContact' => 'required',
            'inputEmail' => 'required|email',
            'inputIssueQuantity' => 'required|numeric|digits_between:1,4'
        ]);

        $issueProduct = new IssueProduct;

        $issueProduct->productId = $request->inputId;
        $issueProduct->consumerId = $request->inputConsumerId;
        $issueProduct->issuedQuantity = $request->inputIssueQuantity;
        $issueProduct->issued_at = new DateTime();
        $issueProduct->returned_at = NULL;
        $issueProduct->returnFlag = 1;

        $issueProduct->save();

        $product = Product::where('id', $request->inputId)->first();
        Product::where('id', $request->inputId)->update([
            'avl_quantity' => (($product->avl_quantity)-($request->inputIssueQuantity)),
        ]);

        //return response('success', 204);
    }

    /*
    * Update the quantity of product
    *
    *
    *
    */
    public function addQuantity(Request $request){
        $validatedData = $request->validate([
            'inputProductName' => 'required',
            'inputQuantity' => 'required|numeric|digits_between:1,4',
            'inputPurchaseDate' => 'required|date|date_format:Y/m/d'
        ]);

        $productEntry = new ProductEntry;
        $productEntry->productId = $request->inputId;
        $productEntry->quantity = $request->inputQuantity;
        $productEntry->added_date = date("Y-m-d");

        $productEntry->save();

        $product = Product::where('id', $request->inputId)->first();
        Product::where('id', $request->inputId)->update([
            'avl_quantity' => (($product->avl_quantity)+($request->inputQuantity)),
        ]);



    }
}
