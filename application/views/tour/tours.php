<section class="parallax-window" data-parallax="scroll" data-image-src="<?php echo $random_wall_tours['image_full']; ?>" data-natural-width="1400" data-natural-height="470">
    <div class="parallax-content-1">
        <div class="animated fadeInDown">
        <h1><?php echo $random_wall_tours['name']; ?></h1>
        <?php  
			if($random_wall_tours['discount_price'] > 0){
				$price = $random_wall_tours['discount_price'];
			}else{
				$price = $random_wall_tours['normal_price'];
			}
		?>
        Start From <span class="price"><sup>$</sup><?php echo $price; ?>/Person</span> <a href="/tour/<?php echo $random_wall_tours['id_tour']; ?>">Read more</a>
        </div>
    </div>
</section><!-- End section -->

<div id="position">
    	<div class="container">
                	<ul>
                    <li><a href="/">Home</a></li>
                    <li>Tours</li>
                    </ul>
        </div>
    </div><!-- Position -->

<div  class="container margin_60">
            
    	<div class="row">
        	<aside class="col-lg-3 col-md-3">
		<div class="box_style_cat">
			<ul id="cat_nav">
            	<li><a href="/tours" id="active"><i class="icon_set_1_icon-51"></i>All Tours</a></li>
            <?php foreach($tour_categories as $row) { ?>
				<li><a href="<?php echo base_url('tours/categories/'.$row->id_categories); ?>" id="<?php echo $row->id_categories; ?>"><i class="<?php echo $row->icon_tags; ?>"></i><?php echo $row->name; ?></a></li>
            <?php } ?>
			</ul>
		</div>
        
		<div class="box_style_2">
			<i class="icon_set_1_icon-57"></i>
			<h4>Need <span>Help?</span></h4>
			<a class="phone"><?php echo $phone_number['value']; ?></a>
            <h4>Whatsapp</h4>
            <a class="phone"><?php echo $wa_number['value']; ?></a>
		</div>
		</aside><!--End aside -->
            <div class="col-lg-9 col-md-9">
            
            <div id="tools">
            
           <div class="row">
           	<div class="col-md-12 col-sm-12 col-xs-12">
            	<marquee onmouseover="this.stop();" onmouseout="this.start();" direction="left"><strong class="text-danger">HOT</strong>: <strong><?php echo strtoupper($random_wall_tours['name_categories']).' TOUR '.$random_wall_tours['name'].' Start From $'.$price.'/Person'; ?> <a href="<?php echo base_url('tour/'.$random_wall_tours['id_tour']); ?>">Booking Now</a></strong></marquee>
            </div>
                
        	
        	</div>
            </div><!--/tools -->
          
    		<div id="tours_post"></div>
            <hr>
            <div class="text-center">
            	<div id="pageination_tours"></div>
            </div>
        </div><!-- End col lg-9 -->
    </div><!-- End row -->
</div><!-- End container -->

<script type="application/javascript">
<?php if($this->uri->segment(2)=='categories'){ ?>
		function load_tours(page){
			$.ajax({
				url: "<?php echo base_url('tours/pagination_categories/'); ?>"+page+"?id=<?php echo $this->uri->segment(3); ?>",
				method: "GET",
				dataType: "json",
				success: function(data){
					$("#tours_post").html(data.tours_post);
					$("#pageination_tours").html(data.pageination_tours);
				}
			});
		}
		$(document).ready(function() {
			$(window).on('load', function() {
				load_tours(1);
			});
		});
		<?php }else if($this->uri->segment(1)=='tours'){ ?>
		function load_tours(page){
			$.ajax({
				url: "<?php echo base_url('tours/pagination/'); ?>"+page,
				method: "GET",
				dataType: "json",
				success: function(data){
					$("#tours_post").html(data.tours_post);
					$("#pageination_tours").html(data.pageination_tours);
				}
			});
		}
		$(document).ready(function() {
			$(window).on('load', function() {
				load_tours(1);
			});
		});
		<?php } ?>
		
		$(document).on("click", ".pagination li a", function(event){
		  event.preventDefault();
		  var page = $(this).data("ci-pagination-page");
		  load_tours(page);
		 });
</script>