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
	let employee_id = localStorage.getItem('user_id');
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
	data.append('company_id', company_id);
	data.append('employee_id', employee_id);
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
		},
		data: data,

		error: function(error) {
			console.log(error);
			$('#add_docx_loader').hide();
			$('#add_docx_btn').show();
			alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_docx_loader').hide();
				$('#add_docx_btn').show();

				$('#mod_body').html('Document Upload successful');
				$('#successModal').modal('show');
				$('#docx_name').val('');
				$('#docx_type').val('');
				$('#docx_file').val('');
				$('#docx_display').toggle();
				list_employee_documents();
			}
		},
	});
}

function list_employee_documents() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = localStorage.getItem('user_id');
	$('#list_docx_table').hide();
	$('#list_docx_loader').show();
	axios
		.get(`${api_path}hrm/new_employee_info`, {
			params: {
				company_id: company_id,
				employee_id: employee_id,
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

// function list_employee_documents() {
// 	var company_id = localStorage.getItem('company_id');
// 	var user_id = localStorage.getItem('user_id');

// 	var page = 1;
// 	var limit = 10;

// 	$('#loading_docv').show();
// 	$('#documentData').html('');

// 	$.ajax({
// 		type: 'POST',
// 		dataType: 'json',
// 		url: api_path + 'hrm/list_of_user_docs',
// 		data: { company_id: company_id, user_id: user_id, page: page, limit: limit },
// 		timeout: 60000,

// 		success: function(response) {
// 			console.log(response);
// 			$('#loading_docv').hide();
// 			var strTable = '';

// 			if (response.status == '200') {
// 				if (response.data.length > 0) {
// 					var k = 1;
// 					$.each(response['data'], function(i, v) {
// 						strTable += '<tr id="row_' + response['data'][i]['document_id'] + '">';

// 						// strTable += '<td>D' + response['data'][i]['document_id'] + '</td>';

// 						strTable += '<td>' + response['data'][i]['original_filename'] + '</td>';

// 						strTable += '<td>' + response['data'][i]['file_size'] + '</td>';
// 						strTable += '<td>' + response['data'][i]['date_uploaded'] + '</td>';
// 						// strTable += '<td valign="top"> <a class="delete_document" style="cursor: pointer;" id="doc_'+response['data'][i]['document_id']+'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" style="font-style: italic; color: #f97c7c; font-size: 20px;" title="Delete Document"></i></a></td>';
// 						strTable += `<td> <div class="dropdown">
// 										<button class="btn btn-secondary dropdown-toggle"
// 											type="button" id="dropdownMenuButton1"
// 											data-toggle="dropdown" aria-expanded="false">
// 											Actions
// 										</button>
// 										<ul class="dropdown-menu"
// 											aria-labelledby="dropdownMenuButton1">
// 											<li><a class="dropdown-item"><i
// 														class="fa fa-pencil"></i> View</a></li>
// 											<li><a class="dropdown-item"><i
// 														class="fa fa-trash"></i> Delete</a></li>
// 										</ul>
// 									</div></td>`;

// 						strTable += '</tr>';

// 						// strTable += '<tr style="display: none;" id="loader_row_'+response['data'][i]['document_id']+'">';
// 						// strTable += '<td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
// 						// strTable +=  '</td>';
// 						// strTable += '</tr>';

// 						k++;
// 					});
// 				} else {
// 					strTable = '<tr><td colspan="4">No record.</td></tr>';
// 				}

// 				$('#documentData').html(strTable);
// 				$('#documentData').show();
// 			} else if (response.status == '400') {
// 				$('#loading_docv').hide();
// 				strTable += '<tr>';
// 				strTable += '<td colspan="4">' + response.msg + '</td>';
// 				strTable += '</tr>';

// 				$('#documentData').html(strTable);
// 				$('#documentData').show();
// 			} else if (response.status == '401') {
// 				//missing parameters
// 				var strTable = '';
// 				$('#loading_docv').hide();
// 				strTable += '<tr>';
// 				strTable += '<td colspan="4">Technical Error</td>';
// 				strTable += '</tr>';

// 				$('#documentData').html(strTable);
// 				$('#documentData').show();
// 			}

// 			$('#loading_docv').hide();
// 		},

// 		error: function(response) {
// 			var strTable = '';
// 			$('#loading_docv').hide();
// 			// alert(response.msg);
// 			strTable += '<tr>';
// 			strTable +=
// 				'<td colspan="5"><strong class="text-danger">Connection error!</strong></td>';
// 			strTable += '</tr>';

// 			$('#documentData').html(strTable);
// 			$('#documentData').show();
// 			$('#loading_docv').hide();
// 		},
// 	});
// }

function viewDocument(id) {
	$('#edit_docx_error').html('');
	$('#edit_docx_modal').modal('show');
	// $('#edit_docx_btn').hide();
	$('#edit_docx_loader').show();

	let company_id = localStorage.getItem('company_id');
	let employee_id = localStorage.getItem('user_id');
	axios
		.get(`${api_path}hrm/single_employee_doc`, {
			params: {
				document_id: id,
				employee_id: employee_id,
				company_id: company_id,
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
		let employee_id = localStorage.getItem('user_id');

		let data = {
			document_id: id,
			employee_id: employee_id,
			company_id: company_id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/delete_employee_doc`,
			data: data,

			error: function(res) {
				console.log(res);
				$(`#docx_loader${id}`).hide();
				$(`#docx_row${id}`).show();

				alert('error');
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#docx_row${id}`).remove();
					$(`#docx_loader${id}`).remove();
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
