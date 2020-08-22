$(function () {
	$("#creategame").on("submit",function(e) {
		e.preventDefault();
		$.get("ajax/creategame.php",$(this).serialize(),function(e){
			if(e!=false) {
				var text = '<div class="input-group mb-3">';
				text += '<div class="input-group-prepend">';
				text += '<div class="input-group-text">';
				text += '<input type="checkbox" class="games" ';
				text += 'value="' + e;
				text += '"></div></div>';
				text += '<div class="form-control">' + e + '</div></div>';
				$("#ownedgame").append(text);
			}
		});			
	});
});