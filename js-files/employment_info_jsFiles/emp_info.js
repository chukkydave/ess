$(document).ready(() => {
	$('#add_dept').on('click', () => {
		$('#dept_display').toggle();
	});

	$('#add_dept_btn').on('click', () => {
		// alert('clicked');
		if (isEmptyInput('.add_dept_fields')) {
			addDepartment();
		}
	});
	$('#edit_dept_btn').on('click', () => {
		editDepartment();
	});
	$('#add_workShift').on('click', () => {
		$('#workShift_display').toggle();
	});

	$('#add_workShift_btn').on('click', () => {
		// alert('clicked');
		if (isEmptyInput('.add_workShift_fields')) {
			addWorkShift();
		}
	});

	$('#add_jobTitle').on('click', () => {
		$('#jobTitle_display').toggle();
	});

	$('#add_jobTitle_btn').on('click', () => {
		// alert('clicked');
		if (isEmptyInput('.add_jobTitle_fields')) {
			addJobTitle();
		}
	});

	$('#edit_jobTitle_btn').on('click', () => {
		editJobTitle();
	});
	$('#edit_additional_btn').on('click', () => {
		addAdditionalInfo();
	});

	$('#edit_emp_btn').on('click', () => {
		// alert('clicked');
		if (isEmptyInput('.edit_emp_fields')) {
			EditEmpInf();
		}
	});

	$('#edit_workShift_btn').on('click', () => {
		editWorkShift();
	});
	$('#edit_emp_info').on('click', () => {
		viewEmpInfo();
	});

	$('#edit_emp_supervisor').on('keyup', () => {
		let input = $('#edit_emp_supervisor').val();
		if (input.length >= 2) {
			getEmployeeList(input);
		}
	});

	// $('#emp_email').on('keyup', () => {
	// 	let input = $('#emp_email').val();
	// 	if (input.length >= 2) {
	// 		getEmployeeEmail(input);
	// 	} else {
	// 		$('#emp_connect').attr('disabled', true);
	// 	}
	// });

	$('#emp_connect').on('click', () => {
		if (isEmptyInput('.emp_connect_field')) {
			getEmployeeEmail();
		}
	});
	$('#view_ess_connect_btn').on('click', () => {
		connectEmployee();
	});
});

$('#dept_from').datepicker({
	dateFormat: 'yy-mm-dd',
});

$('#dept_to').datepicker({
	dateFormat: 'yy-mm-dd',
});
$('#edit_dept_from').datepicker({
	dateFormat: 'yy-mm-dd',
});

$('#edit_dept_to').datepicker({
	dateFormat: 'yy-mm-dd',
});

$('#workShift_from').datepicker({
	dateFormat: 'yy-mm-dd',
});

$('#workShift_to').datepicker({
	dateFormat: 'yy-mm-dd',
});
$('#edit_workShift_from').datepicker({
	dateFormat: 'yy-mm-dd',
});

$('#edit_workShift_to').datepicker({
	dateFormat: 'yy-mm-dd',
});

$('input#edit_jobTitle_from').datepicker({
	dateFormat: 'yy-mm-dd',
});

$('input#edit_jobTitle_to').datepicker({
	dateFormat: 'yy-mm-dd',
});

$('input#jobTitle_from').datepicker({
	dateFormat: 'yy-mm-dd',
});

$('input#jobTitle_to').datepicker({
	dateFormat: 'yy-mm-dd',
});

//department starts
function addDepartment() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');

	$('#add_dept_btn').hide();
	$('#add_dept_loader').show();

	let name = $('#dept_name').val();
	let from = $('#dept_from').val();
	let to = $('#dept_to').val();

	let data = {
		started: from,
		department_id: name,
		// company_id: company_id,
		employee_id: employee_id,
		ended: to,
		type: 'new',
		// user_id: user_id,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/update_employee_department`,
		data: data,
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		error: function(error) {
			console.log(error);
			$('#add_dept_loader').hide();
			$('#add_dept_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${error.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_dept_loader').hide();
				$('#add_dept_btn').show();

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listDepartment(),
				});
				$('#dept_name').val('');
				$('#dept_from').val('');
				$('#dept_to').val('');
				$('#dept_display').toggle();
				// listDepartment();
			}
		},
	});
}

