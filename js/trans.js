$(window).load(function () {
  $("#print_button").focus();
});

$(document).ready(function(){
	$("#print_button").click(function(){
	     $.jPrintArea('#myPrintArea');
	});
});