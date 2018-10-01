<section id="hero_2">
	<div class="intro_title animated fadeInDown">
           <h1>Fill Up Your Details</h1>
            <div class="bs-wizard">
  			
                <div class="col-xs-4 bs-wizard-step complete">
                  <div class="text-center bs-wizard-stepnum">Your cart</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="/cart" class="bs-wizard-dot"></a>
                </div>
                               
                <div class="col-xs-4 bs-wizard-step active">
                  <div class="text-center bs-wizard-stepnum">Your details</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="/cart/checkout" class="bs-wizard-dot"></a>
                </div>
            
              <div class="col-xs-4 bs-wizard-step disabled">
                  <div class="text-center bs-wizard-stepnum">Finish!</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="#" class="bs-wizard-dot"></a>
                </div>  
                   
		</div>  <!-- End bs-wizard --> 
    </div>   <!-- End intro-title --> 
</section><!-- End Section hero_2 -->
    
    <div id="position">
    	<div class="container">
                	<ul>
                    <li><a href="/">Home</a></li>
                    <li>Cart</li>
                    </ul>
        </div>
    </div><!-- End position -->
    
    <div class="container margin_60">
	<div class="row">
    <?php if(!empty($this->cart->contents())){ ?>
    	<div class="col-md-8 add_bottom_15">
    	<?php if(empty($this->session->userdata('auth_client'))){ ?>
			<div class="form_title">
				<h3><strong><i class="icon-login-2"></i></strong>Register</h3>
				<p>
					Fill up your details.
				</p>
			</div>
             <form action="/auth/register" method="post" id="Fregister">
             <input type="hidden" name="<?=$csrfname;?>" id="Rhash" value="<?=$csrfhash;?>" />
			<div class="step">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label>First name</label>
							<input type="text" class="form-control" id="Rfirst_name" name="first_name" required>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label>Last name</label>
							<input type="text" class="form-control" id="Rlast_name" name="last_name" required>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group" id="groupRemail">
							<label>Email</label>
							<input type="email" class="form-control" id="Remail" name="email" required>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
							<label>Telephone</label>
							<input type="text" class="form-control" id="Rphone_number" name="phone_number" required>
						</div>
					</div>
				</div>
                <div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group" id="grouppaswd">
							<label>Password</label>
							<input type="password" id="Rpassword" name="password" class="form-control" required>
						</div>
					</div>
                    <div class="col-md-6 col-sm-6">
						<div class="form-group" id="grouppaswd2">
							<label>Confirmation Password</label>
							<input type="password" id="Rpassword2" class="form-control" required>
						</div>
					</div>
				</div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
						<div class="form-group" id="grreca">
							<label>Captcha</label>
							<input type="text" name="captcha" placeholder="<?=$captcha;?>" class="form-control" required>
						</div>
					</div>
				</div>
                <div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
                        	<button class="btn_1 green medium" id="btnReg" type="submit">Register</button>
                        </div>
                    </div>
                </div>
			</div><!--End step -->
            </form>
            
            <div class="form_title">
				<h3><strong><i class="icon-login"></i></strong>Login</h3>
				<p>
					Already registered?
				</p>
			</div>
            
            <form action="/auth/login" method="post" id="Flogin">
            <input type="hidden" name="<?=$csrfname;?>" id="Lhash" value="<?=$csrfhash;?>" />
			<div class="step">
				<div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group" id="logEm">
							<label>Email</label>
							<input type="email" class="form-control" id="Lemail" name="email" required>
						</div>
					</div>
					<div class="col-md-6 col-sm-6">
						<div class="form-group" id="logPa">
							<label>Password</label>
							<input type="password" class="form-control" id="Lpassword" name="password" required>
						</div>
					</div>
				</div>
                <div class="row">
					<div class="col-md-6 col-sm-6">
						<div class="form-group">
                        	<button class="btn_1 green medium" type="submit">Login</button><div id="Lmessage"></div>
                        </div>
                    </div>
                </div>
			</div><!--End step -->
            </form>
            <?php }else{ ?>
            	<div class="step">
                    <div class="form_title">
                        <h3><strong><i class="icon-basket"></i></strong>Your Details</h3>
                        <p>Just one more step!</p>
                    </div>
                    <form action="ca_checkout" method="post" id="Fcheckout" autocomplete="off">
                    <input type="hidden" name="<?=$csrfname;?>" id="Chash" value="<?=$csrfhash;?>" />
                    <div class="row">
                    	<div class="col-md-6">
                        	<div class="form-group">
                                <label><i class="icon-calendar-7"></i> Date Tour</label>
                                <input class="date-pick form-control" name="date_tour" data-date-format="D,dd MM yyyy" type="text" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                        	<div class="form-group">
                                <label><i class="icon-calendar-7"></i> Payment Method</label>
                                <select class="form-control" name="payment_method" id="payment_method" required>
                                	<option></option>
                                	<?php foreach($all_bank as $row){ ?>
                                	<option value="<?php echo $row->id_bank; ?>"><?php echo $row->bank_name; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                    	<div class="col-md-12">
                        	<table class="table" id="table_bank">
                            	<thead>
                                    <tr>
                                        <th>Bank Name</th>
                                        <th>Account</th>
                                        <th>Account Holder</th>
                                    </tr>
                                </thead>
                                <tbody>
                                
                                </tbody>
                            </table>
                            <div class="form-group">
                            	<input type="submit" class="btn_1 green medium" value="Create Order" />
                            </div>
                        </div>
                    </div>
                </div>
            </form>
            
            <?php } ?>
		</div>
        
		<aside class="col-md-4">
		<div class="box_style_1">
			<h3 class="inner">- Summary -</h3>
			<table class="table table_summary">
                <tbody>
                
                </tbody>
            </table>
		</div>
		<div class="box_style_4">
			<i class="icon_set_1_icon-57"></i>
			<h4>Need <span>Help?</span></h4>
			<a class="phone"><?php echo $phone_number['value']; ?></a>
            <h4>Whatsapp</h4>
            <a class="phone"><?php echo $wa_number['value']; ?></a>
		</div>
		</aside>
        <?php }else{ ?>
        	<div class="col-md-12">
                <h2>Your Cart Is Empty</h2>
            </div>
        <?php } ?>
	</div><!--End row -->
</div><!--End container -->

<!-- Date and time pickers -->
<script src="/assets/js/bootstrap-datepicker.js"></script>
<script src="/assets/js/bootstrap-timepicker.js"></script>
<script>
  $('input.date-pick').datepicker();
  $('input.time-pick').timepicker({
    minuteStep: 15,
    showInpunts: false
})
</script>

<?php if(!empty($this->session->userdata('auth_client'))){ ?>
<script type="application/javascript">
	$(document).ready(function(){
		$("#table_bank").hide();
	});
	
	$("#payment_method").change(function(){
		var val = $(this).val();
		$("#table_bank").show();
		if(val != "cash_on_delivery"){
			$.getJSON("/cart/bank_account/"+val, function(result){
				$("#table_bank thead").show();
				$("#table_bank tbody").html('<tr><td>'+result.bank_name+'</td><td>'+result.account+'</td><td>'+result.account_holder+'</td></tr>');
			});
		}else{
			$("#table_bank thead").hide();
			$("#table_bank tbody").html('<tr><td colspan="3"><strong>Just pay on our driver.</strong></td></tr>');
		}
	});
	
	$("#Fcheckout").submit(function(e){
		var form = $("#Fcheckout");
		e.preventDefault();
		$.ajax({
			url: form.attr('action'),
			method: 'post',
			dataType: 'json',
			data: form.serialize(),
			beforeSend: function(){
				$("#btnReg").html('Loading');
				$("#btnReg").prop('disabled', 'disabled');
			},
			success: function(result){
				if(result.status == true){
					toast('success', '<strong>Booking Successful</strong>, Redirecting...');
					setTimeout(function(){
						$(location).attr('href', '/cart/finish?inv='+result.inv+'&c='+result.hash_tour);
					}, 1000);
				}else{
					$("#Chash").val(result.csrfhash);
					toast('danger', '<strong>Booking Failed</strong>, Pleace Check Your Data!');
				}
				$("#btnReg").html('Register');
				$("#btnReg").removeAttr('disabled');
			}
		});
	});
</script>
<?php } ?>

<script type="application/javascript">
	$(document).ready(function(){
		summary();
	});
	
	function summary(){
		setTimeout(function(){
			$.get("/cart/summary", function(result){
				$(".table_summary tbody").html(result);
			});
		}, 1000);
	}
	
	function refreshhash(has){
		$("#Lhash").attr('value', has);
		$("#Rhash").attr('value', has);
		csrfHash = has;
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
					$("#logPa").attr('class', 'form-group');
					toast('success', '<strong>Login Successful</strong>, Redirecting...');
					setTimeout(function(){
						location.reload();
					}, 1000);
				}else{
					$("#logEm").attr('class', 'form-group has-error has-feedback');
					$("#logPa").attr('class', 'form-group has-error has-feedback');
					toast('danger', '<strong>Login Failed</strong>, Please check your email and password!');
				}
				refreshhash(result.csrfhash);
			}
		});
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
					toast('success', '<strong>Register Successful</strong>, Redirecting...');
						setTimeout(function(){
							location.reload();
					}, 1000);
				}else{
					toast('danger', '<strong>Error</strong>, Please contact admin for more information.');
						setTimeout(function(){
							location.reload();
					}, 1000);
				}

			}
		})
	}
	
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
						hash_e(result.hash);
						$("#groupRemail").attr('class', 'form-group');
						$("#grreca").attr('class', 'form-group');
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
					refreshhash(result.csrfhash);
				}
			});
		}else{
			$("#grouppaswd").attr('class', 'form-group has-error has-feedback');
			$("#grouppaswd2").attr('class', 'form-group has-error has-feedback');
			toast('danger', '<strong>Please check</strong>, password and confirmation is not match');
		}
	});
</script>