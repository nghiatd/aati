jQuery(document).ready(function() {
	//Xóa User
	jQuery(".delete_user").click(function(event){
		event.preventDefault();
		var choose =confirm("Bạn có muốn xóa user này không?");
		if(choose){
			var url=jQuery(this).attr("href");
			var redirect=jQuery("#url_redirect").val();
			jQuery.ajax({
				url:url,
				success:function(result){
					alert(result);
					location.href=redirect;
				}
			});
		}
		
	});
	//Check All User
	jQuery("#check_all").toggle(function(){
		jQuery("table#list_user tbody tr").each(function(index){
			jQuery("#check_all").attr("checked",true);
			var a=jQuery("table#list_user tbody tr").eq(index).children("td").children("input:checkbox").attr("checked",true);
		});
	},function(){
		jQuery("table#list_user tbody tr").each(function(index){
			jQuery("#check_all").attr("checked",false);
			var a=jQuery("table#list_user tbody tr").eq(index).children("td").children("input:checkbox").attr("checked",false);
		});
	});
	jQuery("#delete_user").click(function(){
		var choose=confirm("Bạn có muốn xóa những tài khoản vừa chọn không?");
		if(choose){
			var check="";
			jQuery("table#list_user tbody tr").each(function(index){
				if(jQuery("table#list_user tbody tr").eq(index).children("td").children("input:checkbox").attr("checked")=="checked"){
					check+=jQuery("table#list_user tbody tr").eq(index).children("td").children("input:checkbox").attr("value")+",";
				}
			});
			var arr_ID=check.split(",");
			var redirect=jQuery("#url_redirect").val();
			var kq="";
			var url=jQuery("#check_all").val();
			for(var i=0;i<arr_ID.length-1;i++){
				jQuery.ajax({
					url:url,
					type:"POST",
					data:{data:arr_ID[i]},
					success:function(result){
					}
				});
			}
			
			location.href=redirect;
		}
	});

	$("table#list_user").tablesorter({
		cssAsc:"asc",
		cssDesc:"desc",
		cssHeader:"header",
		headers: { 
            // assign the secound column (we start counting zero) 
            0: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }, 
            // assign the third column (we start counting zero) 
            2: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            } , 
            // assign the third column (we start counting zero) 
            4: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            },
            // assign the third column (we start counting zero) 
            8: { 
                // disable it by setting the property sorter to false 
                sorter: false 
            }
        }  
	});

});

// Load the Visualization API and the piechart package.
	google.load('visualization', '1.0', {'packages':['corechart']});

