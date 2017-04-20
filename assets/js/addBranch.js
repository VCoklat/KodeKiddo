/**
 * File : addBranch.js
 *
 * This file contain the validation of add branch form
 *
 * Using validation plugin : jquery.validate.js
 *
 * @author Kishor Mali
 */

$(document).ready(function(){

	var addBranchForm = $("#addBranch");

	var validator = addBranchForm.validate({

		rules:{
			bname :{ required : true },
			baddress : { required : true },
			mobile : { required : true, digits : true },
		},
		messages:{
			bname :{ required : "This field is required" },
			baddress : { required : "This field is required" },
			mobile : { required : "This field is required", digits : "Please enter numbers only" },
		}
	});
});
