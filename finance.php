    <input type="button" name="submit" id="submit" value="Выйти" onClick = "exit()" />

    <h1>"Здравствуйте, Это Финансовые транзакции."</h1>
    <h3>Ваш Баланс на счёте - <div id="bal"></div></h3>
    <input type="button" name="submit" id="submit" value="Обновить" onClick = "getBalance()" />
    <table>
        <tr>
            <td>Сколько выведем со счёта:</td>
            <td><input type="text" name="money" id="money" /><td>
            <div id="moneymsg"></div>
        </tr>
        <tr>
            <td></td>
            <td><input type="button" name="submit" id="submit" value="Вывести" onClick = "pay()" /></td>
        </tr>
    </table>
    <div id="msg"></div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript">
    function getBalance(){
        $.ajax({
            type: "GET",
            url: "Finance/actionBalance",
            datatype:"json"
        }).done(function(result)
        {
            $("#bal").html(result);
        });
    }
    function exit(){
        $.ajax({
            type: "GET",
            url: "Auth/actionDoExit",
            datatype:"json"
        })
    }
    function pay(){
        var money = $('#money').val();
        $.ajax({
            type: "POST",
            url: "Finance/actionPay",
            datatype:"json",
            data: {'money': money}
        }).done(function(result)
        {
            $("#moneymsg").html(result);
        });
    }
</script>

