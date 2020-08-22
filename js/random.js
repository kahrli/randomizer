$(function () {
	$( "#random > form" ).on( "submit",function(e) {
		e.preventDefault();
		$.get("ajax/result.php",
			$(this).serialize(),
			function(data) { randomize(data); }
		);
		
		$("#rarr").addClass("spinner-border-sm spinner-border");
		$("#rarr").html(' ');
		
	});
});

function randomize(data) {
	$("#rarr").removeClass("spinner-border");
	$("#rarr").html("&rarr");
	$("#random").addClass("d-none");
	$("#result").removeClass("d-none");
	$("#result ul").html('');
	if(data !== null) {
		var winner = Math.floor(Math.random() * (data.length) );

		$.each(data, function(i,game) {
			var text = '<li class="list-group-item';
			if(i==winner)
				text += ' active';
			text += '">';
			text += game;
			text += "</li>";
			$("#result ul").append(text);
		});
	}
	else $("#result ul").html("<li class='list-group-item'>No results.</li>");
}