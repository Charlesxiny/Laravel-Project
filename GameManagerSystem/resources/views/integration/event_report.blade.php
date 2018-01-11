<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 2017/4/29
 * Time: 18:38
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
                    <li><a class="" href="{{ route('problems_list') }}">问题列表</a></li>
                    <li><a class="active" href="{{ route('event_report') }}">数据上报</a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection

@section('main_content')
    <div class="templatemo-content-container">
        <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
                <i class="fa fa-times"></i>
                <div class="media margin-bottom-30">
                    <div class="media-body">
                        <h2 class="media-heading text-uppercase blue-text">数据上报</h2>
                    </div>
                </div>
                <button class="btn-primary" href="#" data-toggle="modal" data-target="#add_event">
                    新增上报
                </button><br><br>
                支持上报：<table class="table">
                    <tr>
                        <th>数据上报字段名称</th>
                        <th>参数1</th>
                        <th>参数2</th>
                        <th>参数3</th>
                        <th>参数4</th>
                    </tr>
                        @foreach($events as $item)
                        <tr>
                            <td>{{ $item->event_name }}</td>
                            <td>{{ $item->event_param1 }}</td>
                            <td>{{ $item->event_param2 }}</td>
                            <td>{{ $item->event_param3 }}</td>
                            <td>{{ $item->event_param4 }}</td>
                        </tr>
                        @endforeach
                </table>
                {{ $events->links() }}
                <br>
                上报次数：<table class="table">
                    <tr>
                        <th>参数名</th>
                        <th>上报次数</th>
                    </tr>
                    @for($i = 0; $i < count($events); $i++)
                        <tr>
                            <td>{{ $events[$i]->event_name }}</td>
                            <td>{{ $event_count[$i] }}</td>
                        </tr>
                    @endfor
                </table>
                {{ $events->links() }}
            </div>
        </div>

        <div class="templatemo-flex-row flex-content-row ">
            <div class="col-1">
                <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
                    <i class="fa fa-times"></i>
                    <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">User Table</h2></div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <td>No.</td>
                                <td>字段名</td>
                                <td>参数1</td>
                                <td>参数2</td>
                                <td>参数3</td>
                                <td>参数4</td>
                            </tr>
                            </thead>

                            <tbody>
                                @foreach($records as $item)
                                    <tr>
                                        <td>{{ $item->id }}</td>
                                        <td>{{ $item->event_name }}</td>
                                        <td>{{ $item->param1 }}</td>
                                        <td>{{ $item->param2 }}</td>
                                        <td>{{ $item->param3 }}</td>
                                        <td>{{ $item->param4 }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div> <!-- Second row ends -->

    </div>
    <div class="modal fade" id="add_event" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                <form method="post" action="{{ route('new_event') }}">
                    <div class="modal-body">
                            {{ csrf_field() }}
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="上报字段 英文+下划线表示" name="event_name">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="参数1" name="param1">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="参数2" name="param2">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="参数3" name="param3">
                            </div>
                            <div class="form-group">
                                <input class="form-control" type="text" placeholder="参数4" name="param4">
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
