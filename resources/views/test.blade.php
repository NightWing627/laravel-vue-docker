<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
@include("./common/head")
<body>
  <div id="app">
    <nav-bar-component
        :url={{ $url }}
        :csrf={{ json_encode(csrf_token()) }}
        :nav_items={{ $nav_items }} />
    <main id="l-main">
      @yield('content')
      @unless(Request::is('/'))
        @include("./common/lead")
      @endunless
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
   
  @include("./common/footer")
</body>
</html>
