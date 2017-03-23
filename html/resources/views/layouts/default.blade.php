@extends('layouts.meta')

@section('body')
  <header id="GHead">
    <div class="l-container">
      <ul class="gNav">
        <li>
          <a href="/"><i class="icon fa fa-home"></i><br>ホーム</a>
        </li>
        <li>
          <a href="/lists"><i class="icon fa fa-list"></i><br>リスト</a>
        </li>
        <li>
          <a href="/auth/logout"><i class="icon fa fa-sign-out"></i><br>ログアウト</a>
        </li>
      </ul>
      <!-- /.gNav -->
    </div>
    <!-- /.l-container -->
  </header>

  <div id="Contents">
    <div class="l-container">
      @yield('content')
    </div>
    <!-- /.l-container -->
  </div>
@endsection
