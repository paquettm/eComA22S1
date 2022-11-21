<?php
$this->view('shared/header', 'Say it again');
?>
I would like to say the following:
<?php
echo $data;
?>
<a href='/Main/index'>go to Main/index</a>

<?php
$this->view('shared/footer');
?>