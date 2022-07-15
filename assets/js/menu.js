$(document).ready(function() {
	//this time interval check if the user roles have been fetched before running anything on this page
	var myVar = setInterval(function() {
		if ($('#user_features').html() != '') {
			//stop the loop
			myStopFunction();
			// hide_show_tabs();
			check_if_user_is_exited2();
		} else {
			// document.querySelector('.hidata').style.display = 'none';
			$('.hidata').hide();

			// console.log('No profile');
		}
	}, 1000);

	function myStopFunction() {
		clearInterval(myVar);
	}
});

function check_if_user_is_exited2() {
	var url = `${api_path}ess/restrict_ess_action`;

	fetch(url, {
		headers: {
			Authorization: localStorage.getItem('token'),
		},
	})
		.then((response) => response.json())
		.then((response) => {
			// document.getElementById("demoShow").innerHTML = response;
			hide_show_tabs(response.is_employee_existed);
			$('#ess_is_exited').html(`${response.is_employee_existed}`);
		})
		.catch((error) => {
			console.log(error);
		});
}

function hide_show_tabs(exited_status) {
	var role_list = $('#does_user_have_roles').html();
	let pack_list = $('#user_features').html();
	if (exited_status) {
		$('.is_exited_stat').remove();
		$('#is_exited_stat_home').html('<a href="/ess/"><i class="fa fa-home"></i> Home </a>');
	} else {
		if (pack_list.indexOf('-2-') < 0) {
			$('.feat_2').remove();
		}
		if (pack_list.indexOf('-3-') < 0) {
			$('.feat_3').remove();
		}
		if (pack_list.indexOf('-4-') < 0) {
			$('.feat_4').remove();
		}
		if (pack_list.indexOf('-5-') < 0) {
			$('.feat_5').remove();
			// $('.feat_5_css').removeClass('col-lg-3 col-md-3 col-sm-6 col-xs-12');
			// $('.feat_5_css').addClass('col-lg-4 col-md-4 col-sm-6 col-xs-12');
			// $('.feat_5_notice').removeClass('col-md-6 col-sm-6 col-xs-12');
			// $('.feat_5_notice').addClass('col-md-12 col-sm-12 col-xs-12');
			// $('.feat_5_notice').insertAfter('.feat_5_exits');
		}
		if (pack_list.indexOf('-6-') < 0) {
			$('.feat_6').remove();
		}
		if (pack_list.indexOf('-38-') < 0) {
			$('.feat_38').remove();
		}
	}

	// if (role_list.indexOf('-83-') >= 0) {
	// 	//Settings
	// 	$('.hidata').show();
	// } else {
	// 	$('.hidata').hide();
	// }

	// if (
	// 	role_list.indexOf('-56-') >= 0 ||
	// 	role_list.indexOf('-57-') >= 0 ||
	// 	role_list.indexOf('-58-') >= 0 ||
	// 	role_list.indexOf('-59-') >= 0
	// ) {
	// 	$('.emp_perm').show();
	// } else {
	// 	$('.emp_perm').hide();
	// }

	// if (
	// 	role_list.indexOf('-77-') >= 0 ||
	// 	role_list.indexOf('-78-') >= 0 ||
	// 	role_list.indexOf('-79-') >= 0 ||
	// 	role_list.indexOf('-80-') >= 0 ||
	// 	role_list.indexOf('-81-') >= 0
	// ) {
	// 	$('.exit_perm').show();
	// } else {
	// 	$('.exit_perm').hide();
	// }

	// if (
	// 	role_list.indexOf('-145-') >= 0 ||
	// 	role_list.indexOf('-146-') >= 0 ||
	// 	role_list.indexOf('-147-') >= 0 ||
	// 	role_list.indexOf('-148-') >= 0
	// ) {
	// 	$('.claims_perm').show();
	// } else {
	// 	$('.claims_perm').hide();
	// }

	// if (
	// 	role_list.indexOf('-64-') >= 0 ||
	// 	role_list.indexOf('-65-') >= 0 ||
	// 	role_list.indexOf('-66-') >= 0 ||
	// 	role_list.indexOf('-67-') >= 0
	// ) {
	// 	$('.leaves_perm').show();
	// } else {
	// 	$('.leaves_perm').hide();
	// }

	// if (
	// 	role_list.indexOf('-73-') >= 0 ||
	// 	role_list.indexOf('-74-') >= 0 ||
	// 	role_list.indexOf('-75-') >= 0 ||
	// 	role_list.indexOf('-76-') >= 0
	// ) {
	// 	$('.grie_perm').show();
	// } else {
	// 	$('.grie_perm').hide();
	// }

	// if (role_list.indexOf('-150-') >= 0) {
	// 	$('.audit_perm').show();
	// } else {
	// 	$('.audit_perm').hide();
	// }

	// if (role_list.indexOf('-60-') >= 0 || role_list.indexOf('-61-') >= 0) {
	// 	$('.att_perm').show();
	// } else {
	// 	$('.att_perm').hide();
	// }

	// if (
	// 	role_list.indexOf('-68-') >= 0 ||
	// 	role_list.indexOf('-69-') >= 0 ||
	// 	role_list.indexOf('-70-') >= 0 ||
	// 	role_list.indexOf('-71-') >= 0 ||
	// 	role_list.indexOf('-72-') >= 0
	// ) {
	// 	$('#pay_permsi').show();
	// } else {
	// 	$('#pay_permsi').hide();
	// }

	// if (role_list.indexOf("-47-") >= 0 || role_list.indexOf("-48-") >= 0 || role_list.indexOf("-49-") >= 0) {

	// 	//Settings
	// 	$('#leads').show();

	// }

	// if (role_list.indexOf("-1-") >= 0 || role_list.indexOf("-2-") >= 0) {

	// 	//Settings
	// 	$('#clients').show();

	// }

	// if (role_list.indexOf("-55-") >= 0) {

	// 	//Settings
	// 	$('#reports').show();

	// }
}
