<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profession;

class ProfessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('jwt.verify');
    }

    public function index()
    {
        $profession = Profession::orderByDesc("id")->get();
        return response()->json($profession, 200)->withHeaders([
            "X-Total-Count" => count($profession),
            "Access-Control-Expose-Headers" => "*"
        ]);
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
        $profession = new Profession();
        $profession->name = $request["name"];
        $profession->save();

        return response()->json([
            "ok" => true, 
            "body" => $profession, 
            "message" => "Profesión registrada"
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
        $profession = Profession::find($id);

        return response()->json($profession, 200);
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
        $profession = Profession::find($id);
        $profession->name = $request["name"];
        $profession->save();

        return response()->json(["ok" => true, "body" => $profession, "message" => "Profesión actalizada"], 200);
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
        $profession = Profession::find($id);
        $profession->state =  !$profession->state;
        $profession->save();

        return response()->json(["ok" => true, "body" => $profession, "message" => "Estado actualizado"], 200);
    }
}
