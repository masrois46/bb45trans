<?php
	if($detail_tour['discount_price'] >0) {
		$price = $detail_tour['discount_price'];
	}else{
		$price = $detail_tour['normal_price'];
	}
?>
<section class="parallax-window" data-parallax="scroll" data-image-src="<?php echo $detail_tour['image_full']; ?>" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-2">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-8">
                    <h1><?php echo $detail_tour['name']; ?></h1>
                    <span><?php echo $detail_tour['cat_name']; ?></span>
                </div>
                <div class="col-md-4 col-sm-4">
                    <div id="price_single_main">
                        from/per person <span><sup>$</sup><?php echo $price; ?></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </section><!-- End section -->

    <div id="position">
            <div class="container">
                        <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/tours">Tour</a></li>
                        <li><?php echo $detail_tour['name']; ?></li>
                        </ul>
            </div>
    </div><!-- End Position -->

<div class="container margin_60">
	<div class="row">
		<div class="col-md-8" id="single_tour_desc">
        
			<div id="single_tour_feat">
				<ul>
                	<?php foreach($features_tour as $row) { ?>
					<li><i class="<?php echo $row->icon_tour_features; ?>"></i><?php echo $row->heading_features; ?></li>
                    <?php } ?>
				</ul>
			</div>
            
            <?php if(!empty($carousel)){ ?>
            <div id="Img_carousel" class="slider-pro">
                <div class="sp-slides">
                	<?php foreach($carousel as $row){ ?>
                    <div class="sp-slide">
                        <img alt="Image" class="sp-image" src="/assets/css/images/blank.gif" 
                        data-src="<?php echo $row->image; ?>" 
                        data-small="<?php echo $row->image; ?>" 
                        data-medium="<?php echo $row->image; ?>" 
                        data-large="<?php echo $row->image; ?>" 
                        data-retina="<?php echo $row->image; ?>">
                    </div>
                    <?php } ?>
                </div>
                <div class="sp-thumbnails">
                	<?php foreach($carousel as $row){ ?>
                    <img alt="Image" class="sp-thumbnail" src="<?php echo $row->image; ?>">
                    <?php } ?>
                </div>
            </div>
            <hr />
            <?php } ?>
			<div class="row">
				<div class="col-md-12">
                	<h3>Description</h3>
					<p>
						<?php echo $detail_tour['short_description']; ?>
					</p>
					
				</div>
			</div>
            
			<hr>
            
			<div class="row">
				<div class="col-md-12">
                	<h3>Tour Timeline</h3>
					<ul class="cbp_tmtimeline">
                    <?php $day = 1; foreach($timeline_tour as $row) { ?>
                      <li>
                        <time class="cbp_tmtime"><span>Day</span> <span><?php echo $day; ?></span></time>
                        <div class="cbp_tmicon <?php echo $row->icon; ?>"></div>
                        <div class="cbp_tmlabel">
                          <h2><?php echo $row->heading; ?></h2>
                          <p><?php echo $row->content; ?></p>
                        </div>
                      </li>
                      <?php $day++; } ?>
                  </ul>
				</div>
			</div>
            
			<hr>
            
			<div class="row">
				<div class="col-lg-12">
                	<h3>Comments</h3>
                </div>
			</div>
		</div><!--End  single_tour_desc-->
        
		<aside class="col-md-4">
		<div class="box_style_1 expose">
			<h3 class="inner" id="hbooking">- Booking -</h3>
            <form action="<?php echo base_url('tours/booking_procces'); ?>" method="post" id="form_booking">
            <input type="hidden" name="id_tour" value="<?php echo $detail_tour['id_tour']; ?>" />
            <input type="hidden" name="name" value="<?php echo $detail_tour['name']; ?>" />
            <input type="hidden" name="price" id="price" value="<?php echo $price; ?>" />
            <input type="hidden" id="csrftoken" name="<?=$csrfname;?>" value="<?=$csrfhash;?>" /> 
            <input type="hidden" name="qty" value="1" />
			<table class="table table_summary">
			<tbody>
			<tr class="total">
				<td>
					Cost
				</td>
				<td class="text-right" id="txtTotalcost">
					$<?=$price;?>
				</td>
			</tr>
            <tr>
            	<td colspan="2" class="text-right">*Price per person</td>
            </tr>
			</tbody>
			</table>
			<button type="submit" class="btn_full">Book Now</button>
		</div><!--/box_style_1 -->
        </form>
        
		<div class="box_style_4">
			<i class="icon_set_1_icon-90"></i>
			<h4><span>Book</span> by Whatsapp</h4>
			<a href="https://api.whatsapp.com/send?phone=phone_number&text=Hi%20admin,%20i%20want%20to%20booking%20<?php echo $detail_tour['name']; ?>"  target="_blank" class="phone"><?php echo $phone_number['value']; ?></a>
		</div>
        
        <div class="box_style_1 expose" id="box_related">
			<h3 class="inner">Related Tours</h3>
            <div id="related_tour"></div>
		</div>
        
		</aside>
	</div><!--End row -->
</div><!--End container -->

<!-- Carousel -->
<script src="/assets/js/owl.carousel.min.js"></script>
<script src="/assets/js/jquery.sliderPro.min.js"></script>

<script>
$(document).ready(function(){   
		$(".carousel").owlCarousel({
		items : 4,
		itemsDesktop : [1199,3],
		itemsDesktopSmall : [979,3]
		});
		
		$( '#Img_carousel' ).sliderPro({
			width: 960,
			height: 500,
			fade: true,
			arrows: true,
			buttons: false,
			fullScreen: false,
			smallSize: 500,
			startSlide: 0,
			mediumSize: 1000,
			largeSize: 3000,
			thumbnailArrows: true,
			autoplay: false
		});
    });
</script>

<script type="application/javascript">
	$(document).ready(function(){
		$("#alert_detail_tour").hide();
		related_tour();
	});
	
	function related_tour(){
		$.getJSON("/tours/related_tour/<?php echo $detail_tour['id_tour'].'/'.$detail_tour['id_categories']; ?>", function(result){
			if(result.status > 0){
				$("#related_tour").html(result.content);
			}else{
				$("#box_related").hide();
			}
		});
	}
		
	$("#form_booking").submit(function(e){
		e.preventDefault();
		var form = $("#form_booking");
		var csrftoken = $("#csrftoken");
		$("#hbooking").html("Loading...");
		setTimeout(function(){
			$.ajax({
				url: form.attr("action"),
				data: form.serialize(),
				method: "POST",
				dataType: "JSON",
				success: function(data){
					$("#hbooking").html("- Booking -");
					toast('success', '<strong>Success!</strong> Your tour has been booked to cart.');
					get_cart();
					csrftoken.attr("name", data.csrfname);
					csrftoken.attr("value", data.csrfhash);
				}
			});
		}, 500);
	});
</script>