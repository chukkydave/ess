$(document).ready(() => {
	$('#add_QC').on('click', () => {
		$('#QC_display').toggle();
	});

	$('#add_work-exp').on('click', () => {
		$('#work-exp_display').toggle();
	});

	$('#add_NOK').on('click', () => {
		$('#NOK_display').toggle();
	});

	listQC();
	listWorkExp();
	listNOK();

	$('#add_QC_btn').on('click', () => {
		if (isEmptyInput('.add_qc_fields')) {
			addQC();
		}
	});

	$('#edit_QC_btn').on('click', () => {
		editQC();
	});

	$('#add_workExp_btn').on('click', () => {
		if (isEmptyInput('.add_workExp_fields')) {
			addWorkExp();
		}
	});

	$('#edit_workExp_btn').on('click', () => {
		editWorkExp();
	});
	$('#add_nok_btn').on('click', () => {
		if (isEmptyInput('.add_nok_fields')) {
			addNOK();
		}
	});

	$('#edit_nok_btn').on('click', () => {
		editNOK();
	});
});

$('#workExp_start').datepicker({
	dateFormat: 'yy-mm-dd',
});

$('#workExp_end').datepicker({
	dateFormat: 'yy-mm-dd',
});
$('#edit_workExp_start').datepicker({
	dateFormat: 'yy-mm-dd',
});

$('#edit_workExp_end').datepicker({
	dateFormat: 'yy-mm-dd',
});

//QC starts
function addQC() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');

	$('#add_QC_btn').hide();
	$('#add_QC_loader').show();

	let institution = $('#QC_institute_name').val();
	let degree = $('#QC_degree').val();
	let year_concluded = $('#QC_year_concluded').val();

	let data = {
		school_name: institution,
		qualification: degree,
		year_concluded: year_concluded,
		type: 'new',
		// company_id: company_id,
		employee_id: employee_id,
		from_year: '0000-00-00',
		to_year: '0000-00-00',
		grade: '',
		// user_id: user_id,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/update_cv_eduhistory`,
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
			$('#add_QC_loader').hide();
			$('#add_QC_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${res.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_QC_loader').hide();
				$('#add_QC_btn').show();

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listQC(),
				});
				$('#QC_institute_name').val('');
				$('#QC_degree').val('');
				$('#QC_year_concluded').val('');
				$('#QC_display').toggle();
			}
		},
	});
}

function listQC() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	$('#list_QC_table').hide();
	$('#list_QC_loader').show();
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
			let qc_list;
			const { employee_cv_edu_history } = response.data.data;

			if (employee_cv_edu_history.length > 0) {
				$(employee_cv_edu_history).map((i, v) => {
					qc_list += `<tr class="even pointer" id="qc_row${v.id}">`;
					qc_list += `<td>${v.school_name}</td>`;
					qc_list += `<td>${v.qualification}</td>`;
					qc_list += `<td>${v.year_concluded}</td>`;
					qc_list += `<td>
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
								<li onClick="viewQC(${v.id})">
									<a class="dropdown-item">
										<i class="fa fa-pencil" /> Edit
									</a>
								</li>
								<!--<li onClick="deleteQC(${v.id})">
									<a class="dropdown-item">
										<i class="fa fa-trash" /> Delete
									</a>
								</li>-->
							</ul>
						</div></td>`;
					qc_list += `</tr>`;
					qc_list += `<tr id="qc_loader${v.id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});

				$('#list_QC_body').html(qc_list);
				$('#list_QC_loader').hide();
				$('#list_QC_table').show();
			} else {
				$('#list_QC_body').html(`<tr><td colspan="4">No record</td></tr>`);
				$('#list_QC_loader').hide();
				$('#list_QC_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_QC_loader').hide();
			$('#list_QC_table').show();
			$('#list_QC_body').html(`<tr><td colspan="4" style="color:red;">Error</td></tr>`);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function viewQC(id) {
	$('#edit_QC_error').html('');
	$('#edit_QC_modal').modal('show');
	$('#edit_QC_btn').hide();
	$('#edit_QC_loader').show();

	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	axios
		.get(`${api_path}hrm/single_cv_eduhistory`, {
			params: {
				empl_edu_id: id,
				employee_id: employee_id,
				// user_id: user_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			console.log(response.data);

			$('#edit_QC_loader').hide();
			$('#edit_QC_btn').show();

			let { school_name, year_concluded, qualification } = response.data.data;
			$('#edit_QC_institute_name').val(school_name);
			$('#edit_QC_degree').val(qualification);
			$('#edit_QC_year_concluded').val(year_concluded);
			$('#edit_QC_btn').attr('data-id', id);
		})
		.catch(function(error) {
			console.log(error);

			$('#edit_QC_loader').hide();
			$('#edit_QC_btn').show();

			$('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function editQC() {
	let id = $('#edit_QC_btn').attr('data-id');
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	$('#edit_QC_btn').hide();
	$('#edit_QC_loader').show();

	let institution = $('#edit_QC_institute_name').val();
	let degree = $('#edit_QC_degree').val();
	let year_concluded = $('#edit_QC_year_concluded').val();

	let data = {
		empl_edu_id: id,
		school_name: institution,
		qualification: degree,
		year_concluded: year_concluded,
		type: 'edit',
		// company_id: company_id,
		employee_id: employee_id,
		// user_id: user_id,
	};

	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/update_cv_eduhistory`,
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
			$('#edit_QC_loader').hide();
			$('#edit_QC_btn').show();
			$('#edit_QC_error').html(res.msg);
			// alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#edit_QC_loader').hide();
				$('#edit_QC_btn').show();

				$('#edit_QC_modal').modal('hide');

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listQC(),
				});
			} else {
				$('#edit_QC_loader').hide();
				$('#edit_QC_btn').show();
				$('#edit_QC_error').html(response.msg);
			}
		},
	});
}

