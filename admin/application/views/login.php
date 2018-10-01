
<!DOCTYPE html>
<html lang="en">
  <base href="<?=base_url();?>">
<head>
    <meta charset="utf-8">
    <title>Administrator Login</title>

	<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <meta name="apple-mobile-web-app-capable" content="yes"> 
    
<link href="/assets/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<link href="/assets/css/bootstrap-responsive.min.css" rel="stylesheet" type="text/css" />

<link href="/assets/css/font-awesome.css" rel="stylesheet">
    <link href="http://fonts.googleapis.com/css?family=Open+Sans:400italic,600italic,400,600" rel="stylesheet">
    
<link href="/assets/css/style.css" rel="stylesheet" type="text/css">
<link href="/assets/css/pages/signin.css" rel="stylesheet" type="text/css">

</head>

<body>
	
	<div class="navbar navbar-fixed-top">
	
	<div class="navbar-inner">
		
		<div class="container">
			
			<a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			
			<a class="brand" href="index.html">
				BB 45Trans Login Administrator				
			</a>		
			
			<div class="nav-collapse">
				<ul class="nav pull-right">
					<li class="">						
						<a href="https://bb45trans.com" class="">
							<i class="icon-chevron-left"></i>
							Back to Homepage
						</a>
						
					</li>
				</ul>
				
			</div><!--/.nav-collapse -->	
	
		</div> <!-- /container -->
		
	</div> <!-- /navbar-inner -->
	
</div> <!-- /navbar -->



<div class="account-container" ng-app="bb45trans">
	
	<div class="content clearfix" ng-controller="login">
		
			<h1>Admin Login</h1>
			<div class="alert {{responsClass}}" ng-show="response">
				{{responsAlert}}
			</div>	
			
			<div class="login-fields">
				<form ng-submit="loginPost()">
				<p>Please provide your details</p>
				<div class="field">
					<label for="username">Email</label>
					<input type="email" ng-model="email" placeholder="Email" class="login username-field" autofocus required />
				</div> <!-- /field -->
				
				<div class="field">
					<label for="password">Password:</label>
					<input type="password" ng-model="password" placeholder="Password" class="login password-field" required/>
				</div> <!-- /password -->
				
			</div> <!-- /login-fields -->
			
			<div class="login-actions">
				<button class="button btn btn-success btn-large">Sign In</button>
			</div> <!-- .actions -->
			
			</form>
	</div> <!-- /content -->
	
</div> <!-- /account-container -->



<div class="login-extra">
	<a href="#">Reset Password</a>
</div> <!-- /login-extra -->


<script src="/assets/js/jquery-1.7.2.min.js"></script>
<script src="/assets/js/bootstrap.js"></script>
<script src="/assets/js/angular.min.js"></script>
<script src="/assets/js/signin.js"></script>
<script src="/assets/js/costume/login.js"></script>
</body>

</html>
