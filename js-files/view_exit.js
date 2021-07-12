$(document).ready(() => {
	fetchSingleExit();
	fetch_employee_details();
	$('.js-example-basic-single').select2();
	load_employee();

	$('#approve_btn').on('click', () => {
		$('#exit_date_modal').modal('show');
	});
	$('#decline_btn').on('click', () => {
		$('#exit_date_modal2').modal('show');
	});
	$('#approve_btnn').on('click', ESSApprove);
	$('#decline_btnn').on('click', ESSDecline);

	// $('#add_apprvoer').on('click', addApprovals);
	listApprovers();
});
const url = window.location.href;
const params = new URL(url).searchParams;
const exit_id = params.get('ex');
const user_id = params.get('us');
const approve_id = params.get('app_id');
const exit_status = params.get('status');

if (exit_status === 'pending') {
	$('#btnGroup').css('display', 'flex');
} else if (exit_status === 'declined' || exit_status === 'approved') {
	$('#add_header_details').hide();
}

// $('#view_prf_btn').attr('href', `employee_info?id=${employee_id}`);

function fetchSingleExit() {
	$('#single_view_error').html('');
	$('#single_view_modal').modal('show');
	$('#single_view_btn').hide();
	$('#single_view_loader').show();

	let company_id = localStorage.getItem('company_id');
	axios
		.get(`${api_path}ess/single_staff_exit`, {
			params: {
				exited_id: exit_id,
				user_id: user_id,
				company_id: company_id,
			},
		})
		.then(function(response) {
			console.log(response.data);

			$('#single_view_loader').hide();
			$('#single_view_btn').show();

			let {
				comment,
				date_initiated,
				date_of_employ,
				department,
				department_name,
				document,
				employee_id,
				employee_status,
				exit_status,
				exit_type_id,
				exit_type_name,
				fullname,
				job_title,
				position,
				supervisor,
				supervisor_name,
				exited_date,
			} = response.data.data;
			let DOJ = moment(date_of_employ, 'YYYY-MM-DD').format('LL');
			let ED =

					exited_date !== '0000-00-00' ? moment(exited_date, 'YYYY-MM-DD').format('LL') :
					'...';
			$('#single_view_name').html(fullname);
			$('#single_view_dept').html(department_name);
			$('#single_view_JT').html(job_title);
			$('#single_view_DOJ').html(DOJ);
			$('#single_view_supervisor').html(supervisor_name);
			$('#single_view_exitType').html(exit_type_name);
			$('#single_view_comment').html(comment);
			$('#single_view_doc').html(

					document !==
					'' ? `<a style="text-decoration:underline;color:green;" target="_blank" href="${window
						.location
						.origin}/files/images/greviance_document/${document}">View Document</a>` :
					'No document',
			);
			$('#single_view_status').html(
				`${
					capitalizeFirstLetter(exit_status) === 'Approve' ? 'Approved' :
					capitalizeFirstLetter(exit_status)}`,
			);
			$('#single_view_exitDate').html(ED);
			// $('#single_view_btn').attr('data-id', employee_id);
		})
		.catch(function(error) {
			console.log(error);

			$('#single_view_loader').hide();
			$('#single_view_btn').show();

			$('#single_view_error').html(error.responeJson.msg);
		})
		.then(function() {
			// always executed
		});
}

