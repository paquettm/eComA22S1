<?php
$this->view('shared/header', 'User account');
?>
<?php
	if(isset($_GET['error'])){ ?>
<div class="alert alert-danger" role="alert">
  <?= $_GET['error'] ?>
</div>
<?php	}
	if(isset($_GET['message'])){ ?>
<div class="alert alert-success" role="alert">
  <?= $_GET['message'] ?>
</div>
<?php	}
?>
<a href="/User/setup2fa">Set up 2-factor authentication</a>


<h1>Modify your password</h1>
<form action='' method='post'>
	<label>Old password:<input type="password" name="old_password" /></label><br>
	<label>New password:<input type="password" name="password" /></label><br>
	<label>New password confirmation:<input type="password" name="password_confirm" /></label><br>
	<input type="submit" name="action" value="Change password" />
</form>

<a href="/User/logout">logout</a>

<?php
$this->view('shared/footer');
?>