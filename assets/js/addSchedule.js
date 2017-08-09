/**
 * File : addSchedule.js
 * 
 * This file contain the validation of add schedule form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Kishor Mali
 */

$(document).ready(function(){
	
	var addScheduleForm = $("#addSchedule");
	
	var validator = addScheduleForm.validate({
		
		rules:{
			fname :{ required : true },
			
			branch : { required : true},
			day : { required : true, selected : true}
		},
		messages:{
			fname :{ required : "This field is required" },
			branch :{ required : "This field is required" },
			day : { required : "This field is required", selected : "Please select atleast one option" }			
		}
	});
});
