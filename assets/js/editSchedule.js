/**
 * File : editSchedule.js 
 * 
 * This file contain the validation of edit schedule form
 * 
 * @author Kishor Mali
 */
$(document).ready(function(){
	
	var editScheduleForm = $("#editSchedule");
	
	var validator = editScheduleForm.validate({
		
		rules:{
			fname :{ required : true },
			day :{ required : true },
			branch : { required : true, selected : true}
		},
		messages:{
			fname :{ required : "This field is required" },
			
			branch : { required : "This field is required", selected : "Please select atleast one option" },	
			day : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});
});