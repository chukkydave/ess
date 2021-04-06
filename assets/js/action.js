$(document).ready(function() {
	// list_of_companies();
	$('#submit_email').on('click', submit_email);
	$('#submit_code').on('click', submit_code);
	$('#submit_password').on('click', submit_password);
	$('#log').on('click', logout);
	// $('.modules_link').on('click', modules_link);
	$(document).on('click', '.modules_link', function(){
		var company_id = $(this).attr("id").replace(/comp_/,'');
		localStorage.setItem('company_id', company_id);	
		modules_link(company_id);
	})

	//$('#user').on('click', user);
});



function validateEmail(emailaddress){  

   var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;  

   if(!emailReg.test(emailaddress)) {  

        return false

   }else{

        return true;

   }

}

	

function cv(){

	$('#load_cv').hide();
	$('#cv_percent').html('0%');
   
}

function no_of_companies_available(){
    // var company_id = $.session.get('id');
    var user_id = localStorage.getItem('user_id');
    // alert(company_id);
    // alert(user_id);

    $('#load_company').show();
    $.ajax({ 
        type: "POST",
        dataType: "json",
        url: api_path+"company/count_number_of_companies_user_has_access_to",
        data: {"user_id": user_id},
        timeout: 60000, // sets timeout to one minute
        // objAJAXRequest, strError

        error: function(response){
            alert('connection error');
            $('#load_company').hide();
            $('#no_companies').html('?');
        },

        success: function(response) {  
     		// console.log(response);
            if(response.status == '200'){
            	
            
                $('#load_company').hide();
                
                $('#no_companies').html(response['data']['total_no_companies']);

            }else if(response.status == '401'){
				$('#load_company').hide();
                
                $('#no_companies').html('?');            		
	                 	
            }

        }
    });	
}

function list_of_user_modules(){
	var user_id = localStorage.getItem('user_id');
    var company_id = localStorage.getItem('company_id');
    // var pathArray = window.location.pathname.split( '/' );
    // pathArray[4].replace(/%20/g,' ');
    // alert($.session.get('id'));
    // $.session.set('id', company_id);
    // alert(localStorage.getItem('company_id'));
    // alert(localStorage.getItem('user_id'));
    // alert($.session.get('user'));
    $('#loader_modules').show();
    $.ajax({ 
        type: "POST",
        dataType: "json",
        url: api_path+"company/list_of_modules_user_has_access_to_under_a_company",
        data: {"company_id": company_id, "user_id" : user_id},
        timeout: 60000, // sets timeout to one minute
        
        error: function(objAJAXRequest, strError){
            var str = "";
            str += '<div class="row">';
            str += '<div class="col-xs-10 col-md-10">';
          	str += '<div class="alert alert-danger alert-dimissible fade-in" role="alert">';
          	str += '<button type="button" class="close" data-dismiss="alert" aria-label="close">';
          	str += '<span aria-hidden="true">x';
          	str += '</span>';
          	str += '</button>';
          	str += '<strong>Connection '+strError;
          	str += '</strong>';
          	str += '</div>';
            str += '</div>';
      		str += '</div>';
    		
        		
			$("#user_modules").html(str); 
        },

        success: function(response) {
            // console.log(response);
            $('#loader_modules').hide();
            
            
            var str_modules = "";

            if(response.status == '200'){
            
            	// alert(elems);
                $.each(response['data'], function (i, v){ 
                	$('#company_name').html(response['data'][i]['company_name']);
            		$('#mod').html('(Modules)');
            		$('#back_comp').html('Back');

	                str_modules += '<a href="'+base_url+"/"+response['data'][i]['landing_page']+'" id="mod_'+response['data'][i]['module_id']+'" class="modules_list">';
	              	str_modules += '<div class="animated flipInY col-lg-3 col-md-3 col-sm-6 col-xs-12">';
	                str_modules += '<div class="tile-stats">';
		            str_modules += '<div class="icon"><i class="'+response['data'][i]['module_icon']+'"></i>';
		            str_modules += '</div>';
		            str_modules += '<div class="count">'+response['data'][i]['module_shortcode']+'</div>';

	                str_modules += '<h3>-</h3>';
	                str_modules += '<p>'+response['data'][i]['module_name']+'</p>';
	                str_modules += '</div>';
	              	str_modules += '</div>';
	              	str_modules += '</a>';

                });



                $("#user_modules").html(str_modules);

            }else if(response.status == '401'){
            		
	          //   	str_modules += '<div class="row">';
	          //     	str_modules += '<div class="col-md-12 col-sm-12 col-xs-12">';
	          //       str_modules += '<div class="x_panel">';
	          //       str_modules += '<div class="x_title">';
	          //       str_modules += '<h2>No Modules!</h2>';
	          //       str_modules += '<div class="clearfix"></div>';
	          //       str_modules += '</div>';
	          //       str_modules += '<div class="x_content">Sorry you have no modules yet, <a href="">click here</a> to go back';
	                      
	                
	          //     	str_modules += '</div>';
	          //   	str_modules += '</div>';
	          // 		str_modules += '</div>';
	        		// str_modules += '</div>';

	        		str_modules += '<div class="text-center">';
	        		str_modules += '<div class="alert alert-warning alert-dismissible fade in" role="alert" style="margin: 30px">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>                    </button>  <strong>Sorry, you are currently not connected to any company.</div>';
        			str_modules += '</div>';

				$("#user_modules").html(str_modules);            	
            }

        }
    });
}

