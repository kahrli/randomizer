$(function () {
	$(document).on("change","input[class='games']",function() {
		$.get("ajax/ownedgame.php",
			{ user: USER_GLOBAL, game: this.value, value: this.checked });
	});
});