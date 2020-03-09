$(document).ready(function(){
    $('#registrationForm').submit(function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:base_url+"api/users/new_user.php",
            type:"POST",
            data:form_data,
            dataType:"json",
            beforeSend:function(){
                $('#registrationSubmitBtn').html('LOADING...');
            },
            success:function(data){
                $('#registrationSubmitBtn').html('REGISTER');
                if(data.message == "success"){
                    window.location.href = base_url+"index.php";
                }
            }
        });
    });

    $('#adminRegistrationForm').submit(function(event){
        event.preventDefault();
        var form_data = $(this).serialize();
        $.ajax({
            url:"http://localhost/kazibau/api/users/new_user.php",
            type:"POST",
            data:form_data,
            dataType:"json",
            beforeSend:function(){
                $('#adminRegistrationSubmitBtn').html('LOADING...');
            },
            success:function(data){
                $('#adminRegistrationSubmitBtn').html('REGISTER');
                if(data.message == "success"){
                    window.location.href = "http://localhost/kazibau/index.php";
                }
                if(data.message == "errEmail"){
                    $('#alertMessages').html('Email Used Exists. Please check and try again..');
                    $('#password').val('');
                    $('#confirm_password').val('');
                    return false;
                }
                if(data.message == "errPassword"){
                    $('#alertMessages').html('Password Entered do not match. Please check and try again..');
                    $('#password').val('');
                    $('#confirm_password').val('');
                    return false;
                }
            }
        });
    });
});