<!DOCTYPE html>
<html lang="ja" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
  <head>
    <meta charset="utf-8">
    <title>学習用TwitterWebクライアント</title>
    <meta name="description" content="page description">
    <meta name="keywords" content="page keywords">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="format-detection" content="telephone=no">
    <meta name="robots" content="noindex,nofollow">

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- COMMON CSS-->
    <link rel="stylesheet" href="/common/css/font-awesome.min.css">
    <link rel="stylesheet" href="/common/css/base.css" media="all">
    <link rel="stylesheet" href="/common/css/common.css" media="all">
    <link rel="stylesheet" href="/common/libs/lightbox/css/lightbox.min.css">
    <!-- PAGE ONLY CSS-->
  </head>
  <body>

    @yield('body')

    <!-- COMMON JS-->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.4/jquery.min.js"></script>
    <script>window.jQuery || document.write('<script src="/common/js/lib/jquery.min.js"><\\/script>')</script>
    <script src="/common/libs/lightbox/js/lightbox.min.js"></script>
    <script src="/common/js/common.js"></script>
    <!-- PAGE ONLY JS-->
  </body>
</html>
