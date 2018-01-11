@extends('appV2')
@section('page_title', '缺陷管理')
@section('bug_manager_page', 'active')

@section('top_navigation')
    <div class="templatemo-top-nav-container">
        <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
                <ul class="text-uppercase">
                    <li><a href="{{ route('bug_list') }}">缺陷列表</a></li>
                    <li><a href="{{ route('bug_list', ['username'=>session('username')]) }}">我负责的</a></li>
                    @if(session('privilege') == 1 || session('privilege') == 6 )
                        <li><a class="active" href="{{ route('new_bug') }}">提出缺陷</a></li>
                    @endif
                </ul>
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
                    <div class="panel-heading"><h2 class="text-uppercase">提出缺陷</h2></div>
                    <div class="panel-body">
                        <form class="templatemo-login-form" method="post" action="{{ route('add_new_bug') }}" id="form_add" enctype="multipart/form-data">
                            <div class="form-group">
                                标题:<input type="text" name="title" class="form-control">
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            </div>
                            <div class="form-group">
                                缺陷描述:<textarea class="form-control" placeholder="少于255个字符" name="description"></textarea>
                            </div>
                            <div class="form-group">
                                出现版本:
                                <select name="version" class="form-control">
                                    @foreach($version as $ver)
                                        <option value="{{ $ver->version }}">{{ $ver->version }}</option>
                                    @endforeach
                                </select>
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
                                严重程度:<select name="danger" class="form-control">
                                    <option value="一般">一般</option>
                                    <option value="紧急">紧急</option>
                                    <option value="建议">建议</option>
                                    <option value="高">高</option>

                                </select>
                            </div>
                            <div class="form-group">
                                缺陷类型:
                                <select name="type" class="form-control">
                                    @foreach($bug_type as $item)
                                        <option value="{{ $item->id }}">{{ $item->bug_type }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                截图上传：<input name="screen_shot" type="file" class="form-control">
                            </div>
                            <!-- Button trigger modal -->
                            <div class="form-group row">
                                <div class="col-md-3"></div>
                                <button type="button" class="btn btn-success col-md-2" data-toggle="modal" data-target="#add_pop">
                                    添加
                                </button>
                                <div class="col-md-3"></div>

                                <input type="reset" class="btn btn-danger col-md-2" value="重置">
                                <div class="col-md-3"></div>

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