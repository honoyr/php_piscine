<?php
session_start();
if (!($_SESSION['authorization_ur']))
    echo "ERROR" . PHP_EOL;
else {
    if ($_POST['msg']) {
        if (!file_exists('../private')) {
            mkdir("../private");
        }
        if (!file_exists('../private/chat')) {
            file_put_contents('../private/chat', null);
        }
        $chat = unserialize(file_get_contents('../private/chat'));
        $fp = fopen('../private/chat', "w");
        flock($fp, LOCK_EX);
        $new['login'] = $_SESSION['authorization_ur'];
        $new['time'] = time();
        $new['msg'] = $_POST['msg'];
        $chat[] = $new;
        file_put_contents('../private/chat', serialize($chat));
        fclose($fp);
    }
    ?>
    <html>
    <head>
        <script language="javascript">top.frames['chat'].location = 'chat.php';</script>
        <style type="text/css">
            .chat input {
                font-family: "Roboto", sans-serif;
                outline: 0;
                background: #f2f2f2;
                float: left;
                width: 80%;
                border: 0;
                margin: 0 0 5px;
                padding: 7px;
                box-sizing: border-box;
                font-size: 12px;
            }
            #sub {
                font-family: "Roboto", sans-serif;
                outline: 0;
                background: #00CCBB;
                float: right;
                width: 20%;
                border: 0;
                margin: 0 0 5px;
                padding: 7px;
                box-sizing: border-box;
                font-size: 12px;
            }
        </style>
    </head>
    <body>
    <form class="chat" action="speak.php" method="POST">
        <input type="text" name="msg" value=""/><input id="sub" type="submit" name="submit" value="Send"/>
    </form>
    </body>
    <?php
}
?>