function logout(){
	localStorage.clear();
	window.location.href = "https://www.paperlack.com.ng/world";
}

function list_of_companies(){
	
	var user_id = localStorage.getItem('user_id');
	// alert($.session.get('user'));
	
    $('#loader_companies').show();
    $.ajax({ 
        type: "POST",
        dataType: "json",
        url: api_path+"user/list_of_companies_user_has_access_to",
        data: {"user_id" : user_id},
        timeout: 60000, // sets timeout to one minute
        
        error: function( objAJAXRequest, strError1){
            
            $('#loader_companies').hide();
            var str = "";
            str += '<div class="row">';
            str += '<div class="col-xs-12 col-md-12">';
          	str += '<div class="alert alert-danger alert-dimissible fade-in" role="alert">';
          	str += '<button type="button" class="close" data-dismiss="alert" aria-label="close">';
          	str += '<span aria-hidden="true">x';
          	str += '</span>';
          	str += '</button>';
          	str += '<strong>Connection '+strError1;
          	str += '</strong>';
          	str += '</div>';
            str += '</div>';
      		str += '</div>';
    		
        		
			$("#company_data").html(str);            	
        },

        success: function(response) {
            
            $('#loader_companies').hide();
            console.log(response);

            var str = "";
            if(response.status == '200'){
               

                $.each(response['data'], function (i, v){	
		    		      	
                	// alert($.session.get('id'));
                	// href= '+site_url+"user/modules"+'
                	//  id="modules_link"
                    str +=  '<div class="modules_link" style="cursor:pointer;" id="comp_'+response['data'][i]['company_id']+'">';
                    str +=  '<div class="col-md-3 col-xs-12 widget widget_tally_box">';
                    str +=  '<div class="x_panel ui-ribbon-container fixed_height_390">';
                    str +=  '<div class="x_content">';
                    str += '<div style="text-align: center; margin-bottom: 17px">';
                    str +=  '<span class="chart" data-percent="86">';
                    str += '<span class="'+response['data'][i]['company_logo']+'"></span>';
                    str += '</span>';
                    // str += '<div class="icon"><i class="'+response['data'][i]['company_logo']+'"></i>';
                    // str += '</div>';
                    // str += '<img src="'+files_path+"logo12c3e73f82gh93h27w.jpg"'">';
                    str += '</div>';
                    str += '<h3 class="name_title">';
                    str +=  '<b>' +response['data'][i]['company_name']+ '</b>';
                    str +=  '</h3>';
                    str += '<div class="divider">';
                    str += '</div>';
                    str +=  '<p>' +response['data'][i]['company_description']+ '</p>';
                    str +=  '</div>';
                    str +=  '</div>';
                    str +=  '</div>';
                    str +=  '</div>';

                	$("#company_data").html(str);
                	    
	            	                  
                });


            }else if(response.status == '401'){

            	str += '<div class="text-center">';
	        	str += '<div class="alert alert-warning alert-dismissible fade in" role="alert" style="margin: 30px">  <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span>                    </button>  <strong>Sorry, you are currently not connected to any company.</div>';
        		str += '</div>';

				$("#company_data").html(str);            	
            }

        }

       	
    });

}

