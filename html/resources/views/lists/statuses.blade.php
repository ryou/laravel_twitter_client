@extends('layouts.default')

@section('content')
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