function deleteQC(id) {
	let ans = confirm('Are you sure you want to delete this record?');
	if (ans) {
		$(`#qc_row${id}`).hide();
		$(`#qc_loader${id}`).show();
		let company_id = localStorage.getItem('company_id');
		let employee_id = '';
		let user_id = localStorage.getItem('user_id');

		let data = {
			empl_edu_id: id,
			employee_id: employee_id,
			// user_id: user_id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/delete_cv_eduhistory`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				$(`#qc_loader${id}`).hide();
				$(`#qc_row${id}`).show();

				Swal.fire({
					title: 'Error!',
					text: `${res.msg}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#qc_row${id}`).remove();
					$(`#qc_loader${id}`).remove();
					Swal.fire({
						title: 'Success',
						text: `Success`,
						icon: 'success',
						confirmButtonText: 'Okay',
						// onClose: window.location.reload(),
					});
				}
			},
		});
	}
}
//QC ends

//work experience start
function addWorkExp() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');

	$('#add_workExp_btn').hide();
	$('#add_workExp_loader').show();

	let prevCom = $('#workExp_prevCom').val();
	let jobTitle = $('#workExp_jobTitle').val();
	let start = $('#workExp_start').val();
	let end = $('#workExp_end').val();

	let data = {
		company_name: prevCom,
		position: jobTitle,
		// company_id: company_id,
		employee_id: employee_id,
		from_year: start,
		to_year: end,
		description: '..',
		type: 'new',
		// user_id: user_id,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/update_cv_workhistory`,
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
			$('#add_workExp_loader').hide();
			$('#add_workExp_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${error.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_workExp_loader').hide();
				$('#add_workExp_btn').show();

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listWorkExp(),
				});
				$('#workExp_prevCom').val('');
				$('#workExp_jobTitle').val('');
				$('#workExp_start').val('');
				$('#workExp_end').val('');
				$('#work-exp_display').toggle();
			}
		},
	});
}

