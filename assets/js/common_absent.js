/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteAbsent", function(){
		var absentId = $(this).data("absentid"),
			hitURL = baseURL + "deleteAbsent",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this absent ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { absentId : absentId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Absent successfully deleted"); }
				else if(data.status = false) { alert("Absent deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
