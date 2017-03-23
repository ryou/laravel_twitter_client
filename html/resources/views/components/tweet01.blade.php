<div class="m-tweet">
  @if (isset($retweeted))
    <div class="m-tweet_row">
      <div class="m-tweet_left">
        <div class="m-tweet_rt"><i class="fa fa-retweet"></i></div>
      </div>
      <!-- /.m-tweet_left -->
      <div class="m-tweet_right">
        <p class="m-tweet_rtuser">{{ $retweeted->name }}さんがリツイート</p>
      </div>
      <!-- /.m-tweet_right -->
    </div>
    <!-- /.m-tweet_row -->
  @endif
  <div class="m-tweet_row">
    <div class="m-tweet_left">
      <div class="m-tweet_icon"><img src="{{ $tweet->user->profile_image_url_https }}"></div>
    </div>
    <!-- /.m-tweet_left -->
    <div class="m-tweet_right">
      <div class="m-tweet_names">
        <span class="m-tweet_name">{{ $tweet->user->name }}</span>
        <span class="m-tweet_id">@<!---->{{ $tweet->user->screen_name }}</span>
      </div>
      <!-- /.m-tweet_names -->
      <p class="m-tweet_content">{{ $tweet->text }}</p>
      @if (isset($tweet->extended_entities->media))
      {{-- TODO: メディアタイプがphotoかどうかとか場合分けしたほうが良さげ --}}
      <div class="m-tweet_media">
        <ul class="m-tweet_photos m-tweet_photos-num{{ count($tweet->extended_entities->media) }}">
          @foreach ($tweet->extended_entities->media as $photo)
          <li>
            <a href="{{ $photo->media_url }}" data-lightbox="{{ $tweet->id_str }}"  style="background-image: url({{ $photo->media_url }});"></a>
          </li>
          @endforeach
        </ul>
        <!-- /.m-tweet_photos -->
      </div>
      <!-- /.m-tweet_media -->
      @endif
      <ul class="m-tweet_actions">
        <li>
          <span data-id="{{ $tweet->id_str }}" class="m-actionBtn m-actionBtn-rt {{ ($tweet->retweeted) ? 'is-active' : '' }}">
            <i class="fa fa-retweet"></i>
          </span>
        </li>
        <li>
          <span data-id="{{ $tweet->id_str }}" class="m-actionBtn m-actionBtn-fav {{ ($tweet->favorited) ? 'is-active' : '' }}">
            <i class="fa fa-heart"></i>
          </span>
        </li>
      </ul>
      <!-- /.m-tweet_actions -->
    </div>
    <!-- /.m-tweet_right -->
  </div>
  <!-- /.m-tweet_row -->
</div>
<!-- /.m-tweet -->
