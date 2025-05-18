/**
 * @author OpenXcode
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteUser", function(){
		var userId = $(this).data("userid"),
			hitURL = baseURL + "deleteUser",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this user ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { userId : userId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("User successfully deleted"); }
				else if(data.status = false) { alert("User deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	jQuery(document).on("click", ".deleteFactory", function(){
		var userId = $(this).data("factoryid"),
			hitURL = baseURL + "factory/deleteFactory",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this factory ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { fc_id : userId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Factory successfully deleted"); }
				else if(data.status = false) { alert("Factory deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});
	
	//Delete Item
	jQuery(document).on("click", ".deleteItemb", function(){
		var item_id = $(this).data("item_id"),
			hitURL = baseURL + "items/deleteItem",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this item ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { item_id : item_id } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Item successfully deleted"); }
				else if(data.status = false) { alert("Item deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});	
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	

	jQuery(document).on("click", ".deleteDestination", function(){
		var dest_id = $(this).data("dest_id"),
			hitURL = baseURL + "destination/deleteDestination",
			currentRow = $(this);
		
		var confirmation = confirm("Are you sure to delete this destination ?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { dest_id : dest_id } 
			}).done(function(data){
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Destination successfully deleted"); }
				else if(data.status = false) { alert("Destination deletion failed"); }
				else { alert("Access denied..!"); }
			});
		}
	});	
});
