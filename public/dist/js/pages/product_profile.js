$(document).ready(function(){
    const product_id = localStorage.getItem("product_id");

    function find_product_by_id(){
        var action = "FIND_PRODUCT_BY_ID";
        $.ajax({
            url:base_url+'api/products/products.php',
            type:"POST",
            data:{action:action, product_id:product_id},
            dataType:"json",
            success:function(data){
                $('#productPic').html('<img class="profile-user-img img-responsive img-circle" src="'+base_url+'landing/img/products/'+data.product_pic+'" alt="User profile picture">');
                $('#productName').html(data.product);
                $('#productDescription').html(data.product_description);
                find_category_by_id(data.category_id);
                find_brand_by_id(data.brand_id);
                find_all_product_images();
                $('#productStatus').html(data.product_status);
                $('#productPrice').html(data.product_price);
            }
        });
    }
    find_product_by_id();

    // find category by id
    function find_category_by_id(category_id){
        var action = "FIND_CATEGORY_BY_ID";
        $.ajax({
            url:base_url+'api/category/categories.php',
            type:"POST",
            data:{action:action, category_id:category_id},
            dataType:"json",
            success:function(data){
                $('#productCategory').html(data.category_name);
            }
        });
    }

    // find brand by id
    function find_brand_by_id(brand_id){
        var action = "FIND_BRAND_BY_ID";
        $.ajax({
            url:base_url+'api/brands/brands.php',
            type:"POST",
            data:{action:action, brand_id:brand_id},
            dataType:"json",
            success:function(data){
                $('#productBrand').html(data.brand_name);
            }
        });
    }

    // change product details
    $('#updateProductBtn').click(function(){
        var action = "FIND_PRODUCT_BY_ID";
        $.ajax({
            url:base_url+'api/products/products.php',
            type:"POST",
            data:{action:action, product_id:product_id},
            dataType:"json",
            success:function(data){
                $('#updateProductId').val(data.id);
                $('#updateProduct').val(data.product);
                $('#updateProductDescription').val(data.product_description);
                $('#updateProductPrice').val(data.product_price);
                $('#updateProductModal').modal('show');
            }
        });
    });

    $('#updateProductForm').submit(function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:base_url+'api/products/update_product.php',
            type:"POST",
            data:form_data,
            dataType:"json",
            success:function(data){
                if(data.message == "success"){
                    $('#updateProductForm')[0].reset();
                    $('#updateProductModal').modal('hide');
                    $('#loadImages').DataTable().destroy();
                    find_product_by_id();
                }
            }
        });

    });

    // change product pic
    $('#updateProductPicBtn').click(function(){
        var action = "FIND_PRODUCT_BY_ID";
        $.ajax({
            url:base_url+'api/products/products.php',
            type:"POST",
            data:{action:action, product_id:product_id},
            dataType:"json",
            success:function(data){
                $('#updateProductPicId').val(data.id);
                $('#updateProductPicModal').modal('show');
            }
        });
    });

    $('#updateProductPicForm').submit(function(event){
        event.preventDefault();
        var product_pic = $('#updateProductPic').val();
        if(product_pic == ''){
            $('#alertMessageProfile').html('<div class="alert alert-danger alert-dismissible">Please Select a profile pic</div>');
            return false;
        }else{
            var extension = product_pic.split('.').pop().toLowerCase();
            if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1){
                $('#updateProductPic').val('');
                $('#alertMessageProfile').html('<div class="alert alert-danger alert-dismissible">The file selected is invalid. Please check and try again</div>');
                return false;
            }else{
                $.ajax({
                    url:base_url+"api/products/change_pic.php",
                    type:"POST",
                    data: new FormData(this),
                    dataType:"json",
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData: false,
                    beforeSend: function () {
                        $("#updateProductPicSubmitBtn").val('Uploading..');
                    },
                    success:function(data){
                        $("#updateProductPicSubmitBtn").val('Update');
                        if(data.message == 'success'){
                            $('#loadImages').DataTable().destroy();
                            find_product_by_id();
                            $('#updateProductPicForm')[0].reset();
                            $('#updateProductPicModal').modal('hide');
                        }
                    }
                });
                
            }
        }
    });

    function find_all_product_images(){
        var dataTable = $('#loadImages').DataTable({
            "processing":true,
            "serverSide":true,
            "order":[],
            "ajax":{
                url: base_url+"api/product_image/fetch.php",
                type:"POST",
                data:{product_id:product_id}
            },
            "autoWidth":false
        });    
    }

    // new image
    $('#newImageBtn').click(function(){
        var action = "FIND_PRODUCT_BY_ID";
        $.ajax({
            url:base_url+'api/products/products.php',
            type:"POST",
            data:{action:action, product_id:product_id},
            dataType:"json",
            success:function(data){
                $('#newProductImageId').val(data.id);
                $('#newImageModal').modal('show');
            }
        });
    });

    /// submit image
    $('#newImageForm').submit(function(event){
        event.preventDefault();
        var product_image = $('#newImage').val();
        if(product_image == ''){
            $('#alertMessageImage').html('<div class="alert alert-danger alert-dismissible">Please Select a profile pic</div>');
            return false;
        }else{
            var extension = product_image.split('.').pop().toLowerCase();
            if(jQuery.inArray(extension, ['gif', 'png', 'jpg', 'jpeg']) == -1){
                $('#newImage').val('');
                $('#alertMessageImage').html('<div class="alert alert-danger alert-dismissible">The file selected is invalid. Please check and try again</div>');
                return false;
            }else{
                $.ajax({
                    url:base_url+"api/product_image/new_image.php",
                    type:"POST",
                    data: new FormData(this),
                    dataType:"json",
                    contentType: false,       // The content type used when sending data to the server.
                    cache: false,             // To unable request pages to be cached
                    processData: false,
                    beforeSend: function () {
                        $("#newProductImageSubmitBtn").html('Uploading..');
                    },
                    success:function(data){
                        $("#updateProductPicSubmitBtn").html('Save');
                        if(data.message == 'success'){
                            $('#loadImages').DataTable().destroy();
                            find_product_by_id();
                            $('#newImageForm')[0].reset();
                            $('#newImageModal').modal('hide');
                        }
                    }
                });
                
            }
        }
    });
});