<!-- Sidebar -->
<div class="navbar-default sidebar" role="navigation">
    <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
          <li align="center">
            <div class="col-sm-12 alert alert-info">
              <h3 class="animated fadeIn">Hello @if (!Auth::guest()) {{ Auth::user()->name }} @endif</h3>
            </div>
            <div class="col-sm-12 alert alert-success">
              <h4 class="animated fadeIn" id="date_now"></h4>
              <h4 class="animated fadeIn" id="weekday_now"></h4>
              <h4 class="animated fadeIn" id="jsclock"></h4>
            </div>
            <div class="col-sm-12 alert alert-warning">
              @if (!Auth::guest())
                @if(Auth::user()->admin)
                <h3 class="animated fadeIn">Role : Administrator</h3>
                <a href="{{{ url('/user') }}}" type="button" class="btn btn-block btn-warning">Permission Setup</a>
                <a href="{{{ url('/physical') }}}" type="button" class="btn btn-block btn-warning">Physical Setup</a>
                @elseif(Auth::user()->admin)
                <h3 class="animated fadeIn">Role : User</h3>
                @else
                <h3 class="animated fadeIn">Not Authorized</h3>
                @endif
              @endif
            </div>
          </li>
        </ul>
    </div>
</div>
