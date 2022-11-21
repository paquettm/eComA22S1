function validationFeedback(form, inputname, valid, message){
	$(form + ' input[name=' + inputname +']').addClass((valid?'is-valid':'is-invalid'));
	$(form + ' input[name=' + inputname +']').parent().append("<div class='invalid-feedback'>" + message + "</div>");
}

function inputFeedback(form,inputname,value){
	try{
		input = $(form + ' input[name='+ inputname +'], textarea[name=' + inputname +'], select[name=' + inputname +']');
		if(input.prop('type') == 'checkbox' || input.prop('type') == 'radio'){
			input = $(form + ' input[name='+ inputname +'][value="'+ value +'"]');
			input.prop('checked', true);
		}else if(input.prop('tagname') == 'select'){
			input = $(form + ' select[name='+ inputname +'] option[value="'+ value +'"]');
			input.attr('selected', true);
		}else{
			input.val(value);
		}
	}catch(err){}
}

function formFeedback(form, validations){
	Object.keys(validations).forEach(key => {
  		inputFeedback(form, key, validations[key]);
	});
}