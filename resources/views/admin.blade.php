<html>
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</head>
<body>
<div>
    Matchmove Admin panel
</div>
<div>
    <form id="adminloginform" action="#">
        <table>
            <tr>
                <input type="text" id="username" placeholder="username">
            </tr>
            <tr>
                <input type="text" id="pass" placeholder="pass">
            </tr>
        </table>
    </form>
</div>
<div>

    <form id="creattokenform" action="#">
        <table>
            <tr>
                <input type="number" id="length" placeholder="12">
            </tr>
            <tr>
                <button class="createtokenbutton">Create a new token</button>
            </tr>
        </table>
    </form>
    <div id="create_token">

    </div>
</div>
<div>
    <form action="#">
        <button id="viewtokensbutton">view all tokens</button>
    </form>
    <div id="viewtokens">

    </div>
</div>
</body>

<script>
    $(document).ready(function () {
        $("#viewtokensbutton").click(function () {
            $.ajax({
                url    : "seeAllTokens",
                headers: {
                    username: $('#username').val(),
                    pass    : $('#pass').val(),
                },
                type   : "GET",
                success: function (response) {
                    if (response.success === 'true') {
                        var html = '<table><tr><td>TOKEN</td><td>EXPIRES AT</td><td>VALIDITY</td></tr>';
                        $tokens  = response.data;
                        $tokens.forEach(function (token) {
                            html += "<tr><td>" + token.token + "<td>" + token.expires_at + "<td>" + token.validity + "</tr>"
                        });
                        html += '</tr></table>';
                        // for (data) ;
                        $('#viewtokens').html(html);
                    } else {
                        $('#create_token').html(response.message);
                    }
                }
            });

        });


        $(".createtokenbutton").click(function () {
            $.ajax({
                url    : "generateToken",
                data   : { length: $('#length').val() },
                headers: {
                    "username": $('#username').val(),
                    "pass"    : $('#pass').val(),
                },
                type   : "POST",
                success: function (response) {
                    if (response.success === 'true') {
                        var html = '<div>';
                        html += 'Token : ' + response.data.token + '<br>Expires at : ' + +response.data.token + "</div>";
                        $('#create_token').html(html);
                    } else {
                        $('#create_token').html(response.message);
                    }
                }
            });

        });
    });
</script>

</html>
