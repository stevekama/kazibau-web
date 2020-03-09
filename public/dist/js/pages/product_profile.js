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
                console.log(data);
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
                    find_product_by_id();
                }
            }
        });

    });
});