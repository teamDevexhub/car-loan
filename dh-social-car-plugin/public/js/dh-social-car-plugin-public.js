(function( $ ) {
	'use strict';

	/**
	 * All of the code for your public-facing JavaScript source
	 * should reside in this file.
	 *
	 * Note: It has been assumed you will write jQuery code here, so the
	 * $ function reference has been prepared for usage within the scope
	 * of this function.
	 *
	 * This enables you to define handlers, for when the DOM is ready:
	 *
	 * $(function() {
	 *
	 * });
	 *
	 * When the window is loaded:
	 *
	 * $( window ).load(function() {
	 *
	 * });
	 *
	 * ...and/or other possibilities.
	 *
	 * Ideally, it is not considered best practise to attach more than a
	 * single DOM-ready or window-load handler for a particular page.
	 * Although scripts in the WordPress core, Plugins and Themes may be
	 * practising this, we should strive to set a better example in our own work.
	 */

})( jQuery );

$(document).on("click", "#nextBtn_1", function() {
    var error1 = 0;
    if($("#amount").val() == '' ){
        error1 = 1;
        $("#amount").css("border","1px solid red");
    }

    if($('#month').val() == '' ){
        error1 = 1;
        $("#month").css("border","1px solid red");
    }

    if($('#loanreason').val() == '' ){
        error1 = 1;
        $("#loanreason").css("border","1px solid red");
    }

    if(error1 == 1){
        return false;
    }else{
        $("#amount").css("border","");
        $("#month").css("border","");
        $("#loanreason").css("border","");
        $("#firstTab").hide();  
        $("#secondtab").show();
    }
});

$(document).on("click", "#nextBtn_2", function() {
    var error2 = 0;
    if($("#yourid").val() == '' ){
        error2 = 1;
        $("#yourid").css("border","1px solid red");
    }

    if($('#yourtitle').val() == '' ){
        error2 = 1;
        $("#yourtitle").css("border","1px solid red");
    }

    if(error2 == 1){
        return false;
    }else{
        $("#yourid").css("border","");
        $("#yourtitle").css("border","");
        $("#secondtab").hide();  
        $("#thirdTab").show();
    }
}); 

$(document).on("click", "#prevBtn_2", function() {
    $("#secondtab").show();
    $("#thirdTab").hide();  
});

$(document).on("click", "#prevBtn_1", function() {
    $("#firstTab").show();
    $("#secondtab").hide();  
});

$(document).on("click", "#nextBtn_3", function(e) {
    var error3 = 0;
    if($("#yourname").val() == '' ){ 
        error3 = 1;
        $("#yourname").css("border","1px solid red");
    }

    if($('#youremail').val() == '' ){
        error3 = 1;
        $("#youremail").css("border","1px solid red");
    }

    if($('#yourtelephone').val() == '' ){
        error3 = 1;
        $("#yourtelephone").css("border","1px solid red");
    }

    if($('#youraddress').val() == '' ){
        error3 = 1;
        $("#youraddress").css("border","1px solid red");
    }

    if(error3 == 1){
        return false;
    }else{ 
        $("#yourname").css("border","");
        $("#youremail").css("border","");
        $("#yourtelephone").css("border","");
        $("#youraddress").css("border","");
        $("#thirdtab").hide();
        $("#submitbtn").click();
    } 
});

$('#yourname').keypress(function (e) {
    var regex = new RegExp("[a-z A-Z]");
    var str = String.fromCharCode(!e.charCode ? e.which : e.charCode);
    if (regex.test(str)) {
        $("#yourname").css("border","1px solid red");
        return true;
    }else{
        e.preventDefault();
        alert('Please Enter Alphabate');
        return false;
    }
});

$('#youremail').bind('keyup blur', function() {
    var Email = $('#youremail').val();
    var regex = /^([a-z A-Z 0-9_\.\-\+])+\@(([a-z A-Z 0-9\-])+\.)+([a-z A-Z 0-9]{2,4})+$/;
    if ($.trim(Email).length == 0) {
        alert('Please enter valid email address');
         $("#youremails").css("border","1px solid red");
        e.preventDefault();
    }
    if (validateEmail(Email)) {
        alert('Email is valid');
    }else {
        alert('Invalid Email Address');
        e.preventDefault();
    }
});

$('#yourtelephone').bind('keyup blur',function(){
    var node = $(this);
    node.val(node.val().replace(/[^0-9]/g,'') );
    node.val(node.val().replace(/[0-9]{1}[0-9]{10}/g,'' ) );
    $("#yourtelephone").css("border","1px solid red");
});