<?php
$this->view('shared/header', 'Add client');?>
<h1>Add a new client</h1>
<?php
$inputs = [
['name'=>'first_name', 'type'=>'text', 'label'=>_('First name:')],
['name'=>'last_name', 'type'=>'text', 'label'=>_('Last name:')],
['name'=>'contact', 'type'=>'text', 'label'=>_('Contact:')]
];
echo $this->form('form','','post',$inputs,'Add owner');
?>
<a href='/Vet'>Cancel</a>
<?php
$this->doFeedback('#form'); 
$this->view('shared/footer');
?>
