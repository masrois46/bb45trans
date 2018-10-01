<?php
    $subdomain = $_SERVER['HTTP_HOST'];
    $domain = explode('.', $subdomain);
?>
<table class="table">
    <tr>
        <th>ID Confirm</th>
        <td><input type="text" name="id_confirm_transfer" class="form-control" readonly value="<?=$result['id_confirm_transfer'];?>"></td>
    </tr>
    <tr>
        <th>Email</th>
        <td><?=$result['email'];?></td>
    </tr>
    <tr>
        <th>ID Invoice</th>
        <td><input type="text" name="id_invoice" class="form-control" readonly value="<?=$result['id_invoice'];?>"></td>
    </tr>
    <tr>
        <th>Date Transfer</th>
        <td><?=date('D, d F Y', $result['date_transfer']);?></td>
    </tr>
    <tr>
        <th>Image Transfer</th>
        <td><a href="http://<?=$domain[1];?>/<?=$result['image'];?>" target="_blank"><img src="http://<?=$domain[1];?>/<?=$result['image'];?>" width="100" height="100"></a></td>
    </tr>
    <tr>
        <th>Status</th>
        <td><?php if($result['status'] == 0){ echo 'Pending'; }else if($result['status'] == 1){ echo 'Approve'; }else{echo'Rejected';} ?></td>
    </tr>
</table>