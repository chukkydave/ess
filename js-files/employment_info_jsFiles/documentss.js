$(document).ready(() => {
	$('#add_docx').on('click', () => {
		$('#docx_display').toggle();
	});
});

//department starts
function addDepartment() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = localStorage.getItem('user_id');

	$('#add_dept_btn').hide();
	$('#add_dept_loader').show();

	let name = $('#dept_name').val();
	let from = $('#dept_from').val();
	let to = $('#dept_to').val();

	let data = {
		started: from,
		department_id: name,
		company_id: company_id,
		employee_id: employee_id,
		ended: to,
		type: 'new',
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/update_employee_department`,
		data: data,
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(error) {
			console.log(error);
			$('#add_dept_loader').hide();
			$('#add_dept_btn').show();
			alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_dept_loader').hide();
				$('#add_dept_btn').show();

				$('#mod_body').html('Department creation successful');
				$('#successModal').modal('show');
				$('#dept_name').val('');
				$('#dept_from').val('');
				$('#dept_to').val('');
				$('#dept_display').toggle();
				listDepartment();
			}
		},
	});
}

function listDepartment() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = localStorage.getItem('user_id');
	$('#list_dept_table').hide();
	$('#list_dept_loader').show();
	axios
		.get(`${api_path}hrm/new_employee_info`, {
			params: {
				company_id: company_id,
				employee_id: employee_id,
			},
		})
		.then(function(response) {
			let dept_list;
			const { department_history } = response.data.data;

			if (department_history.length > 0) {
				$(department_history).map((i, v) => {
					let start = moment(v.started, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD');
					let end = moment(v.ended, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD');
					dept_list += `<tr class="even pointer" id="dept_row${v.id}">`;
					dept_list += `<td>${v.department_name}  <span class="greent_${i}_trial"></span></td>`;
					// dept_list += `<td>${v.nxt_kin_relationship}</td>`;
					dept_list += `<td>${start}</td>`;
					dept_list += `<td>${end}</td>`;

					dept_list += `<td>
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
								<li onClick="viewDepartment(${v.id})">
									<a class="dropdown-item">
										<i class="fa fa-pencil" /> Edit
									</a>
								</li>
								<li onClick="deleteDepartment(${v.id})">
									<a class="dropdown-item">
										<i class="fa fa-trash" /> Delete
									</a>
								</li>
							</ul>
						</div></td>`;
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

function list_employee_documents() {
	var company_id = localStorage.getItem('company_id');
	var user_id = localStorage.getItem('user_id');

	var page = 1;
	var limit = 10;

	$('#loading_docv').show();
	$('#documentData').html('');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_user_docs',
		data: { company_id: company_id, user_id: user_id, page: page, limit: limit },
		timeout: 60000,

		success: function(response) {
			console.log(response);
			$('#loading_docv').hide();
			var strTable = '';

			if (response.status == '200') {
				if (response.data.length > 0) {
					var k = 1;
					$.each(response['data'], function(i, v) {
						strTable += '<tr id="row_' + response['data'][i]['document_id'] + '">';

						strTable += '<td>D' + response['data'][i]['document_id'] + '</td>';

						strTable += '<td>' + response['data'][i]['original_filename'] + '</td>';

						strTable += '<td>' + response['data'][i]['file_size'] + '</td>';
						strTable += '<td>' + response['data'][i]['date_uploaded'] + '</td>';
						// strTable += '<td valign="top"> <a class="delete_document" style="cursor: pointer;" id="doc_'+response['data'][i]['document_id']+'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Document"></i></a></td>';
						strTable += `<td> <div class="dropdown">
										<button class="btn btn-secondary dropdown-toggle"
											type="button" id="dropdownMenuButton1"
											data-toggle="dropdown" aria-expanded="false">
											Actions
										</button>
										<ul class="dropdown-menu"
											aria-labelledby="dropdownMenuButton1">
											<li><a class="dropdown-item"><i
														class="fa fa-pencil"></i> Edit</a></li>
											<li><a class="dropdown-item"><i
														class="fa fa-trash"></i> Delete</a></li>
										</ul>
									</div></td>`;

						strTable += '</tr>';

						// strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['document_id']+'">';
						// strTable += '<td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
						// strTable +=  '</td>';
						// strTable += '</tr>';

						k++;
					});
				} else {
					strTable = '<tr><td colspan="4">No record.</td></tr>';
				}

				$('#documentData').html(strTable);
				$('#documentData').show();
			} else if (response.status == '400') {
				$('#loading_docv').hide();
				strTable += '<tr>';
				strTable += '<td colspan="4">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#documentData').html(strTable);
				$('#documentData').show();
			} else if (response.status == '401') {
				//missing parameters
				var strTable = '';
				$('#loading_docv').hide();
				strTable += '<tr>';
				strTable += '<td colspan="4">Technical Error</td>';
				strTable += '</tr>';

				$('#documentData').html(strTable);
				$('#documentData').show();
			}

			$('#loading_docv').hide();
		},

		error: function(response) {
			var strTable = '';
			$('#loading_docv').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable +=
				'<td colspan="5"><strong class="text-danger">Connection error!</strong></td>';
			strTable += '</tr>';

			$('#documentData').html(strTable);
			$('#documentData').show();
			$('#loading_docv').hide();
		},
	});
}

function viewDepartment(id) {
	$('#edit_dept_error').html('');
	$('#edit_dept_modal').modal('show');
	$('#edit_dept_btn').hide();
	$('#edit_dept_loader').show();

	let company_id = localStorage.getItem('company_id');
	let employee_id = localStorage.getItem('user_id');
	axios
		.get(`${api_path}hrm/single_employee_department`, {
			params: {
				dep_his_id: id,
				employee_id: employee_id,
				company_id: company_id,
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
	let employee_id = localStorage.getItem('user_id');
	$('#edit_dept_btn').hide();
	$('#edit_dept_loader').show();

	let name = $('#edit_dept_name').val();
	let from = $('#edit_dept_from').val();
	let to = $('#edit_dept_to').val();

	let data = {
		started: from,
		department_id: name,
		company_id: company_id,
		employee_id: employee_id,
		ended: to,
		dep_his_id: id,
		type: 'edit',
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/update_employee_department`,
		data: data,
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(res) {
			console.log(res);
			$('#edit_dept_loader').hide();
			$('#edit_dept_btn').show();
			alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#edit_dept_loader').hide();
				$('#edit_dept_btn').show();

				$('#edit_dept_modal').modal('hide');

				$('#mod_body').html('Department Edit Successful');
				$('#successModal').modal('show');
				listDepartment();
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
		let employee_id = localStorage.getItem('user_id');

		let data = {
			dep_his_id: id,
			employee_id: employee_id,
			company_id: company_id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/delete_employee_department`,
			data: data,

			error: function(res) {
				console.log(res);
				$(`#dept_loader${id}`).hide();
				$(`#dept_row${id}`).show();

				alert('error');
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#dept_row${id}`).remove();
					$(`#dept_loader${id}`).remove();
				}
			},
		});
	}
}
//department ends

function list_doctype() {
	let page = 1;
	var company_id = localStorage.getItem('company_id');
	if (page == '') {
		page = 1;
	}
	var limit = 100;

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_company_doctypes',
		data: { company_id: company_id, page: page, limit: limit },
		timeout: 60000,

		success: function(response) {
			// console.log(response);

			let options = '';

			if (response.status == '200') {
				// $('#loading').hide();
				if (response.data.length > 0) {
					var k = 1;

					$(response.data).map((i, v) => {
						options += `<option value="${v.doctype_id}">${v.doctype_name}</option>`;
					});
				} else {
					options += `<option>No record</option>`;
				}

				$('#docx_type').append(options);
				$('#docx_type').show();
			} else if (response.status == '400') {
				options += `<option>Error</option>`;

				$('#docx_type').append(options);
				$('#docx_type').show();
			}
		},

		error: function(response) {
			alert('Connection error');
		},
	});
}
