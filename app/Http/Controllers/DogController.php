<?php

namespace App\Http\Controllers;

use App\Dog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class DogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }


    public function create()
    {


    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::check()) {
            Dog::create([
                'regname' => request('regname'),
                'sire' => request('sire'),
                'dam' => request('dam')
            ]);

            return redirect('/');
        } else {
            return redirect('/login');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Dog $dog
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //

        return Dog::find($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Dog $dog
     * @return \Illuminate\Http\Response
     */
    public function edit(Dog $dog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        if(Auth::check()) {

            $dog = Dog::find($id);
            $dog->update(request()->all());


            return redirect("/dog/$id");
        }
        else {
            return redirect('/login');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Dog $dog
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::check()) {
            Dog::destroy($id);
            return redirect('/dog');
        }

        else{
            return redirect('/login');
        }
    }
}
