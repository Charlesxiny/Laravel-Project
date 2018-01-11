<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 2017/5/2
 * Time: 11:22
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
                    <li><a href="{{ route('unseal_list') }}" class="active"> 解封记录</a></li>
                    @if(session('privilege') == 1 || session('privilege') == 4)
                    <li><a href="{{ route('add_ban') }}"> 封号</a></li>
                    @endif
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
            $('#send_modal').modal('show') ;
        }

    </script>
    <div class="templatemo-content-container">
        <div class="templatemo-content-widget no-padding">
            <div class="panel panel-default table-responsive">
                <table class="table table-striped table-bordered templatemo-user-table">
                    <thead>
                    <tr>
                        <th><a href="" class="white-text templatemo-sort-by">open_id <span class="caret"></span></a></th>
                        <th><a href="" class="white-text templatemo-sort-by">用户名 <span class="caret"></span></a></th>
                        <th><a href="" class="white-text templatemo-sort-by">所在大区 <span class="caret"></span></a></th>
                        <th><a href="" class="white-text templatemo-sort-by">封号时长 <span class="caret"></span></a></th>
                        <th><a href="" class="white-text templatemo-sort-by">封号原因 <span class="caret"></span></a></th>
                        <th><a href="" class="white-text templatemo-sort-by">解封理由 <span class="caret"></span></a></th>
                        <th><a href="" class="white-text templatemo-sort-by">操作人 <span class="caret"></span></a></th>
                        <th><a href="" class="white-text templatemo-sort-by">解封时间 <span class="caret"></span></a></th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>{{ $item->openid }}</td>
                            <td>{{ $item->username }}</td>
                            <td>{{ $item->area }}</td>
                            @if(intval($item->ban_time,10) < 12)
                                <td>
                                    {{ $item->ban_time }}个月
                                </td>
                            @elseif(intval($item->ban_time,10) >= 12)
                                <?php
                                $ban_time = intval($item->ban_time,10);
                                $ban_year = 0;
                                while ($ban_time >= 12){
                                    $ban_time -= 12;
                                    $ban_year += 1;
                                }
                                if ($ban_time != 0){
                                    echo '<td>' . $ban_year . '年' . $ban_time . '个月</td>';;
                                }else{
                                    echo '<td>' . $ban_year . '年';
                                }
                                ?>
                            @endif                            <td>{{ $item->ban_reason }}</td>
                            <td>{{ $item->unseal_reason }}</td>
                            <td>{{ $item->operator }}</td>
                            <td>{{ date('Y-m-d', $item->unseal_timestamp) }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $list->links() }}
        </div>
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

    <div class="modal fade" id="remark_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                <div class="modal-body" id="remark">
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


