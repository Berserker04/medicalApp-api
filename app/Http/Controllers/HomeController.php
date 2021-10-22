<?php

namespace App\Http\Controllers;

use App\Models\Profession;
use App\Models\Specialty;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $employees = User::where("role_id", "=", 2)->get()->count();

        $professions = Profession::count();

        $specialties = Specialty::count();

        return response()->json([
            "ok" => true, 
            "body" => [
                "employees" => $employees,
                "professions" => $professions,
                "specialties" => $specialties,
            ], 
            "message" => "Estadisticas"
        ], 200);
    }
}
