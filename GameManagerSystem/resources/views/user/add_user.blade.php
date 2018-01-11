@extends('app')
@section('active_user', 'active')
@section('nav_title', '用户管理')
@section('title', '添加用户')
@section('sub_title', '添加用户')

@section('main_content')
<script>
    function submitForm() {
        $('#form_add').submit();
    }
</script>



    <form method="post" action="{{ route('add_new_user') }}" id="form_add">
        <div class="form-group">
            用户名:<input type="text" name="username" class="form-control">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
        </div>
        <div class="form-group">
            密码:<input type="password" name="password" class="form-control">
        </div>
        <div class="form-group">
            部门:<input type="text" name="department" class="form-control">
        </div>
        <div class="form-group">
            权限:<select name="privilege" class="form-control">
                @foreach($privilege as $item)
                    <option value="{{ $item->id }}">{{ $item->privilege }}</option>
                @endforeach
            </select>
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
                确认要添加么？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">添加</button>
            </div>
        </div>
    </div>
</div>
@endsection