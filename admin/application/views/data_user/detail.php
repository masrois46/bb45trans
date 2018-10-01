
<div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="widget">
                <div class="widget-header"> <i class="icon-th-list"></i>
                    <h3>Detail User <?=$result['email'];?></h3>
                </div>
                <!-- /widget-header -->
                <div class="widget-content table-responsive">
                    <div class="row">
                        <div class="span7">
                            <h3>Detail User</h3>
                            <table class="table">
                                <tr>
                                    <th>Email</th>
                                    <td><?=$result['email'];?></td>
                                </tr>
                                <tr>
                                    <th>Photo Profile</th>
                                    <td><a href="<?=$server.$result['picture'];?>" target="_blank"><img src="<?=$server.$result['picture'];?>" width="100" height="100"></a></td>
                                </tr>
                                <tr>
                                    <th>First Name</th>
                                    <td><?=$result['first_name'];?></td>
                                </tr>
                                <tr>
                                    <th>Last Name</th>
                                    <td><?=$result['last_name'];?></td>
                                </tr>
                                <tr>
                                    <th>Phone Number</th>
                                    <td><?=$result['phone_number'];?></td>
                                </tr>
                                <tr>
                                    <th>Date of Birth</th>
                                    <td><?=$result['date_of_birth'];?></td>
                                </tr>
                                <tr>
                                    <th>Street Address</th>
                                    <td><?=$result['street_address'];?></td>
                                </tr>
                                <tr>
                                    <th>City</th>
                                    <td><?=$result['city'];?></td>
                                </tr>
                                <tr>
                                    <th>Zip Code</th>
                                    <td><?=$result['zip_code'];?></td>
                                </tr>
                                <tr>
                                    <th>Country</th>
                                    <td><?=$result['country'];?></td>
                                </tr>
                                <tr>
                                    <th>Confirmed</th>
                                    <td><?php if($result['confirmed'] == 0){ echo '<span class="label label-warning">Unconfirmed</span>'; }else{ echo '<span class="label label-success">Confirmed</span>'; } ?></td>
                                </tr>
                                <tr>
                                    <th>Create at</th>
                                    <td><?=date('H:i:s D, d F Y', $result['create_at']);?></td>
                                </tr>
                                <tr>
                                    <th>Last Access</th>
                                    <td><?=date('H:i:s D, d F Y', $result['last_access']);?></td>
                                </tr>
                            </table>
                        </div>
                        <div class="span4">
                            <h3>Change Password</h3>
                            <form action="/users/change-password" method="POST" id="formPassword">
                            <input type="hidden" name="email" value="<?=$result['email'];?>">
                            <table class="table">
                                <tr>
                                    <th>New Password</th>
                                    <td><input type="password" name="newpswd" class="form-control" id="newpswd" placeholder="New Password" required></td>
                                </tr>
                                <tr>
                                    <th>Confirm Password</th>
                                    <td><input type="password" class="form-control" id="confpswd" placeholder="Confirmation Password" required><br><span class="label label-warning" id="alertConfPswd">Confirmation password not match!</span></td>
                                </tr>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><button type="submit" class="btn btn-primary" id="btnSavePassword">Save Changes</button></td>
                                </tr>
                            </table>
                            </form>
                        </div>
                    </div>
                    
                </div>
            </div>
            <!-- /widget -->
        </div>
    </div>
</div>