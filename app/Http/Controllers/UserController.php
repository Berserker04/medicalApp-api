<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function __construct()
    {
        $this->middleware('jwt.verify', ['except' => ['store', 'index']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users, 200)->withHeaders([
            "X-Total-Count" => count($users),
            "Access-Control-Expose-Headers" => "*"
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $employee = Employee::create([
            "firstName" => $request["firstName"],
            "lastName" => $request["lastName"],
            "cellPhone" => $request["cellPhone"],
            "specialty_id" => $request["specialty_id"],
            "profession_id" =>$request["profession_id"]
        ]);

      $user = User::create([
            "email" => $request["user"]["email"],
            "password" =>  Hash::make($request["user"]["password"]),
            "employee_id" => $employee->id,
            "role_id" =>  $request["user"]["role_id"],
            "state" => 1,
        ]);

        return response()->json($user, 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $user->password = Hash::make($request["user"]["password"]);
        $user->role_id = $request["user"]["role_id"];
        $user->state =  $request["user"]["state"];
        $user->save();

        $person = Employee::find($user->person_id);
        $person->firstName = $request["firstName"];
        $person->lastName = $request["lastName"];
        $person->cellPhone = $request["cellPhone"];
        $person->save();

        return response()->json($person,200);
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
        $user = User::find($id);
        $state = !$user->state;
        $user->state =  $state;
        $user->save();

        $message = $state == 1 ? "activado" : "desactivado";
        return response()->json($user, 200);
    }
}
