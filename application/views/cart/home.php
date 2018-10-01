<section id="hero_2">
	<div class="intro_title animated fadeInDown">
           <h1>Place your order</h1>
            <div class="bs-wizard">
  			
                <div class="col-xs-4 bs-wizard-step active">
                  <div class="text-center bs-wizard-stepnum">Your cart</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="/cart" class="bs-wizard-dot"></a>
                </div>
                               
                <div class="col-xs-4 bs-wizard-step disabled">
                  <div class="text-center bs-wizard-stepnum">Your details</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="/cart/checkout" class="bs-wizard-dot"></a>
                </div>
            
              <div class="col-xs-4 bs-wizard-step disabled">
                  <div class="text-center bs-wizard-stepnum">Finish!</div>
                  <div class="progress"><div class="progress-bar"></div></div>
                  <a href="/cart/confirmation" class="bs-wizard-dot"></a>
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
    <?php if($this->cart->total() >0){ ?>
    <div class="col-md-8">
    	<table class="table table-striped cart-list add_bottom_30" id="table_item">
            <thead>
            <tr>
                <th width="65%">
                    Tours
                </th>
                <th width="10%">
                    Person
                </th>
                <th width="15%">
                   Sub Total
                </th>
                <th width="10%">
                    Actions
                </th>
            </tr>
            </thead>
            <tbody>
            
            </tbody>
            <tfoot>
            	<th colspan="2">Total</th>
                <th colspan="2" id="grandtotal"></th>
            </tfoot>
            </table>
            
            <table class="table table-striped options_cart">
            <thead>
            <tr>
                <th colspan="3">
                    Add options / Services
                </th>
            </tr>
            </thead>
            <tbody>
            <?php 
			
			$index = 1; 
			foreach($services as $row){ 
			$rowid = MD5($row->id_services);
			if(!empty($filter_services[$rowid])){
				$selected = 'checked';
			}else{
				$selected = '';
			}
			?>
            <tr>
                <td style="width:10%">
                    <i class="<?php echo $row->icon; ?>"></i>
                </td>
                <td style="width:60%">
                    <?php echo $row->name; ?> <strong>+$<?php echo $row->price; ?></strong>
                </td>
                <td style="width:35%">
                    <label class="switch-light switch-ios pull-right">
                    <input type="checkbox" id="services_<?php echo $index; ?>" class="cxbsrv" data-id="<?php echo $row->id_services; ?>" data-name="<?php echo $row->name; ?>" data-price="<?php echo $row->price; ?>" onChange="services('services_<?php echo $index; ?>');" <?php echo $selected; ?>>
                    <span>
                    <span>No</span>
                    <span>Yes</span>
                    </span>
                    <a></a>
                    </label>
                </td>
            </tr>
            <?php $index++; } ?>
            </tbody>
            </table>
            <div class="add_bottom_15"><small>* Prices for group.</small></div>
            
    </div><!-- End col-md-8 -->
    
    <aside class="col-md-4">
    <div class="box_style_1">
        <h3 class="inner">- Summary -</h3>
        <table class="table table_summary">
        <tbody>
        
        </tbody>
        </table>
        <a class="btn_full" href="/cart/checkout">Check out</a>
        <a class="btn_full_outline" href="/tours"><i class="icon-right"></i> Continue shopping</a>
    </div>
    <div class="box_style_4">
        <i class="icon_set_1_icon-57"></i>
        <h4>Need <span>Help?</span></h4>
        <a class="phone"><?php echo $phone_number['value']; ?></a>
        <h4>Whatsapp</h4>
        <a class="phone"><?php echo $wa_number['value']; ?></a>

    </div>
    </aside><!-- End aside -->
    <?php }else{ ?>
    <div class="col-md-12">
        	<h2>Your Cart Is Empty</h2>
        </div>
    <?php } ?>
</div><!--End row -->
</div><!--End container -->


<script type="application/javascript">
	var csrfHash = "<?=$csrfhash; ?>";
	
	$(document).ready(function(){
		summary();
		show_items();
	});
	
	function show_items(){
		$("#table_item tbody").empty();
		$.getJSON("<?php echo base_url('cart/item'); ?>", function(results){
			$("#table_item tfoot #grandtotal").html('$'+results.total);
			$.each(results.item, function(index, value){
				$("#table_item tbody").append('<tr><td><div class="thumb_cart"><a href="/tour/'+value.id+'" target="_blank"><img src="'+value.img+'" width="80" height="80" alt="'+value.name+'"></a></div><span class="item_cart">'+value.name+'</span></td><td><strong>'+value.qty+'</strong></td><td><strong>$'+value.subtotal+'</strong></td><td class="options"><a href="#." id="remv'+value.index+'" data-rowid="'+value.rowid+'" onClick="delete_item('+value.index+');"><i class=" icon-trash"></i></a></td></tr>');
			});
		});
	}
	
	function qqty(){
		var qty = $("#qQty").val();
		$.ajax({
			url: "/cart/cart_modify",
			method: "post",
			data: {
				type: "qty",
				qty: qty,
				<?=$csrfname; ?>: csrfHash
			},
			dataType: "json",
			success: function(result){
				show_items();
				summary();
				csrfHash = result.csrfhash;
			}
		});
	}
	
	function delete_item(index){
		var rowid = $("#remv"+index).attr("data-rowid");
		$.ajax({
			url: "<?php echo base_url('cart/cart_modify'); ?>",
			method: "POST",
			dataType: "JSON",
			data: {
				type: 'delete_item',
				rowid: rowid,
				<?=$csrfname; ?>: csrfHash
			},
			success: function(result){
				csrfHash = result.csrfhash
				show_items();
				summary();
			}
		});
	}
		
	function services(id){
		var service = $("#"+id);
		var id = service.attr("data-id");
		var name = service.attr("data-name");
		var price = service.attr("data-price");
		$(".options_cart").hide();
		toast('info', '<strong>Please wait</strong>, Proccessing your data');
		setTimeout(function(){
			if(service.is(':checked')){
			$.ajax({
				url: '/cart/option_services',
				method: 'POST',
				dataType: 'JSON',
				data: {
					type: 'add',
					id: id,
					name: name,
					price: price,
					<?=$csrfname; ?>: csrfHash
				},
				success: function(result){
					toast('success', '<strong>Success!</strong>');
					csrfHash = result.csrfhash
					$(".options_cart").delay(1000).show();
					summary();
				}
			});
		}else{
			$.ajax({
				url: '/cart/option_services',
				method: 'POST',
				dataType: 'JSON',
				data: {
					type: 'remove',
					id: id,
					<?=$csrfname; ?>: csrfHash
				},
				success: function(result){
					toast('success', '<strong>Success!</strong>');
					csrfHash = result.csrfhash
					$(".options_cart").delay(1000).show();
					summary();
				}
			});
		}
		}, 1000);
	}
		
	function summary(){
		setTimeout(function(){
			$.get("/cart/summary", function(result){
				$(".table_summary tbody").html(result);
			});
		}, 1000);
	}
</script>