@extends('appV2')
@section('page_title', '用户管理')
@section('user_manager_page', 'active')
@section('top_navigation')
    <div class="templatemo-top-nav-container">
        <div class="row">
            <nav class="templatemo-top-nav col-lg-12 col-md-12">
                <ul class="text-uppercase">
                    <li><a href="{{ route('user_list') }}" class="active">用户列表</a></li>
                    <li><a href="{{ route('show_add_user') }}">添加新员工</a></li>
                    @if(session('privilege') == 1 || session('privilege') == 3 )
                        <li><a href="{{ route('new_require') }}">提出需求</a></li>
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
                <div class="panel-heading"><h2 class="text-uppercase">修改员工信息</h2></div>
                <div class="panel-body">
                    <form id="form_add" method="post" action="{{ route('edit_user_do')}}" class="templatemo-login-form">
                        <div class="form-group">

                            <input type="hidden" name="id" value="{{ $user->id }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                           用户名:<input type="text" name="username" value="{{ $user->username }}" class="form-control">
                        </div>
                        <div class="form-group">
                            部门: <input type="text" name="department" value="{{ $user->department }}" class="form-control">
                        </div>
                        <div class="form-group">
                        权限:<select name="privilege" class="form-control">
                                <option value="{{ $user->privilege }}">
                                    @if($user->privilege == 1)
                                        管理员
                                    @elseif($user->privilege == 2)
                                        商务
                                    @elseif($user->privilege == 3)
                                        策划
                                    @elseif($user->privilege == 4)
                                        运营
                                    @elseif($user->privilege == 5)
                                        开发
                                    @elseif($user->privilege == 6)
                                        测试
                                    @elseif($user->privilege == 7)
                                        项目经理
                                    @endif
                                </option>
                            @foreach($privilege as $item)
                                    @if($item->id != $user->privilege)
                                        <option value="{{ $item->id }}">{{ $item->privilege }}</option>
                                    @endif
                            @endforeach
                        </select>
                        </div>
                        <div class="form-group">
                            电话:<input type="text" name="tel" value="{{ $user->tel }}" class="form-control">
                        </div>
                        <div class="form-group">
                            邮箱:<input type="text" name="email" value="{{ $user->email }}" class="form-control">
                        </div>
                        <div class="form-group">
                            <button type="button" class="templatemo-blue-button" data-toggle="modal" data-target="#confirm_add">修改</button>
                            <a href="{{ route('user_list') }}"><button type="button" class="templatemo-white-button">返回</button></a>
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
                    确认要修改么？
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" onclick="submitForm()">提交</button>
                    </form>

                </div>
            </div>
        </div>
    </div>



@endsection