<?php
session_start();

if ($_GET['submit'] === "OK"){
    $_SESSION['login'] = $_GET['login'];
    $_SESSION['passwd'] = $_GET['passwd'];}
?>
<html>
<body>
<form action="index.php" method="GET">
    login:<br>
    <input type="text" name="login" value="<?php echo $_SESSION['login']; ?>" />
    <br>passwd:<br>
    <input type="password" placeholder="login" name="passwd" value="<?php echo $_SESSION['passwd']; ?>"/>
    <br><br>
    <input type="submit" placeholder="password" name="submit" value="OK" />
</form>

</body>
</html>