function modules_link(company_id){
	var company_id = $(this).attr("id");
	window.location.href = site_url+"user/modules";
}

function modules_list(module_id){
	var module_id = $(this).attr("id");	
}

function submit_email(){

	var email_address = $('#email_address').val();

	if(email_address == ""){
		$('#error-email').show();
		$('#error-email').html("field can't be empty");	
		
		return;	
	}else if(!validateEmail(email_address)){
            
        $('#error-email').show();
        $('#error-email').html('invalid Email');
            
        return;
	}
	
	$('#error-email').hide();
	$('#submit_email').hide();
	$('#load').show();
	
	$.ajax({

		type: "POST",
		dataType: "json",
		cache: false,
		url: base_url+"/api/user/forgot_password",
		data: { "email_address" : email_address},
		// headers: {
		// 	'Accept': 'application/json',
		// 	'Content-Type': 'application/json',
		// 	'Authorization':'Bearer HRlcjoxMjM0NI0YWRhcTY3OHVpY'
		// },
		success: function(response) {
			
			if (response.status == '200') {
				$('#error-email').hide();
				$('#submit_email').hide();
				$('#load').show();

				$('#register').hide();
				$('#code').show();

			}else if(response.status == '401'){ //user error message

				$('#submit_email').show();
				$('#load').hide();
				$('#error-email').show();
				$('#error-email').html(response.msg);

			}

		},
		error: function(response){

			$('#submit_email').show();
			$('#load').hide();
			$('#error-email').show();
			$('#error-email').html("Connection Error.");

		}

	});
}



function submit_code(){
	var sort_code = $('#sort_code').val();


	if(sort_code == ""){
		$('#error-code').show();
		$('#error-code').html("field can't be empty");	
		
		return;	
	}
	$('#error-code').hide();
	$('#submit_code').hide();
	$('#load2').show();
	
	$.ajax({

		type: "POST",
		dataType: "json",
		cache: false,
		url: base_url+"/api/user/password_recovery_code",
		data: { "sort_code" : sort_code},
		// headers: {
		// 	'Accept': 'application/json',
		// 	'Content-Type': 'application/json',
		// 	'Authorization':'Bearer HRlcjoxMjM0NI0YWRhcTY3OHVpY'
		// },
		success: function(response) {

			if (response.status == '200') {
				
				$('#error-code').hide();
				$('#submit_code').hide();
				$('#load2').show();
				$('#hcode').val(sort_code);

				$('#code').hide();
				$('#newpassword').show();

			}else if(response.status == '400'){ // coder error message

				$('#submit_code').show();
				$('#load2').hide();
				$('#error-code').show();
				$('#error-code').html('Technical Error');

			}else if(response.status == '401'){ //user error message

				$('#submit_code').show();
				$('#load2').hide();
				$('#error-code').show();
				$('#error-code').html(response.msg);

			}

		},
		error: function(response){

			$('#submit_code').show();
			$('#load2').hide();
			$('#error-code').show();
			$('#error-code').html("Connection Error.");

		}

	});
}

