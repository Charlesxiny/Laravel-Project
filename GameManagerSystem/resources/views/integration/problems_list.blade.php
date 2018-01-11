<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 19/04/2017
 * Time: 18:08
 */
?>
@extends('appV2')
@section('page_title', '持续集成')
@section('integration_page', 'active')
@section('top_navigation')
    <div class="templatemo-top-nav-container">
        <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
                <ul class="text-uppercase">
                    <li><a class="active" href="{{ route('problems_list') }}">问题列表</a></li>
                    <li><a class="" href="{{ route('event_report') }}">数据上报</a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection
@section('main_content')
    <script>
        function onConfirm(id) {
            $('#confirm_add').modal('show') ;
            document.getElementById('idpass').value = id;
        }
    </script>
    <script src="{{ URL::asset('js/Chart.js') }}"></script>

    <div class="templatemo-content-container">
        <div class="templatemo-flex-row flex-content-row templatemo-overflow-hidden"> <!-- overflow hidden for iPad mini landscape view-->
            <div class="col-1 templatemo-overflow-hidden">
                <div class="templatemo-content-widget white-bg templatemo-overflow-hidden">
                    <i class="fa fa-times"></i>
                    <div class="templatemo-flex-row flex-content-row">
                        <div class="col-12 col-lg-12 col-md-12">

                            <h2 class="text-center">问题数量<span class="badge">ALL</span></h2>

                            <div class="row">
                                <canvas id="canvas" height="500" width="900" class="col-md-4"></canvas>

                                <div style="text-align:center;clear:both;">
                                    <script src="/gg_bd_ad_720x90.js" type="text/javascript"></script>
                                    <script src="/follow.js" type="text/javascript"></script>
                                </div>

                                <script>
                                    var data_time = eval(<?php echo json_encode($time_data);?>);
                                    var barChartData = {
                                        labels : ["过去第7天","过去第6天","过去第5天","过去第4天","过去第3天","前天","昨天"],
                                        datasets : [
                                            {
                                                fillColor : "rgba(151,187,205,0.5)",
                                                strokeColor : "rgba(151,187,205,1)",
                                                data : data_time
                                            }
                                        ]

                                    }
                                    var myLine = new Chart(document.getElementById("canvas").getContext("2d")).Bar(barChartData);

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
                    <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">持续集成</h2></div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <th>标题</th>
                                <th>问题类型</th>
                                <th>出现次数</th>
                                <th>出现版本</th>
                                <th>出现时间</th>
                                <th>影响机型</th>
                                <th>用户操作</th>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($problem_list as $item)
                                <tr>
                                <td>{{ $item->title }}</td>
                                <td>{{ $item->type }}</td>
                                <td>{{ $item->times }}次</td>
                                <td>{{ $item->version }}</td>
                                <td>{{ date('Y-m-d',$item->timestamp) }}</td>
                                    <td>{{ $item->machine_type }}</td>
                                   <td>
                                       @if(session('privilege') == 1 || session('privilege') == 6 || session('privilege') == 5)
                                           @if($item->status == 0)
                                                <button type="button" class="btn btn-primary form-control" onclick="onConfirm({{ $item->id }})">
                                                    添加
                                                </button>
                                           @else
                                               <button type="button" class="btn btn-primary form-control" onclick="onConfirm({{ $item->id }})" disabled>
                                                   已添加
                                               </button>
                                           @endif
                                       @else
                                           <button type="button" class="btn btn-primary form-control" onclick="onConfirm({{ $item->id }})" disabled>
                                               没有权限
                                           </button>
                                       @endif
                                   </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $problem_list->links() }}
            </div>
        </div> <!-- First row ends -->
        <div class="modal fade" id="confirm_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">提示</h4>
                    </div>
                    <form method="post" action="{{ route('add_to_bug') }}">
                    <div class="modal-body">
                        确认要提至缺陷列表吗？
                        <div class="form-group">
                            <input type="text" placeholder="其他描述" class="form-control" name="description">
                        </div>
                        <div class="form-group">
                        处理人:
                        <select name="dealing" class="form-control">
                            <option value="">空</option>
                            @foreach($dealing as $item)
                                <option value="{{ $item->username }}">{{ $item->username }}</option>
                            @endforeach
                        </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                            {{ csrf_field() }}
                            <input type="hidden" name="id" id="idpass">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="submit" class="btn btn-primary">提交</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection