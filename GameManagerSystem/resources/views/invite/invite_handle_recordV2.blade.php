<?php
/**
 * Created by PhpStorm.
 * User: Xenos
 * Date: 2017/5/1
 * Time: 22:54
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
                <li><a href="{{ route('invite_apply_list') }}">邀请码申请列表</a></li>
                <li><a href="{{ route('invite_hand_list') }}" class="active">邀请码发放列表</a></li>
            </ul>
        </nav>
    </div>
</div>
@endsection

@section('main_content')
<script>
    function onDel(id) {
        document.getElementById('id_pass_del').value = id ;
        $('#del_modal').modal('show') ;
    }
    function onDelAdvance(key) {
        if (key == 0){
            document.getElementById('control').value = 0;
            document.getElementById('msg').innerHTML = '要删除所有已使用邀请码记录么？';
        }else{
            document.getElementById('control').value = 1;
            document.getElementById('msg').innerHTML = '要删除所有邀请码记录么？';
        }
        $('#del_adv_modal').modal('show') ;
    }
</script>
<div class="templatemo-content-container">
    <div class="templatemo-content-widget no-padding">
        <button type="button" class="btn btn-primary" onclick="onDelAdvance(0)">
            删除已使用邀请码
        </button>
        <button type="button" class="btn btn-primary" onclick="onDelAdvance(1)">
            删除所有记录
        </button>
        <br>
        <div class="panel panel-default table-responsive">
            <table class="table table-striped table-bordered templatemo-user-table">
                <thead>
                <tr>
                    <th><a href="" class="white-text templatemo-sort-by">No. <span class="caret"></span></a></th>
                    <th><a href="" class="white-text templatemo-sort-by">用户名 <span class="caret"></span></a></th>
                    <th><a href="" class="white-text templatemo-sort-by">所在大区 <span class="caret"></span></a></th>
                    <th><a href="" class="white-text templatemo-sort-by">邀请码 <span class="caret"></span></a></th>
                    <th><a href="" class="white-text templatemo-sort-by">使用状态 <span class="caret"></span></a></th>
                    <th><a href="" class="white-text templatemo-sort-by">发放时间 <span class="caret"></span></a></th>
                    <th><a href="" class="white-text templatemo-sort-by">操作 <span class="caret"></span></a></th>
                </tr>
                </thead>
                <tbody>
                @foreach($list as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td>{{ $item->username }}</td>
                    <td>{{ $item->area }}</td>
                    <td>{{ $item->invite_code }}</td>
                    @if($item->status == 0)
                        <td style="color: green">未使用</td>
                    @else
                        <td style="color: red">已使用</td>
                    @endif
                    <td>{{ date('Y-m-d H:i', $item->timestamp) }}</td>
                    <td>
                        @if($item->status == 1)
                            <button type="button" class="btn btn-primary" onclick="onDel({{ $item->id }})">
                                删除记录
                            </button>
                        @elseif($item->status == 0)
                            <button type="button" class="btn btn-primary" onclick="onDel({{ $item->id }})">
                                回收邀请码
                            </button>
                        @endif
                    </td>
                </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{ $list->links() }}
</div>

<div class="modal fade" id="del_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">提示</h4>
            </div>
            <div class="modal-body">
                确定要删除本条记录么？
            </div>
            <div class="modal-footer">
                <form method="post"  action="{{ route('send_code') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="id" id="id_pass_del">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">提交</button>
                </form>

            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="del_adv_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel">提示</h4>
            </div>
            <div class="modal-body" id="msg">
            </div>
            <div class="modal-footer">
                <form method="post"  action="{{ route('del_advance') }}">
                    {{ csrf_field() }}
                    <input type="hidden" name="control" id="control">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">提交</button>
                </form>

            </div>
        </div>
    </div>
</div>



@endsection

