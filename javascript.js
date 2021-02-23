/**
 * Hides error message by getting all the elements with the class name “error”.
 */
function hideErrors(){
  var errorFields = document.getElementsByClassName("error");

  for(var i = 0; i < errorFields.length; i++){
    errorFields[i].style.display = "none";
  }
}

/**
 * Checks for any error flag set to true.
 * @param e event method.
 * @return A boolean if it finds any error.
 */
function validate(e){
  if(formHasErrors()){
    e.preventDefault();
    return false;
  }

  return true;
}

/**
 * Use a regex to remove spaces from a string.
 * @param str String value of a textbox.
 * @return a string without the space from the beginning of the text or the end.
 */
function trim(str) {
	return str.replace(/^\s+|\s+$/g,"");
}

/**
 * Check if the text field has a value.
 * @param fieldElement the textfield element.
 * @return a bolean if textfields are empty.
 */
function formFieldHasInput(fieldElement){
	if(!fieldElement.value || trim(fieldElement.value) == "" ){
    return false;
	}
	return true;
}

/**
 * Flag the form if there is an error.
 * @return a bolean if the form contains an error.
 */
function formHasErrors(){
  var errorFlag = false;
  var requiredTextFields = ['title', 'author', 'date_published'];

  for(var i=0; i < requiredTextFields.length; i++){
    var textField = document.getElementById(requiredTextFields[i]);

    if(!formFieldHasInput(textField)){
      document.getElementById(requiredTextFields[i] + "_error").style.display = "block";

      if(!errorFlag){
        textField.focus();
        textField.select();
      }

      errorFlag = true;
    }
    else{
      hideErrors();
    }
  }
  return errorFlag;
}

/**
 * Removes error at load time and have an event listener when the form is submitted.
 */
function load(){
hideErrors();

document.getElementById("myForm").addEventListener("submit", validate, false);
}

document.addEventListener("DOMContentLoaded", load, false);
