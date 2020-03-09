$(document).ready(function(){
    $('#loginForm').submit(function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:"http://localhost/kazibau/api/users/login.php",
            type:"POST",
            data:form_data,
            dataType:"json",
            beforeSend:function(){

            },
            success:function(data){
                if(data.message == "success"){
                    window.location.href = "http://localhost/kazibau/index.php";
                }
            }
        });
    });
});