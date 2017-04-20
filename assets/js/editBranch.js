/**
 * File : editBranch.js
 *
 * This file contain the validation of edit branch form
 *
 * @author Kishor Mali
 */
$(document).ready(function(){

	var editBranchForm = $("#editBranch");

	var validator = editBranchForm.validate({

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
