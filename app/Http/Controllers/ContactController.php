<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Contact::where('user_id', auth()->id())->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $contact = Contact::create([
            'name'=> $request->name,
            'celular'=> $request->celular,
            'whatsapp'=> $request->whatsapp,
            'email'=>$request->email,
            'user_id' => auth()->id(),
        ]);
        $response=[
            'contact'=>$contact            
        ];

        return response($response, 201);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Contact::where('id',$id)->where('user_id',auth()->id())->firstOrFail();

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $contact = Contact::where('id',$id)->where('user_id',auth()->id())->firstOrFail();

        $contact->update([
            'name'=> $request->name,
            'celular'=> $request->celular,
            'whatsapp'=> $request->whatsapp,
            'email'=>$request->email,
        ]);

        $response=[
            'contact'=>$contact            
        ];

        return response($response, 201);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $contact = Contact::where('id',$id)->where('user_id',auth()->id())->firstOrFail();

        $contact->destroy($id);

        $response=[
            'contact'=>$contact            
        ];

        return response($response, 201);
    }
}
