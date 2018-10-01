<section class="parallax-window" data-parallax="scroll" data-image-src="/assets/img/bg_login.jpg" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-1">
        <div class="animated fadeInDown">
        	<h1>Hello <?=$data_session['first_name'];?>!</h1>
        	<p>Welcome to BB 45Trans Member area.</p>
        </div>
    </div>
</section><!-- End section -->

<div id="position">
    	<div class="container">
                	<ul>
                    <li><a href="#">Home</a></li>
                    <li>Member</li>
                    </ul>
        </div>
</div><!-- End Position -->

<div class="margin_60 container">
	<div id="tabs" class="tabs">
		<nav>
		<ul>
			<li><a href="#section-1" class="icon-booking"><span>Bookings</span></a></li>
			<li><a href="#section-2" class="icon-ok-circled"><span>Confirm Payment</span></a></li>
			<li><a href="#section-3" class="icon-settings"><span>Settings</span></a></li>
			<li><a href="#section-4" class="icon-profile"><span>Profile</span></a></li>
		</ul>
		</nav>
		<div class="content">
        
			<section id="section-1">
				<div id="list_invoice"></div>
				<div id="page_number"></div>
			</section><!-- End section 1 -->

			<section id="section-2">
				<div class="row">
				<form action="/member/save_confirm_payment" method="POST" id="formConfirmPayment" enctype="multipart/form-data" autocomplete="off">
					<input type="hidden" name="<?=$csrfname;?>" id="tokenPayment" value="<?=$csrfhash;?>">
					<div class="col-md-6">
						<div class="form-group">
							<label>Invoice</label>
							<select class="form-control" name="id_invoice" id="cmbInvoice" required>
								<option></option>
							</select>
						</div>
						<div class="form-group">
							<label>Date Transfer</label>
							<input class="date-pick form-control" name="date_transfer" data-date-format="dd MM yyyy" type="text" required>
						</div>
						<div class="form-group">
							<label>Evidence of Transfer</label>
							<input class="form-control" type="file" name="userfile" accept="image/*" >
						</div>
						<div class="form-group">
							<button class="btn btn-primary" type="submit">Confirm</button>
						</div>
					</div>
					<div class="col-md-6">
					<div class="alert alert-success" id="AlertInfoBank">
						<b>Bank Name</b> : <span id="infoBankName"></span><br>
						<b>Bank Account</b> : <span id="infoBankAccount"></span><br>
						<b>Account Holder</b> : <span id="infoAccountHolder"></span><br>
						<b>View Invoice</b> : <span id="infoViewInvoice"></span>
					</div>
					</div>
					</form>
				</div>
			</section>
            
			<section id="section-3">
			<div class="row">
				<div class="col-md-6 col-sm-6 add_bottom_30">
					<h4>Change your password</h4>
					<form action="/member/change_password" method="POST" id="formPassword">
					<input type="hidden" name="<?=$csrfname;?>" id="tokenPassword" value="<?=$csrfhash;?>">
					<div class="form-group">
						<label>Old password</label>
						<input class="form-control" name="old_pswd" id="old_pswd" type="password" required>
					</div>
					<div class="form-group">
						<label>New password</label>
						<input class="form-control" name="new_pswd" id="new_pswd" type="password" required>
					</div>
					<div class="form-group">
						<label>Confirm new password</label>
						<input class="form-control" id="conf_new_pswd" onkeyup="check_password();" type="password" required><br>
						<label class="label-danger" id="infoMatchPassword">Confirmation password not match with new password!</label>
					</div>
					<button type="submit" class="btn btn-primary" id="btnPassword" disabled>Update Password</button>
					</form>
				</div>
			</div><!-- End row -->
			</section><!-- End section 3 -->

			<?php
				if($profile['picture'] != null){
					$picture = $profile['picture'];
				}else{
					$picture = '/assets/profile/default-avatar.png';
				}
			?>
            
			<section id="section-4">
			<div class="row">
				<div class="col-md-6 col-sm-6">
					<h4>Your profile</h4> <em>Last Update <?php echo date('d M Y H:i:s', $profile['update_at']); ?> Server Time</em>
					<ul id="profile_summary">
						<li>Email <span><?=$profile['email'];?></span></li>
						<li>First name <span><?=$profile['first_name'];?></span></li>
						<li>Last name <span><?=$profile['last_name'];?></span></li>
						<li>Phone number <span><?=$profile['phone_number'];?></span></li>
						<li>Date of birth <span><?=$profile['date_of_birth'];?></span></li>
						<li>Street address <span><?=$profile['street_address'];?></span></li>
						<li>Town/City <span><?=$profile['city'];?></span></li>
						<li>Zip code <span><?=$profile['zip_code'];?></span></li>
						<li>Country <span><?=$profile['country'];?></span></li>
					</ul>
					<button class="btn btn-primary" data-toggle="collapse" data-target="#formUpdateProfile">Update Profile</button>
					<button class="btn btn-primary" data-toggle="collapse" data-target="#formPhoto">Change Photo</button>
				</div>
				<div class="col-md-6 col-sm-6">
					<img height="330" width="515" id="PhotoProfile" src="<?=$picture;?>" alt="Picture of <?=$profile['first_name'];?>" class="img-responsive styled profile_pic">
				</p>
			</div>
		</div><!-- End row -->

		<div id="formPhoto" class="collapse">
			<form action="/member/change_photo" method="POST" id="changePhoto" enctype="multipart/form-data">
			<input type="hidden" name="<?=$csrfname;?>" id="tokenUploadPhoto" value="<?=$csrfhash;?>">
			<div class="divider"></div>
				<div class="row">
					<div class="col-md-12">
						<h4>Change Photo Profile</h4>
					</div>
					<div class="col-md-6 col-sm-6">
						<input type="file" class="form-control" name="userfile">
					</div>
					<div class="col-md-6 col-sm-6">
						<button type="submit" class="btn btn-primary">Upload</button>
					</div>
				</div>
			</form>
		</div>
        
		<div id="formUpdateProfile" class="collapse">
		<div class="divider"></div>
		<form action="/member/save_profile" method="POST" id="formUpdate" autocomplete="off">
        <input type="hidden" name="<?=$csrfname;?>" id="tokenUpdateProfile" value="<?=$csrfhash;?>">
		<div class="row">
			<div class="col-md-12">
				<h4>Edit profile</h4>
			</div>
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<label>First name</label>
					<input class="form-control" name="first_name" type="text" value="<?=$profile['first_name'];?>">
				</div>
			</div>
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<label>Last name</label>
					<input class="form-control" name="last_name" type="text"  value="<?=$profile['last_name'];?>">
				</div>
			</div>
		</div><!-- End row -->

		<?php 
			if($profile['date_of_birth'] != '0000-00-00'){
				$date_of_birth = $profile['date_of_birth'];
			}else{
				$date_of_birth = '';
			}
        ?>
		<div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<label>Phone number</label>
					<input class="form-control" name="phone_number" type="text" value="<?=$profile['phone_number'];?>">
				</div>
			</div>
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<label>Date of birth</label>
					<input class="date-pick form-control" name="date_of_birth" value="<?=$date_of_birth;?>" data-date-format="yyyy-mm-dd" type="text" required>
				</div>
			</div>
		</div><!-- End row -->
        
		<hr>
		<div class="row">
			<div class="col-md-12">
				<h4>Edit address</h4>
			</div>
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<label>Street address</label>
					<input class="form-control" name="street_address" type="text"  value="<?=$profile['street_address'];?>">
				</div>
			</div>
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<label>City/Town</label>
					<input class="form-control" name="city" type="text"  value="<?=$profile['city'];?>">
				</div>
			</div>
		</div><!-- End row -->

		<?php
			if($profile['country'] != null){
				$country = '<option value="'.$profile['country'].'">'.$profile['country'].'</option>';
			}else{
				$country = '<option></option>';
			}
		?>
        
		<div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<label>Zip code</label>
					<input class="form-control" name="zip_code" type="text"  value="<?=$profile['zip_code'];?>">
				</div>
			</div>
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<label>Country</label>
					<select id="country" class="form-control" name="country">
						<?=$country;?>
					</select>
				</div>
			</div>
		</div><!-- End row -->

		<div class="row">
			<div class="col-md-6 col-sm-6">
				<div class="form-group">
					<button class="btn btn-primary" type="submit">Save Profile</button>
				</div>
			</div>
		</div><!-- End row -->
		</div><!-- End content -->
		</div>
		</form>
	</div><!-- End tabs -->