function submit_password(){

	//alert('before validation');
	var new_password = $('#new_password').val();
	var confirm_newpassword = $('#confirm_newpassword').val();
	var hcode = $('#hcode').val();

	
	if(new_password == "" || confirm_newpassword == ""){
		$('#error-password').show();
		$('#error-password').html("You have a blank field");

		return;
	}else if(new_password != confirm_newpassword){
		$('#error-password').show();
		$('#error-password').html("Your password do not match");

		return;
	}

	//alert('after validation');	
	$('#error-password').hide();
	$('#submit_password').hide();
	$('#load3').show();
	
	$.ajax({

		type: "POST",
		dataType: "json",
		cache: false,
		url: base_url+"/api/user/password_recovery_code2",
		data: { "new_password" : new_password, "confirm_newpassword" : confirm_newpassword, "hcode" : hcode},
		// headers: {
		// 	'Accept': 'application/json',
		// 	'Content-Type': 'application/json',
		// 	'Authorization':'Bearer HRlcjoxMjM0NI0YWRhcTY3OHVpY'
		// },
		success: function(response) {
			//alert(response);
			if (response.status == '200') {
				alert('success');
				$('#error-password').hide();
				$('#submit_password').hide();
				$('#load3').show();

				$('#myModal').modal('show'); 

                $('#myModal').on('hidden.bs.modal', function () {
                    $('#submit_password').show();
					$('#load3').hide();
					window.location.replace("http://paperlack.com.ng/erp/welcome"); 
                });
			}else if(response.status == '401'){ 

				$('#submit_password').show();
				$('#load3').hide();
				$('#error-password').show();
				$('#error-password').html(response.msg);

			}

		},
		error: function(response){

			$('#submit_password').show();
			$('#load3').hide();
			$('#error-password').show();
			$('#error-password').html(response.msg);
			//console.log(response);

		}

	});
}

function start(){

	
	var company_name = $('#company_name').val();
	var company_email = $('#company_email').val();
	var company_phone = $('#company_phone').val();
	var company_address = $('#company_address').val();
	var password = $('#password').val();
	var password2 = $('#password2').val();
	
	var blank;

	$(".required").each(function(){

		var the_val = $.trim($(this).val());

		if(the_val == "" || the_val == "0"){

			$(this).addClass('has-error');

			blank = "yes";

		}else{

			$(this).removeClass("has-error");

		}

	});

	
	if(blank == "yes"){
		$('#error').show();
		$('#error').html("You have a blank field");

		return;	

	}

	if(!validateEmail(company_email)){
            
        $('#error').show();
        $('#error').html('invalid Email');
            
        return;
	}

	if(!validateEmail(company_email)){
            
        $('#error').show();
        $('#error').html('invalid Email');
            
        return;
    }

    $('#error').hide();
	$('#start').hide();
	$('#loader').show();

	$.ajax({

		type: "POST",

		url: "/api/company/company_registration",

		data: { "company_name" : company_name, "company_email" : company_email, 
				"company_phone" : company_phone, "company_address" : company_address, "password" : password,
			   "password2" : password2},

		dataType: "json",

		success: function(response) {

			if (response.status == '200') {
				
				$('#error').hide();
				$('#start').hide();
				$('#loader').show();
				//window.location
				$('#myModal').modal('show'); 

                $('#myModal').on('hidden.bs.modal', function () {
                    $('#start').show();
                    $('#loader').hide(); 
                })
			}else if(response.status == '400'){
				//alert(response.msg);
				$('#start').show();
				$('#loader').hide();
				$('#error').show();
				$('#error').html(response.msg);
				

			}else if(response.status == '401'){
				//alert(response.msg);
				$('#start').show();
				$('#loader').hide();
				$('#error').show();
				$('#error').html(response.msg);
			}

	 	}

	});
}


