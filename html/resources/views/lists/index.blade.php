@extends('layouts.default')

@section('content')
<ul class="m-list01">
  @foreach ($lists as $list)
  <li class="m-list01_item"><a href="/lists/statuses/{{ $list->id_str }}">{{ $list->name }}</a></li>
  @endforeach
</ul>
@endsection
