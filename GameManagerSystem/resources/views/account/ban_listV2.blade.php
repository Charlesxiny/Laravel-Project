<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 2017/5/2
 * Time: 10:22
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
                    <li><a href="{{ route('show_ban_list') }}" class="active"> 封号列表</a></li>
                    <li><a href="{{ route('unseal_list') }}"> 解封记录</a></li>
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
        function onUnseal(id) {
            document.getElementById('id_unseal').value = id;
            $('#unseal_modal').modal('show') ;
        }
        function onBanContinue(id) {
            document.getElementById('id_ban_continue').value = id ;
            $('#ban_continue_modal').modal('show') ;
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
                        <th><a href="" class="white-text templatemo-sort-by">操作人 <span class="caret"></span></a></th>
                        <th><a href="" class="white-text templatemo-sort-by">封号时间 <span class="caret"></span></a></th>
                        <th><a href="" class="white-text templatemo-sort-by">备注 <span class="caret"></span></a></th>
                        @if(session('privilege') == 1 || session('privilege') == 4)
                        <th><a href="" class="white-text templatemo-sort-by">操作 <span class="caret"></span></a></th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($list as $item)
                        <tr>
                            <td>{{ $item->openid }}</td>
                            <td>{{ $item->name }}</td>
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
                            @endif
                            <td>{{ $item->ban_reason }}</td>
                            <td>{{ $item->ban_user }}</td>
                            <td>{{ date('Y-m-d', $item->timestamp) }}</td>
                                @if($item->remark == '')
                                <td style="color: grey">
                                没有备注信息
                                </td>
                                @else
                                <td>{{ $item->remark }}</td>
                                @endif
                            @if(session('privilege') == 1 || session('privilege') == 4)
                            <td>
                                <button class="btn-primary" onclick="onUnseal({{ $item->openid }})">解封</button>
                                <button class="btn-primary" onclick="onBanContinue({{ $item->openid }})">续封</button>
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

    <div class="modal fade" id="ban_continue_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>

                <form method="post"  action="{{ route('ban_continue') }}">
                <div class="modal-body">
                    确定要续封么？
                    续封时长：
                    <div class="form-group">
                        <select class="form-control" name="ban_time">
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                            <option value="6">6</option>
                        </select>个月
                    </div>
                </div>
                    <div class="modal-footer">
                        {{ csrf_field() }}
                        <input type="hidden" name="openid" id="id_ban_continue">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">提交</button>

                </div>
                </form>

            </div>
        </div>
    </div>

    <div class="modal fade" id="unseal_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                <form method="post"  action="{{ route('unseal') }}">
                <div class="modal-body" id="remark">

                    <div class="form-group">确定要解封么？</div>
                    <div class="form-group">
                        <input type="text" name="unseal_reason" class="form-control" placeholder="解封理由">
                    </div>
                </div>
                    <div class="modal-footer">
                        {{ csrf_field() }}
                        <input type="hidden" name="openid" id="id_unseal">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">提交</button>
                </div>
                </form>

            </div>
        </div>
    </div>




@endsection

