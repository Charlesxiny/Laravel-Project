@extends('appV2')
@section('page_title', '我的主页')
@section('main_page', 'active')

@section('top_navigation')
    <div class="templatemo-top-nav-container">
        <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
                <ul class="text-uppercase">
                    <li><a href="{{ route('home') }}">应用信息</a></li>
                    <li><a href="{{ route('home_member') }}" class="active">项目组成员</a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection

@section('main_content')
    <script src="{{ URL::asset('js/Chart.js') }}"></script>

    <div class="templatemo-flex-row flex-content-row templatemo-overflow-hidden"> <!-- overflow hidden for iPad mini landscape view-->
        <div class="col-1 templatemo-overflow-hidden">
            <div class="templatemo-content-widget white-bg templatemo-overflow-hidden">
                <i class="fa fa-times"></i>
                <div class="templatemo-flex-row flex-content-row">
                    <div class="col-12 col-lg-12 col-md-12">

                        <h2 class="text-center">人员比例<span class="badge">new</span></h2>
                        <div class="row">
                            <canvas id="canvas" height="450" width="700" class="col-md-8"></canvas>
                            <div class="col-md-4">
                                <div style="width: 100px; height: 100px;"></div>
                                管理员：
                                <div style="width: 20px; height: 20px; background: #F38630; margin-left: 60px; margin-top: -20px"></div>
                                <p></p>
                                商务：
                                <div style="width: 20px; height: 20px; background: #E0E4CC; margin-left: 60px; margin-top: -20px"></div>
                                <p></p>
                                策划：
                                <div style="width: 20px; height: 20px; background: #fde19a; margin-left: 60px; margin-top: -20px"></div>
                                <p></p>
                                运营：
                                <div style="width: 20px; height: 20px; background: #FF2433; margin-left: 60px; margin-top: -20px"></div>
                                <p></p>
                                开发：
                                <div style="width: 20px; height: 20px; background: #F9D2E7; margin-left: 60px; margin-top: -20px"></div>
                                <p></p>
                                测试：
                                <div style="width: 20px; height: 20px; background: #00D2E7; margin-left: 60px; margin-top: -20px"></div>
                                <p></p>
                                项目经理：
                                <div style="width: 20px; height: 20px; background: #4422E7; margin-left: 60px; margin-top: -20px"></div>

                            </div>
                        </div>

                        <script>
                            var data_num = eval(<?php echo json_encode($member_num);?>);
                            var pieData = [
                                {
                                    value: data_num[0],
                                    color:"#F38630"
                                },
                                {
                                    value : data_num[1],
                                    color : "#E0E4CC"
                                },
                                {
                                    value : data_num[2],
                                    color : "#fde19a"
                                },
                                {
                                    value : data_num[3],
                                    color : "#FF2433"
                                },
                                {
                                    value : data_num[4],
                                    color : "#F9D2E7"
                                },
                                {
                                    value : data_num[5],
                                    color : "#00D2E7"
                                },
                                {
                                    value : data_num[6],
                                    color : "#4422E7"
                                }
                            ];

                            var myPie = new Chart(document.getElementById("canvas").getContext("2d")).Pie(pieData);

                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-1">
        <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
            <i class="fa fa-times"></i>
            <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">成员列表</h2></div>
            <div class="table-responsive">
                <table class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <td>No.</td>
                        <td>名字</td>
                        <td>部门</td>
                        <td>分机号</td>
                        <td>邮箱</td>
                        <td>职务</td>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($member as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->department }}</td>
                            <td>{{ $item->tel }}</td>
                            <td>{{ $item->email }}</td>
                            @if($item->privilege == 1)
                                <td>管理员</td>
                            @elseif($item->privilege == 2)
                                <td>商务</td>
                            @elseif($item->privilege == 3)
                                <td>策划</td>
                            @elseif($item->privilege == 4)
                                <td>运营</td>
                            @elseif($item->privilege == 5)
                                <td>开发</td>
                            @elseif($item->privilege == 6)
                                <td>测试</td>
                            @elseif($item->privilege == 7)
                                <td>项目经理</td>
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

@endsection