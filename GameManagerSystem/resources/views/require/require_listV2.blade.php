@extends('appV2')
@section('page_title', '需求管理')
@section('pro_manager_page', 'active')
@section('top_navigation')
    <div class="templatemo-top-nav-container">
        <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
                <ul class="text-uppercase">
                    <li><a class="{{ $active_all }}" href="{{ route('require_list') }}">项目需求</a></li>
                    <li><a class="{{ $active_self }}" href="{{ route('require_list', ['username'=>session('username')]) }}">我负责的</a></li>
                    @if(session('privilege') == 1 || session('privilege') == 3 )
                        <li><a href="{{ route('new_require') }}">提出需求</a></li>
                    @endif
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
                    <div class="media-left padding-right-25">
                        <a href="#">
                            <img class="media-object img-circle templatemo-img-bordered" src="{{ URL::asset('images/pro_icon.png') }}" alt="Sunset">
                        </a>
                    </div>
                    <div class="media-body">
                        <h2 class="media-heading text-uppercase blue-text">需求总览</h2>
                        <p>version {{ session('version') }}</p>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table">
                        <tbody>
                        <tr>
                            <td><div class="circle green-bg"></div></td>
                            <td>需求总量</td>
                            <td>{{ $all }}</td>
                        </tr>
                        <tr>
                            <td><div class="circle pink-bg"></div></td>
                            <td>新增需求</td>
                            <td>{{ $new }}</td>
                        </tr>
                            <tr>
                                <td><div class="circle green-bg"></div></td>
                                <td>开发中</td>
                                <td>{{ $develope }}</td>
                            </tr>
                        <tr>
                            <td><div class="circle pink-bg"></div></td>
                            <td>完成需求</td>
                            <td>{{ $finish }}</td>
                        </tr>
                        <tr>
                            <td><div class="circle green-bg"></div></td>
                            <td>已拒绝</td>
                            <td>{{ $refuse }}</td>
                        </tr>
                        <tr>
                            <td><div class="circle pink-bg"></div></td>
                            <td>挂起</td>
                            <td>{{ $hold_on }}</td>
                        </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="templatemo-flex-row flex-content-row ">
            <div class="col-1">
                <div class="panel panel-default templatemo-content-widget white-bg no-padding templatemo-overflow-hidden">
                    <i class="fa fa-times"></i>
                    <div class="panel-heading templatemo-position-relative"><h2 class="text-uppercase">需求列表</h2></div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                            <tr>
                                <td>需求No.</td>
                                <td>需求标题</td>
                                <td>优先级</td>
                                <td>当前处理人</td>
                                <td>创建人</td>
                                <td>当前状态</td>
                                <td>创建时间</td>
                            </tr>
                            </thead>

                            <tbody>
                            @foreach($require_list as $item)
                                <tr>
                                    <td>{{$item->id}}</td>
                                    <td><a href="{{ route('require_detail', ['id'=>$item->id]) }}">{{ $item->title }}</a></td>
                                    @if($item->remark == '高')
                                        <td style="color: red">{{ $item->remark }}</td>
                                    @elseif($item->remark == '中')
                                        <td style="color: blue">{{ $item->remark }}</td>
                                    @else
                                        <td style="color: green">{{ $item->remark }}</td>
                                    @endif
                                    <td>{{ $item->dealing }}</td>
                                    <td>{{ $item->author }}</td>
                                    <td style="color: #00D2E7">{{ $item->status }}
                                    <td>{{ date("Y-m-d",$item->timestamp) }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                {{ $require_list->links() }}
            </div>
        </div> <!-- Second row ends -->

    </div>
@endsection
