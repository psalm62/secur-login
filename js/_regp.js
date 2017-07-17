function onRegPeopleClick ()
{
		$('#formreg').addClass('open');
		$('#cancel').click(closewindowregp);
}
function closewindowregp () 
{
	$('#formreg').removeClass('open');
}
$(document).ready(function(){
	
	$('#openwindowregp').click(function(event){
		event.preventDefault();
		onRegPeopleClick();
		return false;
	});
});