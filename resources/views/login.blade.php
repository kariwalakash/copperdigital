<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<div>
    Matchmove User App
</div>
<div id="userloginform">
    Login
    <form id="userLogin" action="#">
        <table>
            <tr>
                <input type="text" id="token" placeholder="token">
            </tr>
            <tr>
                <button id="loginbutton"> login</button>
            </tr>
        </table>
    </form>
</div>
<div id="loginDiv">

</div>


</body>
<script>
    $(document).ready(function () {

        $("#loginbutton").click(function () {
            var value = $('#token').val();

            $.ajax({
                url: "login",
                data: { token:  value},
                type: "POST",
                success: function(response) {
                    $('#userloginform').hide();
                    $('#loginDiv').html(response.message);
                }
            });
        });

    });
</script>

</html>