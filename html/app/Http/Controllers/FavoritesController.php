<?php

namespace App\Http\Controllers;

use Twitter;

use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function create(Request $request)
    {
        Twitter::postFavorite([
            'id' => $request->id
        ]);
    }

    public function destroy(Request $request)
    {
        Twitter::destroyFavorite([
            'id' => $request->id
        ]);
    }
}
