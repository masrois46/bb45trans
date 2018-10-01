<div class="row">
        <div class="col-md-12 col-sm-12 wow zoomIn" data-wow-delay="0.1s">
        	<?php foreach($data as $row) { ?>
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
                    </div>
                </div><!-- End box tour -->
            <?php } ?>
            </div><!-- End col-md-4 -->
        </div><!-- End row -->