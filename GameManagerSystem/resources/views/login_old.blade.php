
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Forms</title>
	<link href="{{ URL::asset('css/bootstrap.min.css') }}" rel="stylesheet">
	<link href="{{ URL::asset('css/styles.css') }}" rel="stylesheet">
<!--[if lt IE 9]>
	<script src="js/html5shiv.js"></script>
	<script src="js/respond.min.js"></script>
	<![endif]-->

</head>

<body>
	
	<div class="row">
		<div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">登录</div>
				<div class="panel-body">
					<form role="form" method="post" action="{{ route('login_do') }}">
						<fieldset>
							<div class="form-group">
								<input class="form-control" name="_token" type="hidden" autofocus="" tabindex="1" value="{{ csrf_token() }}">
								<input class="form-control" placeholder="用户名" name="username" type="text" autofocus="" tabindex="1">
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="密码" name="password" type="password" value="" tabindex="2" required>
							</div>
								<input class="form-control btn btn-primary" type="submit" name="sub" value="登录" tabindex="3">
						</fieldset>
					</form>
				</div>
			</div>
		</div><!-- /.col-->
	</div><!-- /.row -->


	<script src="{{ URL::asset('js/jquery-1.11.1.min.js') }}"></script>
	<script src="{{ URL::asset('js/bootstrap.min.js') }}"></script>
	<script>
		!function ($) {
			$(document).on("click","ul.nav li.parent > a > span.icon", function(){		  
				$(this).find('em:first').toggleClass("glyphicon-minus");	  
			}); 
			$(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
		}(window.jQuery);

		$(window).on('resize', function () {
		  if ($(window).width() > 768) $('#sidebar-collapse').collapse('show')
		})
		$(window).on('resize', function () {
		  if ($(window).width() <= 767) $('#sidebar-collapse').collapse('hide')
		})
	</script>	
</body>

</html>
