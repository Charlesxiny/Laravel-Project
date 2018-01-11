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
                </ul>
            </nav>
        </div>
    </div>
@endsection

@section('main_content')
    <script>
        function checkPwd() {
            var pwd = document.getElementById('pwd').value;
            var re_pwd = document.getElementById('re_pwd').value;
            if (pwd != re_pwd) {
                document.getElementById('tip').innerHTML = "<h5 style='color: red'>两次输入密码不一致！</h5>";
            } else {
                $('#confirm_add').modal('show');
            }
        }
        function submitForm() {
            $('#form_add').submit();
        }
    </script>
    <div class="templatemo-content-container">
    </div>
    <div class="templatemo-flex-row flex-content-row">
        <div class="col-1">
            <div class="panel panel-default margin-10">
                <div class="panel-heading"><h2 class="text-uppercase">添加新员工</h2></div>
                <div class="panel-body">
                    <form id="form_add" method="post" action="{{ route('add_new_user')}}" class="templatemo-login-form" enctype="multipart/form-data">
                        <div class="form-group">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                            用户名:<input type="text" name="username" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            密码: <input type="password" name="password" value="" id="pwd" class="form-control">
                        </div>
                        <div class="form-group">
                            再次确认: <input type="password" name="re_password" value="" id="re_pwd" class="form-control">
                        </div>
                        <div class="form-group">
                            部门: <input type="text" name="department" value="" class="form-control">
                        </div>

                        <div class="form-group">
                            电话:<input type="text" name="tel" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            邮箱:<input type="text" name="email" value="" class="form-control">
                        </div>
                        <div class="form-group">
                            <select class="form-control" name="privilege">
                                @foreach($privilege_list as $item)
                                    <option value="{{ $item->id }}">{{ $item->privilege }}</option>
                                @endforeach
                            </select>
                        </div>
                        上传头像:
                        <div class="form-group">
                            <input type="file" name="photo_img" class="form-control">
                        </div>
                        <p id="tip">

                        </p>
                        <div class="form-group">
                            <button type="button" class="templatemo-blue-button" data-toggle="modal" onclick="checkPwd()">提交</button>
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
                    确认要添加么？
                </div>
                <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                        <button type="button" class="btn btn-primary" onclick="submitForm()">提交</button>
                </div>
            </div>
        </div>
    </div>



@endsection