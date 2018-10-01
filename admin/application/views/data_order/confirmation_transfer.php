<div class="row">
        <div class="col-md-12 col-sm-12">
            <div class="widget">
                <div class="widget-header"> <i class="icon-th-list"></i>
                    <h3>List Confirmation Transfer</h3>
                </div>
                <!-- /widget-header -->
                <div class="widget-content table-responsive">
                    <table class="table table-striped table-bordered" id="tableConfirm">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Email</th>
                            <th>ID Invoice</th>
                            <th>Date Transfer</th>
                            <th>Status</th>
                            <th>Options</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
            <!-- /widget -->
        </div>
    </div>
</div>

<div id="ModalApprove" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
        <h3 id="myModalLabel">Approve ID Confirm</h3>
    </div>
    <form action="/data-order/save-confirm" method="POST">
        <input type="hidden" name="type" id="txtType">
        <div class="modal-body" id="modal_body"></div>
        <div class="modal-footer">
            <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>
            <button class="btn btn-primary" type="submit">Save changes</button>
        </div>
    </form>
</div>
