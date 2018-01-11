@extends('appV2')
@section('page_title', '我的主页')
@section('main_page', 'active')

@section('top_navigation')
    <div class="templatemo-top-nav-container">
        <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
                <ul class="text-uppercase">
                    <li><a href="{{ route('home') }}" class="active">应用信息</a></li>
                    <li><a href="{{ route('home_member') }}">项目组成员</a></li>

                </ul>
            </nav>
        </div>
    </div>
@endsection

@section('main_content')
    <script src="{{ URL::asset('js/Chart.js') }}"></script>
<div class="templatemo-content-container">
    <div class="templatemo-flex-row flex-content-row">
        <div class="templatemo-content-widget white-bg col-1 text-center">
            <i class="fa fa-times"></i>
            <h2 class="text-uppercase">
                {{ $basic_info->game_name }}
            </h2>
            <a href="#" data-toggle="modal" data-target="#name_edit">编辑</a>
            <h3 class="text-uppercase margin-bottom-10">version {{ $new_version }}</h3>
            <a href="#" data-toggle="modal" data-target="#change_icon"><img src="{{ URL::asset('images/'. $basic_info->photo_img) }}" alt="Bicycle" class="img-circle img-thumbnail"></a>
            <br><br>
            @if(session('privilege') == 1 || session('privilege') == 7)
            <button class="btn-primary" data-toggle="modal" data-target="#new_version">
                新增版本
            </button>
            @endif
            @if(session('privilege') == 1 || session('privilege') == 7)
                <button class="btn-primary" data-toggle="modal" data-target="#version_manage">
                    版本管理
                </button>
            @endif
        </div>
        <div class="templatemo-content-widget white-bg col-2">
            <i class="fa fa-times"></i>
            <div class="square"></div>
            <h2 class="templatemo-inline-block">项目简介</h2>
            @if(session('privilege') == 1 || session('privilege') == 7)
                <a href="#" data-toggle="modal" data-target="#dec_edit">编辑</a><hr>
            @endif
            <p><h3>
            {{ $basic_info->game_dec }}
            </h3></p>
        </div>

        <div class="templatemo-content-widget white-bg col-1">
            <i class="fa fa-times"></i>
            <h2 class="text-uppercase">项目信息</h2>
            <h3 class="text-uppercase">本期进度</h3><hr>
            <h2 style="color: green;">【需求】</h2><br>
                <h3>总数：{{ $progress_bar['require_total'] }}</h3>
                <h3>已完成：{{ $progress_bar['require_finish'] }}</h3>
                <h3>进度：{{ ceil($progress_bar['require_finish']/$progress_bar['require_total'] *100) }}%</h3>

            <br><h2 style="color: red;">【缺陷】</h2><br>
                <h3>总数：{{ $progress_bar['bug_total'] }}</h3>
                <h3>已完成：{{ $progress_bar['bug_finish'] }}</h3>
                <h3>进度：{{ ceil($progress_bar['bug_finish']/$progress_bar['bug_total'] *100) }}%</h3>

        </div>

    </div>

    <div class="templatemo-flex-row flex-content-row ">
        <div class="col-1">
            <div class="templatemo-content-widget white-bg">
                <i class="fa fa-times"></i>
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object img-circle" src="{{ URL::asset('images/require.png') }}" alt="Sunset">
                        </a>
                    </div>
                    <div class="media-body">
                        <h2 class="media-heading text-uppercase">需求</h2>
                        @foreach($require_list as $item)
                            <p><a href="{{ route('require_detail', ['id'=>$item->id]) }}">{{ $item->title }}</a></p>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="templatemo-content-widget white-bg">
                <i class="fa fa-times"></i>
                <div class="media">
                    <div class="media-left">
                        <a href="#">
                            <img class="media-object img-circle" src="{{ URL::asset('images/repaire.png') }}" alt="Sunset">
                        </a>
                    </div>
                    <div class="media-body">
                        <h2 class="media-heading text-uppercase">缺陷</h2>
                        <ul>
                        @foreach($bug_list as $item)
                            <p><a href="{{ route('bug_detail', ['id'=>$item->id]) }}">{{ $item->title }}</a></p>
                        @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div> <!-- Second row ends -->

    <div class="templatemo-flex-row flex-content-row templatemo-overflow-hidden"> <!-- overflow hidden for iPad mini landscape view-->
        <div class="col-1 templatemo-overflow-hidden">
            <div class="templatemo-content-widget white-bg templatemo-overflow-hidden">
                <i class="fa fa-times"></i>
                <div class="templatemo-flex-row flex-content-row">
                    <div class="col-12 col-lg-12 col-md-12">

                        <h2 class="text-center">玩家活跃数量<span class="badge">new</span></h2>
                        <canvas id="canvas" height="600" width="1400"></canvas>
                        <div style="text-align:center;clear:both;">
                            <script src="/gg_bd_ad_720x90.js" type="text/javascript"></script>
                            <script src="/follow.js" type="text/javascript"></script>
                        </div>
                        <script>
                            var data_num = eval(<?php echo json_encode($active_num);?>);
                            var data_mon = eval(<?php echo json_encode($active_month);?>);
                            var lineChartData = {
                                labels : data_mon,
                                datasets : [
                                    {
                                        fillColor : "rgba(220,220,220,0.5)",
                                        strokeColor : "rgba(220,220,220,1)",
                                        pointColor : "rgba(220,220,220,1)",
                                        pointStrokeColor : "#fff",
                                        data : data_num
                                    },
                                    {
                                        fillColor : "rgba(151,187,205,0.5)",
                                        strokeColor : "rgba(151,187,205,1)",
                                        pointColor : "rgba(151,187,205,1)",
                                        pointStrokeColor : "#fff",
                                        data : data_num
                                    }
                                ]

                            }

                            var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Line(lineChartData);

                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
    <div class="modal fade" id="new_version" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                <form method="post" action="{{ route('new_version') }}">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" class="form-control" name="new_version" placeholder="输入版本号">
                            {{ csrf_field() }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="version_manage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                    <div class="modal-body">
                        点击版本号切换版本
                        @foreach($version_list as $item)
                            <div class="row">
                            <div class="form-group">
                                <div class="col-md-1"></div>
                                <a href="{{ route('change_version', ['id'=>$item->id]) }}"><button class="btn-primary col-md-2">
                                    {{ $item->version  }}
                                </button></a>
                                <div class="col-md-1"></div>
                                <a href="{{ route('del_version', ['id'=>$item->id]) }}"><button class="btn-danger col-md-2">
                                    删除
                                </button></a>
                                <div class="col-md-3"></div>
                            </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    </div>
            </div>
        </div>
    </div>
        <div class="modal fade" id="change_icon" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">提示</h4>
                    </div>
                    <form enctype="multipart/form-data" method="post" action="change_icon">
                        <div class="modal-body">
                            <div class="form-group">
                                <input type="file" class="form-control" name="icon">
                                <input type="hidden" value="{{ $basic_info->id }}" name="id">
                                {{ csrf_field() }}
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="submit" class="btn btn-primary">提交</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    <div class="modal fade" id="dec_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                <form method="post" action="{{ route('edit_dec') }}">
                    <div class="modal-body">
                        <div class="form-group">
                            游戏简介:
                            <textarea name="dec" class="form-control">

                            </textarea>
                            {{ csrf_field() }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="modal fade" id="name_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                <form method="post" action="{{ route('edit_name') }}">
                    <div class="modal-body">
                        <div class="form-group">
                            游戏名字:
                            <input type="text" class="form-control" name="name">
                            {{ csrf_field() }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection