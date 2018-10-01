<section id="hero" class="login">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                	<div id="login">
                    		<div class="text-center"><img src="/assets/img/logo.png" alt="Login Your Account BB 45Trans" data-retina="true" ></div>
                            <hr>
                            <form action="/auth/login" method="post" id="Flogin">
                            <input type="hidden" name="<?=$csrfname;?>" id="Lhash" value="<?=$csrfhash;?>" />
                            <div class="row">
                            <div class="col-md-6 col-sm-6 login_social">
                                <a href="#" class="btn btn-primary btn-block"><i class="icon-facebook"></i> Facebook</a>
                            </div>
                            <div class="col-md-6 col-sm-6 login_social">
                                <a href="#" class="btn btn-info btn-block "><i class="icon-twitter"></i>Twitter</a>
                            </div>
                            </div> <!-- end row -->
                            <div class="login-or"><hr class="hr-or"><span class="span-or">or</span></div>
                       
                               <div class="form-group" id="logEm">
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="Lemail" name="email" required>
                                </div>
                                <div class="form-group" id="logPa">
                                    <label>Password</label>
                                    <input type="password" class="form-control" id="Lpassword" name="password" required>
                                </div>
                                <p class="small">
                                    <a href="/auth/forgot">Forgot Password?</a>
                                </p>
                                <button type="submit" class="btn_full">Sign in</button>
                                <a href="/auth?type=register " class="btn_full_outline">Register</a>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </section>
    
    <script type="application/javascript">
		$("#Flogin").submit(function(e){
		e.preventDefault();
		var form = $("#Flogin");
		$.ajax({
			url: form.attr('action'),
			method: 'POST',
			dataType: 'JSON',
			data: form.serialize(),
			beforeSend: function(){
				toast('info', '<strong>Please wait</strong>, Proccessing your data');
			},
			success: function(result){
				if(result.status == true){
					$("#logEm").attr('class', 'form-group');
					$("#logPa").attr('class', 'form-group');
					toast('success', '<strong>Login Successful</strong>, Redirecting...');
                    setTimeout(() => {
                        location.reload();
                    }, 1000);

				}else{
					$("#logEm").attr('class', 'form-group has-error has-feedback');
					$("#logPa").attr('class', 'form-group has-error has-feedback');
					toast('danger', '<strong>Login Failed</strong>, Please check your email and password!');
				}
				$("#Lhash").attr('value', result.csrfhash);
			}
		});
	});
	</script>