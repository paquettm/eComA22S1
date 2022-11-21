<?php
$this->view('shared/header', 'Edit pet');
?>
<h1>Client Information</h1>
<?php
	$this->view('Owner/detailsPartial', $data['owner']);
?>
<h1>New Pet Information</h1>
<form id='form' action='' method='post' enctype="multipart/form-data">
	<div class="input-group has-validation">
		<label class="input-group-text">Name:</label>
		<input type="text" name="name" class='form-control'/>
	</div>
	<div class="input-group has-validation">
		<label class="input-group-text">Date of Birth:</label>
		<input type="date" name="dob" class='form-control'/>
	</div>
	<div class="input-group has-validation">
		<label class="input-group-text">Profile picture:</label>
		<input type="file" name="profile_pic" id="profile_pic" class='form-control'/><img id='profile_pic_preview' src='/images/blank.jpg' style="max-width:200px;max-height:200px" />
	</div>
	<input type="submit" name="action" value="Modify pet" />
</form>

<script>
profile_pic.onchange = evt => {
  const [file] = profile_pic.files
  if (file) {
    profile_pic_preview.src = URL.createObjectURL(file)
  }
}

file = "<?= \app\core\Model::$input->profile_pic ?>";
if (file != "") {
	document.getElementById("profile_pic_preview").src = "/images/" + file;
}
</script>
<?php $this->doFeedback('#form'); ?>

<a href="/Animal/index/<?= $data['owner']->owner_id ?>">Cancel</a>

<?php
$this->view('shared/footer');
?>