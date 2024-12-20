$(document).ready(function() {

	
	$("#btn_login").click(function() {
		Login();
	});
	
	$("#username").focus();



});


function Login() {
	
	
    $.ajax({
        type: "POST",
        url: "./check_login.php",
        data: "username="+encodeURIComponent($("#username").val())+
				"&password="+encodeURIComponent($("#password").val())
        ,
        success : function(text) {
			if ( text == "success" ) {
				$("#message").html("<b>Access granted.</b> Loading site...");
				window.setTimeout(function() {
					location="menu.php";
				},2000);
			}
			else {
				alert(text);
				$("#message").html("<font color=red>Access denied.</font>");
				$("#username").val("");
				$("#password").val("");
				$("#username").focus();
				
				// Clear message after 1 second
				window.setTimeout(function() {
					$("#message").html("");
					$("#message").addClass("hidden");
				},1000);
			}
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
