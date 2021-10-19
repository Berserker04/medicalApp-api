<?php

namespace App\Http\Controllers;

use App\Models\Permit;
use App\Models\Role;
use App\Models\RolePermit;
use Illuminate\Http\Request;

class RoleController extends Controller
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
        $roles = Role::with("permits.permit")
            ->where("user_id", "=", auth()->user()->id)
            ->orderBy('id', 'DESC')
            ->get();

        return response()->json(["ok" => true, "roles" => $roles], 200);
    }

    public function listPermits()
    {
        $permits = Permit::orderBy('id', 'DESC')->get();

        return response()->json(["ok" => true, "permits" => $permits, 200]);
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
        $role = new Role();
        $role->name = $request["name"];
        $role->user_id = $request["user_id"];
        $role->state = 1;
        $role->save();

        return response()->json(["ok" => true, "newRol" => $role, "message" => "registro exitoso"], 201);
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
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
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
        $role = Role::find($id);
        $role->name = $request["name"];
        // $role->user_id = $request["user_id"];

        foreach ($request["permits"] as $key => $value) {
            $rolePermit = new RolePermit();
            $rolePermit->role_id = $role->id;
            $rolePermit->permit_id = $value;
            $rolePermit->save();
        }

        foreach ($request["deletePermits"] as $key => $value) {
            $rolePermit = RolePermit::find($value);
            $rolePermit->delete();
        }

        $role->save();

        return response()->json(["ok" => true, "newRol" => $role, "message" => "actualización exitosa"], 200);
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
        $role = Role::find($id);
        $state = !$role->state;
        $role->state =  $state;
        $role->save();

        $message = $state == 1 ? "activado" : "desactivado";
        return response()->json(["ok" => true, "newRol" => $role, "message" => "Estado " . $message], 200);
    }
}
