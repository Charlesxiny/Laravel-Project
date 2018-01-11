<!DOCTYPE HTML>
<html>
<head>
<title>Home</title>
<!-- Custom Theme files -->
<link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" type="text/css" media="all"/>
	<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
	<link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">

<!-- Custom Theme files -->
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" /> 
<meta name="keywords" content="Login form web template, Sign up Web Templates, Flat Web Templates, Login signup Responsive web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyErricsson, Motorola web design" />
<!--Google Fonts-->
	<!-- 天朝网络问题 会刷不出界面-->

	{{--<link href='http://fonts.useso.com/css?family=Roboto:500,900italic,900,400italic,100,700italic,300,700,500italic,100italic,300italic,400' rel='stylesheet' type='text/css'>--}}
    {{--<link href='http://fonts.useso.com/css?family=Droid+Serif:400,700,400italic,700italic' rel='stylesheet' type='text/css'>--}}
    <!--Google Fonts-->
</head>
<body>
<div class="login">
	<h2>游戏开发过程管理系统</h2>
	<div class="login-top">
		<h1>用户登录</h1>
		<form method="post" action="{{ route('login_do') }}">
			<input type="text" name="username" value="请输入用户名" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = '请输入用户名';}">
			<input type="password" placeholder="请输入密码" name="password" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'password';}">
			{{ csrf_field() }}
			<div class="forgot">
				<input type="submit" value="Login" >
	    	</div>
	    </form>

	</div>
	<div class="login-bottom">
		<h3><a href="{{ route('forget') }}" data-toggle="modal" data-target="forget">忘记密码？</a>&nbsp 点击找回密码</h3>
	</div>
</div>
<div class="copyright">
	<p>Copyright &copy; 2017.Company xenosLee All rights reserved.
</div>



</body>
</html>