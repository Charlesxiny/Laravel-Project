@extends('app')
@section('active_require', 'active')
@section('nav_title', '需求列表')
@section('title', '添加需求')
@section('sub_title', '添加需求')

@section('main_content')
    <script>
        function submitForm() {
            $('#form_add').submit();
        }
    </script>

    <form method="post" action="{{ route('add_new_require') }}" id="form_add" enctype="multipart/form-data">
        <div class="form-group">
            标题:<input type="text" name="title" class="form-control">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </div>
        <div class="form-group">
            处理人:
            <select name="dealing" class="form-control">
                @foreach($dealing as $item)
                    <option value="{{ $item->username }}">{{ $item->username }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            优先级:<select name="remark" class="form-control">
                    <option value="非常高">非常高</option>
                    <option value="高">高</option>
                    <option value="一般">一般</option>
                    <option value="低">低</option>
                </select>
        </div>
        <div class="form-group">
            需求文档：<input name="doc" type="file" class="form-control">
        </div>
        <!-- Button trigger modal -->
        <div class="form-group">
            <button type="button" class="btn btn-success form-control" data-toggle="modal" data-target="#add_pop">
                添加
            </button>
        </div>
        <div class="form-group">
            <input type="reset" class="form-control btn btn-danger" value="重置">
        </div>
    </form>

    @endsection

    @section('other_content')
            <!-- Modal -->
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
@endsection