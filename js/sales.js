$(document).ready(function() {


	$("#btn_new").click(function() {

		if ( $("#btn_new").text() == "New" ) {
			
			Adding();
		}
		else {
			
			Save();
			
		}
		
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
		report.location="print_sale.php?sale_id="+$("#sale_id").val();
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
	
	$("#btn_add_product").click(function() {
		
		AddProduct();
	});
	
	$(document.body).on("mousemove",".details",function() {
		$(this).addClass("hilite");
	});
	
	$(document.body).on("mouseout",".details",function() {
		$(this).removeClass("hilite");
	});
	
	$(document.body).on("click",".remove_detail",function() {
		if ( confirm("Delete detail?") ) {
			var nIndex = Math.abs($(this).attr("index"));
			DeleteDetail(nIndex);
		};
	});
	
	$("#quantity,#price").focus(function() {
		$(this).select();
	});
	
	$("#quantity,#price").keyup(function() {
		ShowTotal();
	});
	
	$("#quantity,#price").change(function() {
		ShowTotal();
	});
	
	$("#product_id").change(function() {
		GetPrice();
		window.setTimeout(function() {
			ShowTotal();
		},300);
	});
	
	
	
	
	LoadCustomers();
	LoadProducts();
	
	LoadInv();


});

function LoadInv() {
	
	$.ajax({
		type: "POST",
		url:"./load_invoice.php",
		data:"",
		success: function(text) {
			$("#invoice_number").val(text);
		},
		beforeSend:function() {
			
		},
		error: function(a,b,c) {
		}
	});
}	

function ShowTotal() {
	
	var nTotal = Round(Math.abs($("#quantity").val())*Math.abs($("#price").val()));
	$("#total").val(nTotal);
}

function Round(nValue) {
	
	return Math.round(nValue*100)/100;
}

function GetPrice() {
	
	
	$.ajax( {
		type: "POST",
		url: "./get_product.php",
		data: "product_id="+$("#product_id").val(),
		success: function(text) {
			var f = JSON.parse(text);
			$("#price").val(f.price);
		},
		beforeSend: function() {
			
		},
		error: function(a,b,c) {
		}
	});
}

function Get(cID) {
	
	
    $.ajax({
        type: "POST",
        url: "./get_sale.php",
        data: "sale_id="+cID
        ,
        success : function(text) {

			var f = JSON.parse(text);
			
			$("#invoice_number").val(f.invoice_number);
			$("#invoice_date").val(f.invoice_date);
			$("#customer_id").val(f.customer_id);
			$("#sale_id").val(cID);
			
			$("#message").addClass("hidden");
			
			$("#search_window").modal("hide");
			
			Editing();
			LoadDetails();
			
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
        url: "./delete_sale.php",
        data: "sale_id="+$("#sale_id").val()
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
        url: "./search_sales.php",
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


function LoadCustomers() {
	
	
    $.ajax({
        type: "POST",
        url: "./load_customers.php",
        data: ""
        ,
        success : function(text) {
			$("#customer_id").html(text);
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

function LoadProducts() {
	
	
    $.ajax({
        type: "POST",
        url: "./load_products.php",
        data: ""
        ,
        success : function(text) {
			$("#product_id").html(text);
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
	
	if ( $("#invoice_number").val() == "" ) {
		alert("Input invoice number!");
		$("#invoice_number").focus();
		return false;
	}
	
	if ( $("#invoice_date").val() == "" ) {
		alert("Input invoice_date!");
		$("#invoice_date").focus();
		return false;
	}
	
	
	return true;
}

function CheckDetai() {
	
	if ( Math.abs($("#quantity").val()) == 0 ) {
		alert("Input quantity");
		window.setTimeout(function() {
			$("#quantity").focus();
		},150);
		return false;
	}
	
	if ( Math.abs($("#price").val()) == 0 ) {
		alert("Input price");
		window.setTimeout(function() {
			$("#price").focus();
		},150);
		return false;
	}
	
	return true;
}

function ClearProduct() {
	
	$("#quantity").val("1");
	$("#price").val("0");
	$("#total").val("0");
	GetPrice();
	window.setTimeout(function() {
		ShowTotal();
	},300);
}

function AddProduct() {
	
	if ( !CheckDetai() ) {
		return false;
	}
	$("#btn_add_product").attr("disabled",true); // Disable button after clicking to prevent double click
    $.ajax({
        type: "POST",
        url: "./add_sale_product.php",
        data: "product_id="+encodeURIComponent($("#product_id").val())+
			"&description="+encodeURIComponent($("#product_id :selected").text())+
			"&price="+$("#price").val()+
			"&quantity="+$("#quantity").val()
        ,
        success : function(text) {
			
			if ( text !== "" )
				alert(text);
			ClearProduct();
			$("#message").addClass("hidden");
			LoadDetails();
			
			window.setTimeout(function() {
				$("#btn_add_product").attr("disabled",false);
				$("#product_id").focus();
			},300);
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

function DeleteDetail(nIndex) {
	
	$.ajax({
		type: "POST",
		url: "./remove_sale_detail.php",
		data: "index="+nIndex,
		success: function(text) {
			$("#message").addClass("hidden");
			if ( text != "" )
				alert(text);
			LoadDetails();
		},
		beforeSend: function() {
			$("#message").val("Deleting...");
			$("#message").removeClass("hidden");
		},
		error: function(a,b,c) {
			
		}
	});
	
}

function LoadDetails() {
	
	$.ajax({
        type: "POST",
        url: "./load_sale_details.php",
        data: ""
        ,
        success : function(text) {
			$("#details").html(text);			
			$("#message").addClass("hidden");
			location="#sale_bottom";
			
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


function Save() {
	
	if ( !Check() ) 
		return false;
	
    $.ajax({
        type: "POST",
        url: "./save_sale.php",
        data: "invoice_number="+encodeURIComponent($("#invoice_number").val())+
			"&invoice_date="+encodeURIComponent($("#invoice_date").val())+
			"&price="+$("#price").val()+
			"&customer_id="+$("#customer_id").val()+
			"&sale_id="+$("#sale_id").val()
        ,
        success : function(text) {
			
			$("#message").addClass("hidden");
			if ( text == "success" ) {
				Cancelled();
			}
			else {
				alert(text);
			}
			LoadDetails();
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
	
	$("#invoice_number").attr("disabled",false);
	$("#invoice_date").attr("disabled",false);
	$("#customer_id").attr("disabled",false);
	
	$("#product_id").attr("disabled",false);
	$("#quantity").attr("disabled",false);
	$("#price").attr("disabled",false);
	$("#btn_add_product").attr("disabled",false);
	
	$("#btn_new").text("Save");
	$("#btn_cancel").attr("disabled",false);
	$("#btn_delete").attr("disabled",false);
	$("#invoice_number").focus();
	
	
	
	ClearProduct();
		
}


function Adding() {
	
	$("#invoice_number").attr("disabled",false);
	$("#invoice_date").attr("disabled",false);
	$("#customer_id").attr("disabled",false);
	
	$("#product_id").attr("disabled",false);
	$("#quantity").attr("disabled",false);
	$("#price").attr("disabled",false);
	$("#btn_add_product").attr("disabled",false);
	
	$("#btn_new").text("Save");
	$("#btn_cancel").attr("disabled",false);
	$("#invoice_number").focus();
	
	Clear();
	
	GetPrice();
	
	window.setTimeout(function() {
		ShowTotal();
	},300);
	
		
}

function Cancelled() {
	
	location="sales.php";
	
}

function Clear() {

	var currentDate = new Date()
	var day = currentDate.getDate()
	var month = currentDate.getMonth() + 1
	var year = currentDate.getFullYear()
	
	
	
	$("input[type='text']").each(function() {
		$(this).val("");
	});
	
	$("#invoice_date").val(month+"/"+day+"/"+year);
	$("#quantity").val("1");
	$("#price").val("0");
	$("#sale_id").val("0");
	

}