function listWorkExp() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	$('#list_workExp_table').hide();
	$('#list_workExp_loader').show();
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
			let workExp_list;
			const { employee_cv_work_history } = response.data.data;

			if (employee_cv_work_history.length > 0) {
				$(employee_cv_work_history).map((i, v) => {
					let start = moment(v.from_year, 'YYYY-MM-DD HH:mm:ss').format('LL');
					let end = moment(v.to_year, 'YYYY-MM-DD HH:mm:ss').format('LL');
					workExp_list += `<tr class="even pointer" id="workExp_row${v.id}">`;
					workExp_list += `<td>${v.company_name}</td>`;
					workExp_list += `<td>${v.position}</td>`;
					workExp_list += `<td>${start}</td>`;
					workExp_list += `<td>${end}</td>`;
					workExp_list += `<td>
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
								<li onClick="viewWorkExp(${v.id})">
									<a class="dropdown-item">
										<i class="fa fa-pencil" /> Edit
									</a>
								</li>
								<!--<li onClick="deleteWorkExp(${v.id})">
									<a class="dropdown-item">
										<i class="fa fa-trash" /> Delete
									</a>
								</li>-->
							</ul>
						</div></td>`;
					workExp_list += `</tr>`;
					workExp_list += `<tr id="workExp_loader${v.id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});

				$('#list_workExp_body').html(workExp_list);
				$('#list_workExp_loader').hide();
				$('#list_workExp_table').show();
			} else {
				$('#list_workExp_body').html(`<tr><td colspan="5">No record</td></tr>`);
				$('#list_workExp_loader').hide();
				$('#list_workExp_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_workExp_loader').hide();
			$('#list_workExp_table').show();
			$('#list_workExp_body').html(`<tr><td colspan="5" style="color:red;">Error</td></tr>`);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function viewWorkExp(id) {
	$('#edit_workExp_error').html('');
	$('#edit_workExp_modal').modal('show');
	$('#edit_workExp_btn').hide();
	$('#edit_workExp_loader').show();

	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	axios
		.get(`${api_path}hrm/single_cv_workhistory`, {
			params: {
				wrkhisid: id,
				employee_id: employee_id,
				// user_id: user_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			console.log(response.data);

			$('#edit_workExp_loader').hide();
			$('#edit_workExp_btn').show();

			let { company_name, position, from_year, to_year } = response.data.data;
			$('#edit_workExp_prevCom').val(company_name);
			$('#edit_workExp_jobTitle').val(position);
			$('#edit_workExp_start').val(from_year);
			$('#edit_workExp_end').val(to_year);
			$('#edit_workExp_btn').attr('data-id', id);
		})
		.catch(function(error) {
			console.log(error);

			$('#edit_workExp_loader').hide();
			$('#edit_workExp_btn').show();

			$('#edit_workExp_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function editWorkExp() {
	let id = $('#edit_workExp_btn').attr('data-id');
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	$('#edit_workExp_btn').hide();
	$('#edit_workExp_loader').show();

	let prevCom = $('#edit_workExp_prevCom').val();
	let jobTitle = $('#edit_workExp_jobTitle').val();
	let start = $('#edit_workExp_start').val();
	let end = $('#edit_workExp_end').val();

	let data = {
		company_name: prevCom,
		position: jobTitle,
		// company_id: company_id,
		employee_id: employee_id,
		from_year: start,
		to_year: end,
		description: '..',
		type: 'edit',
		wrkhisid: id,
		// user_id: user_id,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/update_cv_workhistory`,
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
			$('#edit_workExp_loader').hide();
			$('#edit_workExp_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${res.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#edit_workExp_loader').hide();
				$('#edit_workExp_btn').show();

				$('#edit_workExp_modal').modal('hide');

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listWorkExp(),
				});
			}
		},
	});
}

function deleteWorkExp(id) {
	let ans = confirm('Are you sure you want to delete this record?');
	if (ans) {
		$(`#workExp_row${id}`).hide();
		$(`#workExp_loader${id}`).show();
		let company_id = localStorage.getItem('company_id');
		let employee_id = '';
		let user_id = localStorage.getItem('user_id');

		let data = {
			wrkhisid: id,
			employee_id: employee_id,
			// user_id: user_id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/delete_cv_workhistory`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				$(`#workExp_loader${id}`).hide();
				$(`#workExp_row${id}`).show();

				Swal.fire({
					title: 'Error!',
					text: `${res.msg}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#workExp_row${id}`).remove();
					$(`#workExp_loader${id}`).remove();
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
//work experience end

//NOK starts
function addNOK() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');

	$('#add_nok_btn').hide();
	$('#add_nok_loader').show();

	let name = $('#nok_name').val();
	let relationship = $('#nok_relationship').val();
	let address = $('#nok_address').val();
	let phone = $('#nok_phone').val();
	let email = $('#nok_email').val();

	let data = {
		nxt_kin_relationship: relationship,
		nxt_kin_fullname: name,
		// company_id: company_id,
		employee_id: employee_id,
		nxt_kin_address: address,
		nxt_kin_phone: phone,
		nxt_kin_email: email,
		type: 'new',
		// user_id: user_id,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/update_employee_kin`,
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
			$('#add_nok_loader').hide();
			$('#add_nok_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${error.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_nok_loader').hide();
				$('#add_nok_btn').show();

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listNOK(),
				});
				$('#nok_name').val('');
				$('#nok_address').val('');
				$('#nok_email').val('');
				$('#nok_phone').val('');
				$('#nok_relationship').val('');
				$('#NOK_display').toggle();
			}
		},
	});
}

