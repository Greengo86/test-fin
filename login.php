Это страница авторизации.
<br />
<form method="post">
    Username: <input type="text" name="user" id="user" /><br />
    Password: <input type="password" name="pass" id="pass" /><br />
    <input type="submit" name="submit" value="Войти" onClick = "doAuth()" />
</form>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    function doAuth(){
        var user = $('#user').val();
        var pass = $('#pass').val();
        console.log(user);
        console.log(pass);
        $.ajax({
            type: "POST",
            url: "Auth/actionAuth",
            datatype:"json",
            data: {'user': user, 'pass': pass}
        });
    }

</script>

