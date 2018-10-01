<section id="hero" class="login">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                	<div id="login">
                    		<div class="text-center"><img src="/assets/img/logo.png" alt="Login Your Account BB 45Trans" data-retina="true" ></div>
                            <hr>
                            <div class="alert alert-success" id="alert_message">
                                <strong>Reset Password Successful</strong>, please check your email inbox/spam.
                            </div>
                            <form action="/auth/forgot" method="post" id="Flogin">
                            <input type="hidden" name="<?=$csrfname;?>" id="Lhash" value="<?=$csrfhash;?>" />

                               <div class="form-group" id="logEm">
                                    <label>Email</label>
                                    <input type="email" class="form-control" id="Lemail" name="email" required>
                                </div>
                                <div class="form-group" id="logC">
                                    <label>Captcha</label>
                                    <input type="text" placeholder="<?=$captcha;?>" class="form-control" id="Lcaptcha" name="captcha" required>
                                </div>
                                <button type="submit" class="btn_full">Reset Password</button>
                                <a href="/auth?type=login " class="btn_full_outline">Login</a>
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

		$("#Flogin").submit(function(e){
            e.preventDefault();
            var form = $("#Flogin");
            var email = $("#Lemail").val();
            $.get("/auth/forgot_check_email?e="+email, function(result){
                if(result == 200){
                    $.ajax({
                        url: form.attr('action'),
                        method: 'POST',
                        dataType: 'JSON',
                        data: form.serialize(),
                        beforeSend: function(){
                            toast('info', '<strong>Please wait</strong>, Proccessing your data');
                        },
                        success: function(result){
                            if(result.status == 200){
                                $("#logEm").attr('class', 'form-group');
                                $("#logC").attr('class', 'form-group');
                                toast('success', '<strong>Reset Password Successfull</strong>, please check your email inbox/spamm');
                            }else if(result.status == 'captcha'){
                                $("#logC").attr('class', 'form-group has-error has-feedback');
                                toast('danger', '<strong>Captcha Wrong</strong>, please fill correctly.');
                            }else{
                                $("#logEm").attr('class', 'form-group has-error has-feedback');
                                $("#logC").attr('class', 'form-group has-error has-feedback');
                                toast('danger', '<strong>Reset Password Failed</strong>, please contact admin.');
                            }
                            $("#Lhash").attr('value', result.csrfhash);
                        }
                    });
                }else{
                    toast('danger', '<strong>Reset Password Failed</strong>, Email not found');
                }
            });
        });
	</script>