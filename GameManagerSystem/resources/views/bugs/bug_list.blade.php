@extends('appV2')
@section('page_title', '缺陷管理')
@section('bug_manager_page', 'active')
@section('top_navigation')
    <div class="templatemo-top-nav-container">
        <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
                <ul class="text-uppercase">
                    <li><a class="{{ $active_all }}" href="{{ route('bug_list') }}">缺陷列表</a></li>
                    <li><a class="{{ $active_self }}" href="{{ route('bug_list', ['username'=>session('username')]) }}">我负责的</a></li>
                @if(session('privilege') == 1 || session('privilege') == 6 )
                        <li><a href="{{ route('new_bug') }}">提出缺陷</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endsection

@section('main_content')
    <script src="{{ URL::asset('js/Chart.js') }}"></script>

    <div class="templatemo-content-container">
        <div class="templatemo-flex-row flex-content-row templatemo-overflow-hidden"> <!-- overflow hidden for iPad mini landscape view-->
            <div class="col-1 templatemo-overflow-hidden">
                <div class="templatemo-content-widget white-bg templatemo-overflow-hidden">
                    <i class="fa fa-times"></i>
                    <div class="templatemo-flex-row flex-content-row">
                        <div class="col-12 col-lg-12 col-md-12">

                            <h2 class="text-center">缺陷类型<span class="badge">ALL</span></h2>

                            <div class="row">
                                <canvas id="canvas" height="450" width="600" class="col-md-4"></canvas>
                                <div class="col-md-4">
                                    <div style="width: 100px; height: 100px;"></div>
                                    技术实现错误：
                                    <div style="width: 20px; height: 20px; background: #F38630; margin-left: 120px; margin-top: -20px"></div>
                                    <p></p>
                                    需求方案缺陷：
                                    <div style="width: 20px; height: 20px; background: #E0E4CC; margin-left: 120px; margin-top: -20px"></div>
                                    <p></p>
                                    美术UI设计缺陷：
                                    <div style="width: 20px; height: 20px; background: #fde19a; margin-left: 120px; margin-top: -20px"></div>
                                    <p></p>
                                    配置表错误：
                                    <div style="width: 20px; height: 20px; background: #FF2433; margin-left: 120px; margin-top: -20px"></div>
                                    <p></p>
                                    其他：
                                    <div style="width: 20px; height: 20px; background: #F9D2E7; margin-left: 120px; margin-top: -20px"></div>
                                    <p></p>
                                    玩家非法操作：
                                    <div style="width: 20px; height: 20px; background: #00D2E7; margin-left: 120px; margin-top: -20px"></div>
                                    <p></p>
                                    GM工具修改错无：
                                    <div style="width: 20px; height: 20px; background: #4422E7; margin-left: 120px; margin-top: -20px"></div>

                                </div>
                                <div style="text-align:center;clear:both;">
                                    <script src="/gg_bd_ad_720x90.js" type="text/javascript"></script>
                                    <script src="/follow.js" type="text/javascript"></script>
                                </div>
                                <script>
                                    var dataArr = eval(<?php echo json_encode($bug_type_arr);?>);
                                    var doughnutData = [
                                        {
                                            value: dataArr[0],
                                            color:"#F38630"
                                        },
                                        {
                                            value : dataArr[1],
                                            color : "#E0E4CC"
                                        },
                                        {
                                            value : dataArr[2],
                                            color : "#fde19a"
                                        },
                                        {
                                            value : dataArr[3],
                                            color : "#FF2433"
                                        },
                                        {
                                            value : dataArr[4],
                                            color : "#F9D2E7"
                                        },
                                        {
                                            value : dataArr[5],
                                            color : "#00D2E7"
                                        },
                                        {
                                            value : dataArr[6],
                                            color : "#4422E7"
                                        }

                                    ];

                                    var myDoughnut = new Chart(document.getElementById("canvas").getContext("2d")).Doughnut(doughnutData);

                                </script>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="templatemo-flex-row flex-content-row ">
            <div class="col-1">
                <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
                    <i class="fa fa-times"></i>
                    <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">缺陷管理</h2></div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>缺陷No.</th>
                                <th>缺陷标题</th>
                                <th>优先级</th>
                                <th>出现版本</th>
                                <th>当前状态</th>
                                <th>提出时间</th>
                                <th>创建人</th>
                                <th>当前处理人</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($bug_list as $item)
                                <tr>
                                <td>{{$item->id}}</td>
                                <td style="width: 700px"><a href="{{ route('bug_detail', ['id'=>$item->id]) }}">{{ $item->title }}</a></td>
                                @if($item->danger == '紧急')
                                <td style="color: purple">{{ $item->danger }}</td>
                                @elseif($item->danger == '高')
                                <td style="color: red">{{ $item->danger }}</td>
                                @elseif($item->danger == '一般')
                                <td style="color: blue">{{ $item->danger }}</td>
                                    @elseif($item->danger == '建议')
                                        <td style="color: darkgray">{{ $item->danger }}</td>
                                @endif
                                <td>{{ $item->version}}</td>
                                <td style="color: deepskyblue;" >{{ $item->status }}</td>
                                    <td>{{ date("Y-m-d",$item->timestamp) }}</td>
                                    <td>{{ $item->author }}</td>
                                    <td>{{ $item->dealing }}</td>

                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $bug_list->links() }}
            </div>
        </div> <!-- First row ends -->
    </div>
@endsection