function listDepartment() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	$('#list_dept_table').hide();
	$('#list_dept_loader').show();
	axios
		.get(`${api_path}hrm/new_employee_info`, {
			params: {
				// company_id: company_id,
				employee_id: employee_id,
				// user_id: user_id,
			},
		})
		.then(function(response) {
			let dept_list;
			const { department_history } = response.data.data;

			if (department_history.length > 0) {
				$(department_history).map((i, v) => {
					let start;
					let end;
					if (v.ended === '0000-00-00 00:00:00') {
						end = '';
					} else {
						end = moment(v.ended, 'YYYY-MM-DD HH:mm:ss').format('LL');
					}

					if (v.started === '0000-00-00 00:00:00') {
						start = '';
					} else {
						start = moment(v.started, 'YYYY-MM-DD HH:mm:ss').format('LL');
					}
					dept_list += `<tr class="even pointer" id="dept_row${v.id}">`;
					dept_list += `<td>${v.department_name}  <span class="greent_${i}_trial"></span></td>`;
					// dept_list += `<td>${v.nxt_kin_relationship}</td>`;
					dept_list += `<td>${start}</td>`;
					dept_list += `<td>${end}</td>`;

					// dept_list += `<td>
					// 	<div class="dropdown">
					// 		<button
					// 			class="btn btn-secondary dropdown-toggle"
					// 			type="button"
					// 			id="dropdownMenuButton1"
					// 			data-toggle="dropdown"
					// 			aria-expanded="false">
					// 			Actions
					// 		</button>
					// 		<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
					// 			<li onClick="viewDepartment(${v.id})">
					// 				<a class="dropdown-item">
					// 					<i class="fa fa-pencil" /> Edit
					// 				</a>
					// 			</li>
					// 			<li onClick="deleteDepartment(${v.id})">
					// 				<a class="dropdown-item">
					// 					<i class="fa fa-trash" /> Delete
					// 				</a>
					// 			</li>
					// 		</ul>
					// 	</div></td>`;
					dept_list += `</tr>`;
					dept_list += `<tr id="dept_loader${v.id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});

				$('#list_dept_body').html(dept_list);
				$('#list_dept_loader').hide();
				$('#list_dept_table').show();
			} else {
				$('#list_dept_body').html(`<tr><td colspan="4">No record</td></tr>`);
				$('#list_dept_loader').hide();
				$('#list_dept_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_dept_loader').hide();
			$('#list_dept_table').show();
			$('#list_dept_body').html(`<tr><td colspan="4" style="color:red;">Error</td></tr>`);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function viewDepartment(id) {
	$('#edit_dept_error').html('');
	$('#edit_dept_modal').modal('show');
	$('#edit_dept_btn').hide();
	$('#edit_dept_loader').show();

	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	axios
		.get(`${api_path}hrm/single_employee_department`, {
			params: {
				dep_his_id: id,
				employee_id: employee_id,
				// company_id: company_id,
				// user_id: user_id,
			},
		})
		.then(function(response) {
			console.log(response.data);

			$('#edit_dept_loader').hide();
			$('#edit_dept_btn').show();

			let { department_id, started, ended } = response.data.data;
			$('#edit_dept_name').val(department_id);
			$('#edit_dept_from').val(started);
			$('#edit_dept_to').val(ended);
			$('#edit_dept_btn').attr('data-id', id);
		})
		.catch(function(error) {
			console.log(error);

			$('#edit_dept_loader').hide();
			$('#edit_dept_btn').show();

			$('#edit_dept_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function editDepartment() {
	let id = $('#edit_dept_btn').attr('data-id');
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	$('#edit_dept_btn').hide();
	$('#edit_dept_loader').show();

	let name = $('#edit_dept_name').val();
	let from = $('#edit_dept_from').val();
	let to = $('#edit_dept_to').val();

	let data = {
		started: from,
		department_id: name,
		// company_id: company_id,
		employee_id: employee_id,
		ended: to,
		dep_his_id: id,
		type: 'edit',
		// user_id: user_id,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/update_employee_department`,
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
			$('#edit_dept_loader').hide();
			$('#edit_dept_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${res.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#edit_dept_loader').hide();
				$('#edit_dept_btn').show();

				$('#edit_dept_modal').modal('hide');

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listDepartment(),
				});
			}
		},
	});
}

function deleteDepartment(id) {
	let ans = confirm('Are you sure you want to delete this record?');
	if (ans) {
		$(`#dept_row${id}`).hide();
		$(`#dept_loader${id}`).show();
		let company_id = localStorage.getItem('company_id');
		let employee_id = '';
		let user_id = localStorage.getItem('user_id');

		let data = {
			dep_his_id: id,
			employee_id: employee_id,
			// company_id: company_id,
			// user_id: user_id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/delete_employee_department`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				$(`#dept_loader${id}`).hide();
				$(`#dept_row${id}`).show();

				Swal.fire({
					title: 'Error!',
					text: `${res.msg}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#dept_row${id}`).remove();
					$(`#dept_loader${id}`).remove();
					Swal.fire({
						title: 'Success',
						text: `Success`,
						icon: 'success',
						confirmButtonText: 'Okay',
						// onClose: listDepartment(),
					});
				}
			},
		});
	}
}
//department ends

