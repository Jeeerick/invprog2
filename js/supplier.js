$(document).ready(function() {


	$("#btn_new").click(function() {
		
		if ( $("#btn_new").text() == "New" ) {
			
			Adding();
		}
		else {
			
			Save();
			
		}
		
	});
	
	$("#price").focus(function() {
		$(this).select();
	});
	
	$("#btn_cancel").click(function() {
		Cancelled();
	});
	
	$("#btn_close").click(function() {
		if ( confirm("Close module?") ) 
			location="menu.php";
	});
	
	$("#btn_search").click(function() {
		$("#search_window").modal("show");
	});
	
	$('#search_window').on('shown.bs.modal', function () {
		Search();
	});
	
	$("#btn_print").click(function() {
		$("#report_window").modal("show");
	});
	
	$('#report_window').on('shown.bs.modal', function () {
		$("#report_status").removeClass("hidden");
		report.location="report_suppliers.php";
	});
	
	$('#report_window').on('hidden.bs.modal', function () {
		$("#report_status").addClass("hidden");
		report.location="blank.html";
	});
	
	$(document.body).on("mousemove",".current_record",function() {
		$(this).addClass("hilite");
	});
	
	$(document.body).on("mouseout",".current_record",function() {
		$(this).removeClass("hilite");
	});
	
	$(document.body).on("click",".current_record",function() {
		Get($(this).attr("record_id"));
	});
	
	$("#btn_delete").click(function() {
		if ( confirm("Delete current record?") )
			Delete();
	});
	
	


});

function Get(cID) {
	
	
    $.ajax({
        type: "POST",
        url: "./get_supplier.php",
        data: "supplier_id="+cID
        ,
        success : function(text) {
			
			var f = JSON.parse(text);
			
			$("#name").val(f.name);
			$("#supplier_id").val(cID);
			
			$("#message").addClass("hidden");
			
			$("#search_window").modal("hide");
			console.log(cID);
			Editing();
			
        },
        beforeSend:function() {
			$("#message").removeClass("hidden");
			$( "#message" ).html("Checking...");
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.status);
			console.log(thrownError);
		}
    });
}

function Delete() {
	
	
    $.ajax({
        type: "POST",
        url: "./delete_supplier.php",
        data: "supplier_id="+$("#supplier_id").val()
        ,
        success : function(text) {
			
			$("#message").addClass("hidden");
			if ( text = "" )
				alert(text);
			
			
			Cancelled();
			
        },
        beforeSend:function() {
			$("#message").removeClass("hidden");
			$( "#message" ).html("Checking...");
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.status);
			console.log(thrownError);
		}
    });
}


function Search() {
	
	
    $.ajax({
        type: "POST",
        url: "./search_supplier.php",
        data: ""
        ,
        success : function(text) {
			$("#records").html(text);
			$("#message").addClass("hidden");
        },
        beforeSend:function() {
			$("#message").removeClass("hidden");
			$( "#message" ).html("Checking...");
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.status);
			console.log(thrownError);
		}
    });
}



function Check() {
	
	if ( $("#name").val() == "" ) {
		alert("Input code!");
		$("#name").focus();
		return false;
	}
	
	if ( $("#description").val() == "" ) {
		alert("Input description!");
		$("#description").focus();
		return false;
	}
	
	
	return true;
}
	

function Save() {
	
	if ( !Check() ) 
		return false;
	
    $.ajax({
        type: "POST",
        url: "./save_supplier.php",
        data: "name="+encodeURIComponent($("#name").val())+
			"&supplier_id="+$("#supplier_id").val()
        ,
        success : function(text) {
			
			$("#message").addClass("hidden");
			if ( text == "success" ) {
				Cancelled();
			}
			else {
				alert(text);
			}
        },
        beforeSend:function() {
			$("#message").removeClass("hidden");
			$( "#message" ).html("Saving...");
		},
		error: function (xhr, ajaxOptions, thrownError) {
			console.log(xhr.status);
			console.log(thrownError);
		}
    });
}

function Editing() {
	
	$("#name").attr("disabled",false);

	
	$("#btn_new").text("Save");
	$("#btn_cancel").attr("disabled",false);
	$("#btn_delete").attr("disabled",false);
	$("#name").focus();
		
}


function Adding() {
	
	$("#name").attr("disabled",false);
	
	$("#btn_new").text("Save");
	$("#btn_cancel").attr("disabled",false);
	$("#name").focus();
		
}

function Cancelled() {
	
	Clear();
	
	$("#name").attr("disabled",true);
	
	$("#btn_new").text("New");
	$("#btn_cancel").attr("disabled",true);
	$("#btn_delete").attr("disabled",true);
	
}

function Clear() {
	
	
	$("input[type='text']").each(function() {
		$(this).val("");
	});
	

}
