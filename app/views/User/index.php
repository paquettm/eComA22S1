<?php
$this->view('shared/header', 'Login');
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

$inputs = [
['name'=>'username','label'=>_('Username:'),'type'=>'text'],
['name'=>'password','label'=>_('Password:'),'type'=>'password']
];
echo $this->form('form','','post',$inputs,'Log in');
?>
<!--form action='' method='post'>
	<label>Username:<input type="text" name="username" /></label><br>
	<label>Password:<input type="password" name="password" /></label><br>
	<input type="submit" name="action" value="Log in" />
</form-->

Don't have an account? <a href="/User/register">Register.</a>
<?php
$this->view('shared/footer');
?>
