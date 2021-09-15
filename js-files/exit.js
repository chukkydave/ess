$(document).ready(() => {
	load_employee();
	listExitType();
	listPolicy();
	listExits();
	$('#view_policy_btn').on('click', () => {
		$('#view_policy_modal').modal('show');
	});
	$('#add_exit_btn').on('click', () => {
		if (isEmptyInput('.add_exit_fields')) {
			initiateExit();
		}
	});
});

$('#supervisor').on('change', updateSupervisor);

function listPolicy() {
	let company_id = localStorage.getItem('company_id');
	$('#list_policy_table').hide();
	$('#list_policy_loader').show();
	axios
		.get(`${api_path}hrm/get_exit_policy`, {
			params: {
				// company_id: company_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let policy_list = '';
			// const { employee_cv_work_history } = response.data.data;
			if (response.data.data) {
				const { policy_document, policy_note, policy_id } = response.data.data;

				if (policy_document === '') {
					$('#policy_list').html(policy_note);
				} else if (policy_document !== '' && policy_note !== '') {
					$('#policy_list').html(
						`${policy_note} <div><a target="_blank" href="${window.location
							.origin}/files/images/greviance_document/${policy_document}"><button class="btn btn-sm btn-primary">View Document</button></a></div>`,
					);
				} else if (policy_note === '') {
					$('#policy_list').html(
						`<div><a target="_blank" href="${window.location
							.origin}/files/images/greviance_document/${policy_document}"><button class="btn btn-sm btn-primary">View Document</button></a></div>`,
					);
				}

				// $('#policy_list').html(policy_list);
				// $('#list_policy_body').html(policy_list);
				$('#list_policy_loader').hide();
				$('#list_policy_table').show();
			} else if (response.data.data.length === 0 || response.data.data.length === '0') {
				$('#policy_list').html(`<p>No Policy</p>`);
				$('#list_policy_loader').hide();
				$('#list_policy_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_policy_loader').hide();
			$('#list_policy_table').show();
			$('#policy_list').html(`<p style="color:red;">Error</p>`);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function listExits() {
	let company_id = localStorage.getItem('company_id');
	let user_id = localStorage.getItem('user_id');
	let statusArr = [];
	$('#list_exit_table').hide();
	$('#list_exit_loader').show();
	axios
		.get(`${api_path}ess/get_staff_record_to_exit`, {
			params: {
				// company_id: company_id,
				// user_id: user_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let exit_list;
			// const { employee_cv_work_history } = response.data.data;

			if (response.data.data.exited.length > 0) {
				// alert('yes');
				$(response.data.data.exited).map((i, v) => {
					let dates =

							v.date_initiated !== '0000-00-00 00:00:00' ? moment(
								v.date_initiated,
								'YYYY-MM-DD HH:mm:ss',
							).format('LL') :
							v.date_initiated;
					exit_list += `<tr class="even pointer" id="exitList_row${v.exit_id}">`;
					exit_list += `<td>${capitalizeFirstLetter(v.exit_type_name)}</td>`;
					exit_list += `<td>${dates}</td>`;
					exit_list += `<td>${capitalizeFirstLetter(v.employee_status)}</td>`;
					// exit_list += `<td>${capitalizeFirstLetter(v.exit_status)}</td>`;
					statusArr.push(v.exit_status);
					if (v.exit_status === 'approve') {
						exit_list += `<td><i class="fa fa-check fa-2x" style="color: green"></i></td>`;
						exit_list += `<td>
						<div class="dropdown">
							<button
								class="btn btn-secondary dropdown-toggle"
								type="button"
								id="dropdownMenuButton1"
								data-toggle="dropdown"
								aria-expanded="false">
								Actions
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								<li onClick="viewExit(${v.exit_id})">
									<a class="dropdown-item">
										<i class="fa fa-pencil" /> View
									</a>
								</li>
								<li>
									<a href="correspondence?exitId=${v.exit_id}" class="dropdown-item">
										<i class="fa fa-comment" /> Correspondence
									</a>
								</li>
								<li>
									<a href="interview?id=${v.exit_id}&status=${v.sending_status}" class="dropdown-item">
										<i class="fa fa-question-circle"></i> Interview
									</a>
								</li>
							</ul>
						</div></td>`;
					} else if (v.exit_status === 'decline') {
						exit_list += `<td><i class="fa fa-times fa-2x" style="color: red"></i></td>`;
						exit_list += `<td>
						<div class="dropdown">
							<button
								class="btn btn-secondary dropdown-toggle"
								type="button"
								id="dropdownMenuButton1"
								data-toggle="dropdown"
								aria-expanded="false">
								Actions
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								<li onClick="viewExit(${v.exit_id})">
									<a class="dropdown-item">
										<i class="fa fa-pencil" /> View
									</a>
								</li>
								<li>
									<a href="correspondence?exitId=${v.exit_id}" class="dropdown-item">
										<i class="fa fa-comment" /> Correspondence
									</a>
								</li>
							</ul>
						</div></td>`;
					} else if (v.exit_status === 'pending') {
						exit_list += `<td><i class="fa fa-exclamation-triangle fa-2x" style="color: orange"></i></td>`;
						exit_list += `<td>
						<div class="dropdown">
							<button
								class="btn btn-secondary dropdown-toggle"
								type="button"
								id="dropdownMenuButton1"
								data-toggle="dropdown"
								aria-expanded="false">
								Actions
							</button>
							<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
								<li onClick="viewExit(${v.exit_id})">
									<a class="dropdown-item">
										<i class="fa fa-pencil" /> View
									</a>
								</li>
								<li>
									<a href="correspondence?exitId=${v.exit_id}" class="dropdown-item">
										<i class="fa fa-comment" /> Correspondence
									</a>
								</li>
							</ul>
						</div></td>`;
					}

					exit_list += `</tr>`;
					exit_list += `<tr id="exitList_loader${v.exit_id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});

				$('#list_exit_body').html(exit_list);
				$('#list_exit_loader').hide();
				$('#list_exit_table').show();
			} else {
				$('#list_exit_body').html(`<tr><td colspan="5">No record found</td></tr>`);
				$('#list_exit_loader').hide();
				$('#list_exit_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_exit_loader').hide();
			$('#list_exit_table').show();
			$('#list_exit_body').html(
				`<tr><td colspan="5" style="color:red;">${error.responseJSON.msg}</td></tr>`,
			);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
			if (statusArr.includes('pending') || statusArr.includes('approve')) {
				$('#intiating_btn').attr('disabled', true);
			}
		});
}

function capitalizeFirstLetter(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}

function initiateExit() {
	let company_id = localStorage.getItem('company_id');

	$('#add_exit_btn').hide();
	$('#add_exit_loader').show();

	let supervisor = $('#supervisor').val();
	let exitType = $('#exit_type').val();
	let comment = $('#comment').val();

	let upImage = document.querySelector(`#file`).files[0];

	let employee_id = $('#employee_idr').html();

	let dates = new Date();

	let day = dates.getDate();
	let month = dates.getMonth() + 1;
	let year = dates.getFullYear();
	let hour = dates.getHours();
	let min = dates.getMinutes();
	let sec = dates.getSeconds();
	// 2021-06-22 03:14:00
	let formatedDate = `${year}-${month}-${day} ${hour}:${min}:${sec}`;

	let data = new FormData();
	data.append('file', upImage);
	data.append('comment', comment);
	data.append('exit_type_id', exitType);
	data.append('date_initiated', formatedDate);
	// data.append('supervisor', supervisor);
	// data.append('company_id', company_id);
	data.append('employee_id', employee_id);
	console.log(data);

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: `${api_path}ess/create_staff_exit`,
		processData: false,
		contentType: false,
		headers: {
			enctype: 'multipart/form-data',
			Authorization: localStorage.getItem('token'),
		},
		data: data,
		error: function(error) {
			console.log(error);
			$('#add_exit_loader').hide();
			$('#add_exit_btn').show();
			$('#exit_error').html(error.responseJSON.msg);
			// alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_exit_loader').hide();
				$('#add_exit_btn').show();
				$(`#collapseExample`).removeClass('in');

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listExits(),
				});
			}
		},
	});
}

function updateSupervisor() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = $('#employee_idr').html();
	$('#supervisor').hide();
	$('#edit_visor_loader').show();

	let supervisor = $('#supervisor').val();

	let data = {
		// company_id: company_id,
		employee_id: employee_id,
		supervisor: supervisor,
	};
	$.ajax({
		type: 'Put',
		dataType: 'json',
		url: `${api_path}hrm/update_supervisor`,
		data: data,
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(res) {
			console.log(res);
			$('#edit_visor_loader').hide();
			$('#supervisor').show();
			Swal.fire({
				title: 'Error!',
				text: `${res.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#edit_visor_loader').hide();
				$('#supervisor').show();

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
				});
				// $('#edit_nok_modal').modal('hide');

				// $('#mod_body').html('Next Of Kin Edit Successful');
				// $('#successModal').modal('show');
				// listNOK();
			}
		},
	});
}

function isEmptyInput(first) {
	let isEmpty = false;
	$(first).each(function() {
		var input = $.trim($(this).val());
		if (input.length === 0 || input === '0') {
			$('#exit_error').html('Empty fields');
			$('.asterix').addClass('has-errors');
			isEmpty = true;
		} else {
			$('#exit_error').html('');
			$('.asterix').removeClass('has-errors');
			// isEmpty = false;
		}
	});
	if (isEmpty === true) {
		return false;
	} else {
		return true;
	}
}

function viewEmploymentInfo() {
	$('#view_exit_div').hide();
	$('#view_exit_loader').show();

	let company_id = localStorage.getItem('company_id');
	let user_id = localStorage.getItem('user_id');
	axios
		.get(`${api_path}ess/get_staff_record_to_exit`, {
			params: {
				// company_id: company_id,
				// user_id: user_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			console.log(response.data);

			$('#view_exit_loader').hide();
			$('#view_exit_div').show();

			let {
				supervisor,
				job_title,
				fullname,
				department_name,
				date_of_employ,
				employee_id,
			} = response.data.data;
			let DOJ = moment(date_of_employ, 'YYYY-MM-DD').format('LL');
			$('#date_of_joining').html(DOJ);
			$('#department').html(department_name);
			$('#name').html(fullname);
			$('#employee_idr').html(employee_id);
			$('#job_title').html(job_title);
			$('#supervisor').val(supervisor);
			// $('#view_exit_div').attr('data-id', id);
		})
		.catch(function(error) {
			console.log(error);

			$('#view_exit_loader').hide();
			$('#view_exit_div').show();

			$('#view_exit_error').html(error.responseJSON.msg);
		})
		.then(function() {
			// always executed
		});
}

function load_employee() {
	var company_id = localStorage.getItem('company_id');
	var page = -1;
	var limit = 0;

	$.ajax({
		url: api_path + 'hrm/list_of_company_employees',
		type: 'POST',
		data: { page: page, limit: limit },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		dataType: 'json',

		success: function(response) {
			// console.log(response);

			var options = '';

			$(response.data).each((i, v) => {
				options += `<option value="${v.employee_id}">${v.firstname} ${v.lastname} (${v.position})</option>`;
			});
			$('#supervisor').append(options);
			viewEmploymentInfo();
			// $('#employee_name').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error: function(response) {
			alert('Connection error');
		},
	});
}

function listExitType() {
	let company_id = localStorage.getItem('company_id');

	axios
		.get(`${api_path}hrm/company_exit_type`, {
			params: {
				// company_id: company_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			var options = '';

			if (response.data.data.length > 0) {
				$(response.data.data).map((i, v) => {
					options += `<option value="${v.exit_type_id}">${v.exit_type}</option>`;
				});
			} else {
				options += `<option value="${v.exit_type_id}">No Record</option>`;
			}
			$('#exit_type').append(options);
		})
		.catch(function(error) {
			console.log(error);
			$('#exit_type').append(`<option value="">Error</option>`);
		})
		.then(function() {
			// always executed
		});
}

function viewExit(id) {
	$('#single_view_error').html('');
	$('#single_view_modal').modal('show');
	$('#single_view_btn').hide();
	$('#single_view_loader').show();

	let company_id = localStorage.getItem('company_id');
	let user_id = localStorage.getItem('user_id');
	axios
		.get(`${api_path}ess/single_staff_exit`, {
			params: {
				exited_id: id,
				user_id: user_id,
				// company_id: company_id,
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
			let ED;
			if (exited_date === '' || exited_date === '0000-00-00') {
				ED = '...';
			} else {
				ED = moment(exited_date, 'YYYY-MM-DD').format('LL');
			}
			let exStat;
			if (exit_status.toLowerCase() === 'approve') {
				exStat = 'Approved';
			} else if (exit_status.toLowerCase() === 'decline') {
				exStat = 'Declined';
			} else if (exit_status.toLowerCase() === 'pending') {
				exStat = 'Pending';
			} else {
				exStat = capitalizeFirstLetter(exit_status);
			}
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
			$('#single_view_status').html(exStat);
			$('#single_view_exitDate').html(ED);
			$('#single_view_btn').attr('data-id', employee_id);
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
