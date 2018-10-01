    <?php 
        foreach($data as $row){ 
        $dt = date('d-D-M-Y', $row->order_date);
        $date = explode('-', $dt);
        $date_order = date('l, d M Y', $row->order_date);
        $date_tour = date('l, d M Y', $row->date_tour);
        if($row->status_invoice == 0){
            $status = '<span class="label label-warning" style="color:white;">Pending</span>';
        }else if($row->status_invoice == 1){
            $status = '<span class="label label-success" style="color:white;">Completed</span>';
        }else{
            $status = '<span class="label label-danger" style="color:white;">Canceled</span>';
        }
    ?>
    <div class="strip_booking">
				<div class="row">
					<div class="col-md-2 col-sm-2">
						<div class="date">
							<span class="month"><?=$date[2];?> <?=$date[3];?></span>
							<span class="day"><strong><?=$date[0];?></strong><?=$date[1];?></span>
						</div>
					</div>
					<div class="col-md-6 col-sm-5">
						<h3 class="tours_booking">Tour Booking <?=$date_order;?><span><?=$row->bank_name;?> <strong><?=$status;?></strong></span></h3>
					</div>
					<div class="col-md-2 col-sm-3">
						<ul class="info_booking">
							<li><strong>Booking id</strong> <?=$row->id_invoice;?></li>
							<li><strong>Date Tour on</strong> <?=$date_tour;?></li>
						</ul>
					</div>
					<div class="col-md-2 col-sm-2">
                    <div class="dropdown">
                    <button class="btn btn-primary btn-sm dropdown-toggle" type="button" data-toggle="dropdown">See More
                    <span class="caret"></span></button>
                    <ul class="dropdown-menu">
                            <?php if($row->status_invoice == 1){
                                echo '<li><a href="/invoice/'.$row->id_invoice.'?v='.md5($row->id_invoice).'" target="_blank">View Invoice</a></li>';
                            }else if($row->status_paid == 0 && $row->status_invoice == 0){
                                echo '<li><a href="/invoice/'.$row->id_invoice.'?v='.md5($row->id_invoice).'" target="_blank">View Invoice</a></li>'; ?>
                                <li><a href="/member/cancel_tour/<?=$row->id_invoice;?>" onClick="return confirm('Are you sure?');">Cancel</a></li>
                            <?php 
                            }else{
                                echo '<li><a href="/invoice/'.$row->id_invoice.'?v='.md5($row->id_invoice).'" target="_blank">View Invoice</a></li>';
                            }
                            ?>
                            
                        </ul>                            
						</div>
					</div>
				</div><!-- End row -->
			</div><!-- End strip booking -->
    <?php } ?>