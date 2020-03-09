$(document).ready(function(){
    // load houses using DATA tales
    var dataTable = $('#loadCategories').DataTable({
        "processing":true,
        "serverSide":true,
        "order":[],
        "ajax":{
            url: base_url+"api/category/fetch.php",
            type:"POST"
        },
        "autoWidth":false
    });

    $('#newCategoryBtn').click(function(){
        $('#newCatgoryModal').modal('show');
        $('#newCatgoryForm')[0].reset();
    });

    $('#newCatgoryForm').submit(function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:base_url+'api/category/new_category.php',
            type:"POST",
            data:form_data,
            dataType:"json",
            beforeSend:function(){
                $('#newCategorySubmitBtn').html('Loading...');
            },
            success:function(data){
                $('#newCategorySubmitBtn').html('Save');
                if(data.message == 'success'){
                    $('#newCatgoryForm')[0].reset();
                    $('#newCatgoryModal').modal('hide');
                    // load data
                    dataTable.ajax.reload();
                }

            }
        });
    });
});