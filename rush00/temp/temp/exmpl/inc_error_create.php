<?php
	if (isset($_GET['create']) && $_GET['create']) {
		if ($_GET['create'] == 'success') {
?>
<div id="login-modal-form2" class="modal" style="display:block">
		<div id="loginform" class="login-page">
			<form class="form" action="login.php" method="POST">
			<div class="imgcontainer">
			  <span onclick="document.getElementById('login-modal-form2').style.display='none'" class="close" title="Close Modal">&times;</span>
			</div>
				<h2>Account created!</h2> <h3>Please, sign in</h3>
				<input type="text" placeholder="login" name="login" value="" />
				<input type="password" placeholder="password" name="passwd" value="" />
				<input class="submit" type="submit" name="submit" value="OK" />
			</form>
		</div>
</div>
<?php
}
else if ($_GET['create'] == 'erroroldlogin') {
?>
<div id="login-modal-form3" class="modal" style="display:block">
		<div id="loginform" class="login-page">
			<div id="createform" class="login-page">
				<form class="form" action="create.php" method="POST">
				<div class="imgcontainer">
				  <span onclick="document.getElementById('login-modal-form3').style.display='none'" class="close" title="Close Modal">&times;</span>
				</div>
					<h2>Login already exist</h2>
					<h3>Please, try with another login</h3>
					<input type="text" placeholder="login" name="login" value="" />
					<input type="password" placeholder="password" name="passwd" value="" />
					<input type="text" placeholder="e-mail" class="email-ch" name="email" value="" />
					<input type="text" placeholder="telephone" name="phone" value="" />
					<input class="submit" type="submit" name="submit" value="OK" />
				</form>
			</div>
		</div>
</div>
<?php
}
else {
?>
<div id="login-modal-form4" class="modal" style="display:block">
		<div id="loginform" class="login-page">
			<div id="createform" class="login-page">
				<form class="form" action="create.php" method="POST">
				<div class="imgcontainer">
				  <span onclick="document.getElementById('login-modal-form4').style.display='none'" class="close" title="Close Modal">&times;</span>
				</div>
					<h2>Wrong filling form!</h2>
					<h3>Please, try again</h3>
					<input type="text" placeholder="login" name="login" value="" />
					<input type="password" placeholder="password" name="passwd" value="" />
					<input type="text" placeholder="e-mail" class="email-ch" name="email" value="" />
					<input type="text" placeholder="telephone" name="phone" value="" />
					<input class="submit" type="submit" name="submit" value="OK" />
				</form>
			</div>
		</div>
</div>

<?php
}
}
	if (isset($_GET['signin']) && $_GET['signin']) {
		if ($_GET['signin'] == 'success') {
?>
<div id="login-modal-form5" class="modal" style="display:block">
		<div id="loginform" class="login-page">
			<form class="form">
			<div class="imgcontainer">
			  <span onclick="document.getElementById('login-modal-form5').style.display='none'" class="close" title="Close Modal">&times;</span>
			</div>
				<h2>Welcome!</h2>
			</form>
		</div>
</div>
<?php
}
else {
?>
<div id="login-modal-form6" class="modal" style="display:block">
		<div id="loginform" class="login-page">
			<div id="createform" class="login-page">
				<form class="form" action="login.php" method="POST">
				<div class="imgcontainer">
				  <span onclick="document.getElementById('login-modal-form6').style.display='none'" class="close" title="Close Modal">&times;</span>
				</div>
					<h2>Sign in error</h2>
					<input type="text" placeholder="login" name="login" value="" />
					<input type="password" placeholder="password" name="passwd" value="" />
					<input class="submit" type="submit" name="submit" value="OK" />
				</form>
			</div>
		</div>
</div>

<?php
}
}
?>