function pickOption(name, id) {
	$('#edit_emp_supervisor').val(name);
	$('#edit_emp_supervisor').attr('data', id);
	$('#emp_list').removeClass('show');
}

let root = document.querySelector('#emp_list');
document.addEventListener('click', (event) => {
	if (!root.contains(event.target)) {
		$('#emp_list').removeClass('show');
	}
});

function getEmployeeList(param) {
	// let param = $('#edit_emp_supervisor').val();
	let company_id = localStorage.getItem('company_id');

	axios
		.get(`${api_path}hrm/search_staff_autocomplete`, {
			params: {
				// company_id: company_id,
				query_param: param,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			// console.log('res', response);
			let emList = '';
			$(response.data.data).map((i, v) => {
				emList += `<li><a class="dropdown-item" onClick="pickOption('${v.lastname} ${v.firstname} ${v.middlename}',${v.employee_id})">${v.lastname} ${v.firstname} ${v.middlename}</a></li>`;
			});
			$('#emp_list').html(emList);
			$('#emp_list').addClass('show');
		})
		.catch(function(error) {
			console.log(error);
			$('#emp_list').html(`<em>Error loading data</em>`);
		})
		.then(function() {
			// always executed
		});
}

//work shift starts
function addWorkShift() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');

	$('#add_workShift_btn').hide();
	$('#add_workShift_loader').show();

	let name = $('#workShift_name').val();
	let from = $('#workShift_from').val();
	let to = $('#workShift_to').val();

	let data = {
		started: from,
		workshift_id: name,
		// company_id: company_id,
		employee_id: employee_id,
		ended: to,
		type: 'new',
		// user_id: user_id,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/update_workshift_history`,
		data: data,
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(error) {
			console.log(error);
			$('#add_workShift_loader').hide();
			$('#add_workShift_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${error.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_workShift_loader').hide();
				$('#add_workShift_btn').show();

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listWorkShift(),
				});
				$('#workShift_name').val('');
				$('#workShift_from').val('');
				$('#workShift_to').val('');
				$('#workShift_display').toggle();
			}
		},
	});
}

function listWorkShift() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	$('#list_workShift_table').hide();
	$('#list_workShift_loader').show();
	axios
		.get(`${api_path}hrm/new_employee_info`, {
			params: {
				// company_id: company_id,
				employee_id: employee_id,
				// user_id: user_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let workShift_list;
			const { workshift_data } = response.data.data;

			if (workshift_data.length > 0) {
				$(workshift_data).map((i, v) => {
					let start;
					let end;
					if (v.ended === '0000-00-00 00:00:00') {
						end = '';
					} else {
						end = moment(v.ended, 'YYYY-MM-DD HH:mm:ss').format('LL');
					}

					if (v.started === '0000-00-00 00:00:00') {
						start = '';
					} else {
						start = moment(v.started, 'YYYY-MM-DD HH:mm:ss').format('LL');
					}
					workShift_list += `<tr class="even pointer" id="workShift_row${v.id}">`;
					workShift_list += `<td>${v.workshift_name}  <span class="greent_${i}_trial"></span></td>`;
					// workShift_list += `<td>${v.nxt_kin_relationship}</td>`;
					workShift_list += `<td>${start}</td>`;
					workShift_list += `<td>${end}</td>`;

					// workShift_list += `<td>
					// 	<div class="dropdown">
					// 		<button
					// 			class="btn btn-secondary dropdown-toggle"
					// 			type="button"
					// 			id="dropdownMenuButton1"
					// 			data-toggle="dropdown"
					// 			aria-expanded="false">
					// 			Actions
					// 		</button>
					// 		<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
					// 			<li onClick="viewWorkShift(${v.id})">
					// 				<a class="dropdown-item">
					// 					<i class="fa fa-pencil" /> Edit
					// 				</a>
					// 			</li>
					// 			<li onClick="deleteWorkShift(${v.id})">
					// 				<a class="dropdown-item">
					// 					<i class="fa fa-trash" /> Delete
					// 				</a>
					// 			</li>
					// 		</ul>
					// 	</div></td>`;
					workShift_list += `</tr>`;
					workShift_list += `<tr id="workShift_loader${v.id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});

				$('#list_workShift_body').html(workShift_list);
				$('#list_workShift_loader').hide();
				$('#list_workShift_table').show();
			} else {
				$('#list_workShift_body').html(`<tr><td colspan="4">No record</td></tr>`);
				$('#list_workShift_loader').hide();
				$('#list_workShift_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_workShift_loader').hide();
			$('#list_workShift_table').show();
			$('#list_workShift_body').html(
				`<tr><td colspan="4" style="color:red;">Error</td></tr>`,
			);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function viewWorkShift(id) {
	$('#edit_workShift_error').html('');
	$('#edit_workShift_modal').modal('show');
	$('#edit_workShift_btn').hide();
	$('#edit_workShift_loader').show();

	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	axios
		.get(`${api_path}hrm/single_workshift_history`, {
			params: {
				wrkshift_his_id: id,
				employee_id: employee_id,
				// company_id: company_id,
				// user_id: user_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			console.log(response.data);

			$('#edit_workShift_loader').hide();
			$('#edit_workShift_btn').show();

			let { workshift_id, started, ended } = response.data.data;
			$('#edit_workShift_name').val(workshift_id);
			$('#edit_workShift_from').val(started);
			$('#edit_workShift_to').val(ended);
			$('#edit_workShift_btn').attr('data-id', id);
		})
		.catch(function(error) {
			console.log(error);

			$('#edit_workShift_loader').hide();
			$('#edit_workShift_btn').show();

			$('#edit_workShift_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function editWorkShift() {
	let id = $('#edit_workShift_btn').attr('data-id');
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	$('#edit_workShift_btn').hide();
	$('#edit_workShift_loader').show();

	let name = $('#edit_workShift_name').val();
	let from = $('#edit_workShift_from').val();
	let to = $('#edit_workShift_to').val();

	let data = {
		started: from,
		workshift_id: name,
		// company_id: company_id,
		employee_id: employee_id,
		ended: to,
		wrkshift_his_id: id,
		type: 'edit',
		// user_id: user_id,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/update_workshift_history`,
		data: data,
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(res) {
			console.log(res);
			$('#edit_workShift_loader').hide();
			$('#edit_workShift_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${res.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#edit_workShift_loader').hide();
				$('#edit_workShift_btn').show();

				$('#edit_workShift_modal').modal('hide');

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listWorkShift(),
				});
			}
		},
	});
}

