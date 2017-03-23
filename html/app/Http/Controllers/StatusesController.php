<?php

namespace App\Http\Controllers;

use Twitter;
use Redirect;

use Illuminate\Http\Request;

class StatusesController extends Controller
{
    public function __construct()
    {
      $this->middleware('auth.twitter');
    }

    public function homeTimeline()
    {
        $timeline = Twitter::getHomeTimeline([
            'count' => 200
        ]);

        return view('statuses.home_timeline')
               ->with('timeline', $timeline);
    }

    public function update(Request $request)
    {
        // ツイートはpostTweet()で行う
        // 引数は配列
        // status => ツイート内容
        Twitter::postTweet([
            'status' => $request->status
        ]);
        // 一覧ページへリダイレクト
        return Redirect::route('statuses.home_timeline');
    }

    public function retweet(Request $request)
    {
        Twitter::postRt($request->id);
    }

    public function unretweet(Request $request)
    {
        Twitter::post('statuses/unretweet/' . $request->id, []);
    }
}
