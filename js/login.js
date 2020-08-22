$(function () {
	$( "#login > form").on("submit",function(e) {
		e.preventDefault();
	});
	
	$( "#loggedin > form").on("submit",function(e) {
		e.preventDefault();
	});

	$("#login>form>button[type=submit]").on("click",function(e) {
		var value = this.value;
		$(this).addClass(this.value=="Login"?"btn-primary":"btn-secondary");
		$(this).removeClass("btn-danger");
		this.innerHTML = this.value + 
			' <span class="spinner-border-sm spinner-border">&nbsp;</span>';
		$.post("ajax/login.php",
			$("#login > form").serialize(),
			function(data,status) {
				validate(data,status,value);
		});
	});
});

function validate(data,status,message) {

	var button = $("#login button[value="+message+"]");
	
	if(!data['result']) {
		button.html(message+" failed");
		button.addClass("btn-danger");
		button.removeClass("btn-secondary btn-primary");
		return;
	}

	button.html(message);
	USER_GLOBAL = data['user'];

	if("new" in data) {
		var text = '<div class="input-group mb-3">' +
			'<div class="input-group-prepend">' +
			'<div class="input-group-text">' +
			'<input type="checkbox" value="' + USER_GLOBAL + '" name="user[]">' +
			'</div></div><div class="form-control">' +
			USER_GLOBAL + '</div></div>';
		var inner = $("#random form").html();
		$("#random form").html(text+inner);
	}
	
	$("#login").addClass("d-none");
	$("#loggedin").removeClass("d-none");
	$("#loggedin h2").html(data['user'] +"'s games:");
	
	$.each(data['games'], function(i,game) {
		var text = '<div class="input-group mb-3">';
		text += '<div class="input-group-prepend">';
		text += '<div class="input-group-text">';
		text += '<input type="checkbox" class="games" ';
		if('owned' in data && data['owned']!==null ) 
			$.each(data['owned'],function(j,owned) {
				if(owned == game)
					text += 'checked ';
			});
		text += 'value="' + game;
		text += '" name="games[]"></div></div>';
		text += '<div class="form-control">' + game + '</div></div>';

		$("#ownedgame").append(text);
		
	});
}