<nav class="ui menu">
      <a class="navbar-brand header item" href="{{ url('/') }}">
          统计数据  <small>tongjishuju.com</small>
      </a>
  <a href="/articles/" class="active item">文章列表</a>
  <a class="item">Link</a>
  <div class="right menu">
    <div class="item">
      <div class="ui action left icon input">
        <i class="search icon"></i>
        <input type="text" placeholder="Search">

      </div>
    </div>
    @if (Auth::guest())
    <a href="{{ url('/login') }}" class="item">Login</a>
    <a href="{{ url('/register') }}" class="item">Register</a>
    @else
    <a href="/admin" class="item">
        {{ Auth::user()->name }}
    </a>
    <a href="{{ url('/logout') }}" class="item"><i class="fa fa-btn fa-sign-out"></i>Logout</a>
    @endif
  </div>
</nav>
