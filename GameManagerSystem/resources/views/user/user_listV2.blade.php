@extends('appV2')
@section('page_title', '用户管理')
@section('user_manager_page', 'active')
@section('top_navigation')
    <div class="templatemo-top-nav-container">
        <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
                <ul class="text-uppercase">
                    <li><a href="{{ route('user_list') }}" class="active">用户列表</a></li>
                    @if(session('privilege') == 1 || session('privilege') == 7)
                        <li><a href="{{ route('show_add_user') }}">添加新员工</a></li>
                    @endif
                </ul>
            </nav>
        </div>
    </div>
@endsection

@section('main_content')
    <script>
        function onConfirm(id) {
            $('#confirm_delete').modal('show') ;
            document.getElementById('idpass').value = id;
        }
    </script>
    <div class="templatemo-content-container">
        <div class="templatemo-content-widget no-padding">
            <div class="panel panel-default table-responsive">
                <table class="table table-striped table-bordered templatemo-user-table">
                    <thead>
                    <tr>
                        <td><a href="" class="white-text templatemo-sort-by">No. <span class="caret"></span></a></td>
                        <td><a href="" class="white-text templatemo-sort-by">用户名 <span class="caret"></span></a></td>
                        <td><a href="" class="white-text templatemo-sort-by">部门 <span class="caret"></span></a></td>
                        <td><a href="" class="white-text templatemo-sort-by">电话 <span class="caret"></span></a></td>
                        <td><a href="" class="white-text templatemo-sort-by">邮箱 <span class="caret"></span></a></td>
                        <td><a href="" class="white-text templatemo-sort-by">职位 <span class="caret"></span></a></td>
                        @if(session('privilege') == 1)
                            <td>编辑</td>
                            <td>删除</td>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->username }}</td>
                            <td>{{ $user->department }}</td>
                            <td>{{ $user->tel }}</td>
                            <td>{{ $user->email }}</td>
                            @if($user->privilege == 1)
                                <td>管理员</td>
                            @elseif($user->privilege == 2)
                                <td>商务</td>
                            @elseif($user->privilege == 3)
                                <td>策划</td>
                            @elseif($user->privilege == 4)
                                <td>运营</td>
                            @elseif($user->privilege == 5)
                                <td>开发</td>
                            @elseif($user->privilege == 6)
                                <td>测试</td>
                            @elseif($user->privilege == 7)
                                <td>项目经理</td>
                            @endif
                            @if(session('privilege') == 1)
                            <td><a href="{{ route('edit_user_info', ['id'=>$user->id]) }}" class="templatemo-edit-btn">编辑</a></td>
                            <td><a href="" class="templatemo-edit-btn" style="background: red; color: white" data-toggle="modal" onclick="onConfirm({{$user->id}})">删除</a></td>
                            @endif
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        {{$users->links()}}
    </div>

    <div class="modal fade" id="confirm_delete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title" id="myModalLabel">提示</h4>
                </div>
                <div class="modal-body">
                    确认要删除么？
                </div>
                <div class="modal-footer">
                    <form method="post" action="{{ route('delete_user') }}">
                        {{ csrf_field() }}
                        <input type="hidden" name="id" id="idpass">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="submit" class="btn btn-primary">提交</button>
                    </form>

                </div>
            </div>
        </div>
    </div>



@endsection