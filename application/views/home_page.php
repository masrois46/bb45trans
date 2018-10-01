

    <!-- Slider -->
    <div class="tp-banner-container">
        <div class="tp-banner">
            <ul>
            	<?php foreach($slider as $row){ ?>
                <!-- SLIDE  -->
                <li data-transition="fade" data-slotamount="7" data-masterspeed="500" data-saveperformance="on" data-title="Intro Slide">
                    <!-- MAIN IMAGE -->
                    <img src="/assets/img/slides_bg/dummy.png" alt="slidebg1" data-lazyload="<?php echo $row->image; ?>" data-bgposition="center top" data-bgfit="cover" data-bgrepeat="no-repeat">
                    <!-- LAYER NR. 1 -->
                    <div class="tp-caption white_heavy_40 customin customout text-center text-uppercase" data-x="center" data-y="center" data-hoffset="0" data-voffset="-20" data-customin="x:0;y:0;z:0;rotationX:90;rotationY:0;rotationZ:0;scaleX:1;scaleY:1;skewX:0;skewY:0;opacity:0;transformPerspective:200;transformOrigin:50% 0%;" data-customout="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0.75;scaleY:0.75;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="1000" data-start="1700" data-easing="Back.easeInOut" data-endspeed="300" style="z-index: 5; max-width: auto; max-height: auto; white-space: nowrap;"><?php echo $row->caption; ?>
                    </div>
                    <!-- LAYER NR. 2 -->
                    <div class="tp-caption customin tp-resizeme rs-parallaxlevel-0 text-center" data-x="center" data-y="center" data-hoffset="0" data-voffset="15" data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="500" data-start="2600" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.05" data-endelementdelay="0.1" style="z-index: 9; max-width: auto; max-height: auto; white-space: nowrap;">
                        <div style="color:#ffffff; font-size:16px; text-transform:uppercase">
                            <?php echo $row->information; ?></div>
                    </div>
                    <!-- LAYER NR. 3 -->
                    <div class="tp-caption customin tp-resizeme rs-parallaxlevel-0" data-x="center" data-y="center" data-hoffset="0" data-voffset="70" data-customin="x:0;y:0;z:0;rotationX:0;rotationY:0;rotationZ:0;scaleX:0;scaleY:0;skewX:0;skewY:0;opacity:0;transformPerspective:600;transformOrigin:50% 50%;" data-speed="500" data-start="2900" data-easing="Power3.easeInOut" data-splitin="none" data-splitout="none" data-elementdelay="0.1" data-endelementdelay="0.1" data-linktoslide="next" style="z-index: 12;"><a href='<?php echo $row->link_button1; ?>' class="button_intro"><?php echo $row->text_button1; ?></a> <a href='<?php echo $row->link_button2; ?>' class=" button_intro outline"><?php echo $row->text_button2; ?></a>
                    </div>
                </li>
                <?php } ?>
            </ul>
            <div class="tp-bannertimer tp-bottom"></div>
        </div>
    </div>
    <!-- End Slider -->

    <div class="container margin_60">
    
        <div class="main_title">
            <h2>Random <span>Our</span> Tours</h2>
            <p>The Only Best Destination That Will Make Your Holiday Fun!</p>
        </div>
        
        <div class="row">
        
        	<?php foreach($random_tours as $row) { ?>
            <div class="col-md-4 col-sm-6 wow zoomIn" data-wow-delay="0.1s">
                <div class="tour_container">
                	<?php if($row->badge == "popular") { ?>
                	<div class="ribbon_3 popular"><span>Popular</span></div>
                    <?php }else if($row->badge == "top_rated") { ?>
                    <div class="ribbon_3"><span>Top rated</span></div>
                    <?php } ?>
                    <div class="img_container">
                        <a href="/tour/<?php echo $row->id_tour; ?>">
                        <img src="<?php echo $row->image_thumbnail; ?>" class="img-responsive" alt="<?php echo $row->name; ?>">
                        <div class="short_info">
                        	<?php  
								if($row->discount_price > 0){
									$price = $row->discount_price;
								}else{
									$price = $row->normal_price;
								}
							?>
                            <i class="<?php echo $row->icon_tags; ?>"></i><?php echo $row->name_categories; ?><span class="price"><sup>$</sup><?php echo $price; ?>/Person</span>
                        </div>
                        </a>
                    </div>
                    <div class="tour_title">
                        <h3><strong><?php echo $row->name; ?></strong> tour</h3>
                        <div class="rating">
                            <i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile voted"></i><i class="icon-smile"></i><small>(75)</small>
                        </div><!-- end rating -->
                        <div class="wishlist">
                            <a class="tooltip_flip tooltip-effect-1" href="javascript:void(0);">+<span class="tooltip-content-flip"><span class="tooltip-back">Add to wishlist</span></span></a>
                        </div><!-- End wish list-->
                    </div>
                </div><!-- End box tour -->
            </div><!-- End col-md-4 -->
            <?php } ?>
            
        </div><!-- End row -->
        <p class="text-center add_bottom_30">
            <a href="/tours" class="btn_1 medium"><i class="icon-eye-7"></i>View all tours</a>
        </p>
    </div><!-- End container -->
    
    <div class="white_bg">
        <div class="container margin_60">
            <div class="main_title">
                <h2>Other <span>Random</span> tours</h2>
                <p>
                    The Best Choice For Your Tour.
                </p>
            </div>
            <div class="row add_bottom_45">
                <div class="col-md-4 other_tours">
                    <ul>
                    	<?php 
						$no = 1; 
						foreach($other_random_tours as $row) { 
						$icon = explode(',',$row->icon_tags);
						?>
                        <li><a href="/tour/<?php echo $row->id_tour; ?>"><i class="<?php echo $icon[0]; ?>"></i><?php echo $row->name; ?><span class="other_tours_price">$<?php echo $row->normal_price; ?></span></a>
                        </li>
                        <?php 
						if($no == 6 || $no == 12){
							echo '</ul>
               					</div> <div class="col-md-4 other_tours">
                    <ul>';
						}
						$no++;
						} 
						?>
                    </ul>
                </div>
                
            </div><!-- End row -->
            
            <div class="banner colored">
                <h4>Discover our Top tours <span>from $34</span></h4>
                <p>
                    "When overseas you learn more about your own country, than you do the place you're visiting." - <em>Clint Borgen</em>
                </p>
                <a href="/tours" class="btn_1 white">Book Now</a>
            </div>
        </div><!-- End container -->
    </div><!-- End white_bg -->
    
    <section class="promo_full">
    <div class="promo_full_wp magnific">
        <div>
            <h3>Welcome To Indonesian Tourism</h3>
            <p>
               Holiday With Family Brings Much More Joy Than A Loner. And Welcome To Indonesia
            </p>
            <a href="<?php echo $youtube_video['value']; ?>" class="video"><i class="icon-play-circled2-1"></i></a>
        </div>
    </div>
    </section><!-- End section -->
    
    <div class="container margin_60">
    
        <div class="main_title">
            <h2>Some <span>good</span> reasons</h2>
            <p>
                We Provide The Best Service For You And Your Family On Vacation.
            </p>
        </div>
        
        <div class="row">
        
            <div class="col-md-4 wow zoomIn" data-wow-delay="0.2s">
                <div class="feature_home">
                    <i class="icon_set_1_icon-41"></i>
                    <h3><span>+120</span> Premium tours</h3>
                    <p>
                         Enjoy your tour with the best choice of places destination.
                    </p>
                    <a href="/tours" class="btn_1 outline">Book Now</a>
                </div>
            </div>
            
            <div class="col-md-4 wow zoomIn" data-wow-delay="0.4s">
                <div class="feature_home">
                    <i class="icon_set_1_icon-30"></i>
                    <h3><span>+1000</span> Customers</h3>
                    <p>
                         Already many of our customers are satisfied with the service we provide, now your turn..
                    </p>
                </div>
            </div>
            
            <div class="col-md-4 wow zoomIn" data-wow-delay="0.6s">
                <div class="feature_home">
                    <i class="icon_set_1_icon-57"></i>
                    <h3><span>Best </span> Support</h3>
                    <p>
                         Your satisfaction is our pride.
                    </p>
                    <a href="/contact-us" class="btn_1 outline">Contact Us</a>
                </div>
            </div>
            
        </div><!--End row -->
        
        <hr>
        
        <div class="row">
            <div class="col-md-8 col-sm-6 hidden-xs">
                <img src="/assets/img/laptop.png" alt="Laptop" class="img-responsive laptop">
            </div>
            <div class="col-md-4 col-sm-6">
                <h3><span>Get started</span> with Us</h3>
                <p>
                    Discover new things with us.
                </p>
                <ul class="list_order">
                    <li><span>1</span>Select your preferred tours</li>
                    <li><span>2</span>Purchase tickets and options</li>
                    <li><span>3</span>Pick them directly from your office</li>
                </ul>
                <a href="/tours" class="btn_1">Start now</a>
            </div>
        </div><!-- End row -->
        
    </div><!-- End container -->
    
    