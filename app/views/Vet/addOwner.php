<?php
$this->view('shared/header', 'Add client');
$inputs = [
['name'=>'first_name', 'type'=>'text', 'label'=>_('First name:')],
['name'=>'last_name', 'type'=>'text', 'label'=>_('Last name:')],
['name'=>'contact', 'type'=>'text', 'label'=>_('Contact:')]
];
echo $this->form('form','','post',$inputs,'Add owner');

$this->doFeedback('#form'); 
$this->view('shared/footer');
?>