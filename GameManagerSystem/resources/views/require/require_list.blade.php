@extends('app')
@section('active_require', 'active')
@section('nav_title', '需求列表')
@section('title', '需求列表')
@section('sub_title', '需求列表')

@section('header_extension')
    <div class="panel-heading">
            @if(session('privilege') == 1 || session('privilege') == 3)
            <a href="{{ route('new_require') }}">
                <button class="btn btn-primary" type="button">
                    添加新需求
                </button>
            </a>
            @else
                <button class="btn btn-default" type="button" disabled>
                    添加新需求
                </button>
            @endif
    </div>
@endsection

@section('main_content')
    <script>
        function sendConfirm(id){
            $('#id').val(id);
            $('#accept_pop').modal('show');
        }
    </script>
    <table class="table table-striped">
        <tr>
            <th>编号</th>
            <th>标题</th>
            <th>需求文件</th>
            <th></th>
            <th>发起人</th>
            <th>处理人</th>
            <th>提出时间</th>
            <th>备注</th>
            <th>当前状态</th>
            <th>操作</th>
        </tr>
        <tbody>
        @foreach($require as $item)
            <tr>
                <td>{{ $item->id }}</td>
                <td><a href="#">{{ $item->title }}</a></td>
                <td>{{ $item->file_name }}</td>
                <td><a href="{{ route('require_doc_download', ['file_name'=>$item->file_name]) }}">点击下载</a></td>
                <td>{{ $item->author }}</td>
                <td>{{ $item->dealing }}</td>
                <td>{{ date('Y-m-d H:i', $item->timestamp) }}</td>
                <td>{{ $item->remark }}</td>
                @if($item->status == -1)
                    <td>未处理</td>
                @elseif($item->status == 0)
                    <td>已接受</td>
                @else
                    <td>已解决</td>
                @endif
                <td>
                    @if($item->status == -1)
                        <button type="button" class="btn btn-success form-control" onclick="sendConfirm({{ $item->id }})">
                            接受
                        </button>
                        <button type="button" class="btn btn-success form-control" onclick="sendConfirm(-99)">
                            拒接
                        </button>
                    @elseif($item->status == 0)
                        <button type="button" class="btn btn-success form-control" onclick="sendConfirm({{ $item->id }})">
                            解决
                        </button>
                    @elseif($item->status == 1)
                        <button type="button" class="btn btn-default form-control" onclick="" disabled>
                            已解决
                        </button>
                    @else
                        <button type="button" class="btn btn-default form-control" onclick="" disabled>
                            已拒绝
                        </button>
                    @endif
                </td>
            </tr>

        @endforeach
        </tbody>
    </table>
    {{ $require->links() }}

    @endsection

    @section('other_content')
            <!-- Modal -->
    <div class="modal fade" id="accept_pop" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                <form method="post" action="" id="unseal">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <input type="hidden" id="id" name="id">
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