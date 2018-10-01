<section id="hero" class="login">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                	<div id="login">
                    		<div class="text-center"><img src="/assets/img/logo.png" alt="Register Your Account BB 45Trans" data-retina="true" ></div>
                            <hr>
                           <form action="/auth/register" method="post" id="Fregister">
                           <input type="hidden" name="<?=$csrfname;?>" id="Rhash" value="<?=$csrfhash;?>" />
                                <div class="form-group">
                                	<label>First name</label>
									<input type="text" class="form-control" id="Rfirst_name" name="first_name" required>
                                </div>
                                <div class="form-group">
                                	<label>Last name</label>
									<input type="text" class="form-control" id="Rlast_name" name="last_name" required>
                                </div>
                                <div class="form-group" id="groupRemail">
                                	<label>Email</label>
									<input type="email" class="form-control" id="Remail" name="email" required>
                                </div>
                                <div class="form-group">
                                	<label>Telephone</label>
									<input type="text" class="form-control" id="Rphone_number" name="phone_number" required>
                                </div>
                                <div class="form-group" id="grouppaswd">
                                    <label>Password</label>
                                    <input type="password" id="Rpassword" name="password" class="form-control" required>
                                </div>
                                <div class="form-group" id="grouppaswd2">
                                    <label>Confirmation Password</label>
                                    <input type="password" id="Rpassword2" class="form-control" required>
                                </div>
                                <div class="form-group" id="grreca">
                                    <label>Captcha</label>
                                    <input type="text" id="Rcaptc" placeholder="<?=$captcha;?>" name="captcha" class="form-control" required>
                                </div>
                                <div id="pass-info" class="clearfix"></div>
                                <button class="btn_full">Create an account</button>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </section>

	<script type="application/javascript">
	
	$("#Fregister").submit(function(e){
		e.preventDefault();
		var form = $("#Fregister");
		if($("#Rpassword").val() == $("#Rpassword2").val()){
			$("#grouppaswd").attr('class', 'form-group');
			$("#grouppaswd2").attr('class', 'form-group');
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
						$("#groupRemail").attr('class', 'form-group');
						$("#grreca").attr('class', 'form-group');
						toast('success', '<strong>Register Successful</strong>, Redirecting...');
					}else if(result.status == "captcha"){
						refreshcapt();
						$("#grreca").attr('class', 'form-group has-error has-feedback');
						$("#Rcaptc").val('');
						toast('danger', '<strong>Register Failed</strong>, Wrong captcha!');
					}else{
						$("#grreca").attr('class', 'form-group');
						$("#groupRemail").attr('class', 'form-group has-error has-feedback');
						toast('danger', '<strong>Register Failed</strong>, Your email is already registered!');
					}
					$("#Rhash").attr('value', result.csrfhash);
				}
			});
		}else{
			$("#grouppaswd").attr('class', 'form-group has-error has-feedback');
			$("#grouppaswd2").attr('class', 'form-group has-error has-feedback');
			toast('danger', '<strong>Please check</strong>, password and confirmation is not match');
		}
	});
	</script>