@extends('app')
@section('active_account', 'active')
@section('nav_title', '账号管理')
@section('title', '账户管理')
@section('sub_title', '封号')

@section('main_content')
    <script>
        function submitForm() {
            $('#ban_form').submit();
        }
    </script>
<form class="form-group" method="post" action="{{ route('ban_do') }}" id="ban_form">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    OpenID:<input type="text" class="form-control" name="openId"/><br>
    角色昵称：<input type="text" class="form-control" name="username">
    <select name="area" class="form-control">
        <option value="一区">一区</option>
        <option value="二区">二区</option>
        <option value="三区">三区</option>
    </select><br>
    封号时长：('月'以单位)<input type="text" class="form-control" name="ban_time"><br>
    封号理由：<br><textarea name="ban_reason" class="form-control"></textarea><br>
    <div class="form-group">
        <button class="btn btn-primary form-control" data-toggle="modal" data-target="#ban_modal" type="button">
            封号
        </button>
    </div>
    <div class="form-group">
        <button class="btn btn-danger form-control" type="reset">
            重置
        </button>
    </div>
</form>
<!-- Modal -->
<div class="modal fade" id="ban_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">提示</h4>
            </div>
            <div class="modal-body">
                确认要封号么？
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default"  data-dismiss="modal">关闭</button>
                <button type="button" class="btn btn-primary" onclick="submitForm()">确认</button>
            </div>
        </div>
    </div>
</div>

@endsection