@extends('app')
@section('active_user', 'active')
@section('nav_title', '用户管理')
@section('title', '用户列表')
@section('sub_title', '用户列表')

@section('header_extension')
    <div class="panel-heading">
        <a href="{{ route('show_add_user') }}">
            <button class="btn btn-success" type="button">
                添加新用户
            </button>
        </a>
    </div>
@endsection

@section('main_content')
    <table class="table table-striped">
        <tr>
            <th>用户ID</th>
            <th>用户名</th>
            <th>所在部门</th>
            <th>用户权限</th>
            <th>操作</th>
        </tr>
        <tbody>
            @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->username }}</td>
                    <td>{{ $user->department }}</td>
                    <td>
                        @if($user->privilege == 1)
                            管理员
                        @elseif($user->privilege == 2)
                            普通用户
                        @elseif($user->privilege == 3)
                            策划
                        @elseif($user->privilege == 4)
                            运营
                        @elseif($user->privilege == 5)
                            开发
                        @elseif($user->privilege == 6)
                            测试
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('edit_user_info', ['user'=>$user->id]) }}"><button class="btn btn-primary">修改信息</button></a>
                        <a href="{{ route('delete_user', ['id'=>$user->id])}}"><button class="btn btn-danger">删除</button></a>
                    </td>
                </tr>
                <div class="modal fade" id="password_edit" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                <h4 class="modal-title" id="myModalLabel">修改密码</h4>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        </tbody>
    </table>
    {{$users->links()}}

@endsection