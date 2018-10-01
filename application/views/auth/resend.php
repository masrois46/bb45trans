<section id="hero" class="login">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                	<div id="login">
                    		<div class="text-center"><img src="/assets/img/logo.png" alt="Login Your Account BB 45Trans" data-retina="true" ></div>
                            <hr>
                            <div class="alert alert-success" id="alert_message">
                                <strong>Resend Successful</strong>, please check your email inbox/spam.
                            </div>
                            <form action="/auth/resendaction" method="post" id="Flogin">
                            <input type="hidden" name="<?=$csrfname;?>" id="Lhash" value="<?=$csrfhash;?>" />

                               <div class="form-group" id="logEm">
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="Lemail" name="email" required>
                                </div>
                                <div class="form-group" id="logC">
                                    <label>Captcha</label>
                                    <input type="text" placeholder="<?=$captcha;?>" class="form-control" id="Lcaptcha" name="captcha" required>
                                </div>
                                <p class="small">
                                    <a href="/auth/forgot">Forgot Password?</a>
                                </p>
                                <button type="submit" class="btn_full">Resend</button>
                                <a href="/auth?type=register " class="btn_full_outline">Register</a>
                            </form>
                        </div>
                </div>
            </div>
        </div>
    </section>
    
    <script type="application/javascript">
     
        $(document).ready(function(){
            $("#alert_message").hide();
        });

        function hash_e(hash){
            $.ajax({
                url: '/auth/auth',
                method: 'get',
                data: {
                    'hash' : hash
                },
                success: function(result){
                    if(result == 202){
                        toast('success', '<strong>Resend Successful</strong>, please check your email inbox/spam.');
                        $("#alert_message").show();
                    }else{
                        toast('danger', '<strong>Error</strong>, Please contact admin for more information.');
                            setTimeout(function(){
                                location.reload();
                        }, 1000);
                    }

                }
            })
        }

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
                    $("#logC").attr('class', 'form-group');
					hash_e(result.hash);
                }else if(result.status == 'email'){
                    $("#logEm").attr('class', 'form-group has-error has-feedback');
                    toast('danger', '<strong>Email not found</strong>, please check your email valid.');
				}else{
					$("#logEm").attr('class', 'form-group has-error has-feedback');
                    $("#logC").attr('class', 'form-group has-error has-feedback');
					toast('danger', '<strong>Wrong Captcha</strong>, please fill captcha correctly.');
				}
				$("#Lhash").attr('value', result.csrfhash);
			}
		});
	});
	</script>