<?php
$this->view('shared/header', 'Client Details');
?>
<dl>
	<dt>
		First name:
	</dt>
	<dd>
		<?= $data->first_name ?>
	</dd>
	<dt>
		Last name:
	</dt>
	<dd>
		<?= $data->last_name ?>
	</dd>
	<dt>
		Contact:
	</dt>
	<dd>
		<?= $data->contact ?>
	</dd>
</dl>

<a href='/Vet/index'>Back to index</a>
<?php
$this->view('shared/footer');
?>