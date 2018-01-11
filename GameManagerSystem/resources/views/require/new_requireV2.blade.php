@extends('appV2')
@section('page_title', '需求管理')
@section('pro_manager_page', 'active')

@section('top_navigation')
    <div class="templatemo-top-nav-container">
        <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
                <ul class="text-uppercase">
                    <li><a href="{{ route('require_list') }}">项目需求</a></li>
                    <li><a href="{{ route('require_list', ['username'=>session('username')]) }}">我负责的</a></li>
                    @if(session('privilege') == 1 || session('privilege') == 3 )
                        <li><a class="active" href="{{ route('require_list', ['username'=>session('username')]) }}">提出需求</a></li>
                @endif
            </nav>
        </div>
    </div>
@endsection

@section('main_content')
    <script>

    function submitForm() {
        $('#form_add').submit();
    }
    </script>
    <div class="templatemo-content-container">
    <div class="templatemo-flex-row flex-content-row">
        <div class="col-1">
            <div class="panel panel-default margin-10">
                <div class="panel-heading"><h2 class="text-uppercase">新增需求</h2></div>
                <div class="panel-body">
                    <form class="templatemo-login-form" method="post" action="{{ route('add_new_require') }}" id="form_add" enctype="multipart/form-data">
                        <div class="form-group">
                            标题:<input type="text" name="title" class="form-control">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>
                        <div class="form-group">
                            需求背景描述:<input type="text" name="bg_dec" class="form-control">
                        </div>
                        <div class="form-group">
                            需求描述:<textarea class="form-control" placeholder="少于255个字符" name="description"></textarea>
                        </div>
                        <div class="form-group">
                            需求目的:<input type="text" name="determine" class="form-control">
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
                        <div class="form-group">
                            优先级:<select name="remark" class="form-control">
                                <option value="高">高</option>
                                <option value="中">中</option>
                                <option value="低">低</option>
                            </select>
                        </div>
                        <div class="form-group">
                            需求文档：<input name="doc" type="file" class="form-control">
                        </div>
                        <div class="form-group">
                            截图上传：<input name="screen_shot" type="file" class="form-control">
                        </div>
                        <!-- Button trigger modal -->
                        <div class="form-group ">
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#add_pop">
                                添加
                            </button>

                                <input type="reset" class="btn btn-danger" value="重置">
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="add_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                        <h4 class="modal-title" id="myModalLabel">提示</h4>
                    </div>
                    <div class="modal-body">
                        确认要提交么？
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" onclick="submitForm()">提交</button>
                    </div>
                </div>
            </div>
        </div>
        </div>
@endsection