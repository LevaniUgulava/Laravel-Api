<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CarRequest;
use App\Models\Car;
use Illuminate\Support\Facades\Auth;

class CarController extends Controller
{
    public function store(CarRequest $request)
    {
        $car = Car::create([
            'name' => $request->name,
            'model' => $request->model,
            'year' => $request->year,

        ]);

        $car->owners()->create([
            'name' => Auth::user()->name,
        ]);

        return response()->json([
            'message' => 'Add Car!',
        ]);
    }
}
