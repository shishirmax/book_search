$('.submit').click(function(){
        var admin_name = $("#admin_login");
        var password = $("#password");
         result = document.getElementById('result');

        if(admin_name.val() == '') {
            result.innerHTML = "<div id='status'><strong>Oh Snap! </strong>Login ID cannot be empty.</div>";
            return false;
        } else if(password.val() == '') {
            result.innerHTML = "<div id='status'><strong>Oh Snap! </strong>Password cannot be empty.</div>";
            return false;
        }
    });

$('.book_submit').submit(function(){
        var admin_name = $("#admin_login");
        var password = $("#password");
        var admin_name = $("#admin_login");
        var password = $("#password");
        var admin_name = $("#admin_login");
        var password = $("#password");
        var admin_name = $("#admin_login");
        var password = $("#password");
         result = document.getElementById('result');

        if(admin_name.val() == '') {
            result.innerHTML = "<div id='status'><strong>Oh Snap! </strong>Login ID cannot be empty.</div>";
            return false;
        } else if(password.val() == '') {
            result.innerHTML = "<div id='status'><strong>Oh Snap! </strong>Password cannot be empty.</div>";
            return false;
        }
    });

$('.edit').click(function(){
    var bid = $(this).attr('id');
    $.post("edit.php",{bid:bid},function(data){
        console.log(data);
        $("#frame").fadeIn();
        $("#frame").html(data);
        $("#overlay").fadeIn();
    });
});

$('#overlay').click(function(){
    $('#overlay').fadeOut();
    $('#frame').fadeOut();
    $('#confirm_box').fadeOut();
});

$('.delete').click(function(){
    var bid = $(this).attr('id');
    $.post("delete.php",{bid:bid},function(e){
        $('#overlay').fadeIn();
        $('#confirm_box').fadeIn();
        $('#confirm_box').html(e);
        console.log(e);
    });
});