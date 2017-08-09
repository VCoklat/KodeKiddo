/**
 * File : addStudent.js
 * 
 * This file contain the validation of add student form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Kishor Mali
 */

$(document).ready(function(){
	
	var addStudentForm = $("#addStudent");
	
	var validator = addStudentForm.validate({
		
		rules:{
			student_name :{ required : true },
			parent_name :{ required : true },
			email : { required : true, email : true, remote : { url : baseURL + "checkEmailExists", type :"post"} },
			mobile : { required : true, digits : true },
			address :{ required : true },
			branch :{ required : true },
			schedule :{ required : true },
		},
		messages:{
			student_name :{ required : "This field is required" },
			parent_name :{ required : "This field is required" },
			email : { required : "This field is required", email : "Please enter valid email address", remote : "Email already taken" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
			address :{ required : "This field is required" },	
			branch :{ required : "This field is required" },
			schedule :{ required : "This field is required" },			
		}
	});
});