function deleteWorkShift(id) {
	let ans = confirm('Are you sure you want to delete this record?');
	if (ans) {
		$(`#workShift_row${id}`).hide();
		$(`#workShift_loader${id}`).show();
		let company_id = localStorage.getItem('company_id');
		let employee_id = '';
		let user_id = localStorage.getItem('user_id');

		let data = {
			wrkshift_his_id: id,
			employee_id: employee_id,
			// company_id: company_id,
			// user_id: user_id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/delete_workshift_history`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				$(`#workShift_loader${id}`).hide();
				$(`#workShift_row${id}`).show();

				Swal.fire({
					title: 'Error!',
					text: `${res.msg}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#workShift_row${id}`).remove();
					$(`#workShift_loader${id}`).remove();
					Swal.fire({
						title: 'Success',
						text: `Success`,
						icon: 'success',
						confirmButtonText: 'Okay',
					});
				}
			},
		});
	}
}
//work shift ends

function fetch_workList() {
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'workshifts/list_shifts',
		data: {},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				var the_list = '';
				$(response.data).each(function(index, value) {
					the_list += `<option value="${value.id}">${value.name}</option>`;
				});

				$('#workShift_name').append(the_list);
				$('#edit_workShift_name').append(the_list);
			} else if (response.status == '400') {
				// coder error message

				$('#workShift_name').append(`<option>Error</option>`);
				$('#edit_workShift_name').append(`<option>Error</option>`);
			} else if (response.status == '401') {
				//user error message

				$('#workShift_name').append(`<option>Error</option>`);
				$('#edit_workShift_name').append(`<option>Error</option>`);
			}

			$('#loading_td').hide();
		},

		error: function(response) {
			console.log(response);
			$('#workShift_name').append(`<option>Error</option>`);
			$('#edit_workShift_name').append(`<option>Error</option>`);
		},
	});
}

function EditEmpInf() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');

	$('#edit_emp_btn').hide();
	$('#edit_emp_loader').show();

	let name = $('#edit_emp_supervisor').attr('data');
	let date = $('#edit_emp_date').val();
	let type = $('#edit_emp_type').val();
	let branch = $('#edit_emp_branch').val();

	let data = {
		employee_type: type,
		supervisor: name,
		// company_id: company_id,
		employee_id: employee_id,
		employee_date: date,
		branch: branch,
		// user_id: user_id,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/update_employement_info`,
		data: data,
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(error) {
			console.log(error);
			$('#edit_emp_loader').hide();
			$('#edit_emp_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${error.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#edit_emp_loader').hide();
				$('#edit_emp_btn').show();
				$('#edit_emp_supervisor').val('');
				$('#edit_emp_date').val('');
				$('#edit_emp_type').val('');
				$('#edit_emp_branch').val('');
				$('#edit_employment_info_modal').modal('hide');
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: showEmployeeDataInfo(),
				});

				// employementInfo();
			}
		},
	});
}

