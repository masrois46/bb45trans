<section id="hero" class="login">
    	<div class="container">
        	<div class="row">
            	<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
                	<div id="login">
                    		<div class="text-center"><img src="/assets/img/logo.png" alt="Login Your Account BB 45Trans" data-retina="true" ></div>
                            <hr>
                            <div class="alert <?php if($status){ echo 'alert-success'; }else{ echo 'alert-danger'; } ?>">
                                <?=$notif;?>
                            </div>
                            <hr>
                            <a href="/auth?type=login " class="btn_full">Login</a>
                            <a href="/auth?type=register " class="btn_full">Register</a>
                        </div>
                </div>
            </div>
        </div>
    </section>