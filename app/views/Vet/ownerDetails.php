<html>
<head>
	<title>Edit client</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-A3rJD856KowSb7dwlZdYEkO39Gagi7vIsF0jrRAoQmDKKtQBHUuLZ9AsSv4jD4Xa" crossorigin="anonymous"></script>
</head>

<body>
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

</body>
</html>