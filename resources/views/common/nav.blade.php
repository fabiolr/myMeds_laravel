<div class="container">
  <div class="header clearfix">

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="dashboard.php">myMeds</a>

        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
          	<li {{ Request::path() == 'dash' ? ' class=active' : '' }}><a href="/dash">Dash</a></li>
            <li {{ Request::path() == 'about' ? ' class=active' : '' }}><a href="/about">About</a></li>
            <li {{ Request::path() == 'meds' ? ' class=active' : '' }}><a href="/meds">Meds</a></li>
            <li {{ Request::path() == 'mymeds' ? ' class=active' : '' }}><a href="/mymeds">My Meds</a></li>
            <li {{ Request::path() == 'symps' ? ' class=active' : '' }}><a href="/symps">Treatments</a></li>
            <li {{ Request::path() == 'friends' ? ' class=active' : '' }}><a href="/friends">Friends</a></li>
            <li {{ Request::path() == 'search' ? ' class=active' : '' }}><a href="/search">Search</a></li>
            <li {{ Request::path() == 'logout' ? ' class=active' : '' }}><a href="/logout">Logout</a></li>
          </ul>
          <p class="navbar-text navbar-right"><a href="#" class="navbar-link">{{ Auth::user()->name }}</a></p>

        </div><!--/.nav-collapse -->

      </div>
    </nav>
   
      <h3 class="text-muted">myMeds</h3><br>

    </div>
</div>
