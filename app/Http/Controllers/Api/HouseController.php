<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\HouseRequest;
use App\Models\House;
use Illuminate\Support\Facades\Auth;

class HouseController extends Controller
{
    public function store(HouseRequest $request)
    {
        $house = House::create([
            'location' => $request->location,
            'size' => $request->size,
        ]);

        $house->owners()->create([
            'name' => Auth::user()->name,
        ]);

        return response()->json([
            'message' => 'Add',
        ]);
    }
}
