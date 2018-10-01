<?php foreach($data as $row) { ?>
<div class="strip_all_tour_list wow fadeIn" data-wow-delay="0.1s" data-id_tour="<?php echo $row->id_tour; ?>">
                   <div class="row">
                	<div class="col-lg-4 col-md-4 col-sm-4">
                    <?php if($row->badge == 'popular'){ ?>
                        <div class="ribbon_3 popular"><span>Popular</span></div>
                    <?php }else if($row->badge == 'top_rated'){ ?>
                    	<div class="ribbon_3"><span>Top Rated</span></div>
                    <?php } ?>
                    	<div class="img_list"><a href="<?php echo base_url('tour/').$row->id_tour; ?>"><img src="<?php echo $row->image_thumbnail; ?>" alt="<?php echo $row->name; ?>">
                        <div class="short_info"><i class="<?php echo $row->icon_tags; ?>"></i><?php echo $row->name_categories; ?></div></a>
                        </div>
                    </div>
                     <div class="clearfix visible-xs-block"></div>
                    <div class="col-lg-6 col-md-6 col-sm-6">
                    		<div class="tour_list_desc">
                    		<h3><strong><?php echo $row->name; ?></strong> tour</h3>
                            <p><?php echo substr($row->short_description, 0, 330); ?>....</p>
                            <ul class="add_info">
                            	<?php $no = 1;
							foreach($features as $row_feat) {
							if($no<=5){
							if($row->id_tour == $row_feat->id_tour_features){ ?>
                            <li>
                            <div class="tooltip_styled tooltip-effect-4">
                            	<span class="tooltip-item"><i class="<?php echo $row_feat->icon_tour_features; ?>"></i></span>
                                	<div class="tooltip-content"><h4><?php echo $row_feat->heading_features; ?></h4>
                                    	<?php 
											$content = explode('==========', $row_feat->content_features); 
											foreach($content as $conval){
												echo $conval.'<br>';
											}
										?>
                                        
                                </div>
                              </div>
                           </li>
                           <?php }}$no++;} ?>
                            </ul>
                            </div>
                    </div>
					<div class="col-lg-2 col-md-2 col-sm-2">
                    	<div class="price_list"><div><sup>$</sup><?php echo $row->discount_price; ?>*<span class="normal_price_list">$<?php echo $row->normal_price; ?></span><small >*Per person</small>
                        <p><a href="<?php echo base_url('tour/').$row->id_tour; ?>" class="btn_1">Details</a></p>
                        </div>
                       
                        </div>
                    </div>
                    </div>
				</div><!--End strip -->
                <?php } ?>