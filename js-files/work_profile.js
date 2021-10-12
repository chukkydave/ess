// $(document).ready(() => {
// 	fetch_employee_details();
// });
function fetch_employee_details() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = ''; //pathArray[4].replace(/%20/g,' ');
	let user_id = localStorage.getItem('user_id');

	// alert(employee_id);
	// $('#page_loader').hide();
	$.ajax({
		type: 'GET',
		dataType: 'json',
		url: api_path + 'hrm/new_employee_info',
		data: { employee_id: employee_id },
		timeout: 60000,
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			// console.log(response);
			$('#page_loader').hide();
			$('#employee_details_display').show();
			var str = '';
			var str2 = '';
			var str3 = '';

			if (response.status == '200') {
				let dobs;
				if (response.data.employee_data == '') {
					dobs = '';
					$('#firstname').html('...');
					$('#lastname').html('...');
					$('#gender').html('...');
					$('#middlename').html('...');
					$('#dob').html('...');
					$('#marital_status').html('...');
					$('#phone').html('...');
					$('#residential_address').html('...');
					$('#email').html('...');
					$('#religion').html('...');
					$('#next_of_kin').html('...');
					$('#status').html('...');

					$('#profile_name').html('...');
				} else {
					dobs = moment(response.data.employee_data.dob, 'YYYY-MM-DD').format('LL');
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
					$('#status').html(response.data.employee_data.active_status);

					$('#profile_name').html(
						'<b>' +
							response.data.employee_data.firstname +
							' ' +
							response.data.employee_data.lastname +
							'</b>',
					);
				}

				// str2 +=
				// 	'<a href="' +
				// 	base_url +
				// 	'employees"><button id="send"  class="btn btn-default">Back</button></a>';
				str2 +=
					'<a onClick="viewBasicInfo()"><button id="editBasicInfo" data-toggle="modal" data-target="#edit_basic_modal" class="btn btn-primary">Edit</button></a>';

				str3 += '<div id="crop-avatar">';

				str3 +=
					'<img src="' +
					site_url +
					'/files/images/employee_images/mid_' +
					response.data.employee_data.profile_picture +
					'" alt="..."><div style="text-decoration:underline;text-align:center;margin-top:5px;" data-toggle="modal" data-target="#edit_proPic_modal">Update Image</div>';
				str3 += '</div>';

				str += '<li><i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'employee_info?id=' +
					response.data.employee_data.employee_id +
					'">Profile</a></li>';

				str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_employment_info?id=' +
					response.data.employee_data.employee_id +
					'">Employment Info</a></li>';

				str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_info?id=' +
					response.data.employee_data.employee_id +
					'">Salary Info</a></li>';

				str += '<li><i class="fa fa-briefcase user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_history?id=' +
					response.data.employee_data.employee_id +
					'">Payslips</a></li>';

				str += '<li><i class="fa fa-sticky-note user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_leave_history?id=' +
					response.data.employee_data.employee_id +
					'">Leave History</a></li>';

				// str += '<li><i class="fa fa-external-link user-profile-icon"></i>&nbsp;&nbsp;';
				// str += '<a href="<?= base_url() ?>hrm/view_supervisor/'+response.data.employee_data.employee_id+'">Supervisor/Manager</a></li>';

				str += '<li><i class="fa fa-bars user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_position_history?id=' +
					response.data.employee_data.employee_id +
					'">Job Title History</a></li>';

				str += '<li><i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'emp_documents?id=' +
					response.data.employee_data.employee_id +
					'">Documents</a></li>';

				str += '<li><i class="fa fa-bell user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_attendance?id=' +
					response.data.employee_data.employee_id +
					'">Attendance</a></li>';

				$('#button_link').html(str2);
				$('#picture').html(str3);
				$('#profile_links').html(str);
				$('#profile_links').show();
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
