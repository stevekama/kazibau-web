$(document).ready(function(){
    $('#loginForm').submit(function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:base_url+"api/users/login.php",
            type:"POST",
            data:form_data,
            dataType:"json",
            beforeSend:function(){

            },
            success:function(data){
                if(data.message == "success"){
                    window.location.href = base_url+"index.php";
                }
            }
        });
    });
});