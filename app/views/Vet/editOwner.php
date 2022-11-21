<?php $this->view('shared/header','Edit client'); ?>
<form action='' method='post'>
	<label>First name:<input type="text" name="first_name"/></label><br>
	<label>Last name:<input type="text" name="last_name"/></label><br>
	<label>Contact:<input type="text" name="contact"/></label><br>
	<input type="submit" name="action" value="Save changes" />
</form>
<?php $this->doFeedback(''); ?>
<a href='/Vet'>Cancel</a>
<?php
$this->view('shared/footer');
?>
