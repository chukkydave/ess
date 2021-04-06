function format_a_date(the_date){

	var monthNames = [

		"Jan", "Feb", "Mar",
		"Apr", "May", "Jun", "Jul",
		"August", "Sep", "Oct",
		"Nov", "Dec"

	];

	var d = new Date(the_date);
	var monthIndex = d.getMonth();
	var datestring = d.getDate()  + "/" +  monthNames[monthIndex] + "/" + d.getFullYear();

	return datestring;

}

function format_a_date_time(the_time){
	// dateFormat(the_time, "mm/dd/yy, h:MM:ss TT");
	var monthNames = [

		"Jan", "Feb", "Mar",
		"Apr", "May", "Jun", "Jul",
		"August", "Sep", "Oct",
		"Nov", "Dec"

	];

	var d = new Date(the_time);
	var monthIndex = d.getMonth();
	var datestring = d.getDate()  + "/" +  monthNames[monthIndex] + "/" + d.getFullYear() +" "+d.getHours()+":"+d.getMinutes();

	return datestring;
}

function format_to_money(money){

	var output = parseInt(money).toLocaleString(
											undefined, {
											  minimumFractionDigits: 2,
											  maximumFractionDigits: 2
											}); 
	return output;

}

function remove_commas_from_number(number){
	 return number.replace(/,/g, '');
}

$(document).on("keypress keyup blur", ".allownumericwithdecimal", function (event) {
  
  //this.value = this.value.replace(/[^0-9\.]/g,'');
  $(this).val($(this).val().replace(/[^0-9\.]/g,''));
  if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
      event.preventDefault();
  }

});



$(".allownumericwithoutdecimal").on("keypress keyup blur",function (event) {    
   $(this).val($(this).val().replace(/[^\d].+/, ""));
    if ((event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});