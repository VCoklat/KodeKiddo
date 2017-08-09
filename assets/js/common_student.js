/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteStudent", function(){
		var studentId = $(this).data("studentid"),
			hitURL = baseURL + "deleteStudent",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this student ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { studentId : studentId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Student successfully deleted"); }
				else if(data.status = false) { alert("Student deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