function listNOK() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	$('#list_nok_table').hide();
	$('#list_nok_loader').show();
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
			let nok_list;
			const { employee_next_kin } = response.data.data;

			if (employee_next_kin.length > 0) {
				$(employee_next_kin).map((i, v) => {
					nok_list += `<tr class="even pointer" id="nok_row${v.id}">`;
					nok_list += `<td>${v.nxt_kin_fullname}<p style="font-size:0.75em;color:green;">${v.nxt_kin_relationship}</p></td>`;
					// nok_list += `<td>${v.nxt_kin_relationship}</td>`;
					nok_list += `<td>${v.nxt_kin_phone}</td>`;
					nok_list += `<td>${v.nxt_kin_address}</td>`;
					nok_list += `<td>${v.nxt_kin_email}</td>`;
					nok_list += `<td>
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
								<li onClick="viewNOK(${v.id})">
									<a class="dropdown-item">
										<i class="fa fa-pencil" /> Edit
									</a>
								</li>
								<li onClick="deleteNOK(${v.id})">
									<a class="dropdown-item">
										<i class="fa fa-trash" /> Delete
									</a>
								</li>
							</ul>
						</div></td>`;
					nok_list += `</tr>`;
					nok_list += `<tr id="nok_loader${v.id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});

				$('#list_nok_body').html(nok_list);
				$('#list_nok_loader').hide();
				$('#list_nok_table').show();
			} else {
				$('#list_nok_body').html(`<tr><td colspan="5">No record</td></tr>`);
				$('#list_nok_loader').hide();
				$('#list_nok_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_nok_loader').hide();
			$('#list_nok_table').show();
			$('#list_nok_body').html(`<tr><td colspan="5" style="color:red;">Error</td></tr>`);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function viewNOK(id) {
	$('#edit_nok_error').html('');
	$('#edit_nok_modal').modal('show');
	$('#edit_nok_btn').hide();
	$('#edit_nok_loader').show();

	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	axios
		.get(`${api_path}hrm/single_employee_kin`, {
			params: {
				kin_id: id,
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

			$('#edit_nok_loader').hide();
			$('#edit_nok_btn').show();

			let {
				nxt_kin_fullname,
				nxt_kin_relationship,
				nxt_kin_email,
				nxt_kin_address,
				nxt_kin_phone,
			} = response.data.data;
			$('#edit_nok_name').val(nxt_kin_fullname);
			$('#edit_nok_email').val(nxt_kin_email);
			$('#edit_nok_phone').val(nxt_kin_phone);
			$('#edit_nok_address').val(nxt_kin_address);
			$('#edit_nok_relationship').val(nxt_kin_relationship);
			$('#edit_nok_btn').attr('data-id', id);
		})
		.catch(function(error) {
			console.log(error);

			$('#edit_nok_loader').hide();
			$('#edit_nok_btn').show();

			$('#edit_nok_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function editNOK() {
	let id = $('#edit_nok_btn').attr('data-id');
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	$('#edit_nok_btn').hide();
	$('#edit_nok_loader').show();

	let name = $('#edit_nok_name').val();
	let relationship = $('#edit_nok_relationship').val();
	let address = $('#edit_nok_address').val();
	let phone = $('#edit_nok_phone').val();
	let email = $('#edit_nok_email').val();

	let data = {
		nxt_kin_relationship: relationship,
		nxt_kin_fullname: name,
		// company_id: company_id,
		employee_id: employee_id,
		nxt_kin_address: address,
		nxt_kin_phone: phone,
		nxt_kin_email: email,
		type: 'edit',
		kin_id: id,
		// user_id: user_id,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/update_employee_kin`,
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
			$('#edit_nok_loader').hide();
			$('#edit_nok_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${res.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#edit_nok_loader').hide();
				$('#edit_nok_btn').show();

				$('#edit_nok_modal').modal('hide');

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listNOK(),
				});
			}
		},
	});
}

function deleteNOK(id) {
	let ans = confirm('Are you sure you want to delete this record?');
	if (ans) {
		$(`#nok_row${id}`).hide();
		$(`#nok_loader${id}`).show();
		let company_id = localStorage.getItem('company_id');
		let employee_id = '';
		let user_id = localStorage.getItem('user_id');

		let data = {
			kin_id: id,
			employee_id: employee_id,
			// company_id: company_id,
			// user_id: user_id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/delete_employee_kin`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				$(`#nok_loader${id}`).hide();
				$(`#nok_row${id}`).show();

				Swal.fire({
					title: 'Error!',
					text: `${res.msg}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#nok_row${id}`).remove();
					$(`#nok_loader${id}`).remove();
					Swal.fire({
						title: 'Success',
						text: `Success`,
						icon: 'success',
						confirmButtonText: 'Okay',
						// onClose: window.location.reload(),
					});
				}
			},
		});
	}
}
//NOK ends
