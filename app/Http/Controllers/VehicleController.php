<?php


namespace App\Http\Controllers;

use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function search(Request $request)
    {
        $query = Vehicle::query();

        if ($request->filled('make')) {
            $query->where('make', $request->input('make'));
        }

        if ($request->filled('model')) {
            $query->where('model', $request->input('model'));
        }

        if ($request->filled('registration')) {
            $query->where('registration', $request->input('registration'));
        }

        $vehicles = $query->get();

        return response()->json($vehicles);
    }
}