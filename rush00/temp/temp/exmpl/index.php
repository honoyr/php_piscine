<?php
	session_start();
	include 'busket_price2.php';
?>
<html>
	<head>
		<title>ft_minishop</title>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<style>
#userstable {
    font-family: "Trebuchet MS", Arial, Helvetica, sans-serif;
    border-collapse: collapse;
    margin-top: 10px;
    margin-bottom: 20px;
    padding-bottom: 20px;
    margin: auto;
}

#userstable td, #userstable th {
    border: 1px solid #ddd;
    padding: 8px;
}

#userstable tr:nth-child(even){background-color: #f2f2f2;}

#userstable tr:hover {background-color: #ddd;}
#userstable img {width: 20px;}
#userstable .admin {width: 100px;}
#userstable .pic {width: 20px;}

#userstable th {
    padding-top: 12px;
    padding-bottom: 12px;
    text-align: left;
    background-color: #fbba00;
    color: white;
}
		.footer {
			left: 0;
			bottom: 0;
			width: 100%;
			background-color: #fbba00;
			color: white;
			cursor: unset;
			text-align: center;
		}
		.footer p {
			display: block;
			margin: 0 auto;
			padding: 10px;
		}
			body {
				background: #fbba00;
				position: relative;
			}
			.container h1 {
				padding: 17px 17px 0px 27px ;
				font-size: 24px;
			}
			h2 {
				color: #565454;
			}
			h3 {
				color: #565454;
			}
			h4 {
				color: #565454;
			}
			hr {
				max-width: 98%;
				clear: right;
			}
			.content-products {
				width: 98%;
				padding: 15px;
				display: block;
				margin: 15px auto;
			}
			.content-products h2 {
				color: #565454;
				font-size: 18px;
				margin: 5px;
			}
			.content-products .product-line {
				width: 98%
				margin: 5px;
			}
			.content-products .product-line .product{
				width: 19%;
				margin: 10px;
				border: 1px solid #E2E2E2;
				border: 5px solid #ffffff;
				-webkit-box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				-moz-box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
				padding: 1em;
				float:left;
			}
			.product img {
				min-height: 5vw;
				max-height: 10vw;
				max-width: 100%;
				display: block;
				margin: 0 auto;
				border: 1px solid #ffffff;
				-webkit-box-shadow: 0 0 13px rgba(0, 0, 0, 1);
				-moz-box-shadow: 0 0 13px rgba(0, 0, 0, 1);
				box-shadow: 0 0 13px rgba(0, 0, 0, 1);
			}
			.product h3 {
				text-align: center;
				display: block;
				margin: 10px auto;
				margin-top: 25px;
				margin-bottom: 25px;
			}
			.product h4 {
				text-align: center;
				display: block;
				margin: 10px auto;
				margin-top: 25px;
				margin-bottom: 25px;
				font-style: italic;
				font-weight: 900;
				text-shadow:5px 5px 30px #fbba00;
			}
			.product input {
				background-color: #565454;
				color: white;
				padding: 10px 40px;
				margin: 0 auto;
				display: block;
				border: none;
				cursor: pointer;
			}
			@media (max-width : 758px) {
				.product input {
				background-color: #565454;
				color: white;
				padding: 5px 20px;
				margin: 0 auto;
				display: block;
				border: none;
				cursor: pointer;
				font-size: 10px;
			}
			}

			.login-b button {
				background-color: #565454;
				color: white;
				float: right;
				padding: 14px 20px;
				margin: 8px 0;
				border: none;
				cursor: pointer;
				right: 20px;
				top: 3px;
				position: absolute;
			}
			.login-b .adm {
				background-color: #565454;
				color: white;
				float: right;
				padding: 14px 20px;
				margin: 8px 0;
				border: none;
				cursor: pointer;
				right: 100px;
				top: 3px;
				position: absolute;
			}
			.modal {
				display: none; /* Hidden by default */
				position: fixed; /* Stay in place */
				z-index: 1; /* Sit on top */
				left: 0;
				top: 0;
				width: 100%; /* Full width */
				height: 100%; /* Full height */
				overflow: auto; /* Enable scroll if needed */
				background-color: rgb(0,0,0); /* Fallback color */
				background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
				padding-top: 60px;
			}
			.container {
				width: 90%;
				min-height: 90%;
				max-width: 1500px;
				margin: auto;
				font-family: "Roboto", sans-serif;]
				box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
				position: relative;
				z-index: 1;
				background: #FFFFFF;
				border-radius: 10px;
			}
			.login-page {
				width: 360px;
				padding: 8% 0 0;
				margin: auto;
				font-family: "Roboto", sans-serif;
			}
			.busket-form {
				width: 360px;
				padding: 8% 0 0;
				margin: auto;
				z-index: 100;
				font-family: "Roboto", sans-serif;
			}
			#busket-modal-form {
				z-index: 200!important;
				display: none; /* Hidden by default */
				position: fixed; /* Stay in place */
				left: 0;
				top: 0;
				width: 100%; /* Full width */
				height: 100%; /* Full height */
				overflow: auto; /* Enable scroll if needed */
				background-color: rgb(0,0,0); /* Fallback color */
				background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
				padding-top: 60px;
			}
			#busket-modal-form #formb {
				position: relative;
				z-index: 201;
				background: #FFFFFF;
				max-width: 100%;
				margin: 0 auto 100px;
				padding: 45px;
				text-align: center;
				box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
			}
			.form {
				position: relative;
				z-index: 2;
				background: #FFFFFF;
				max-width: 360px;
				margin: 0 auto 100px;
				padding: 45px;
				text-align: center;
				box-shadow: 0 0 20px 0 rgba(0, 0, 0, 0.2), 0 5px 5px 0 rgba(0, 0, 0, 0.24);
			}
			.form input {
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
			.form .submit {
				font-family: "Roboto", sans-serif;
				text-transform: uppercase;
				outline: 0;
				background: #565454;
				width: 100%;
				border: 0;
				padding: 15px;
				margin: 10px;
				color: #FFFFFF;
				font-size: 14px;
				-webkit-transition: all 0.3 ease;
				transition: all 0.3 ease;
				cursor: pointer;
			}
			.adm, .login-b button:hover, .form .submit:hover,.form .submit:active,.form .submit:focus {
				background: #fbba00;
			}
			.form .message {
				margin: 15px 0 0;
				color: #565454;
				font-size: 14px;
			}
			.form .message a {
				color: #fbba00;
				text-decoration: none;
			}
			.close {
				position: absolute;
				right: 25px;
				top: 0;
				color: #000;
				font-size: 35px;
				font-weight: bold;
			}
			.close:hover {
				cursor: pointer;
				color: #fbba00;
			}
			.form .message a:hover {
				cursor: pointer;
			}
			.basket {
				position: fixed;
				right: 20px;
				float: right;
				z-index: 222;
				top: 500px;
			}
			.forbasket img {
				background: #565454;
				padding: 10px;
				border-radius: 20px;
			}
		</style>
	</head>
	<body>
		<div class="forbasket">
		<img class="basket" src="img/basket.png"  onclick="document.getElementById('busket-modal-form').style.display='block'"">
		</div>
		<div style="clear:left">
		<div class="container">
			<h1>Project Shop</h1>
				<div class="login-b">
					<?php
					function admcheck($login) {
						$arr = unserialize(file_get_contents("../private/passwd"));
						foreach ($arr as $key => $inarr) {
							if ($inarr['login'] === $login && $inarr['admin'] == 1) {
								return (true);
							}
						}
						return (false);
					}
					if (isset($_SESSION['authorized_user']) && admcheck($_SESSION['authorized_user'])) {
					?>
					<button class="adm" onclick="window.location.href='admin.php'">ADM</button>
					<?php
					}
					if (isset($_SESSION['authorized_user']) && $_SESSION['authorized_user']) {
					?>
					<button onclick="window.location.href='logout.php'" style="width:auto;">Logout</button>
					<?php
					} else {
					?>
					<button onclick="document.getElementById('login-modal-form').style.display='block'" style="width:auto;">Login</button>
					<?php 
					}
					?>
					<div id="login-modal-form" class="modal">
						<div id="loginform" class="login-page">
							<form class="form" action="login.php" method="POST">
							<div class="imgcontainer">
							  <span onclick="document.getElementById('login-modal-form').style.display='none'" class="close" title="Close Modal">&times;</span>
							</div>
								<h2>Sign in</h2>
								<input type="text" placeholder="login" name="login" value="" />
								<input type="password" placeholder="password" name="passwd" value="" />
								<input class="submit" type="submit" name="submit" value="OK" />
								<p class="message">Are you not registered? <a onclick="opentab('createform')">Create account</a></p>
							</form>
						</div>
						<div id="createform" class="login-page" style="display:none">
							<form class="form" action="create.php" method="POST">
							<div class="imgcontainer">
							  <span onclick="document.getElementById('login-modal-form').style.display='none'" class="close" title="Close Modal">&times;</span>
							</div>
								<h2>Create account</h2>
								<input type="text" placeholder="login" name="login" value="" />
								<input type="password" placeholder="password" name="passwd" value="" />
								<input type="text" placeholder="e-mail" class="email-ch" name="email" value="" />
								<input type="text" placeholder="telephone" name="phone" value="" />
								<input class="submit" type="submit" name="submit" value="OK" />
								<p class="message">Are you registered? <a onclick="opentab('loginform')">Sign in</a></p>
							</form>
						</div>
					</div>
				</div>
			<hr>
	<?php 
		if (!file_exists('../private/product')) {
		mkdir("../private/product");
		}
		if (!file_exists('../private/product/product')) {
			file_put_contents('../private/product/product', null);
		}
		if (!file_exists('../private/p_l')) {
			mkdir("../private/p_l");
		}
		if (!file_exists('../private/p_l/p_l')) {
			file_put_contents('../private/p_l/p_l', null);
		}
		$list = unserialize(file_get_contents('../private/p_l/p_l'));
		foreach ($list as $key => $value) {
			echo "<hr><div class=\"content-products\"><h2>" . $value . "</h2><div class=\"product-line\">"  . PHP_EOL ;
			$account = unserialize(file_get_contents('../private/product/product'));
			foreach ($account as $val) {
				$i = 0;
				if (in_array($value, $val['type_of_product'])) {
					echo "<div class=\"product\"><img title=\"" . $val['description'] ."\" src=\"" . $val['url'] ."\"><h3>" . $val['name_of_product'] . "</h3><h4>" . $val['price'] ."UAH</h4><form  action=\"put_in_busket.php\" method=\"POST\">
				<input type=\"text\" style=\"display:none;\" placeholder=\"type_of_product\" name=\"type_of_product\" value=\"" . $val['type_of_product'][0] . "\" />
				<input type=\"text\" style=\"display:none;\" placeholder=\"name_of_product\" name=\"name_of_product\" value=\"" . $val['name_of_product'] . "\" />
				<input type=\"text\" style=\"display:none;\" placeholder=\"name_of_product\" name=\"price\" value=\"" . $val['price'] . "\" />
					<input class=\"submit\" type=\"submit\" name=\"submit\" value=\"BUY\" ></form></div>"  . PHP_EOL ;
				}
			}
			echo "</div></div><div style=\"clear:left\"><hr>" . PHP_EOL ;
		}	
		?>
</div></div>

<?php include 'inc_error_create.php';
?>

<div class="footer">
	<p>ft_minishop &copy; apakhomo:bgres
</div>
		</div>

<script>
var modal = document.getElementById('id01');
window.onclick = function(event) {
	if (event.target == modal) {
		modal.style.display = "none";
	}
}
function opentab(tabname) {
	var i;
	var x = document.getElementsByClassName("login-page");
	for (i = 0; i < x.length; i++) {
	   x[i].style.display = "none";  
	}
	document.getElementById(tabname).style.display = "block";  
}
</script>
		<div id="busket-modal-form" class="modal">
			<div id="busket-form" class="busket-form">
				<div style="clear:both;"></div>
				<form id="formb" class="form" action="make_order.php" method="POST">
				<h2>shopping cart</h2>
				<table id="userstable">
				<tr><th>PRODUCT</th><th>CATEGORY</th><th>PRICE</th></tr>
				<?php
				if ($_SESSION['authorized_user'])
				{
					if (!file_exists('../private/user_basket')) {
						mkdir("../private/user_basket");
					}
					$path1 = "../private/user_basket/" . $_SESSION['authorized_user'] . "_user_basket";
					if (!file_exists($path1)) {
						file_put_contents($path1, null);
					}
					$basket = unserialize(file_get_contents($path1));
					foreach ($basket as $key => $value) {
						echo "<tr><td>" . $value['name_of_product']. "</td><td>" . $value['type_of_product']. "</td><td>" . $value['price']. "</td></tr>";
					}
					echo "<tr><td colspan=\"2\"></td><td>". $_SESSION['price'] ."</td></tr>";
				}
				else {
					if (!file_exists('../private/tmp_basket')) {
						mkdir("../private/tmp_basket");
					}
					$path1 = "../private/tmp_basket/" . session_id() . "_basket";
					if (!file_exists($path1)) {
						file_put_contents($path1, null);
					}
					$basket = unserialize(file_get_contents($path1));
					foreach ($basket as $key => $value) {
						echo "<tr><td>" . $value['name_of_product']. "</td><td>" . $value['type_of_product']. "</td><td>" . $value['price']. "</td></tr>";
					}
					echo "<tr><td colspan=\"2\"></td><td>". $_SESSION['price'] ."</td></tr>";
				}
				?>
				</table>
				<div class="imgcontainer">
				  <span onclick="document.getElementById('busket-modal-form').style.display='none'" class="close" title="Close Modal">&times;</span>
				</div>
					<input class="submit" type="submit" name="submit" value="OK" />
				</form>
			</div>
		</div>
	</body>
</html>