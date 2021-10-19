<?php

namespace App\Http\Controllers;

use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationController extends Controller
{
    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['show', 'update', 'store']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $publications = Publication::orderBy('id', 'DESC')
            ->get();

        return response()->json($publications, 200)->withHeaders([
            "X-Total-Count" => count($publications),
            // "Content-Range"=> 25,
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
        // ["Admin" ,"Client"];

        $publication = new Publication();
        $publication->title = $request["title"];
        $publication->description = $request["description"];
        $publication->user_id = $request["user_id"];
        $publication->state = 1;
        $publication->save();

        return response()->json($publication, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $publication = Publication::find($id);

        return response()->json($publication, 200)->withHeaders([
            "Access-Control-Expose-Headers" => "*"
        ]);
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
        $publication = Publication::find($id);
        $publication->title = $request["title"];
        $publication->description = $request["description"];
        $publication->save();

        return response()->json($publication, 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
    }

    public function changeState($id)
    {
        try {
            $publication = Publication::find($id);
            $state = !$publication->state;
            $publication->state =  $state;
            $publication->save();

            $message = $state == 1 ? "activado" : "desactivado";
        } catch (\Throwable $th) {
            return response()->json(["ok" => false, "newPublication" => $publication, "message" => "Error"], 500);
        }

        return response()->json(["ok" => true, "newPublication" => $publication, "message" => "Estado " . $message], 200);
    }
}