function showEmployeeDataInfo() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	// $('#list_workShift_table').hide();
	// $('#list_workShift_loader').show();
	axios
		.get(`${api_path}hrm/new_employee_info`, {
			params: {
				// company_id: company_id,
				employee_id: employee_id,
				// user_id: user_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			if (response.data.data.employee_data == '') {
				$('#branch').html('...');
				$('#employment_type').html('...');
				$('#date_of_employment').html('...');
				$('#supervisor').html('...');
			} else {
				const { employee_data } = response.data.data;

				if (employee_data) {
					const {
						branch_name,
						employment_type_name,
						supervisor_name,
						date_of_employ,
					} = response.data.data.employee_data;
					let sup_name = '';
					if (supervisor_name !== 'N/A') {
						sup_name = `${supervisor_name.lastname} ${supervisor_name.firstname} ${supervisor_name.middlename}`;
					}
					let empee;
					if (
						date_of_employ === '0000-00-00 00:00:00' ||
						date_of_employ === '0000-00-00'
					) {
						empee = '';
					} else {
						empee = moment(date_of_employ, 'YYYY-MM-DD').format('LL');
					}
					$('#branch').html(branch_name);
					$('#employment_type').html(employment_type_name);
					$('#date_of_employment').html(empee);
					$('#supervisor').html(sup_name);
					// $('#list_workShift_loader').hide();
					// $('#list_workShift_table').show();
				} else {
					// $('#list_workShift_body').html(`<tr><td colspan="4">No record</td></tr>`);
					// $('#list_workShift_loader').hide();
					// $('#list_workShift_table').show();
				}
			}
		})
		.catch(function(error) {
			console.log(error);

			// $('#list_workShift_loader').hide();
			// $('#list_workShift_table').show();
			// $('#list_workShift_body').html(
			// 	`<tr><td colspan="4" style="color:red;">Error</td></tr>`,
			// );

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function viewEmpInfo() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	$('#edit_emp_btn').hide();
	$('#edit_emp_loader').show();
	axios
		.get(`${api_path}hrm/new_employee_info`, {
			params: {
				// company_id: company_id,
				employee_id: employee_id,
				// user_id: user_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			const { employee_data } = response.data.data;

			if (employee_data || response.data.status == 200) {
				const {
					branch_name,
					branch,
					employment_type_name,
					employment_type,
					supervisor_name,
					supervisor,
					date_of_employ,
				} = response.data.data.employee_data;

				$('#edit_emp_supervisor').attr('data', supervisor);
				if (supervisor_name == 'N/A') {
					$('#edit_emp_supervisor').val('');
				} else {
					$('#edit_emp_supervisor').val(
						`${supervisor_name.lastname} ${supervisor_name.firstname} ${supervisor_name.middlename}`,
					);
				}

				$('#edit_emp_supervisor').attr('data', supervisor);
				$('#edit_emp_date').val(date_of_employ);
				$('#edit_emp_type').val(employment_type);
				$('#edit_emp_branch').val(branch);

				$('#edit_emp_loader').hide();
				$('#edit_emp_btn').show();
			} else {
				$('#edit_emp_error').html(response.data.msg);
				$('#edit_emp_loader').hide();
				$('#edit_emp_btn').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#edit_emp_loader').hide();
			$('#edit_emp_btn').show();
			$('#edit_emp_error').html(response.data.msg);
			// $('#list_workShift_body').html(
			// 	`<tr><td colspan="4" style="color:red;">Error</td></tr>`,
			// );

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

//Job Title starts
function addJobTitle() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');

	$('#add_jobTitle_btn').hide();
	$('#add_jobTitle_loader').show();

	let name = $('#jobTitle_name').val();
	let from = $('#jobTitle_from').val();
	let to = $('#jobTitle_to').val();

	let data = {
		from_date: from,
		to_date: to,
		// company_id: company_id,
		employee_id: employee_id,
		position_id: name,
		// user_id: user_id,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/add_company_employee_position_history`,
		data: data,
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(error) {
			console.log(error);
			$('#add_jobTitle_loader').hide();
			$('#add_jobTitle_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${error.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_jobTitle_loader').hide();
				$('#add_jobTitle_btn').show();

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listJobTitle(),
				});
				$('#jobTitle_name').val('');
				$('#jobTitle_from').val('');
				$('#jobTitle_to').val('');
				$('#jobTitle_display').toggle();
			}
		},
	});
}

function listJobTitle() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	$('#list_jobTitle_table').hide();
	$('#list_jobTitle_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: `${api_path}hrm/list_company_employee_positions_history`,
		data: { employee_id: employee_id },
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				let jobTitle_list;
				// const { jobTitle_data } = response.data.data;

				if (response.data.length > 0) {
					$(response.data).map((i, v) => {
						let start;
						let end;
						if (v.to_date === '0000-00-00') {
							end = '';
						} else {
							end = moment(v.to_date, 'YYYY-MM-DD').format('LL');
						}

						if (v.from_date === '0000-00-00') {
							start = '';
						} else {
							start = moment(v.from_date, 'YYYY-MM-DD').format('LL');
						}
						jobTitle_list += `<tr class="even pointer" id="jobTitle_row${v.id}">`;
						jobTitle_list += `<td>${v.position_name}  <span class="greent_${i}_trial"></span></td>`;
						// jobTitle_list += `<td>${v.nxt_kin_relationship}</td>`;
						jobTitle_list += `<td>${start}</td>`;
						jobTitle_list += `<td>${end}</td>`;

						// jobTitle_list += `<td>
						// <div class="dropdown">
						// 	<button
						// 		class="btn btn-secondary dropdown-toggle"
						// 		type="button"
						// 		id="dropdownMenuButton1"
						// 		data-toggle="dropdown"
						// 		aria-expanded="false">
						// 		Actions
						// 	</button>
						// 	<ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
						// 		<li onClick="viewJobTitle(${v.id})">
						// 			<a class="dropdown-item">
						// 				<i class="fa fa-pencil" /> Edit
						// 			</a>
						// 		</li>
						// 		<li onClick="deleteJobTitle(${v.id})">
						// 			<a class="dropdown-item">
						// 				<i class="fa fa-trash" /> Delete
						// 			</a>
						// 		</li>
						// 	</ul>
						// </div></td>`;
						jobTitle_list += `</tr>`;
						jobTitle_list += `<tr id="jobTitle_loader${v.id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
					});

					$('#list_jobTitle_body').html(jobTitle_list);
					$('#list_jobTitle_loader').hide();
					$('#list_jobTitle_table').show();
				} else {
					$('#list_jobTitle_body').html(`<tr><td colspan="4">No record</td></tr>`);
					$('#list_jobTitle_loader').hide();
					$('#list_jobTitle_table').show();
				}
			} else if (response.status == '400') {
				// coder error message
				$('#list_jobTitle_loader').hide();
				$('#list_jobTitle_table').show();
				$('#list_jobTitle_body').html(`<tr><td colspan="4">No record</td></tr>`);
			} else if (response.status == '401') {
				//user error message
				$('#list_jobTitle_loader').hide();
				$('#list_jobTitle_table').show();
				$('#list_jobTitle_body').html(
					`<tr><td colspan="4" style="color:red;">Error</td></tr>`,
				);
			}

			// $('#loading_td').hide();
		},

		error: function(response) {
			console.log(response);
			$('#list_jobTitle_loader').hide();
			$('#list_jobTitle_table').show();
			$('#list_jobTitle_body').html(`<tr><td colspan="4" style="color:red;">Error</td></tr>`);
		},
	});
}

function viewJobTitle(id) {
	$('#edit_jobTitle_error').html('');
	$('#edit_jobTitle_modal').modal('show');
	$('#edit_jobTitle_btn').hide();
	$('#edit_jobTitle_loader').show();

	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	axios
		.get(`${api_path}hrm/single_job_history`, {
			params: {
				history_id: id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			console.log(response.data);

			$('#edit_jobTitle_loader').hide();
			$('#edit_jobTitle_btn').show();

			let { history_id, from_date, to_date, position_id } = response.data.data;
			$('#edit_jobTitle_name').val(position_id);
			$('#edit_jobTitle_from').val(from_date);
			$('#edit_jobTitle_to').val(to_date);
			$('#edit_jobTitle_btn').attr('data-id', history_id);
		})
		.catch(function(error) {
			console.log(error);

			$('#edit_jobTitle_loader').hide();
			$('#edit_jobTitle_btn').show();

			$('#edit_jobTitle_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function editJobTitle() {
	let id = $('#edit_jobTitle_btn').attr('data-id');
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	$('#edit_jobTitle_btn').hide();
	$('#edit_jobTitle_loader').show();

	let to = $('#edit_jobTitle_to').val();

	let data = {
		enddate: to,
		history_id: id,
		// user_id: user_id,
		// type: 'edit',
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/end_position_history`,
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
			$('#edit_jobTitle_loader').hide();
			$('#edit_jobTitle_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${res.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#edit_jobTitle_loader').hide();
				$('#edit_jobTitle_btn').show();
				$('#edit_jobTitle_error').html('');
				$('#edit_jobTitle_modal').modal('hide');

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listJobTitle(),
				});
			} else {
				$('#edit_jobTitle_loader').hide();
				$('#edit_jobTitle_btn').show();
				$('#edit_jobTitle_error').html(response.msg);
			}
		},
	});
}

