<?php
$this->view('shared/header', 'Add new pet');
?>
<h1>Client Information</h1>
<?php
	$this->view('Owner/detailsPartial', $data);
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
<?php $this->doFeedback('#form'); ?>

<a href="/Animal/index/<?= $data->owner_id ?>">Cancel</a>
<?php
$this->view('shared/footer');
?>
