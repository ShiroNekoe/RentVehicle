<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    // GET /api/vehicles
    public function index()
    {
        $vehicles = Vehicle::with('galleries')->latest()->get();
        return response()->json($vehicles);
    }

    // GET /api/vehicles/{id}
    public function show($id)
    {
        $vehicle = Vehicle::with('galleries')->findOrFail($id);
        return response()->json($vehicle);
    }
}
