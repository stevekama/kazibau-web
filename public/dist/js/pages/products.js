$(document).ready(function(){
    // load houses using DATA tales
    var dataTable = $('#loadProducts').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url: base_url+"api/products/fetch.php",
            type:"POST"
        },
        "autoWidth":false
    });

    $('#newProductBtn').click(function(){
        $('#newProductModal').modal('show');
        $('#newProductForm')[0].reset();
    }); 

    $('#newProductForm').submit(function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:base_url+'api/products/new_product.php',
            type:"POST",
            data:form_data,
            dataType:"json",
            beforeSend:function(){
                $('#newProductSubmitBtn').html('Loading...');
            },
            success:function(data){
                $('#newProductSubmitBtn').html('Save');
                if(data.message == 'success'){
                    $('#newProductForm')[0].reset();
                    $('#newProductModal').modal('hide');
                    // load data
                    dataTable.ajax.reload();
                }

            }
        });
    });


    $(document).on('click', '.view_product', function(){
        var product_id = $(this).attr('id');
        var action = "FIND_PRODUCT_BY_ID";
        $.ajax({
            url:base_url+'api/products/products.php',
            type:"POST",
            data:{action:action, product_id:product_id},
            dataType:"json",
            success:function(data){
                localStorage.setItem('product_id', data.id);
                window.location.href = base_url+"public/products/profile.php";
            }
        });
    });
});