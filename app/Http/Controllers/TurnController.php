<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Date;

class TurnController extends Controller
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
        $employees = User::where("role_id", "=", 2)->get();
        $auxEmployees = $employees;
        $totalEmployees = count($employees);

        $totalPatients = $request["totalPatients"];
        $totalTimeByType = $request["totalTimeByType"];
        $totalTimeGeneral = $request["totalTimeGeneral"];
        $employeesByDay = $request["employeesByDay"];
        $patients = $request["patients"];

        $timeByEmployee = $totalTimeByType / $totalEmployees;

        $day = 1;

        $turns = collect([]);

        foreach ($patients as $key => $item) {

            for ($i = 0; $i < $employeesByDay; $i++) {
                $employee_id = $this->getEmployee($auxEmployees, $turns);
                $turns->push([
                    "day" => $day,
                    "date" => new Date(),
                    "employee_id" => $employee_id,
                    "timeStart" => $day,
                    "timeEnd" => $day,
                    "state" => 1,
                ]);

                $index = null;

                for ($i = 0; $i < count($auxEmployees); $i++) {
                    if ($index == $auxEmployees[$i]) {
                        $index = $i;
                        break;
                    }
                }

                array_splice($auxEmployees, $index, 1);
            }
            $day++;
        }

        return response()->json(["ok" => true, "body" => count($turns), "message" => "Turnos aginados con exito"], 201);
    }

    public function getEmployee($auxEmployees, $turns)
    {
        $employee_id = null;
        $max = 0;

        while ($employee_id == null && $max < 100) {


            $max++;
        }

        return $employee_id;
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
}
