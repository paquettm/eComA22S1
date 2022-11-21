<?php
$this->view('shared/header', 'Pet details');
?>
<h1>Client information</h1>
<?php $this->view('Owner/detailsPartial',$data['owner']); ?>

<h1>Animal information</h1>
<dl>
	<dt>
		Name:
	</dt>
	<dd>
		<?= $data['animal']->name ?>
	</dd>
	<dt>
		Date of Birth:
	</dt>
	<dd>
		<?= $data['animal']->dob ?>
	</dd>
	<dt>
		Picture:
	</dt>
	<dd>
		<img src="/images/blank.jpg" style="max-width:200px;max-height:200px" id="profile_pic_preview" />
	</dd>
</dl>



<script>
file = "" + "<?= $data['animal']->profile_pic ?>"
if (file != "") {
	document.getElementById("profile_pic_preview").src = "/images/" + file;
}
</script>

<a href='/Animal/index/<?= $data['owner']->owner_id ?>'>Back to index</a>
<?php
$this->view('shared/footer');
?>