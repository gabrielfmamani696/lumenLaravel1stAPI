<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return response()->json(["users" => $users]);
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
        // validacion para la insercion de datos
        $this->validate($request, [
            'name'=>'required|string',
            'email'=>'required|email:rfc,dns|unique:users',
            'phone'=>'required|digits:10'
        ]);
        // insercion de datos
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        // pueden haber problemas en la tabla si el password se define
        // con un tamaño pequeño, pero no es asi en nuestro caso pq 
        // usamos sqlite
        $user->status = $request->status;
        $user->save();
        // devolvemos un json del request
        // return response()->json([$request]);

        // devolvemos el usuario que trabajamos
        return response()->json($user);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $user = User::where('id', $id)->get();
        if(count($user)<1){
            return response()->json(['error'=>'User Not Found']);
        }
        return response($user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
        // validacion para la insercion de datos
        $this->validate($request, [
            'name'=>'required|string',
            'email'=>'required|email:rfc,dns',
            'phone'=>'required|digits:10'
        ]);
        // insercion de datos
        $user = User::where('id', $id)->first();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->password = Hash::make($request->password);
        // pueden haber problemas en la tabla si el password se define
        // con un tamaño pequeño, pero no es asi en nuestro caso pq 
        // usamos sqlite
        $user->status = $request->status;
        $user->save();
        // devolvemos un json del request
        // return response()->json([$request]);

        // devolvemos el usuario que trabajamos
        return response()->json($user);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $user = User::where('id', $id)->first();
        if(!$user){
            return response()->json(['error'=> "User Not Found"]);
        }
        $userName = $user->name;
        $user->delete();
        return response()->json(["data" => "user $userName with id $id deleted succesfully"]);
    }
}
