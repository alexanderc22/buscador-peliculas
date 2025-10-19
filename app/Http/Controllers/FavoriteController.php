<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'imdb_id' => 'required|string',
            'title' => 'required|string',
            'year' => 'nullable|string',
            'poster' => 'nullable|string',
        ]);

        $user = Auth::user();

        $exists = Favorite::where('user_id', $user->id)
            ->where('imdb_id', $request->imdb_id)
            ->exists();

        if ($exists) {
            return back()->with('error', 'Esta película ya está en tus favoritos.');
        }

        Favorite::create([
            'user_id' => $user->id,
            'imdb_id' => $request->imdb_id,
            'title' => $request->title,
            'year' => $request->year,
            'poster' => $request->poster,
        ]);

        return back()->with('success', 'Película agregada a favoritos.');
    }

    public function destroy($id)
    {
        $favorite = Favorite::where('id', $id)
            ->where('user_id', Auth::id())
            ->firstOrFail();

        $favorite->delete();

        return back()->with('success', 'Película eliminada de favoritos.');
    }

    public function index()
    {
        $favorites = Favorite::where('user_id', Auth::id())->get();
        return view('favorites.index', compact('favorites'));
    }
}
