<?php $config = $this->session->userdata('config'); ?>
<!DOCTYPE html>
<!--[if IE 8]><html class="ie ie8"> <![endif]-->
<!--[if IE 9]><html class="ie ie9"> <![endif]-->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    
    <meta name="author" content="BB 45Trans">
    <title><?php echo $this->session->flashdata('title'); ?> - <?php echo $config['get_title']['value']; ?></title>
    
    <!-- Favicons-->
    <link rel="shortcut icon" href="/assets/img/favicon.ico" type="image/x-icon">
    <link rel="apple-touch-icon" type="image/x-icon" href="/assets/img/apple-touch-icon-57x57-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="72x72" href="/assets/img/apple-touch-icon-72x72-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="114x114" href="/assets/img/apple-touch-icon-114x114-precomposed.png">
    <link rel="apple-touch-icon" type="image/x-icon" sizes="144x144" href="/assets/img/apple-touch-icon-144x144-precomposed.png">

    <!-- CSS -->
    <link href="/assets/css/base.css" rel="stylesheet">
	
    <!-- Google web fonts -->
   <link href='http://fonts.googleapis.com/css?family=Montserrat:400,700' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Gochi+Hand' rel='stylesheet' type='text/css'>
   <link href='http://fonts.googleapis.com/css?family=Lato:300,400' rel='stylesheet' type='text/css'>
    
	<style>
    .invoice-title h2, .invoice-title h3 {
        display: inline-block;
    }
    
    .table > tbody > tr > .no-line {
        border-top: none;
    }
    
    .table > thead > tr > .no-line {
        border-bottom: none;
    }
    
    .table > tbody > tr > .thick-line {
        border-top: 2px solid;
    }
    </style>
        
    <!--[if lt IE 9]>
      <script src="js/html5shiv.min.js"></script>
      <script src="js/respond.min.js"></script>
    <![endif]-->
        <?php if($detail['status_paid'] == 0){
			$status_paid = 'Unpaid';
		}else{
			$status_paid = 'Paid';
		}

		if($detail['status_invoice'] == 0){
			$status_invoice = 'Waiting Tour';
		}else if($detail['status_invoice'] == 1){
			$status_invoice = 'Tour Completed';
		}else{
			$status_invoice = 'Canceled';
		}
		?>
</head>
<body>
  <div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice (<?=$status_invoice;?>)</h2><h3 class="pull-right">Order # <?=$detail['id_invoice'];?> (<?=$status_paid;?>)</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed To:</strong><br>
                        <?=$detail['first_name'];?> <?=$detail['last_name'];?><br>
    					<?=$detail['street_address'];?><br>
    					<?=$detail['city'];?><br>
    					<?=$detail['country'];?>, <?=$detail['zip_code'];?>
    				</address>
    			</div>
                <div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					<?php echo date('d-M-Y', $detail['order_date']); ?><br><br>
    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					<?=$detail['bank_name'];?><br>
    					<?=$detail['account'];?><br>
                        <?=$detail['account_holder'];?>
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Date Tour:</strong><br>
    					<?php echo date('d-M-Y', $detail['date_tour']); ?><br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
                                    <th colspan="4">Tours</th>
                                </tr>
                                <tr>
        							<td><strong>Tour</strong></td>
        							<td class="text-center"><strong>qty Person</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
        							<td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<?php $totalr = 0; foreach($tour as $row){ $totalr += $row->subtotal; ?>
    							<tr>
    								<td><?=$row->name;?></td>
    								<td class="text-center"><?=$row->qty;?></td>
    								<td class="text-center">$<?=number_format($row->price);?></td>
    								<td class="text-right">$<?=number_format($row->subtotal);?></td>
    							</tr>
                                <?php } ?>
    							<tr>
    								<td colspan="3" class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">$<?=number_format($totalr);?></td>
    							</tr>
    						</tbody>
    					</table>
                        <table class="table table-condensed">
    						<thead>
                                <tr>
                                    <th colspan="2">Services</th>
                                </tr>
                                <tr>
        							<td><strong>Service</strong></td>
        							<td class="text-center"><strong>Price</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<?php $totals = 0; foreach($services as $row){ $totals += $row->price; ?>
    							<tr>
    								<td><?=$row->name;?></td>
    								<td class="text-center">$<?=number_format($row->price);?></td>
    							</tr>
                                <?php } ?>
    							<tr>
    								<td class="thick-line text-center"><strong>Subtotal</strong></td>
    								<td class="thick-line text-right">$<?=number_format($totals);?></td>
    							</tr>
    						</tbody>
    					</table>

                        <table class="table table-condensed">
    						<thead>
                                <tr>
                                    <th colspan="2">Totals</th>
                                </tr>
    						</thead>
    						<tbody>
    							<tr>
    								<td>Tour</td>
    								<td class="text-right">$<?=number_format($totalr);?></td>
    							</tr>
                                <tr>
    								<td>Service</td>
    								<td class="text-right">$<?=number_format($totals);?></td>
    							</tr>
    							<tr>
    								<td class="thick-line text-center"><strong>Totals</strong></td>
    								<td class="thick-line text-right">$<?=number_format($totals+$totalr);?></td>
    							</tr>
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>



  </body>
</html>