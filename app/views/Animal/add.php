<html>
<head>
	<title>Add an animal</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
<script type="text/javascript" src='https://code.jquery.com/jquery-3.6.1.min.js'></script>
</head>

<body>
<h1>Client Information</h1>
<?php
	$this->view('Owner/detailsPartial', $data['owner']);
	$input = isset($data['input'])?$data['input']:[];
	$error = isset($data['error'])?$data['error']->getSet():[];
?>
<h1>New Pet Information</h1>
<form id='form' action='' method='post' enctype='multipart/form-data'>
	<div class="input-group has-validation">
		<label class="input-group-text" >Name:</label>
		<input type="text" name="name" class='form-control' />
	</div>
	<div class="input-group has-validation"><label class="input-group-text">Date of Birth:</label>
		<input type="date" name="dob" class='form-control' />
	</div>
	<div class="input-group has-validation">
		<label class="input-group-text">Profile Picture:</label>
		<input type="file" name="profile_pic" id="profile_pic" /></label><img id='profile_pic_preview' src='/images/<?=(isset($input->profile_pic)?$input->profile_pic:'blank.jpg')?>' style="max-width:200px;max-height:200px" />
	</div>
	<input type="submit" name="action" value="Add new pet" />
</form>

<script>
	profile_pic.onchange = evt => {
  const [file] = profile_pic.files
  if (file) {
    profile_pic_preview.src = URL.createObjectURL(file)
  }
}
</script>
<script><?php
foreach ($error as $key => $value) { ?>
	$('#form input[name=<?=$key?>]').addClass('<?=($value->isValid?'is-valid':'is-invalid')?>');
	$('#form input[name=<?=$key?>]').parent().append("<div class='invalid-feedback'><?=$value->errorMessage?></div>");	
<?php } 
foreach ($input as $key => $value) { ?>
	try{$('#form input[name=<?=$key?>]').val('<?=$input->$key?>');}catch(err){}
<?php } ?>
</script>

</body>
</html>