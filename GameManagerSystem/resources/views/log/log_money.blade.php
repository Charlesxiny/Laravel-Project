@extends('app')
@section('active_log', 'active')
@section('nav_title', '日志下载')
@section('title', '虚拟货币日志')
@section('sub_title', '虚拟货币日志')

@section('main_content')
    <script>
        function delConfirm(id){
            $('#openid').val(id);
            $('#unseal_pop').modal('show');
        }
    </script>
    <table class="table table-striped">
        <tr>
            <th>日期</th>
            <th>文件名</th>
            <th>&nbsp;&nbsp;操作</th>
        </tr>
        <tbody>
        @for($i = 0 ;$i < count($file_list);$i++)
            <tr>
                <td>{{ $file_time[$i] }}</td>
                <td>{{ $file_list[$i] }}</td>
                <td>
                    <a href="{{ route('download_log_money', ['file_name'=>$file_list[$i]]) }}">
                        <button type="button" class="btn btn-primary form-control">
                            下载
                        </button>
                    </a>
                </td>
            </tr>

        @endfor
        </tbody>
    </table>
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