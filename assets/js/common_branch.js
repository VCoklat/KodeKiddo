/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteBranch", function(){
		var branchId = $(this).data("branchid"),
			hitURL = baseURL + "deleteBranch",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this branch ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { branchId : branchId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Branch successfully deleted"); }
				else if(data.status = false) { alert("Branch deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
