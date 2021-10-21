<?php

namespace App\Http\Controllers;

use App\Models\Specialty;
use Illuminate\Http\Request;
use Throwable;

class SpecialtyController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 
            $specialty = Specialty::with("profession")->orderByDesc("id")->get();
            return response()->json($specialty, 200);
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
        $specialty = new Specialty();
        $specialty->name = $request["name"];
        $specialty->profession_id = $request["profession_id"];
        $specialty->save();

        return response()->json([
            "ok" => true, 
            "body" => $specialty, 
            "message" => "Especialidad registrada"
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $specialty = Specialty::find($id);

        return response()->json($specialty, 200);
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
        $specialty = Specialty::find($id);
        $specialty->name = $request["name"];
        $specialty->profession_id = $request["profession_id"];
        $specialty->save();

        return response()->json([
            "ok" => true, 
            "body" => $specialty, 
            "message" => "Especialidad actualizada"
        ], 201);
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
    }

    public function changeState($id)
    {
        $specialty = Specialty::find($id);
        $specialty->state =  !$specialty->state;
        $specialty->save();

        return response()->json(["ok" => true, "body" => $specialty, "message" => "Estado actualizado"], 200);
    }
}
