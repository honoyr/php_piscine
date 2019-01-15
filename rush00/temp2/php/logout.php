<?php
    session_start();
    $_SESSION['authorization_ur'] = NULL;
?>
<html>
<title>42 chat</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<style>
    body {
        background: #38a2b3;
    }
    .page {
        padding: 8% 0 0;
        font-family: "Roboto", sans-serif;
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 600px;
        margin: 10% auto ;
        padding: 45px;
        text-align: center;
        box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
    }
    .login-page {
        width: 660px;
        padding: 8% 0 0;
        margin: auto;
        font-family: "Roboto", sans-serif;
    }
    .form {
        position: relative;
        z-index: 1;
        background: #FFFFFF;
        max-width: 360px;
        margin: 0 auto 100px;
        padding: 45px;
        text-align: center;

    }
    .form input {
        color: #FFFFFF;
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #f2f2f2;
        width: 100%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 14px;
    }
    .exit input {
        font-family: "Roboto", sans-serif;
        outline: 0;
        background: #5e2f62;
        width: 33%;
        border: 0;
        margin: 0 0 15px;
        padding: 15px;
        box-sizing: border-box;
        font-size: 10px;
    }
    .form .submit {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #6c1f55;
        width: 100%;
        border: 0;
        padding: 15px;
        color: #FFFFFF;
        font-size: 14px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
    }
    .exit .submit {
        font-family: "Roboto", sans-serif;
        text-transform: uppercase;
        outline: 0;
        background: #c9d748;
        width: 33%;
        border: 0;
        padding: 7px;
        color: #FFFFFF;
        font-size: 12px;
        -webkit-transition: all 0.3 ease;
        transition: all 0.3 ease;
        cursor: pointer;
    }
    .form .exit .submit:hover,.form .submit:active,.form .submit:focus {
        background: #e1ef4e;
    }
    .form .message {
        margin: 15px 0 0;
        color: #b3b3b3;
        font-size: 12px;
    }
    .form .message a {
        color: #4CAF50;
        text-decoration: none;
    }
</style>
<body>
<!--<p>-->
<!--    <br>-->
<!--    <a href="index.html"><-Back</a>-->
<!--</p>-->

<div class="login-page">
    <form class="form" action="login.php" method="POST">
        <h2>42 chat</h2>
        <h3>Error! You are not authorized!</h3>
        <p class="message">Still not loged in? <a href="index.html">Log in an account</a></p>
        <p class="message">Would you like change password? <a href="modif.html">Change password</a></p>
        <p class="message">Still not registered? <a href="create.html">Create an account</a></p>
    </form>
</div>
</body>
</html>

