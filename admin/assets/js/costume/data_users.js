var app = angular.module('bb45trans', []);

app.controller('menuCtrl', function($scope, $http){
    angular.element(document.querySelector("#menuUser")).addClass("active");
});

$(document).ready(function () {
    $('#alertConfPswd').hide();
    $('#ListTableUsers').DataTable({  
        "processing":true,  
        "serverSide":true,
        "lengthChange" : false,
        "responsive": true,
        "order":[],  
        "ajax":{  
             url:"/users/user_json",  
             type:"POST"  
        },  
        "columnDefs":[  
             {  
                  "targets":[1,2,3,4,5,7],  
                  "orderable":false,  
             }
        ],  
   });
});

$('#formPassword').submit(function(e){
    e.preventDefault();
    var new_pswd = $('#newpswd').val();
    var conf_pswd = $('#confpswd').val();
    if(new_pswd == conf_pswd){
        $('#alertConfPswd').hide();
        var form = $('#formPassword');
        $.ajax({
            type: form.attr('method'),
            url: form.attr('action'),
            data: form.serialize(),
            dataType: "json",
            beforeSend: function(){
                $('#btnSavePassword').html('Loading..');
            },
            success: function (response) {
                $('#btnSavePassword').html('Save Changes');
                alert(response.status);
                form.trigger('reset');
            }
        });
    }else{
        $('#alertConfPswd').show();
    }
});