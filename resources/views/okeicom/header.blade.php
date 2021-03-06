<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width,initial-scale=1" />
    
        {{-- CSRF Token --}}
        <meta name="csrf-token" content="{{ csrf_token() }}">
    
        <title>@yield('title') - おけいcom</title>
        <meta name="description" content="@yield('description')">
    
        <meta name="description" content="">
    
        {{-- OGPタグ/twitterカード --}}
        <meta property="og:url" content="ページのURL" />
        <meta property="og:title" content="ページのタイトル" />
        <meta property="og:type" content="ページのタイプ">
        <meta property="og:description" content="記事の抜粋" />
        <meta property="og:image" content="画像のURL" />
        <meta name="twitter:card" content="カード種類" />
        <meta name="twitter:site" content="@Twitterユーザー名" />
        <meta property="og:site_name" content="サイト名" />
        <meta property="og:locale" content="ja_JP" />
        <meta property="fb:app_id" content="appIDを入力" />
        <link rel="shortcut icon" href="{{ asset('/img/common/favicon.png') }}" type="image/x-icon" />
        {{-- スマホ用アイコン画像 --}}
        <link rel="apple-touch-icon-precomposed" href="{{ asset('/img/common/favicon.png') }}" />
    
        {{-- Windows用タイル設定 --}}
        <meta name="msapplication-TileImage" content="画像のURL" />
        <meta name="msapplication-TileColor" content="カラーコード（例：#F89174）"/>
    
        {{-- フィードページの指定 --}}
        <link rel="alternate" type="application/rss+xml" title="フィード" href="フィードページのURL" />
    
        {{-- css --}}
        <link href="{{ asset('/css/okeicom/style.css') }}" rel="stylesheet" type="text/css">
        <link href="{{ asset('css/okeicom/header_style.css') }}" rel="stylesheet">
       
        @stack('css')
        {{-- vue --}}
        @stack('js')
    
    </head>
<body>
    <div id="app">
        @if(Auth::user())
            @if( Auth::user()->status == 0 )
              <header-user-component logout="{{ route('logout') }}" :csrf="{{ json_encode(csrf_token()) }}" user-img="{{ Auth::user()->img }}"></header-user-component>
            @elseif( Auth::user()->status == 1 )
              <header-teacher-component teacher-link="1" logout="{{ route('logout') }}" :csrf="{{ json_encode(csrf_token()) }}" user-img="{{ Auth::user()->img }}"></header-teacher-component>
            @endif
        @else
          <header-component :csrf="{{ json_encode(csrf_token()) }}"></header-component>
        @endif
    
        <main id="l-main">
          @yield('content')
        </main>
      </div>
    
       <!-- Global site tag (gtag.js) - Google Analytics -->
       <script type="application/javascript" async src="https://www.googletagmanager.com/gtag/js?id=G-7YT2K7JN1P"></script>
       <script>
           window.dataLayer = window.dataLayer || [];
           function gtag(){dataLayer.push(arguments);}
           gtag('js', new Date());
           gtag('config', 'G-7YT2K7JN1P', { 'send_page_view': false });
       </script>
       <!-- End Google Analytics -->
       
      @include("../common/footer")
</body>
</html>


