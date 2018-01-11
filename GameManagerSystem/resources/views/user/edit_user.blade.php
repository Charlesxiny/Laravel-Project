@extends('app')
@section('active_user', 'active')
@section('nav_title', '用户管理')
@section('title', '添加用户')
@section('sub_title', '添加用户')
@section('main_content')

<link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet">

<!--[if lt IE 9]>
<script src="{{ URL::asset('js/respond.min.js') }}"></script>
<![endif]-->
<form method="post" action="{{ route('edit_user_do') }}">
     用户名：<input type="text" name="username" placeholder="用户名" class="form-control" value="{{ $user->username }}">
        部门：<input type="text" name="department" placeholder="所在部门" class="form-control" value="{{ $user->department }}">
        权限:<select name="privilege" class="form-control">
            @foreach($privilege as $item)
                <option value="{{ $item->id }}">{{ $item->privilege }}</option>
            @endforeach
        </select>

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="id" value="{{ $user->id }}">
        <a href="{{ route('user_list') }}"><button type="button" class="btn btn-default" >返回</button></a>
        <button type="submit" class="btn btn-primary">修改</button>
</form>
<script src="{{ URL::asset('js/jquery-1.11.1.min.js') }}"></script>
<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
@endsection