
<div class="row">
        <div class="col-md-12">
            <div class="widget">
                <div class="widget-header"> <i class="icon-th-list"></i>
                    <h3>Detail Invoice <?=$result['id_invoice'];?></h3>
                </div>
                <!-- /widget-header -->
                <div class="widget-content table-responsive">
                    <div class="row">
                        <div class="span6">
                            <table class="table">
                                <tr>
                                    <th>ID Invoice</th>
                                    <td><?=$result['id_invoice'];?></td>
                                </tr>
                                <tr>
                                    <th>User Email</th>
                                    <td><?=$result['user_email'];?></td>
                                </tr>
                                <tr>
                                    <th>Payment Method</th>
                                    <td><?=$result['bank_name'];?></td>
                                </tr>
                                <tr>
                                    <th>Order Date</th>
                                    <td><?php echo date('D, d F Y', $result['order_date']);?></td>
                                </tr>
                                <tr>
                                    <th>Tour Date</th>
                                    <td><?php echo date('D, d F Y', $result['date_tour']);?></td>
                                </tr>
                                <tr>
                                    <th>Status Paid</th>
                                    <td><?php if($result['status_paid'] == 0){ echo 'Unpaid'; }else{ echo 'Paid';}?></td>
                                </tr>
                                <tr>
                                    <th>Status Invoice</th>
                                    <td><?php if($result['status_invoice'] == 0){ echo 'Waiting Tour'; }else if($result['status_invoice'] == 1){ echo 'Done'; }else{ echo 'Canceled'; }?></td>
                                </tr>
                                <tr>
                                    <th>Confirmation Transfer</th>
                                    <td><?php if($result['confirm']){ echo '<button class="btn btn-primary" data-toggle="modal" data-target="#ModalConfirm" onClick="getModal('.$result['confirm']['id_confirm_transfer'].');">Detail</button>'; }else{ echo 'Empty'; }?></td>
                                </tr>
                                <tr>
                                    <th>Total Bill</th>
                                    <td>$<?=number_format($result['totalInvoice']);?></td>
                                </tr>
                                <?php if($result['admin_name']){ ?>
                                <tr>
                                    <th>Processing by admin</th>
                                    <td><?=$result['admin_name'];?></td>
                                </tr>
                            <?php }?>
                            <?php if($result['status_paid'] == 1 && $result['status_invoice'] != 1){ ?>
                                <tr>
                                    <td colspan="2">
                                        <button class="btn btn-success" data-toggle="modal" data-target="#ModalProses" onClick="getModalProses(<?=$result['id_invoice'];?>);">Process</button>
                                    </td>
                                </tr>
                            <?php } ?>
                            </table>
                        </div>
                        <div class="span5">
                            <h3>Service</h3>
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                </tr>
                                <?php $total=0; foreach($result['service'] as $row){ $total+=$row->price;?>
                                <tr>
                                    <td><?=$row->name;?></td>
                                    <td>$<?=$row->price;?></td>
                                </tr>
                                <?php }?>
                                <tr>
                                    <th>Total</th>
                                    <th>$<?=$total;?></th>
                                </tr>
                            </table>
                            <h3>Tour</h3>
                            <table class="table">
                                <tr>
                                    <th>Name</th>
                                    <th>Qty</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                </tr>
                                <?php $total=0; foreach($result['tour'] as $row){ $total+=$row->subtotal;?>
                                    <tr>
                                        <td><?=$row->name;?></td>
                                        <td><?=$row->qty;?></td>
                                        <td>$<?=number_format($row->price);?></td>
                                        <td>$<?=number_format($row->subtotal);?></td>
                                    </tr>
                                <?php }?>
                                <tr>
                                    <th colspan="3">Total</th>
                                    <th>$<?=number_format($total);?></th>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /widget -->
        </div>
    </div>
</div>

<div id="ModalConfirm" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3>Detail Confirmation Transfer</h3>
    </div>
        <div class="modal-body" id="modal_body"></div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        </div>
</div>

<div id="ModalProses" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="headTitle"></h3>
    </div>
    <form action="/data-order/process-tour" method="post">
    <div class="modal-body">
        <table class="table">
            <tr>
                <th>ID Invoice</th>
                <td><input type="text" name="id_invoice" id="txtIdInvoice" class="form-control" readonly></td>
            </tr>
            <tr>
                <th>Driver</th>
                <td><input type="text" name="driver" class="form-control"></td>
            </tr>
        </table>
    </div>
    <div class="modal-footer">
        <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
        <button class="btn btn-primary" type="submit">Proccess</button>
    </div>
    </form>
</div>