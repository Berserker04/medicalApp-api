<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Person;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

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
        $users = User::with("employee.specialty.profession")->where("role_id", "=", 2)->get();
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
            "document" => $request["document"],
            "cellPhone" => $request["cellPhone"],
            "image" => "avatar.png",
            "specialty_id" => $request["specialty_id"],
            "profession_id" => $request["profession_id"]
        ]);

        $user = User::create([
            "email" => $request["user"]["email"],
            "password" =>  Hash::make($request["user"]["password"]),
            "employee_id" => $employee->id,
            "role_id" =>  $request["user"]["role_id"],
            "state" => 1,
        ]);

        return response()->json(["ok" => true, "body" => $employee, "message" => "Empleado registrado"], 201);
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
    public function show($id)
    {
        $user = User::with("employee.specialty.profession")->where("id", "=", $id)->get();

        if(count($user)>0){
            $user = $user[0];
        }   

        return response()->json(["ok" => true, "body" => $user, "message" => null], 200);
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
        $user = User::find($id);
        

        if($request["user"]["password"] != null){
            $user->password = Hash::make($request["user"]["password"]);
        }

        $user->role_id = $request["user"]["role_id"];
        $user->state =  $request["user"]["state"];
        $user->save();

        $employee = Employee::find($user->employee_id);

        if($employee->image != $request["image"]){
            $base_to_php = explode(',', $request["image"]);
            $image = base64_decode($base_to_php[1]);
            $imageName = Str::random(40) . '.' . 'jpg';
            Storage::disk('images')->put($imageName, $image);
            $employee->image = $imageName;
        }
        
        $employee->firstName = $request["firstName"];
        $employee->lastName = $request["lastName"];
        $employee->cellPhone = $request["cellPhone"];
        $employee->document = $request["document"];
        $employee->profession_id = $request["profession_id"];
        $employee->specialty_id = $request["specialty_id"];
        $employee->save();

        return response()->json(["ok" => true, "body" => $employee, "message" => "Usuario actualizado"], 200);
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
        $user->state =  !$user->state;
        $user->save();

        return response()->json(["ok" => true, "body" => $user, "message" => "Estado actualizado"], 200);
    }
}
