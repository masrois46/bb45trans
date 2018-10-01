var app = angular.module('bb45trans', []);

app.controller('menuCtrl', function($scope, $http){
    angular.element(document.querySelector("#menuOrder")).addClass("active");
});

$(document).ready(function () {
    $('#tableDataOrder').DataTable({  
        "processing":true,  
        "serverSide":true,
        "lengthChange" : false,
        "responsive": true,
        "order":[],  
        "ajax":{  
             url:"/data-order/get-data-invoice",  
             type:"POST"  
        },  
        "columnDefs":[  
             {  
                  "targets":[1,4,5,6,7],  
                  "orderable":false,  
             }
        ],  
   });
});

function cancel(id){
    var r = confirm('Are you sure cancel order #'+id);
    if(r == true){
        window.location.href = '/data-order/cancel_invoice/'+id;
    }else{

    }
}

$(document).ready(function () {
    $('#tableConfirm').DataTable({  
        "processing":true,  
        "serverSide":true,
        "lengthChange" : false,
        "responsive": true,
        "order":[],  
        "ajax":{  
             url:"/data-order/get-data-confirm",  
             type:"POST"  
        },  
        "columnDefs":[  
             {  
                  "targets":[5],  
                  "orderable":false,  
             }
        ],  
   });
});

function getModal(id){
    $.get('/data-order/get-data-modal?id='+id, function(result){
        $('#myModalLabel').html('APPROVE ID Confirm '+id);
        $('#modal_body').html(result);
        $('#txtType').val('approve');
    });
}

function getModalReject(id){
    $.get('/data-order/get-data-modal?id='+id, function(result){
        $('#myModalLabel').html('REJECT ID Confirm '+id);
        $('#modal_body').html(result);
        $('#txtType').val('reject');
    });
}

function getModalProses(id){
    $('#headTitle').html('Process Tour '+id);
    $('#txtIdInvoice').val(id);
}