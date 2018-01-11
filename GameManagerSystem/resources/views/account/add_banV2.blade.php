<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 2017/5/2
 * Time: 16:50
 */
?>

@extends('appV2')
@section('page_title', '玩家账号管理')
@section('account_page', 'active')
@section('top_navigation')
    <div class="templatemo-top-nav-container">
        <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
                <ul class="text-uppercase">
                    <li><a href="{{ route('show_ban_list') }}"> 封号列表</a></li>
                    <li><a href="{{ route('unseal_list') }}"> 解封记录</a></li>
                    @if(session('privilege') == 1 || session('privilege') == 4)
                    <li><a href="{{ route('add_ban') }}" class="active"> 封号</a></li>
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
    </div>
    <div class="templatemo-flex-row flex-content-row">
        <div class="col-1">
            <div class="panel panel-default margin-10">
                <div class="panel-heading"><h2 class="text-uppercase">封号</h2></div>
                <div class="panel-body">
                    <form id="form_add" method="post" action="{{ route('add_ban_do')}}" class="templatemo-login-form">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            openid:<input type="text" name="openid" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            用户名: <input type="text" name="username" value="" id="pwd" class="form-control">
                        </div>
                        <div class="form-group">
                            所在大区: <input type="text" name="area" value="" id="re_pwd" class="form-control">
                        </div>
                        <div class="form-group">
                            封号时长: <input type="text" name="ban_time" value="" class="form-control">个月
                        </div>

                        <div class="form-group">
                            封号理由:<input type="text" name="ban_reason" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            备注:<textarea class="form-control" name="remark">
                            </textarea>
                        </div>
                        <p id="tip">

                        </p>
                        <div class="form-group row">
                            <div class="col-md-3"></div>
                            <button type="button" class="templatemo-blue-button col-md-2" data-toggle="modal" data-target="#confirm_add">提交</button>
                            <div class="col-md-3"></div>
                            <a href="{{ route('user_list') }}"><button type="button" class="templatemo-white-button col-md-2">返回</button></a>
                            <div class="col-md-2"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!-- Second row ends -->
    <div class="modal fade" id="confirm_add" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
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



