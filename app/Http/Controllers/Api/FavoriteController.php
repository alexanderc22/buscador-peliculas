<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())->get();
        return response()->json($favorites);
    }

    public function store(Request $request)
    {
        $request->validate([
            'imdb_id' => 'required|string',
            'title' => 'required|string',
            'year' => 'nullable|string',
            'poster' => 'nullable|string',
        ]);

        $exists = Favorite::where('user_id', Auth::id())
            ->where('imdb_id', $request->imdb_id)
            ->exists();

        if ($exists) {
            return response()->json(['message' => 'Already in favorites'], 409);
        }

        $favorite = Favorite::create([
            'user_id' => Auth::id(),
            'imdb_id' => $request->imdb_id,
            'title' => $request->title,
            'year' => $request->year,
            'poster' => $request->poster,
        ]);

        return response()->json($favorite, 201);
    }

    public function destroy($imdb_id)
    {
        $favorite = Favorite::where('user_id', Auth::id())
            ->where('imdb_id', $imdb_id)
            ->first();

        if (!$favorite) {
            return response()->json(['error' => 'Favorite not found'], 404);
        }

        $favorite->delete();

        return response()->json(['message' => 'Favorite removed']);
    }
}