function deleteJobTitle(id) {
	let ans = confirm('Are you sure you want to delete this record?');
	if (ans) {
		$(`#jobTitle_row${id}`).hide();
		$(`#jobTitle_loader${id}`).show();
		let company_id = localStorage.getItem('company_id');
		let employee_id = '';
		let user_id = localStorage.getItem('user_id');

		let data = {
			id: id,
		};

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: `${api_path}hrm/delete_company_employee_position_history`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				$(`#jobTitle_loader${id}`).hide();
				$(`#jobTitle_row${id}`).show();

				Swal.fire({
					title: 'Error!',
					text: `${res.msg}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#jobTitle_row${id}`).remove();
					$(`#jobTitle_loader${id}`).remove();
					Swal.fire({
						title: 'Success',
						text: `Success`,
						icon: 'success',
						confirmButtonText: 'Okay',
					});
				} else {
					$(`#jobTitle_loader${id}`).hide();
					$(`#jobTitle_row${id}`).show();

					Swal.fire({
						title: 'Error!',
						text: `${response.msg}`,
						icon: 'error',
						confirmButtonText: 'Close',
					});
				}
			},
		});
	}
}
//job Title ends

function fetch_jobTitle() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: `${api_path}hrm/list_of_company_positions`,
		data: { page: 1, limit: 1000 },
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				let the_list = '';
				$(response.data).each(function(index, value) {
					the_list += `<option value="${value.position_id}">${value.position_name}</option>`;
				});

				$('#jobTitle_name').append(the_list);
				$('#edit_jobTitle_name').append(the_list);
			} else if (response.status == '400') {
				// coder error message

				$('#jobTitle_name').append(`<option>Error</option>`);
				$('#edit_jobTitle_name').append(`<option>Error</option>`);
			} else if (response.status == '401') {
				//user error message

				$('#jobTitle_name').append(`<option>Error</option>`);
				$('#edit_jobTitle_name').append(`<option>Error</option>`);
			}

			// $('#loading_td').hide();
		},

		error: function(response) {
			console.log(response);
			$('#jobTitle_name').append(`<option>Error</option>`);
			$('#edit_jobTitle_name').append(`<option>Error</option>`);
		},
	});
}

