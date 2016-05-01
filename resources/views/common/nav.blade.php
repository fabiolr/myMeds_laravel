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
            <li {{ Request::path() == 'meds' ? ' class=active' : '' }}><a href="/meds">Meds</a></li>
            <li {{ Request::path() == 'mymeds' ? ' class=active' : '' }}><a href="/mymeds">My Meds</a></li>
            <li {{ Request::path() == 'uses' ? ' class=active' : '' }}><a href="/uses">Uses</a></li>
            <li {{ Request::path() == 'friends' ? ' class=active' : '' }}><a href="/friends">Friends</a></li>
            <li {{ Request::path() == 'search' ? ' class=active' : '' }}><a href="#">Search</a></li>
         


          </ul>
          <form action="/search" class="navbar-form navbar-left" role="search">
            <div class="form-group">
             <input name="q" type="text" class="form-control" placeholder="Search">
            </div>
            <button type="submit" class="btn btn-default">Go</button>
          </form>
          <div class="navbar-text navbar-right"><a href="#" class="navbar-link">{{ Auth::user()->name }}</a>   <a class="navbar-link" href="/logout"><span class="glyphicon glyphicon glyphicon-log-out" aria-hidden="true"></span></a></di>

        </div><!--/.nav-collapse -->

      </div>
    </nav>
   
      <h3 class="text-muted">myMeds</h3><br>

    </div>
</div>
