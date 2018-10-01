<section id="hero_2">
	<div class="intro_title animated fadeInDown">
           <h1>Booking Tour Completed</h1>
            <div class="bs-wizard">
  			
                <div class="col-xs-4 bs-wizard-step complete">
                  <div class="text-center bs-wizard-stepnum">Your cart</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="/cart" class="bs-wizard-dot"></a>
                </div>
                               
                <div class="col-xs-4 bs-wizard-step complete">
                  <div class="text-center bs-wizard-stepnum">Your details</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="/cart/checkout" class="bs-wizard-dot"></a>
                </div>
            
              <div class="col-xs-4 bs-wizard-step complete">
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
                    <li><a href="/cart">Cart</a></li>
                    <li>Finish</li>
                    </ul>
        </div>
    </div><!-- End position -->
    
    <div class="container margin_60">
	<div class="row">
		<div class="col-md-8 add_bottom_15">
            
			<div class="form_title">
				<h3><strong><i class="icon-ok"></i></strong>Booking summary</h3>
				<p>
					below is your invoice.
				</p>
			</div>
			<div class="step">
				<table class="table">
					<tr>
						<th>ID Invoice</th>
						<th>Email</th>
						<th>Order Date</th>
						<th>Payment Method</th>
						<th>Date Tour</th>
					</tr>
					<tr>
						<td><?=$detailinvoice['id_invoice']; ?></td>
						<td><?=$detailinvoice['user_email']; ?></td>
						<td><?php echo date('d-M-Y', $detailinvoice['order_date']); ?></td>
						<td><?=$detailinvoice['bank_name'];?></td>
						<td><?php echo date('d-M-Y', $detailinvoice['date_tour']); ?></td>
					</tr>
				</table>
				<table class="table confirm">
					<thead>
						<tr>
							<th width="50%">Tour</th>
							<th width="10%">qty Person</th>
							<th width="20%">Price</th>
							<th width="20%">subTotal</th>
						</tr>
					</thead>
					<tbody>
				<?php $total=0; foreach($detailtour as $row){ $total+=$row->subtotal; ?>
					<tr>
						<td><?=$row->name;?></td>
						<td><?=$row->qty;?></td>
						<td>$<?php echo number_format($row->price);?></td>
						<td>$<?php echo number_format($row->subtotal);?></td>
					</tr>
				<?php } ?>
				</tbody>
				<tfoot>
					<tr>
						<th colspan="3">Total</th>
						<th>$<?php echo number_format($total);?></th>
					</tr>
					</tfoot>
				</table>
			</div><!--End step -->
		</div><!--End col-md-8 -->
        
		<aside class="col-md-4">
		<div class="box_style_1">
			<h3 class="inner">Thank you!</h3>
			<p>
				Booking completed, Thank you for choosing us as your travel and tourism services. below is your invoice
			</p>
			<hr>
			<a class="btn_full_outline" href="/invoice/<?=$detailinvoice['id_invoice']; ?>?v=<?=MD5($detailinvoice['id_invoice']); ?>" target="_blank">View your invoice</a>
		</div>
		<div class="box_style_4">
			<i class="icon_set_1_icon-89"></i>
			<h4>Need <span>Help?</span></h4>
			<a class="phone"><?php echo $phone_number['value']; ?></a>
			<h4>Whatsapp</h4>
			<a class="phone"><?php echo $wa_number['value']; ?></a>
		</div>
		</aside>
        
	</div><!--End row -->
</div><!--End container -->

<script type="application/javascript">
	$(document).ready(function(){
		$.ajax({
			url: '/email/invoice/<?=$detailinvoice['id_invoice']; ?>',
			method: 'get',
			dataType: 'json',
			success: function(){}
		});
	});
</script>