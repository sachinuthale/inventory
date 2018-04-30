<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Consumer;
use DateTime;

class ConsumerController extends Controller
{
    /**
     * Store the Consumer
     *
     * @param  Request
     * @return Message
     */
    public function store(Request $request){
    	$validatedData = $request->validate([
            'inputName' => 'required',
            'inputContact' => 'required|numeric|digits_between:1,10|unique:consumers,contact',
            'inputEmail' => 'required|email|unique:consumers,email',
            'inputAddress' => '',            
        ]);

        $consumer = new Consumer();

        $consumer->name = $request->inputName;
        $consumer->contact = $request->inputContact;
        $consumer->email = $request->inputEmail;
        if(isset($request->inputAddress)){
        	$consumer->address = $request->inputAddress;
        }

        if(! $consumer->save()){
            return redirect()->route('addConsumer')->with('error','Consumer not saved....');
        }
        return redirect()->route('addConsumer')->with('success','Consumer added successfully....');
    }//end store 

    /**
     * Return the Consumer list for autosuggestion
     *
     * @param  searchQuery
     * @return JSON Response
     */
    public function searchConsumer(Request $request)
    {
        $query = $request->input('query');
        $data = Consumer::where('name','like','%'.$query.'%')->get();
        return response()->json($data);
    }
}
