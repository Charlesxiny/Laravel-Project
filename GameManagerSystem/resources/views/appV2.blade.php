<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('page_title')</title>
    <meta name="description" content="">
    <meta name="author" content="templatemo">

    <link href="{{ URL::asset('css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/templatemo-style.css') }}" rel="stylesheet">
    <link href="{{ URL::asset('css/datepicker3.css') }}" rel="stylesheet">


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    @section('extension')
    @show
</head>
<body>
<!-- Left column -->
<div class="templatemo-flex-row">
    <div class="templatemo-sidebar">
        <header class="templatemo-site-header">
            <div class="square"></div>
            <h1>{{ session('username') }}</h1>
            <span style="color: white">(
                @if(session('privilege') == 1)
                    管理员
                @elseif(session('privilege') == 2)
                    商务
                @elseif(session('privilege') == 3)
                    策划
                @elseif(session('privilege') == 4)
                    运营
                @elseif(session('privilege') == 5)
                    开发
                @elseif(session('privilege') == 6)
                    测试
                @elseif(session('privilege') == 7)
                    项目经理
                @endif
            )</span>
        </header>
        <div class="profile-photo-container">
            <img src="{{ URL::asset('photo_img/' . session('photo_img'))}}" alt="Profile Photo" class="img-responsive">
            {{--<div class="profile-photo-overlay"></div>--}}
        </div>
        <!-- Search box -->
        {{--<form class="templatemo-search-form" role="search">--}}
            {{--<div class="input-group">--}}
                {{--<button type="submit" class="fa fa-search"></button>--}}
                {{--<input type="text" class="form-control" placeholder="Search" name="srch-term" id="srch-term">--}}
            {{--</div>--}}
        {{--</form>--}}

        {{--先占位--}}

        <div class="mobile-menu-icon">
            <i class="fa fa-bars"></i>
        </div>
        <nav class="templatemo-left-nav">
            <ul>
                <li><a href="{{ route('home') }}" class="@yield('main_page')"><i class="fa fa-home fa-fw"></i>我的主页</a></li>
                <li><a href="{{ route('require_list') }}" class="@yield('pro_manager_page')"><i class="fa fa-bar-chart fa-fw"></i>需求管理</a></li>
                <li><a href="{{ route('bug_list') }}" class="@yield('bug_manager_page')"><i class="fa fa-database fa-fw"></i>缺陷管理</a></li>
                <li><a href="{{ route('problems_list')  }}" class="@yield('integration_page')"><i class="fa fa-map-marker fa-fw"></i>持续集成</a></li>
                <li><a href="{{ route('user_list') }}" class="@yield('user_manager_page')"><i class="fa fa-users fa-fw"></i>用户管理</a></li>
                <li><a href="{{ route('invite_apply_list') }}" class="@yield('invite_page')"><i class="fa fa-sliders fa-fw"></i>邀请码管理</a></li>
                <li><a href="{{ route('show_ban_list') }}" class="@yield('account_page')"><i class="fa fa-bar-chart fa-fw"></i>玩家账号管理</a></li>
                <li><a href="{{ route('logout') }}"><i class="fa fa-eject fa-fw"></i>退出系统</a></li>
            </ul>
        </nav>
    </div>
    <!-- Main content -->
    <div class="templatemo-content col-1 light-gray-bg">
        @section('top_navigation')

        @show
            @section('main_content')

            @show
            <footer class="text-center">
                <p>Copyright &copy; 2017 Company Xenos CompanyManagerV2.
            </footer>
    </div>
</div>

<!-- JS -->
<script src="{{ URL::asset('js/jquery-1.11.2.min.js') }}"></script>      <!-- jQuery -->
<script src="{{ URL::asset('js/jquery-migrate-1.2.1.min.js')}}"></script> <!--  jQuery Migrate Plugin -->
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/templatemo-script.js')}}"></script>      <!-- Templatemo Script -->

</body>
</html>