// additional info start

function showAdditionalInfo() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	// $('#list_workShift_table').hide();
	// $('#list_workShift_loader').show();
	axios
		.get(`${api_path}hrm/new_employee_info`, {
			params: {
				employee_id: employee_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			const { employee_data } = response.data.data;
			// alert('entered');
			if (employee_data) {
				const { additional_info } = response.data.data.employee_data;
				// alert(additional_info);
				if (additional_info == null || additional_info == '') {
					$('#list_addInfo').html('No Information currently');
					$('#additional_info').val('');
				} else {
					$('#list_addInfo').html(additional_info);
					$('#additional_info').val(additional_info);
				}
			} else {
				// $('#list_workShift_body').html(`<tr><td colspan="4">No record</td></tr>`);
				// $('#list_workShift_loader').hide();
				// $('#list_workShift_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			// $('#list_workShift_loader').hide();
			// $('#list_workShift_table').show();
			// $('#list_workShift_body').html(
			// 	`<tr><td colspan="4" style="color:red;">Error</td></tr>`,
			// );

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function addAdditionalInfo() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');

	$('#edit_additional_btn').hide();
	$('#edit_additional_loader').show();

	let name = $('#additional_info').val();

	let data = {
		// company_id: company_id,
		employee_id: employee_id,
		additional_info: name,
		// user_id: user_id,
	};
	$.ajax({
		type: 'Put',
		dataType: 'json',
		url: `${api_path}hrm/update_additional_information`,
		data: data,
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(error) {
			console.log(error);
			$('#edit_additional_loader').hide();
			$('#edit_additional_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${error.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#edit_additional_loader').hide();
				$('#edit_additional_btn').show();
				$('#edit_additional_info_modal').modal('hide');
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: showAdditionalInfo(),
				});
				// $('#additional_info').val('');
			}
		},
	});
}

// additional info end

// Ess connect start

function pickEmailOption(name, id) {
	$('#emp_email').val(name);
	$('#emp_email').attr('data', id);
	$('#emp_email_list').removeClass('show');
	$('#emp_connect').removeAttr('disabled');
}

let rootEmail = document.querySelector('#emp_email_list');
document.addEventListener('click', (event) => {
	if (!rootEmail.contains(event.target)) {
		$('#emp_email_list').removeClass('show');
	}
});

