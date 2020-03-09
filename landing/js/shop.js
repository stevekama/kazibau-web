$(document).ready(function(){
    function find_all_products(){
        var action = "FIND_PRODUCTS_FOR_LANDING_PAGE";
        $.ajax({
            url:base_url+'api/products/products.php',
            type:"POST",
            data:{action:action},
            dataType:"html",
            success:function(data){
                $('#loadProducts').html(data);
            }
        });
    }
    find_all_products();
});