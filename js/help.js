function visibleButtons(){
	$('#vButton').removeClass('helpButton');
	$('#closeHelp').click(closeButton);
}
function closeButton(){
	$('#vButton').addClass('helpButton');
}
$(document).ready(function(){
	$('#visHelp').click(function(){
		visibleButtons();
		return false;
	});
});
