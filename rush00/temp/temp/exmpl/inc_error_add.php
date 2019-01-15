<?php
	if (isset($_GET['create'])) {
		if ($_GET['create'] == 'success') {
?>
<div id="login-modal-form2" class="modal" style="display:block">
		<div id="loginform" class="login-page">
			<form class="form">
			<div class="imgcontainer">
			  <span onclick="document.getElementById('login-modal-form2').style.display='none'" class="close" title="Close Modal">&times;</span>
			</div>
				<h2>Account created!</h2>
			</form>
		</div>
</div>
<?php
}
else if (isset($_GET['create']) && $_GET['create'] == 'erroroldlogin') {
?>
<div id="login-modal-form3" class="modal" style="display:block">
		<div id="loginform" class="login-page">
			<div id="createform" class="login-page">
				<form class="form">
				<div class="imgcontainer">
				  <span onclick="document.getElementById('login-modal-form3').style.display='none'" class="close" title="Close Modal">&times;</span>
				</div>
					<h2>Login already exist</h2>
					<h3>Please, try with another login</h3>
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
				<form class="form">
				<div class="imgcontainer">
				  <span onclick="document.getElementById('login-modal-form4').style.display='none'" class="close" title="Close Modal">&times;</span>
				</div>
					<h2>Wrong filling form!</h2>
					<h3>Please, try again</h3>
				</form>
			</div>
		</div>
</div>

<?php
}
}

?>