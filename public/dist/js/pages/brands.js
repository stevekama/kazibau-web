$(document).ready(function(){
    // load houses using DATA tales
    var dataTable = $('#loadBrands').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url: base_url+"api/brands/fetch.php",
            type:"POST"
        },
        "autoWidth":false
    });

    $('#newBrandBtn').click(function(){
        $('#newBrandModal').modal('show');
        $('#newBrandForm')[0].reset();
    });

    $('#newBrandForm').submit(function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:base_url+'api/brands/new_brand.php',
            type:"POST",
            data:form_data,
            dataType:"json",
            beforeSend:function(){
                $('#newBrandSubmitBtn').html('Loading...');
            },
            success:function(data){
                $('#newBrandSubmitBtn').html('Save');
                if(data.message == 'success'){
                    $('#newBrandForm')[0].reset();
                    $('#newBrandModal').modal('hide');
                    // load data
                    dataTable.ajax.reload();
                }

            }
        });
    });
});