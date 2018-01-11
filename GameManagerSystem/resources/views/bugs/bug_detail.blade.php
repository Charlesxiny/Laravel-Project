@extends('appV2')
@section('page_title', '缺陷管理')
@section('bug_manager_page', 'active')

@section('top_navigation')
    <div class="templatemo-top-nav-container">
        <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
                <ul class="text-uppercase">
                    <li><a href="{{ route('bug_list') }}" class="active">缺陷列表</a></li>
                    <li><a href="{{ route('bug_list', ['username'=>session('username')]) }}">我负责的</a></li>
                    @if(session('privilege') == 1 || session('privilege') == 6 )
                        <li><a href="{{ route('new_bug') }}">提出缺陷</a></li>
                @endif
            </nav>
        </div>
    </div>
@endsection
@section('extension')
    <style>
        .mdcontent h2 {
            font-size: 24px;
            border-bottom: 1px solid #cccccc;
            color: black; }
        .mdcontent p, .mdcontent blockquote, .mdcontent ul, .mdcontent ol, .mdcontent dl, .mdcontent li, .mdcontent table, .mdcontent pre {
            margin: 15px 0; }

        .mdcontent hr {
            background: transparent url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAAYAAAAECAYAAACtBE5DAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAAyJpVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMC1jMDYwIDYxLjEzNDc3NywgMjAxMC8wMi8xMi0xNzozMjowMCAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNSBNYWNpbnRvc2giIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OENDRjNBN0E2NTZBMTFFMEI3QjRBODM4NzJDMjlGNDgiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OENDRjNBN0I2NTZBMTFFMEI3QjRBODM4NzJDMjlGNDgiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo4Q0NGM0E3ODY1NkExMUUwQjdCNEE4Mzg3MkMyOUY0OCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo4Q0NGM0E3OTY1NkExMUUwQjdCNEE4Mzg3MkMyOUY0OCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PqqezsUAAAAfSURBVHjaYmRABcYwBiM2QSA4y4hNEKYDQxAEAAIMAHNGAzhkPOlYAAAAAElFTkSuQmCC) repeat-x 0 0;
            border: 0 none;
            color: #cccccc;
            height: 4px;
            padding: 0;
        }
        .mdcontent > h2:first-child {
            margin-top: 0;
            padding-top: 0; }
        .mdcontent > h1:first-child {
            margin-top: 0;
            padding-top: 0; }
        .mdcontent > h1:first-child + h2 {
            margin-top: 0;
            padding-top: 0; }
        .mdcontent > h3:first-child, body > h4:first-child, body > h5:first-child, body > h6:first-child {
            margin-top: 0;
            padding-top: 0; }

        .mdcontent a:first-child h1, a:first-child h2, a:first-child h3, a:first-child h4, a:first-child h5, a:first-child h6 {
            margin-top: 0;
            padding-top: 0; }
        .mdcontent body {
            font-family: Helvetica, arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
            padding-top: 10px;
            padding-bottom: 10px;
            background-color: white;
            padding: 30px; }
        .mdcontent > *:first-child {
            margin-top: 0 !important; }
        .mdcontent > *:last-child {
            margin-bottom: 0 !important; }
        .mdcontent h1, .mdcontent h2, .mdcontent h3, .mdcontent h4, .mdcontent h5, .mdcontent h6 {
            margin: 20px 0 10px;
            padding: 0;
            font-weight: bold;
            -webkit-font-smoothing: antialiased;
            cursor: text;
            position: relative; }

        .mdcontent h1:hover .mdcontent a.anchor, .mdcontent h2:hover .mdcontent a.anchor, .mdcontent h3:hover .mdcontent a.anchor, .mdcontent h4:hover a.anchor, .mdcontent h5:hover a.anchor, h6:hover a.anchor {
            background: url(data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAAAGXRFWHRTb2Z0d2FyZQBBZG9iZSBJbWFnZVJlYWR5ccllPAAAA09pVFh0WE1MOmNvbS5hZG9iZS54bXAAAAAAADw/eHBhY2tldCBiZWdpbj0i77u/IiBpZD0iVzVNME1wQ2VoaUh6cmVTek5UY3prYzlkIj8+IDx4OnhtcG1ldGEgeG1sbnM6eD0iYWRvYmU6bnM6bWV0YS8iIHg6eG1wdGs9IkFkb2JlIFhNUCBDb3JlIDUuMy1jMDExIDY2LjE0NTY2MSwgMjAxMi8wMi8wNi0xNDo1NjoyNyAgICAgICAgIj4gPHJkZjpSREYgeG1sbnM6cmRmPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5LzAyLzIyLXJkZi1zeW50YXgtbnMjIj4gPHJkZjpEZXNjcmlwdGlvbiByZGY6YWJvdXQ9IiIgeG1sbnM6eG1wPSJodHRwOi8vbnMuYWRvYmUuY29tL3hhcC8xLjAvIiB4bWxuczp4bXBNTT0iaHR0cDovL25zLmFkb2JlLmNvbS94YXAvMS4wL21tLyIgeG1sbnM6c3RSZWY9Imh0dHA6Ly9ucy5hZG9iZS5jb20veGFwLzEuMC9zVHlwZS9SZXNvdXJjZVJlZiMiIHhtcDpDcmVhdG9yVG9vbD0iQWRvYmUgUGhvdG9zaG9wIENTNiAoMTMuMCAyMDEyMDMwNS5tLjQxNSAyMDEyLzAzLzA1OjIxOjAwOjAwKSAgKE1hY2ludG9zaCkiIHhtcE1NOkluc3RhbmNlSUQ9InhtcC5paWQ6OUM2NjlDQjI4ODBGMTFFMTg1ODlEODNERDJBRjUwQTQiIHhtcE1NOkRvY3VtZW50SUQ9InhtcC5kaWQ6OUM2NjlDQjM4ODBGMTFFMTg1ODlEODNERDJBRjUwQTQiPiA8eG1wTU06RGVyaXZlZEZyb20gc3RSZWY6aW5zdGFuY2VJRD0ieG1wLmlpZDo5QzY2OUNCMDg4MEYxMUUxODU4OUQ4M0REMkFGNTBBNCIgc3RSZWY6ZG9jdW1lbnRJRD0ieG1wLmRpZDo5QzY2OUNCMTg4MEYxMUUxODU4OUQ4M0REMkFGNTBBNCIvPiA8L3JkZjpEZXNjcmlwdGlvbj4gPC9yZGY6UkRGPiA8L3g6eG1wbWV0YT4gPD94cGFja2V0IGVuZD0iciI/PsQhXeAAAABfSURBVHjaYvz//z8DJYCRUgMYQAbAMBQIAvEqkBQWXI6sHqwHiwG70TTBxGaiWwjCTGgOUgJiF1J8wMRAIUA34B4Q76HUBelAfJYSA0CuMIEaRP8wGIkGMA54bgQIMACAmkXJi0hKJQAAAABJRU5ErkJggg==) no-repeat 10px center;
            text-decoration: none; }

        .mdcontent h1 tt, .mdcontent h1 code {
            font-size: inherit; }

        .mdcontent h2 tt, .mdcontent h2 code {
            font-size: inherit; }

        .mdcontent h3 .mdcontent tt, .mdcontent h3 code {
            font-size: inherit; }

        .mdcontent h4 tt, .mdcontent h4 code {
            font-size: inherit; }

        .mdcontent h5 tt, .mdcontent h5 code {
            font-size: inherit; }

        .mdcontent h6 tt, .mdcontent h6 code {
            font-size: inherit; }
        .mdcontent pre code {
            margin: 0;
            padding: 0;
            white-space: pre;
            border: none;
            background: transparent; }
        .mdcontent pre {
            background-color: #f8f8f8;
            border: 1px solid #cccccc;
            font-size: 13px;
            line-height: 19px;
            overflow: auto;
            padding: 6px 10px;
            border-radius: 3px; }
        .mdcontent pre code, .mdcontent pre tt {
            background-color: transparent;
            border: none; }
    </style>
@endsection
@section('main_content')
    <div class="templatemo-content-container">
        <div class="templatemo-flex-row flex-content-row">
            <div class="templatemo-content-widget white-bg col-2">
                <i class="fa fa-times"></i>
                <div class="mdcontent">

                    <h2 id="toc_0"> @if($detail->danger == '紧急')
                            <span style="color: red">紧急</span>
                        @elseif($detail->danger == '高')
                            <span style="color: blue">高</span>
                        @elseif($detail->danger == '一般')
                            <span style="color: green">一般</span>
                        @elseif($detail->danger == '建议')
                            <span style="color: green">建议</span>
                        @endif

                        【需求】{{ $detail->title }}        </h2>

                    <div><pre><code class="language-none">
                                创建时间:  {{ date('Y-m-d H:i', $detail->timestamp) }}
                                创建人：   {{ $detail->author }}
                                当前处理人：{{ $detail->dealing }}
                                优先级：   {{ $detail->danger }}
                                当前状态： {{ $detail->status }}
                                缺陷类型:  {{ $bug_type }}</code></pre>
                    </div>
                    <hr>

                    <h3>【发现版本】</h3>
                    <p style="padding-left: 54px">{{ $detail->version }}</p>

                    <h3>【需求描述】</h3>
                    <p style="padding-left: 54px">{{ $detail->description }}</p><br>
                    @if($detail->screen_shot != '')
                        <img src="{{ URL::asset('bug_image/' . $detail->screen_shot) }}">
                    @endif

                </div>
            </div>
        </div>
        @if($detail->status != '已拒绝' || $detail->status != '完成')
            <div class="templatemo-flex-row flex-content-row">
                <div class="col-1">
                    <div class="panel panel-default margin-10">
                        <div class="panel-heading"><h2 class="text-uppercase">下一状态</h2></div>
                        <div class="panel-body">
                            <form action="{{ route('deal_bug') }}" class="templatemo-login-form" method="post">
                                <div class="row form-group">
                                    <div class="col-lg-12 form-group">
                                        @if($detail->status == '新')
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="change_status" id="r4" value="新" checked>
                                                <label for="r4" class="font-weight-400"><span></span>保持当前状态</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="change_status" id="r5" value="接受">
                                                <label for="r5" class="font-weight-400"><span></span>接受</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="change_status" id="r6" value="已拒绝">
                                                <label for="r6" class="font-weight-400"><span></span>拒绝</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="change_status" id="r7" value="挂起">
                                                <label for="r7" class="font-weight-400"><span></span>挂起</label>
                                            </div>
                                        @elseif($detail->status == '接受')
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="change_status" id="r4" value="接受" checked>
                                                <label for="r4" class="font-weight-400"><span></span>保持当前状态</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="change_status" id="r5" value="已解决">
                                                <label for="r5" class="font-weight-400"><span></span>已解决</label>
                                            </div>
                                        @elseif($detail->status == '已解决')
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="change_status" id="r4" value="已解决" checked>
                                                <label for="r4" class="font-weight-400"><span></span>保持当前状态</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="change_status" id="r5" value="已自测">
                                                <label for="r5" class="font-weight-400"><span></span>已自测</label>
                                            </div>
                                        @elseif($detail->status == '已自测')
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="change_status" id="r4" value="已自测" checked>
                                                <label for="r4" class="font-weight-400"><span></span>保持当前状态</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="change_status" id="r5" value="完成">
                                                <label for="r5" class="font-weight-400"><span></span>完成</label>
                                            </div>
                                        @elseif($detail->status == '挂起')
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="change_status" id="r4" value="挂起" checked>
                                                <label for="r4" class="font-weight-400"><span></span>保持当前状态</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="change_status" id="r5" value="新">
                                                <label for="r5" class="font-weight-400"><span></span>重新打开</label>
                                            </div>
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="change_status" id="r6" value="已拒绝">
                                                <label for="r6" class="font-weight-400"><span></span>拒绝</label>
                                            </div>
                                        @elseif($detail->status == '完成')
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="change_status" id="r4" value="完成" checked>
                                                <label for="r4" class="font-weight-400"><span></span>保持当前状态</label>
                                            </div>
                                        @elseif($detail->status == '已拒绝')
                                            <div class="margin-right-15 templatemo-inline-block">
                                                <input type="radio" name="change_status" id="r4" value="已拒绝" checked>
                                                <label for="r4" class="font-weight-400"><span></span>保持当前状态</label>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                {{--<div class="form-group">--}}
                                {{--<label>变更状态:</label>--}}
                                {{--<select class="form-control" name="change_status">--}}
                                {{--@if($detail->status == '开发中')--}}
                                {{--<option value="保持当前状态">保持当前状态</option>--}}
                                {{--<option value="已完成">已完成</option>--}}
                                {{--<option value="已自测">已自测</option>--}}
                                {{--@elseif($detail->status == '规划中')--}}
                                {{--<option value="保持当前状态">保持当前状态</option>--}}
                                {{--<option value="开发中">开发中</option>--}}
                                {{--<option value="已拒绝">已拒绝</option>--}}
                                {{--@elseif($detai->status == '已完成')--}}
                                {{--<option value="保持当前状态">保持当前状态</option>--}}
                                {{--<option value="已自测">已自测</option>--}}
                                {{--@elseif($detail->status == '已自测')--}}
                                {{--<option value="保持当前状态">保持当前状态</option>--}}
                                {{--<option value="完成需求">完成测试</option>--}}
                                {{--@endif--}}
                                {{--</select>--}}
                                {{--</div>--}}
                                <div class="form-group">
                                    <label for="inputEmail">处理人<span style="color: red">*</span></label>
                                    <input type="hidden" name="id" value="{{ $detail->id  }}">
                                    <select class="form-control" name="deal_to">
                                        @foreach($user_list as $user)
                                            <option>{{ $user->username }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="templatemo-blue-button">流转</button>
                                </div>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </form>
                        </div>
                    </div>
                </div>
            </div> <!-- Second row ends -->
        @endif

    </div>
@endsection