</div><!-- end container -->

<!-- Date and time pickers -->
<script src="/assets/js/bootstrap-datepicker.js"></script>
<script src="/assets/js/bootstrap-timepicker.js"></script>

<script type="application/javascript">
	$(document).ready(function() {
		$(window).on('load', function() {
			$('#AlertInfoBank').hide();
			$('#infoMatchPassword').hide();
			load_invoice(1);
			get_data_confirm();
			getCountry();
			$('input.date-pick').datepicker();
			$('input.time-pick').timepicker({
				minuteStep: 15,
				showInpunts: false
			})
		});
	});

	function getCountry(){
		$.getJSON("/assets/country.json", function(data){
			$.each(data.countries.country, function(k, v){
					$('#country').append('<option value="' + v.countryName + '">' + v.countryName + '</option>');
				});
		});
		
	}

	$('#cmbInvoice').change(function(){
		var id_invoice = $('#cmbInvoice option:selected').text();
		$.ajax({
			url: '/member/get_invoice_confirm/' + id_invoice,
			method: 'get',
			dataType: 'json',
			success: function(data){
				$('#AlertInfoBank').show();
				$('#infoBankName').html(data.bank_name);
				$('#infoBankAccount').html(data.account);
				$('#infoAccountHolder').html(data.account_holder);
				$('#infoViewInvoice').html('<a href="/invoice/' + data.id_invoice + '?v=' + data.v + '" target="_blank">Click Here</a>');
			}
		})
	})
		
	$(document).on("click", ".pagination li a", function(event){
		event.preventDefault();
		var page = $(this).data("ci-pagination-page");
		load_invoice(page);
	});
	
	function load_invoice(page){
		$.ajax({
			url: '/member/page_invoice/'+page,
			method: 'get',
			dataType: 'json',
			success: function(data){
				$("#list_invoice").html(data.list_invoice);
				$("#page_number").html(data.page_number);
			}
		});
	}

	function get_data_confirm(){
		$.ajax({
			url: '/member/get_invoice_confirm',
			method: 'get',
			dataType: 'json',
			success: function(data){
				$.each(data, function(k, v){
					$('#cmbInvoice').append('<option value="' + v.id_invoice + '">' + v.id_invoice + '</option>');
				});
			}
		})
	}

	$("#formConfirmPayment").submit(function(e){
		e.preventDefault();
		var form = $("#formConfirmPayment");
		$.ajax({
			type: form.attr('method'),
			url: form.attr('action'),
			data: new FormData(this),
			cache: false,
			processData:false,
			contentType: false,
			dataType: 'json',
			beforeSend: function(){
				toast('info', '<strong>Please wait</strong>, Proccessing your data');
			},
			success: function (data) {
				if(data.status == true){
					toast('success', data.message);
					form.trigger('reset');
				}else{
					alert(data.message);
					toast('danger', data.message);
				}
				refreshtoken(data.csrfhash);
			}
		});
	})

	function check_password(){
		var new_pswd = $('#new_pswd').val();
		var conf_pswd = $('#conf_new_pswd').val();
		if(new_pswd == conf_pswd){
			$('#infoMatchPassword').hide();
			$('#btnPassword').removeAttr('disabled');
		}else{
			$('#infoMatchPassword').show();
			$('#btnPassword').attr('disabled', 'disabled');
		}
	}

	$("#formPassword").submit(function(e){
		e.preventDefault();
		var form = $("#formPassword");
		$.ajax({
			type: form.attr('method'),
			url: form.attr('action'),
			data: form.serialize(),
			dataType: "json",
			beforeSend: function(){
				toast('info', '<strong>Please wait</strong>, Proccessing your data');
			},
			success: function (data) {
				if(data.status == true){
					toast('success', data.message);
					form.trigger('reset');
				}else{
					toast('danger', data.message);
				}
				refreshtoken(data.csrfhash);
			}
		});
	})

	$('#formUpdate').submit(function(e){
		e.preventDefault();
		var form = $('#formUpdate');
		$.ajax({
			type: form.attr('method'),
			url: form.attr('action'),
			data: new FormData(this),
			cache: false,
			processData:false,
			contentType: false,
			dataType: 'json',
			beforeSend: function(){
				toast('info', '<strong>Please wait</strong>, Proccessing your data');
			},
			success: function (data) {
				toast('success', data.message);
				refreshtoken(data.csrfhash);
			}
		});
	})

	
	$('#changePhoto').submit(function(e){
		e.preventDefault();
		var form = $('#changePhoto');
		$.ajax({
			type: form.attr('method'),
			url: form.attr('action'),
			data: new FormData(this),
			cache: false,
			processData:false,
			contentType: false,
			dataType: 'json',
			beforeSend: function(){
				toast('info', '<strong>Please wait</strong>, Proccessing your data');
			},
			success: function (data) {
				toast('success', data.message);
				$('#PhotoProfile').attr('src', data.link_image);
				refreshtoken(data.csrfhash);
			}
		});
	})

	function refreshtoken(token){
		$('#tokenPayment').val(token);
		$('#tokenPassword').val(token);
		$('#tokenUpdateProfile').val(token);
		$('#tokenUploadPhoto').val(token);
	}

	function confirm_cancel(){
		return confirm("Are you sure?");
	}
</script>