@extends('layouts.default')

@section('content')
  <div class="postBox">
    <form method="post" action="/statuses/update">
      {{ csrf_field() }}
      <div>
        <textarea name="status" placeholder="いまどうしてる？"></textarea>
      </div>
      <div class="u-align-right">
        <button type="submit" class="m-btn">送信</button>
      </div>
    </form>
  </div>
  <!-- /.postBox -->
  <ul class="m-tweetList">
    @foreach ($timeline as $index => $tweet)
    <li class="m-tweetList_item{{ ($index > 20) ? ' is-hidden' : '' }}">
      @if (isset($tweet->retweeted_status))
        @component('components.tweet01', [
          'tweet' => $tweet->retweeted_status,
          'retweeted' => $tweet->user
        ])
        @endcomponent
      @else
        @component('components.tweet01', ['tweet' => $tweet])
        @endcomponent
      @endif
    </li>
    @endforeach
  </ul>
  <!-- /.m-tweetList -->
@endsection
