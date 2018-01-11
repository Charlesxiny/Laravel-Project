<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 2017/5/1
 * Time: 18:18
 */
?>
@extends('appV2')
@section('page_title', '邀请码申请列表')
@section('invite_page', 'active')
@section('top_navigation')
    <div class="templatemo-top-nav-container">
        <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
                <ul class="text-uppercase">
                    <li><a href="{{ route('invite_apply_list') }}" class="active">邀请码申请列表</a></li>
                    <li><a href="{{ route('invite_hand_list') }}">邀请码发放列表</a></li>
                </ul>
            </nav>
        </div>
    </div>
@endsection

@section('main_content')
    <script>
        function onSend(id) {
            document.getElementById('id_pass_send').value = id ;
            $('#send_modal').modal('show') ;
        }
        function onDeny(id) {
            document.getElementById('id_pass_deny').value = id ;
            $('#deny_modal').modal('show') ;
        }
    </script>
    <div class="templatemo-content-container">
        <p style="text-align: right; padding-right: 40px; color: blue;">已发送：<span style="color: red">{{ $send_count }}</span>条</p>

        <div class="templatemo-content-widget no-padding">
            <div class="panel panel-default table-responsive">
                <table class="table table-striped table-bordered templatemo-user-table">
                    <thead>
                    <tr>
                        <th><a href="" class="white-text templatemo-sort-by">No. <span class="caret"></span></a></th>
                        <th><a href="" class="white-text templatemo-sort-by">账号 <span class="caret"></span></a></th>
                        <th><a href="" class="white-text templatemo-sort-by">用户名 <span class="caret"></span></a></th>
                        <th><a href="" class="white-text templatemo-sort-by">所在大区 <span class="caret"></span></a></th>
                        <th><a href="" class="white-text templatemo-sort-by">邮箱 <span class="caret"></span></a></th>
                        <th><a href="" class="white-text templatemo-sort-by">申请时间 <span class="caret"></span></a></th>
                        @if(session('privilege') == 1 || session('privilege') == 4)
                            <th><a href="" class="white-text templatemo-sort-by">操作 <span class="caret"></span></a></th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->account }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->area }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ date('Y-m-d H:i', $item->timestamp) }}</td>
                            @if(session('privilege') == 1 || session('privilege') == 4)
                                <td>
                                    <button type="button" class="btn btn-primary" onclick="onSend({{ $item->id }})">
                                        发送邀请码
                                    </button>

                                    <button type="button" class="btn btn-danger" onclick="onDeny({{ $item->id }})">
                                        拒绝
                                    </button>
                                </td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        {{ $list->links() }}
    </div>

    <div class="modal fade" id="send_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                <div class="modal-body">
                    确定要发送邀请码么？
                </div>
                <div class="modal-footer">
                    <form method="post"  action="{{ route('send_code') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_send" id="id_pass_send">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">提交</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="deny_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                <div class="modal-body">
                    确定要拒绝申请么？
                </div>
                <div class="modal-footer">
                    <form method="post"  action="{{ route('deny_invite') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id_deny" id="id_pass_deny">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">提交</button>
                    </form>

                </div>
            </div>
        </div>
    </div>



@endsection
