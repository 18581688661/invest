<nav class="navbar-default">
        <div class="container">
                <div class="navbar-header">
                    <a href="/" class="navbar-brand">清风理财</a>
                </div>
                <ul class="nav navbar-nav navbar-left">
                    <li><a href="#">项目列表</a></li>
                    <li><a href="#">平台公告</a></li>
                </ul>
                @if (Auth::user()->check())
                <div class="container">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="dropdown-toggle" data-toggle="dropdown">
                                {{ Auth::user()->get()->username }}
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('show')}}">个人中心</a></li>
                                <li class="divider"></li>
                                <li>
                                    <a id="logout" href="#">
                                        <form action="{{ route('logout') }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                                        </form>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                @elseif (Auth::manager()->check())
                <div class="container">
                    <ul class="nav navbar-nav navbar-right">
                        <li>
                            <a class="dropdown-toggle" data-toggle="dropdown">
                                {{ Auth::manager()->get()->mana_name }}
                                <span class="caret"></span>
                            </a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ route('user.show') }}">个人中心</a></li>
                                <li class="divider"></li>
                                <li>
                                    <a id="logout" href="#">
                                        <form action="{{ route('logout') }}" method="POST">
                                            {{ csrf_field() }}
                                            {{ method_field('DELETE') }}
                                            <button class="btn btn-block btn-danger" type="submit" name="button">退出</button>
                                        </form>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                @else
                <div class="container">
                    <ul class="nav navbar-nav navbar-right">
                      <li><a href="{{ route('login') }}">登录</a></li>
                      <li><a href="{{ route('signup') }}">注册</a></li>
                    </ul>
                </div>
                @endif
        </div>
</nav>