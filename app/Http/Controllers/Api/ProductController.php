<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\product\productRequest;
use App\Http\Resources\PrdouctResource;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(productRequest $request)
    {
        $user = Auth::user();
        dd($user);
        Product::create([
            'name' => $request->name,
            'price' => $request->price,
            'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => 'added succesfully',
        ]);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $product = Product::with('user')->findorfail($id);
        return PrdouctResource::make($product);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
