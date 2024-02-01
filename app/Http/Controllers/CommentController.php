<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function show($id)
    {
        $product = Product::with(['comments', 'user'])->findorfail($id);

        return response()->json([
            'product' => $product,
        ]);

    }

    public function comment(Commentrequest $request, $id)
    {

        Comment::create([
            'comments' => $request->comments,
            'product_id' => $id,
            'user_id' => Auth::user()->id,
        ]);

        return response()->json([
            'message' => 'You commented',
        ]);
    }
}
