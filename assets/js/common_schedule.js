/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteSchedule", function(){
		var scheduleId = $(this).data("scheduleid"),
			hitURL = baseURL + "deleteSchedule",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this schedule ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { scheduleId : scheduleId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Schedule successfully deleted"); }
				else if(data.status = false) { alert("Schedule deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
