$(document).ready(() => {
	$('#add_docx').on('click', () => {
		$('#docx_display').toggle();
	});
	$('#add_docx_btn').on('click', () => {
		if (isEmptyInput('.add_docx_fields')) {
			addDocument();
		}
	});
});

//department starts
function addDocument() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');

	$('#add_docx_btn').hide();
	$('#add_docx_loader').show();

	let name = $('#docx_name').val();
	let type = $('#docx_type').val();
	let doc_file = document.querySelector('#docx_file').files[0];

	let data = new FormData();
	data.append('company_doc_type_id', type);
	data.append('file_tag', '');
	data.append('document_name', name);
	// data.append('company_id', company_id);
	data.append('employee_id', '');
	// data.append('user_id', user_id);
	data.append('uploaded_by', user_id);
	data.append('file', doc_file);

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: `${api_path}hrm/update_employee_document`,
		processData: false,
		contentType: false,
		headers: {
			enctype: 'multipart/form-data',
			Authorization: localStorage.getItem('token'),
		},
		data: data,

		error: function(error) {
			console.log(error);
			$('#add_docx_loader').hide();
			$('#add_docx_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${error.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_docx_loader').hide();
				$('#add_docx_btn').show();

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: list_employee_documents(),
				});
				$('#docx_name').val('');
				$('#docx_type').val('');
				$('#docx_file').val('');
				$('#docx_display').toggle();
			}
		},
	});
}

function list_employee_documents() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	$('#list_docx_table').hide();
	$('#list_docx_loader').show();
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
			let docx_list;
			const { employee_document } = response.data.data;

			if (employee_document.length > 0) {
				$(employee_document).map((i, v) => {
					// let start = moment(v.started, 'YYYY-MM-DD HH:mm:ss').format('YYYY-MM-DD');
					let uploaded = moment(v.date_uploaded, 'YYYY-MM-DD HH:mm:ss').format('LL');
					docx_list += `<tr class="even pointer" id="docx_row${v.document_id}">`;
					docx_list += `<td>${v.document_name} </td>`;
					// docx_list += `<td>${v.nxt_kin_relationship}</td>`;
					docx_list += `<td>${v.type}</td>`;
					docx_list += `<td>${uploaded}</td>`;

					docx_list += `<td>
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
								<li onClick="viewDocument(${v.document_id})">
									<a class="dropdown-item">
										<i class="fa fa-eye" /> View
									</a>
								</li>
								<li onClick="deleteDocument(${v.document_id})">
									<a class="dropdown-item">
										<i class="fa fa-trash" /> Delete
									</a>
								</li>
							</ul>
						</div></td>`;
					docx_list += `</tr>`;
					docx_list += `<tr id="docx_loader${v.document_id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});

				$('#documentData').html(docx_list);
				$('#list_docx_loader').hide();
				$('#list_docx_table').show();
			} else {
				$('#documentData').html(`<tr><td colspan="4">No record</td></tr>`);
				$('#list_docx_loader').hide();
				$('#list_docx_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			// $('#list_docx_loader').hide();
			// $('#list_docx_table').show();
			// $('#list_docx_body').html(`<tr><td colspan="4" style="color:red;">Error</td></tr>`);

			// $('#edit_QC_error').html(error);

			var strTable = '';
			// $('#loading_docv').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable +=
				'<td colspan="5"><strong class="text-danger">Connection error!</strong></td>';
			strTable += '</tr>';

			$('#documentData').html(strTable);
			$('#list_docx_loader').hide();
			$('#list_docx_table').show();
		})
		.then(function() {
			// always executed
		});
}

function viewDocument(id) {
	$('#edit_docx_error').html('');
	$('#edit_docx_modal').modal('show');
	// $('#edit_docx_btn').hide();
	$('#edit_docx_loader').show();

	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');

	axios
		.get(`${api_path}hrm/single_employee_doc`, {
			params: {
				document_id: id,
				employee_id: employee_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			console.log(response.data);

			$('#edit_docx_loader').hide();
			// $('#edit_docx_btn').show();

			let {
				document_name,
				file_path,
				type,
				date_uploaded,
				new_filename,
			} = response.data.data;
			let path = `${file_path}${new_filename}`;
			$('#edit_docx_name').html(document_name);
			$('#edit_docx_type').html(type);
			$('#edit_docx_date').html(date_uploaded);
			$('#edit_docx_file').attr('href', path);
			$('#edit_docx_file').css('color', 'green');
		})
		.catch(function(error) {
			console.log(error);

			$('#edit_docx_loader').hide();
			// $('#edit_docx_btn').show();

			$('#edit_docx_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function deleteDocument(id) {
	let ans = confirm('Are you sure you want to delete this record?');
	if (ans) {
		$(`#docx_row${id}`).hide();
		$(`#docx_loader${id}`).show();
		let company_id = localStorage.getItem('company_id');
		let employee_id = '';
		let user_id = localStorage.getItem('user_id');

		let data = {
			document_id: id,
			employee_id: employee_id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/delete_employee_doc`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				$(`#docx_loader${id}`).hide();
				$(`#docx_row${id}`).show();

				Swal.fire({
					title: 'Error!',
					text: `${res.msg}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#docx_row${id}`).remove();
					$(`#docx_loader${id}`).remove();
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
		data: { page: page, limit: limit },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
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
