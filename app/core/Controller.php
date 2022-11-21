<?php
namespace app\core;

class Controller{
//TODO: add a parameter for data later
	public function view($name, $data = []){
		include('app/views/' . $name . '.php');
	}

	public function doFeedback($form){
		if(Model::$input!=null)
			$this->JSinputFeedback(Model::$input, $form);
		if(Model::$validation!=null)
			$this->JSvalidationFeedback(Model::$validation, $form);
	}

	public function saveFile($file){
		if(empty($file['tmp_name']))
			return false;
		$check = getimagesize($file['tmp_name']);
		$allowed_types = ['image/png'=>'png', 'image/jpeg'=>'jpg'];
		if(in_array($check['mime'], array_keys($allowed_types))){
			$ext = $allowed_types[$check['mime']];
			$filename = uniqid() . "." . $ext;
			move_uploaded_file($file['tmp_name'], 'images/' . $filename);
		}
		return $filename;
	}

	protected function JSvalidationFeedback(ValidationResultSet $validation, $form){
		$error = $validation->get();
		echo '<script>';
		foreach ($error as $key => $value) {
			echo "validationFeedback('$form', '$key',". ($value->isValid()?'true':'false') . ", '$value');\n";
		}
		echo "</script>\n";
	}

	protected function JSinputFeedback(Model $input, $form){	
		//render call to JS
		echo "<script>formFeedback('$form',".json_encode($input).");</script>\n";
	}

	protected function renderInput($name,$type,$label){
		return "<div class='input-group has-validation'>
	<label class='input-group-text' >$label</label>
	<input type='$type' name='$name' class='form-control' />
</div>";
	}

	protected function inputs($inputColl){
		$inputs = "";
		foreach ($inputColl as $input) {
			$inputs .= $this->renderInput($input['name'],$input['type'],$input['label']);
		}
		return $inputs;
	}

	protected function form($id,$action,$method,$inputs,$submitVal){
		$form = "<form id='$id' action='$action' method='$method'>";
		$form .= $this->inputs($inputs);
		$form .= "<input type='submit' name='action' value='$submitVal' />\n</form>";
		return $form;

	}
}
