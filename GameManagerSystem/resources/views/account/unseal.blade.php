@extends('app')
@section('active_account', 'active')
@section('nav_title', '账户管理')
@section('title', '账户列表')
@section('sub_title', '解封列表')

@section('main_content')
     <script>
         function delConfirm(id){
             $('#openid').val(id);
             $('#unseal_pop').modal('show');
         }
     </script>
    <table class="table table-striped">
        <tr>
            <th>OpenID</th>
            <th>昵称</th>
            <th>所在大区</th>
            <th>封号时长</th>
            <th>封号理由</th>
            <th>操作人</th>
            <th>操作时间</th>
            <th>&nbsp;&nbsp;操作</th>
        </tr>
        <tbody>
        @foreach($ban_list as $item)
            <tr>
                <td>{{ $item->openid }}</td>
                <td>{{ $item->name }}</td>
                <td>{{ $item->area }}</td>
                <td>{{ $item->ban_time }}个月</td>
                <td>{{ $item->ban_reason }}</td>
                <td>{{ $item->ban_user }}</td>
                <td>{{ date('Y-m-d H:i', $item->timestamp) }}</td>
                <td>
                    <button type="button" class="btn btn-danger form-control" onclick="delConfirm({{ $item->openid }})">
                        解封
                    </button>
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
     {{ $ban_list->links() }}

@endsection

@section('other_content')
        <!-- Modal -->
    <div class="modal fade" id="unseal_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                <form method="post" action="{{ route('unseal') }}" id="unseal">
                <div class="modal-body">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="hidden" id="openid" name="openid">
                    确认要解封么？
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                    <button type="submit" class="btn btn-primary">确认</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endsection