    
<html lang="en">

  @include('common.head')

  <body>

    @include('common.nav_not_logged')

    <div class="container">
     
      @yield('content')

    </div><!-- /.container -->

    @include('common.foot')

  </body>

</html>