function getEmployeeEmail() {
	// let param = $('#emp_email').val();
	$('#view_ess_conect_btn').attr('disabled', true);
	$('#view_ess_modal').modal('show');
	let company_id = localStorage.getItem('company_id');
	let param = $('#emp_email').val();

	axios
		.get(`${api_path}hrm/search_nahere_user`, {
			params: {
				// company_id: company_id,
				email: param,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			// console.log('res', response);

			if (response.data.data) {
				let { firstname, lastname, othernames, email, user_id } = response.data.data;
				$('#view_ess_name').html(`${firstname} ${othernames} ${lastname}`);
				$('#view_ess_email').html(email);
				$('#view_ess_connect_btn').attr('data', user_id);
			} else {
				$('#view_ess_error').html('No record found');
			}

			$('#view_ess_loader').hide();
			$('#view_ess_modal_body').show();
			$('#view_ess_conect_btn').attr('disabled', false);
			// let emList = '';
			// if (response.data.data.length > 0) {
			// 	$(response.data.data).map((i, v) => {
			// 		emList += `<li><a class="dropdown-item" onClick="pickEmailOption('${v.email}','${v.user_id}')">${v.email}</a></li>`;
			// 	});
			// } else {
			// 	emList += `<li><a class="dropdown-item">No result</a></li>`;
			// }
			// $('#emp_email_list').html(emList);
			// $('#emp_email_list').addClass('show');
		})
		.catch(function(error) {
			$('#view_ess_error').html('Error');

			$('#view_ess_loader').hide();
			$('#view_ess_modal_body').show();
			console.log(error);
			// $('#emp_email_list').html(`<em>Error loading data</em>`);
		})
		.then(function() {
			// always executed
		});
}

function connectEmployee() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	// let user_id = localStorage.getItem('user_id')
	let user_id = $('#view_ess_connect_btn').attr('data');

	$('#view_ess_connect_btn').hide();
	$('#view_ess_connect_loader').show();

	let email = $('#view_ess_email').html();

	let data = {
		employee_id: employee_id,
		email: email,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/assign_ess_users`,
		data: data,
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(error) {
			console.log(error);
			$('#view_ess_connect_loader').hide();
			$('#view_ess_connect_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${error.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#view_ess_connect_loader').hide();
				$('#view_ess_connect_btn').show();
				$('#view_ess_modal').modal('hide');

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: showConnectedInfo(),
				});

				// $('#jobTitle_name').val('');
				// $('#jobTitle_from').val('');
				// $('#jobTitle_to').val('');
				// $('#jobTitle_display').toggle();
				// listJobTitle();
			} else {
				$('#view_ess_connect_loader').hide();
				$('#view_ess_connect_btn').show();
				Swal.fire({
					title: 'Error!',
					text: `${response.msg}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			}
		},
	});
}

function showConnectedInfo() {
	$('#emp_list_body').hide();
	$('#emp_list_loader').show();
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	// var user_id = localStorage.getItem('user_id');
	let user_id = localStorage.getItem('user_id');

	// $('#list_workShift_table').hide();
	// $('#list_workShift_loader').show();
	axios
		.get(`${api_path}hrm/ess_company_staff_image`, {
			params: {
				employee_id: employee_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			if (response.data.data == '') {
				$('#ess_list_body').html('<p>No Connected Data Available</p>');
				$('#emp_list_loader').hide();
				$('#emp_list_body').show();
			} else {
				let ess_list = '';
				const { email, firstname, lastname, image_path, pics } = response.data.data;
				ess_list += `<div class="profile_img">
                                            <div id="crop-avatar">

                                                <img class="img-responsive avatar-view" id="ess_list_img" src="${image_path}${pics}"  alt="Avatar" title="Change the avatar">
                                            </div>
                                        </div>`;
				ess_list += `<h3 id="ess_list_name">${firstname} ${lastname}</h3>`;
				ess_list += `<ul class="list-unstyled user_data">
                                            <li id="ess_list_email"><i class="fa fa-envelope user-profile-icon"></i>   ${email}
                                            </li>
                                           
                                        </ul>`;
				$('#ess_list_body').html(ess_list);
				$('#emp_list_loader').hide();
				$('#emp_list_body').show();
			}
		})
		.catch(function(error) {
			console.log(error);
			$('#ess_list_body').html('<em style="color:red">Error</em>');
			$('#emp_list_loader').hide();
			$('#emp_list_body').show();
			// $('#list_workShift_loader').hide();
			// $('#list_workShift_table').show();
			// $('#list_workShift_body').html(
			// 	`<tr><td colspan="4" style="color:red;">Error</td></tr>`,
			// );

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

// Ess connect end