function fetch_employee_details() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	// var employee_id = $.urlParam('id'); //pathArray[4].replace(/%20/g,' ');

	// alert(employee_id);
	// $('#page_loader').hide();
	$.ajax({
		type: 'GET',
		dataType: 'json',
		url: api_path + 'hrm/new_employee_info',
		data: { company_id: company_id, employee_id: '', user_id: user_id },
		timeout: 60000,

		success: function(response) {
			// console.log(response);
			$('#page_loader').hide();
			$('#employee_details_display').show();
			// var str = '';
			// var str2 = '';
			// var str3 = '';

			if (response.status == '200') {
				let dobs = moment(response.data.employee_data.dob, 'YYYY-MM-DD').format('LL');
				$('#firstname').html(response.data.employee_data.firstname);
				$('#lastname').html(response.data.employee_data.lastname);
				$('#gender').html(response.data.employee_data.gender);
				$('#middlename').html(response.data.employee_data.middlename);
				$('#dob').html(dobs);
				$('#marital_status').html(response.data.employee_data.marital_status);
				$('#phone').html(response.data.employee_data.phone);
				$('#residential_address').html(response.data.employee_data.residential_address);
				$('#email').html(response.data.employee_data.email);
				$('#religion').html(response.data.employee_data.religion);
				$('#next_of_kin').html(response.data.employee_data.next_of_kin);
				$('#status').html(
					`${
						capitalizeFirstLetter(response.data.employee_data.active_status) ===
						'Terminated' ? 'Exited' :
						capitalizeFirstLetter(response.data.employee_data.active_status)}`,
				);

				// $('#profile_name').html(
				// 	'<b>' +
				// 		response.data.employee_data.firstname +
				// 		' ' +
				// 		response.data.employee_data.lastname +
				// 		'</b>',
				// );

				// str2 +=
				// 	'<a href="' +
				// 	base_url +
				// 	'employees"><button id="send"  class="btn btn-default">Back</button></a>';
				// str2 +=
				// 	'<a onClick="viewBasicInfo()"><button id="editBasicInfo" data-toggle="modal" data-target="#edit_basic_modal" class="btn btn-primary">Edit</button></a>';

				// str3 += '<div id="crop-avatar">';

				// str3 +=
				// 	'<img src="' +
				// 	site_url +
				// 	'/files/images/employee_images/mid_' +
				// 	response.data.employee_data.profile_picture +
				// 	'" alt="..."><div style="text-decoration:underline;text-align:center;margin-top:5px;" data-toggle="modal" data-target="#edit_proPic_modal">Update Image</div>';
				// str3 += '</div>';

				// str += '<li><i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
				// str +=
				// 	'<a href="' +
				// 	base_url +
				// 	'employee_info?id=' +
				// 	response.data.employee_data.employee_id +
				// 	'">Profile</a></li>';

				// str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				// str +=
				// 	'<a href="' +
				// 	base_url +
				// 	'view_employment_info?id=' +
				// 	response.data.employee_data.employee_id +
				// 	'">Employment Info</a></li>';

				// str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				// str +=
				// 	'<a href="' +
				// 	base_url +
				// 	'view_salary_info?id=' +
				// 	response.data.employee_data.employee_id +
				// 	'">Salary Info</a></li>';

				// str += '<li><i class="fa fa-briefcase user-profile-icon"></i>&nbsp;&nbsp;';
				// str +=
				// 	'<a href="' +
				// 	base_url +
				// 	'view_salary_history?id=' +
				// 	response.data.employee_data.employee_id +
				// 	'">Payslips</a></li>';

				// str += '<li><i class="fa fa-sticky-note user-profile-icon"></i>&nbsp;&nbsp;';
				// str +=
				// 	'<a href="' +
				// 	base_url +
				// 	'view_leave_history?id=' +
				// 	response.data.employee_data.employee_id +
				// 	'">Leave History</a></li>';

				// // str += '<li><i class="fa fa-external-link user-profile-icon"></i>&nbsp;&nbsp;';
				// // str += '<a href="<?= base_url() ?>hrm/view_supervisor/'+response.data.employee_data.employee_id+'">Supervisor/Manager</a></li>';

				// str += '<li><i class="fa fa-bars user-profile-icon"></i>&nbsp;&nbsp;';
				// str +=
				// 	'<a href="' +
				// 	base_url +
				// 	'view_position_history?id=' +
				// 	response.data.employee_data.employee_id +
				// 	'">Job Title History</a></li>';

				// str += '<li><i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
				// str +=
				// 	'<a href="' +
				// 	base_url +
				// 	'emp_documents?id=' +
				// 	response.data.employee_data.employee_id +
				// 	'">Documents</a></li>';

				// str += '<li><i class="fa fa-bell user-profile-icon"></i>&nbsp;&nbsp;';
				// str +=
				// 	'<a href="' +
				// 	base_url +
				// 	'view_attendance?id=' +
				// 	response.data.employee_data.employee_id +
				// 	'">Attendance</a></li>';

				// $('#button_link').html(str2);
				// $('#picture').html(str3);
				// $('#profile_links').html(str);
				// $('#profile_links').show();
			} else if (response.status == '400') {
				$('#page_loader').hide();
				$('#employee_details_display').hide();
				$('#employee_data_display').show();
			}
		},
		// objAJAXRequest, strError
		error: function(response) {
			$('#page_loader').hide();
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}

function capitalizeFirstLetter(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}

function listApprovers() {
	let company_id = localStorage.getItem('company_id');

	$('#appv_table').hide();
	$('#appv_loader').show();

	axios
		.get(`${api_path}hrm/fetch_exit_approval`, {
			params: {
				company_id: company_id,
				exit_id: exit_id,
			},
		})
		.then((response) => {
			let appv_list = '';
			if (response.data.data.length > 0) {
				$(response.data.data).each((i, v) => {
					let received;
					let action;
					// if (v.created_at === '0000-00-00 00:00:00' || v.created_at === null) {
					// 	received = '';
					// } else {
					// 	received = moment(v.created_at, 'YYYY-MM-DD HH:mm:ss').format('LL');
					// }

					// if (v.date_acted === '0000-00-00 00:00:00' || v.date_acted === null) {
					// 	action = '';
					// } else {
					// 	action = moment(v.date_acted, 'YYYY-MM-DD HH:mm:ss').format('LL');
					// }
					appv_list += `<tr id="appv_div${v.approval_id}">`;
					appv_list += `<td><div class="profile_pic"><img src="${site_url}/files/images/employee_images/sml_${v.profile_picture}" " alt="..." width="50"></div></td>`;
					appv_list += `<td><b>${v.fullname} (${v.job_title})</b></td>`;
					if (v.approval_status == 'not_approved') {
						appv_list += `<td><i class="fa fa-times-circle" style="color: red; font-size: 15px;"></i></td>`;
						appv_list += `<td width="30%">${
							v.comment !== null ? v.comment :
							'No Comment'}</td>`;
						// appv_list += `<td onClick="deleteAppvrover(${v.approval_id})"><i  class="fa fa-trash-o"  data-toggle="tooltip" data-placement="top" title="Delete Approver"></i></td>`;
					} else if (v.approval_status == 'approved') {
						appv_list += `<td><i class="fa fa-check-circle" style="color: green; font-size: 15px;"></i></td>`;
						appv_list += `<td width="30%">${
							v.comment !== null ? v.comment :
							'No Comment'}</td>`;
					} else {
						appv_list += `<td><i class="fa fa-exclamation-triangle fa-2x" style="color: orange"></i></td>`;
						appv_list += `<td width="30%">${
							v.comment !== null ? v.comment :
							'No Comment'}</td>`;
						// appv_list += `<td onClick="deleteAppvrover(${v.approval_id})"><i  class="fa fa-trash-o"  data-toggle="tooltip" data-placement="top" title="Delete Approver"></i></td>`;
					}
					appv_list += `</tr>`;
					appv_list += `<tr id="appv_del_loader${v.approval_id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-2x"></i></td></tr>`;
				});
			} else {
				appv_list += `<tr><td colspan="4">No record found<td><tr>`;
			}
			$('#appv_body').html(appv_list);
			$('#appv_loader').hide();
			$('#appv_table').show();
		})
		.catch((error) => {
			$('#appv_body').html(`<tr><td colspan="4" style="color:red;">${error}<td><tr>`);
			$('#appv_loader').hide();
			$('#appv_table').show();
		})
		.then(() => {});
}

function load_employee() {
	var company_id = localStorage.getItem('company_id');
	var page = -1;
	var limit = 0;

	$.ajax({
		url: api_path + 'hrm/list_of_company_employees',
		type: 'POST',
		data: { company_id: company_id, page: page, limit: limit },
		dataType: 'json',

		success: function(response) {
			// console.log(response);

			var options = '';

			$(response.data).each((i, v) => {
				options += `<option value="${v.employee_id}">${v.firstname} ${v.lastname} (${v.position})</option>`;
			});
			$('#empo_name').html(options);
			// $('#employee_name').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error: function(response) {
			alert('Connection error');
		},
	});
}

function ESSApprove() {
	$('#exit_date_error').html('');
	let comment = $('#exit_comment').val();
	console.log(comment);
	if (comment !== '') {
		$('#exit_date_modal').modal('hide');
		let ans = confirm('Are you sure you want to approve this Exit request?');
		if (ans) {
			$(`#approve_btn`).hide();
			$(`#decline_loader`).show();
			let company_id = localStorage.getItem('company_id');
			// let comment = $('#exit_comment').val();
			let myUserId = localStorage.getItem('user_id');

			let data = {
				company_id: company_id,
				user_id: myUserId,
				approve_status: 'approved',
				exit_id: exit_id,
				comment: comment,
				approve_id: approve_id,
			};

			$.ajax({
				type: 'Put',
				dataType: 'json',
				url: `${api_path}ess/ess_approve_exit`,
				data: data,

				error: function(res) {
					console.log(res);
					$(`#decline_loader`).hide();
					$(`#approve_btn`).show();

					alert('error');
				},
				success: function(response) {
					if (response.status == 200 || response.status == 201) {
						// getPaySlipDetails(employee_id);
						alert('Exit request has been Approved');
						$(`#approve_btn`).show();
						$(`#decline_loader`).hide();
						// $(`#btnGroup`).hide();
						window.location.href = 'approvals';
					}
				},
			});
		}
	} else {
		$('#exit_date_error').html('Empty field');
		return;
	}
}

function ESSDecline() {
	$('#exit_date_error2').html('');
	let comment = $('#exit_comment2').val();
	console.log(comment);
	if (comment !== '') {
		$('#exit_date_modal2').modal('hide');

		let ans = confirm('Are you sure you want to decline this Exit request?');
		if (ans) {
			$(`#decline_btnn`).hide();
			$(`#declinee_loader`).show();
			let company_id = localStorage.getItem('company_id');
			let myUserId = localStorage.getItem('user_id');

			let data = {
				company_id: company_id,
				user_id: myUserId,
				approve_status: 'declined',
				exit_id: exit_id,
				comment: comment,
				approve_id: approve_id,
			};

			$.ajax({
				type: 'Put',
				dataType: 'json',
				url: `${api_path}ess/ess_approve_exit`,
				data: data,

				error: function(res) {
					console.log(res);
					$(`#declinee_loader`).hide();
					$(`#decline_btnn`).show();

					alert('error');
				},
				success: function(response) {
					if (response.status == 200 || response.status == 201) {
						// getPaySlipDetails(employee_id);
						alert('Exit request has been Declined');
						$(`#declinee_loader`).hide();
						$(`#decline_btnn`).show();
						// $(`#btnGroup`).hide();
						window.location.href = 'approvals';
					}
				},
			});
		}
	} else {
		$('#exit_date_error2').html('Empty field');
		return;
	}
}
