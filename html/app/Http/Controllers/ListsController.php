<?php

namespace App\Http\Controllers;

use Twitter;

use Illuminate\Http\Request;

class ListsController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth.twitter');
    }

    public function index()
    {
        $lists = Twitter::getLists();

        return view('lists.index')
               ->with('lists', $lists);
    }

    public function statuses($id)
    {
        $timeline = Twitter::getListsStatuses([
            'list_id' => $id,
            'count' => 200
        ]);

        return view('lists.statuses')
               ->with('timeline', $timeline);
    }
}
