<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet">

    <!--[if lt IE 9]>
    <script src="{{ URL::asset('js/respond.min.js') }}"></script>
    <![endif]-->

</head>

<body>
<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>


            <a class="navbar-brand" href="#"><span>游戏</span>管理系统</a>

            <ul class="user-menu">
                <li class="dropdown pull-right">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown"><span class="glyphicon glyphicon-user"></span> {{ session('username') }} <span class="caret"></span></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="" data-toggle="modal" data-target="#edit_password"><span class="glyphicon glyphicon-cog"></span>修改密码</a></li>
                        <li><a href="{{ route('logout') }}"><span class="glyphicon glyphicon-log-out"></span>注销</a></li>
                    </ul>
                </li>
            </ul>


        </div>
    </div><!-- /.container-fluid -->
</nav>

<div id="sidebar-collapse" class="col-sm-3 col-lg-2 sidebar">
    <form role="search">
        <select class="form-control" name="暮色先锋" id="暮色先锋">
            <option value="暮色先锋">暮色先锋</option>
            <option value="暮色先锋">天魔幻想</option>
        </select>
    </form>

    <ul class="nav menu">

        <li class="parent @yield('active_log')"  >
            <a href="#">
                <span class="glyphicon glyphicon-edit"></span>游戏日志<span data-toggle="collapse" href="#sub-item-1" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-1">
                <li onClick="javascript:main.location.href='/Mahatten/public/character_lv'">
                    <a class="" href="{{ route('character_log') }}">
                        <span class="glyphicon glyphicon-transfer" ></span>人物等级流水
                    </a>
                </li>
                <li onClick="javascript:main.location.href='gameLog/idealMoney_new.php'">
                    <a class="" href="{{ route('money_log') }}">
                        <span class="glyphicon glyphicon-usd" ></span>虚拟货币流水
                    </a>
                </li>
            </ul>
        </li>
        @if(session('privilege') == 1 || session('privilege') == 3)
            <li class="@yield('active_require')"><a href="{{ route('require_list') }}"><span class="glyphicon glyphicon-gift"></span>需求</a></li>
        @endif

        @if(session('privilege') == 1 || session('privilege') == 4)
        <li class="parent @yield('active_invite')">
            <a href="#">
                <span class="glyphicon glyphicon-copyright-mark"></span>邀请码管理<span data-toggle="collapse" href="#sub-item-4" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-4">
                <li>
                    <a class="" href="{{ route('invite_apply_list') }}">
                        <span class="glyphicon glyphicon-export" ></span>申请列表
                    </a>
                </li>
                <li>
                    <a class="" href="{{ route('invite_hand_list') }}">
                        <span class="glyphicon glyphicon-align-justify" ></span>发放列表
                    </a>
                </li>
            </ul>
        </li>
        @endif

        @if(session('privilege') == 1 || session('privilege') == 4)
        <li class="parent @yield('active_account')">
            <a href="#">
                <span class="glyphicon glyphicon-lock"></span>账号管理<span data-toggle="collapse" href="#sub-item-5" class="icon pull-right"><em class="glyphicon glyphicon-s glyphicon-plus"></em></span>
            </a>
            <ul class="children collapse" id="sub-item-5">
                <li>
                    <a class="" href="{{ route('show_ban') }}">
                        <span class="glyphicon glyphicon-export" ></span>封号
                    </a>
                </li>
                <li>
                    <a class="" href="{{ route('show_ban_list') }}">
                        <span class="glyphicon glyphicon-align-justify" ></span>解封
                    </a>
                </li>
            </ul>
        </li>
        @endif

        @if(session('privilege') == 1)
        <li class="@yield('active_user')"><a href="{{ route('user_list') }}"><span class="glyphicon glyphicon-bell"></span>用户管理</a></li>
        @endif
    </ul>
</div><!--/.sidebar-->

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <ol class="breadcrumb">
            <li><a href="#"><span class="glyphicon glyphicon-home"></span></a></li>
            <li class="active">@yield('nav_title')</li>
        </ol>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header">@yield('title')</h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
                <div class="panel-heading">@yield('sub_title')</div>
                @section('header_extension')
                @show
                <div class="panel-body">
                    @section('main_content')
                    @show
                </div>
            </div>
        </div>
    </div><!--/.row-->
    @section('other_content')
    @show

</div>
<!--/.main-->

<iframe id="main" name="main" frameborder="0" height="100%" width="100%" scrolling="auto" onload="this.height=main.document.body.scrollHeight"></iframe>
<script src="{{ URL::asset('js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>


<div class="modal fade" id="edit_password" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">修改密码</h4>
            </div>
            <form method="post" action="{{ route('edit_password_self') }}">

                <div class="modal-body">
                    <input type="password" name="new_password" placeholder="新密码" class="form-control">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">修改</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>

</html>
