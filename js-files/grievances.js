$(document).ready(function() {
	var grievance_id;

	load_employee();
	load_branch();
	list_of_grievances('');
	// load_leave_type();

	$('input#incident_date').datepicker({
		dateFormat: 'yy-mm-dd',
	});
	// $('input#resumption_date').datepicker({
	//   dateFormat: "yy-mm-dd"
	// });

	$('#apply').on('click', display_apply);
	// $('#add_g').on('click', () => {
	// 	add_grievance_report();
	// });
	// $('#add_d').on('click', () => {
	// 	add_grievance_report2();
	// });
	$(document).on('click', '#add_d', function() {
		add_grievance_report2();
	});
	$(document).on('click', '#add_g', function() {
		add_grievance_report();
	});
	// $('#add_leave').on('click', add_employee_leave);

	// list_of_leaves('');

	// $(document).on('click', '#filter', function(){
	//     $('#pagination').twbsPagination('destroy');
	//      list_of_incoming_items('');
	// });

	// $('#incoming_filter').on('click', display_filter);

	// $('input#date_range').daterangepicker({
	//   autoUpdateInput: false
	// });

	// $('input#date_range').on('apply.daterangepicker', function(ev, picker) {
	//    $(this).val(picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'));

	// });

	$(document).on('click', '.g_info', function() {
		var grievance_id = $(this).attr('id').replace(/gr_/, '');
		fetch_grievance_info(grievance_id);
	});

	$(document).on('click', '.delete_g', function() {
		var grievance_id = $(this).attr('id').replace(/grie_/, '');
		delete_grievance(grievance_id);
	});

	$(document).on('click', '.edit_g_icon', function() {
		grievance_id = $(this).attr('id').replace(/gri_/, '');
		fetch_grievance_details(grievance_id);
	});

	$(document).on('click', '#edit_g', function() {
		// var warehouse_id = $(this).attr('id').replace(/edt_/,'');
		edit_employee_grievance(grievance_id);
		alert(grievance_id);
	});

	$('#g_against').on('change', () => {
		if ($('#g_against').val() === 'Employee') {
			$('#selct_empl').fadeIn();
		} else {
			$('#selct_empl').fadeOut();
		}
	});
});

function load_branch() {
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		url: api_path + 'hrm/list_of_company_branches',
		type: 'POST',
		data: {
			company_id: company_id,
		},
		dataType: 'json',

		success: function(response) {
			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['branch_id'] +
					'">' +
					response['data'][i]['branch_name'] +
					'</option>';
			});
			$('#branch').append(options);
			$('#modal_edit_g #branch').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			alert('Connection error');
		},
	});
}

function load_employee() {
	var company_id = localStorage.getItem('company_id');
	var page = -1;
	var limit = 0;

	$.ajax({
		url: api_path + 'hrm/list_of_company_employees',
		type: 'POST',
		data: {
			company_id: company_id,
			page: page,
			limit: limit,
		},
		dataType: 'json',

		success: function(response) {
			console.log(response);

			var options = '';

			$(response.data).each((i, v) => {
				options += `<option value="${v.employee_id}">${v.firstname} ${v.lastname}(${v.position})</option>`;
			});

			$('#g_against').append(options);
			$('#modal_edit_g #g_against').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			alert('Connection error');
		},
	});
}

function edit_employee_grievance(grievance_id) {
	var g_type = $('#modal_edit_g #g_type').val();

	var incident_date = $('#modal_edit_g #incident_date').val();
	var emp_response = $('#modal_edit_g #emp_response').val();
	var incident = $('#modal_edit_g #incident').val();
	var approval = $('#modal_edit_g #approval').val();
	var branch = $('#modal_edit_g #branch').val();
	var against = $('#modal_edit_g #against').val();
	var company_id = localStorage.getItem('company_id');
	var g_by = localStorage.getItem('email');

	var blank;

	// alert(warehouse_id);

	$('#modal_edit_g .required').each(function() {
		var the_val = $.trim($(this).val());

		if (the_val == '' || the_val == '0') {
			$(this).addClass('has-error');

			blank = 'yes';
		} else {
			$(this).removeClass('has-error');
		}
	});

	if (blank == 'yes') {
		$('#modal_edit_g #error').html('You have a blank field');

		return;
	}

	// $("#modal_edit_warehouse #error").html("");

	$('#modal_edit_g #edit_g').hide();
	$('#modal_edit_g #edit_g_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'ess/edit_grievance',
		data: {
			g_by: g_by,
			g_against: g_against,
			company_id: company_id,
			grievance_id: grievance_id,
			incident: incident,
			incident_date: incident_date,
			emp_response: emp_response,
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				$('#modal_edit_g #error').html('');
				$('#modal_edit_g #edit_g_loader').hide();
				$('#modal_edit_g #edit_g').show();

				$('#modal_edit_g #edit_form').hide();
				$('#modal_edit_g #edit_msg').show();

				// $('#modal_department_edit').on('hidden.bs.modal', function () {
				//     $('#department_name').val();
				//     $('#department_description').val();
				window.location.reload();
				//     window.location.href = base_url+"/erp/hrm/departments";
				// })
			} else if (response.status == '400') {
				// coder error message

				$('#modal_edit_g #error').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#modal_edit_g #error').html(response.msg);
			}
		},

		error: function(response) {
			console.log(response);
			$('#modal_edit_g #edit_g_loader').hide();
			$('#modal_edit_g #edit_g').show();
			$('#modal_edit_g #error').html('Connection Error.');
		},
	});
}

function fetch_grievance_details(grievance_id) {
	var company_id = localStorage.getItem('company_id');

	$('#gri_' + grievance_id).hide();
	$('#loader12_' + grievance_id).show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'ess/view_single_grievance',
		data: {
			grievance_id: grievance_id,
			company_id: company_id,
		},

		success: function(response) {
			var str = '';
			console.log(response);

			$('#modal_edit_g #error').html('');

			$('#modal_edit_g .required').each(function() {
				var the_val = $.trim($(this).val());

				$(this).removeClass('has-error');
			});

			$('#loader12_' + grievance_id).hide();
			$('#gri_' + grievance_id).show();

			if (response.status == '200') {
				$('#modal_edit_g #g_type').val(response.data.gri_type);
				$('#modal_edit_g #incident_date').val(response.data.incident_date);
				$('#modal_edit_g #incident').val(response.data.incident);
				$('#modal_edit_g #approval').val(response.data.approval);
				$('#modal_edit_g #branch').val(response.data.branch);

				$('#modal_edit_g').modal('show');
			}
		},

		error: function(response) {
			$('#loader12_' + grievance_id).hide();
			$('#gri_' + grievance_id).show();
			alert('Connection Error.');
		},
	});
}

function add_grievance_report() {
	var company_id = localStorage.getItem('company_id');
	var g_by = localStorage.getItem('user_id');
	var g_type = $('#g_type').val();
	var incident_date = $('#incident_date').val();
	var incident = $('#incident').val();
	var g_against;
	var branch = $('#branch').val();
	var emp_response = $('#emp_response').val();
	let action_acting = $('#prior_action').val();
	let upImage = document.querySelector('input#upload_doc').files[0];

	var blank;

	if ($('#g_against').val() == 'Employee') {
		g_against = $('#g_against_select').val();
	} else {
		g_against = $('#g_against').val();
	}

	// alert(warehouse_id);

	$('.required1').each(function() {
		var the_val = $.trim($(this).val());

		if (the_val == '' || the_val == '0') {
			$(this).addClass('has-error');

			blank = 'yes';
		} else {
			$(this).removeClass('has-error');
		}
	});

	if (blank == 'yes') {
		$('#error_g').html('You have a blank field');

		return;
	}

	let data = new FormData();
	// data.append('file', upImage);
	data.append('g_type', g_type);
	data.append('incident_date', incident_date);
	data.append('incident', incident);
	data.append('company_id', company_id);
	data.append('g_by', g_by);
	data.append('g_against', g_against);
	data.append('branch', branch);
	data.append('emp_response', emp_response);
	data.append('draft_or_completed', 'completed');
	data.append('action_b4_acting', action_acting);

	// $("#modal_edit_warehouse #error").html("");

	$('#add_g').hide();
	$('#loading_g').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'ess/report_grievance',
		processData: false,
		contentType: false,
		headers: {
			enctype: 'multipart/form-data',
		},
		data: data,

		// type: 'POST',
		// dataType: 'json',
		// cache: false,
		// url: api_path + 'ess/report_grievance',
		// data: data,

		success: function(response) {
			console.log(response);

			$('#error_g').html('');
			$('#loading_g').hide();
			$('#add_g').show();

			if (response.status == '200') {
				$('#modal_g').modal('show');

				$('#modal_g').on('hidden.bs.modal', function() {
					window.location.reload();
					// window.location.href = base_url+"incoming";
				});
			} else if (response.status == '400') {
				// coder error message

				$('#error_g').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error_g').html(response.msg);
			}
		},

		error: function(response) {
			console.log(response);
			$('#loading_g').hide();
			$('#add_g').show();
			$('#error_g').html('Connection Error.');
		},
	});
}

function add_grievance_report2() {
	var company_id = localStorage.getItem('company_id');
	var g_by = localStorage.getItem('user_id');
	var g_type = $('#g_type').val();
	var incident_date = $('#incident_date').val();
	var incident = $('#incident').val();
	var g_against;
	var branch = $('#branch').val();
	var emp_response = $('#emp_response').val();
	let action_acting = $('#prior_action').val();
	let upImage = document.querySelector('input#upload_doc').files[0];

	var blank;

	if ($('#g_against').val() == 'Employee') {
		g_against = $('#g_against_select').val();
	} else {
		g_against = $('#g_against').val();
	}

	// alert(warehouse_id);

	$('.required1').each(function() {
		var the_val = $.trim($(this).val());

		if (the_val == '' || the_val == '0') {
			$(this).addClass('has-error');

			blank = 'yes';
		} else {
			$(this).removeClass('has-error');
		}
	});

	if (blank == 'yes') {
		$('#error_g').html('You have a blank field');

		return;
	}

	let data = new FormData();
	// data.append('file', upImage);
	data.append('g_type', g_type);
	data.append('incident_date', incident_date);
	data.append('incident', incident);
	data.append('company_id', company_id);
	data.append('g_by', g_by);
	data.append('g_against', g_against);
	data.append('branch', branch);
	data.append('emp_response', emp_response);
	data.append('draft_or_completed', 'draft');
	data.append('action_b4_acting', action_acting);

	// $("#modal_edit_warehouse #error").html("");

	$('#add_g').hide();
	$('#loading_g').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'ess/report_grievance',
		processData: false,
		contentType: false,
		headers: {
			enctype: 'multipart/form-data',
		},
		data: data,
		success: function(response) {
			console.log(response);

			$('#error_g').html('');
			$('#loading_g').hide();
			$('#add_g').show();

			if (response.status == '200') {
				$('#modal_g').modal('show');

				$('#modal_g').on('hidden.bs.modal', function() {
					window.location.reload();
					// window.location.href = base_url+"incoming";
				});
			} else if (response.status == '400') {
				// coder error message

				$('#error_g').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error_g').html(response.msg);
			}
		},

		error: function(response) {
			console.log(response);
			$('#loading_g').hide();
			$('#add_g').show();
			$('#error_g').html('Connection Error.');
		},
	});
}

function display_filter() {
	$('#filter_display').toggle();
	$('#item_name').val('');
	$('#vendor_name').val('');
	$('#item_code').val('');
	$('#date_range').val('');
}

function display_apply() {
	$('#apply_display').toggle();
	$('#leave_start').val('');
	$('#resumption_date').val('');
	$('#comment').val('');
	$('#leave_type').val('');
}

function fetch_grievance_info(grievance_id) {
	var company_id = localStorage.getItem('company_id');

	$('#gr_' + grievance_id).hide();
	$('#loader11_' + grievance_id).show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'ess/view_single_grievance',
		data: {
			company_id: company_id,
			grievance_id: grievance_id,
		},

		success: function(response) {
			console.log(response);

			$('#loader11_' + grievance_id).hide();
			$('#gr_' + grievance_id).show();

			if (response.status == '200') {
				var monthNames = [
					'Jan',
					'Feb',
					'Mar',
					'Apr',
					'May',
					'Jun',
					'Jul',
					'August',
					'Sep',
					'Oct',
					'Nov',
					'Dec',
				];

				var s = new Date(response.data.incident_date);
				var month = s.getMonth();
				var datestring = s.getDate() + '/' + monthNames[month] + '/' + s.getFullYear();

				$('#modal_view_g #g_type').html(response.data.gri_type);
				$('#modal_view_g #incident_date').html(datestring);
				$('#modal_view_g #approval').html();
				$('#modal_view_g #report').html(response.data.incident);
				$('#modal_view_g #response').html();
				$('#modal_view_g #branch').html();

				$('#modal_view_g').modal('show');
			}
		},

		error: function(response) {
			$('#loader11_' + grievance_id).hide();
			$('#gr_' + grievance_id).show();
			alert('Connection Error.');
		},
	});
}

function delete_grievance(grievance_id) {
	var company_id = localStorage.getItem('company_id');
	var g_by = localStorage.getItem('user_id');

	var ans = confirm('Are you sure you want to delete this report?');
	if (!ans) {
		return;
	}

	$('#row_' + grievance_id).hide();
	$('#loader_row_' + grievance_id).show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'ess/delete_grievance',
		data: {
			company_id: company_id,
			g_by: g_by,
			grievance_id: grievance_id,
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#loader_row_' + grievance_id).hide();
			$('#row_' + grievance_id).show();

			alert('connection error');
		},

		success: function(response) {
			// console.log(response);
			if (response.status == '200') {
				// $('#row_'+user_id).hide();
			} else if (response.status == '401') {
			}

			$('#loader_row_' + grievance_id).hide();
		},
	});
}

function list_of_grievances(page) {
	var company_id = localStorage.getItem('company_id');
	var user_id = localStorage.getItem('user_id');
	if (page == '') {
		var page = 1;
	}
	var limit = 10;

	$('#loading').show();
	$('#grievanceData').html('');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'ess/all_reported_grievance',
		data: {
			company_id: company_id,
			page: page,
			limit: limit,
			user_id: user_id,
		},
		timeout: 60000,

		success: function(response) {
			console.log(response);

			var strTable = '';

			if (response.status == '200') {
				$('#loading').hide();
				if (response.data.length > 0) {
					var k = 1;
					$(response.data).each((i, v) => {
						strTable += `<tr id="row_${v.id}">`;
						strTable += `<td>${v.code}</td>`;
						strTable += `<td>${v.against}</td>`;
						strTable += `<td>${v.complaint}</td>`;
						strTable += `<td>${v.disciplinary}</td>`;
						strTable += `<td>
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
                                                <li>
                                                    <a class="dropdown-item g_info" id="gr_${v.id}">
                                                        <i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Grievance info" /> View
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item edit_g_icon" id="gri_${v.id}">
                                                        <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit Grievance"/> Edit
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item delete_g" id="grie_${v.id}">
                                                        <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete Grievance"/> Delete
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="view_grieviance" id="">
                                                        <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title=""/> Test Case
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>`;
						strTable += `</tr>`;

						strTable += `<tr style="display: none;" id="loader_row_${v.id}">`;
						strTable += `<td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>`;
						strTable += `</td>`;
						strTable += `</tr>`;

						k++;
					});
					// $.each(response['data'], function(i, v) {
					// 	strTable += '<tr id="row_' + response['data'][i]['id'] + '">';
					// 	strTable += '<td>' + response['data'][i]['code'] + '</td>';
					// 	strTable += '<td>' + response['data'][i]['against'] + '</td>';
					// 	strTable += '<td>' + response['data'][i]['complaint'] + '</td>';
					// 	strTable += '<td>' + response['data'][i]['disciplinary'] + '</td>';
					// 	strTable += `<td>
					//                     <div class="dropdown">
					//                         <button
					//                             class="btn btn-secondary dropdown-toggle"
					//                             type="button"
					//                             id="dropdownMenuButton1"
					//                             data-toggle="dropdown"
					//                             aria-expanded="false">
					//                             Actions
					//                         </button>
					//                         <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
					//                             <li>
					//                                 <a class="dropdown-item g_info" id="gr_${v.id}">
					//                                     <i class="fa fa-eye" data-toggle="tooltip" data-placement="top" title="View Grievance info" /> View
					//                                 </a>
					//                             </li>
					//                             <li>
					//                                 <a class="dropdown-item edit_g_icon" id="gri_${v.id}">
					//                                     <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit Grievance"/> Edit
					//                                 </a>
					//                             </li>
					//                             <li>
					//                                 <a class="dropdown-item delete_g" id="grie_${v.id}">
					//                                     <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete Grievance"/> Delete
					//                                 </a>
					//                             </li>
					//                         </ul>
					//                     </div>
					//                 </td>`;

					// 	// strTable +=
					// 	// 	'<td valign="top"><a class="g_info btn btn-primary btn-xs"  id="gr_' +
					// 	// 	response['data'][i]['id'] +
					// 	// 	'"><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title="View Grievance info"></i> View</a>';

					// 	// strTable +=
					// 	// 	'<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader11_' +
					// 	// 	response['data'][i]['id'] +
					// 	// 	'"></i>&nbsp;&nbsp;';

					// 	// strTable +=
					// 	// 	'<a class="edit_g_icon btn btn-info btn-xs"id="gri_' +
					// 	// 	response['data'][i]['id'] +
					// 	// 	'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" title="Edit Grievance"></i> Edit</a>&nbsp;&nbsp;';

					// 	// strTable +=
					// 	// 	'<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader12_' +
					// 	// 	response['data'][i]['id'] +
					// 	// 	'"></i>&nbsp;&nbsp;';

					// 	// strTable +=
					// 	// 	'<a class="delete_g btn btn-danger btn-xs" style="cursor: pointer;" id="grie_' +
					// 	// 	response['data'][i]['id'] +
					// 	// 	'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" title="Delete Grievance"></i> Delete</a></td>';

					// 	strTable += '</tr>';

					// 	strTable +=
					// 		'<tr style="display: none;" id="loader_row_' +
					// 		response['data'][i]['id'] +
					// 		'">';
					// 	strTable +=
					// 		'<td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
					// 	strTable += '</td>';
					// 	strTable += '</tr>';

					// 	k++;
					// });
				} else {
					strTable = '<tr><td colspan="5">' + response.msg + '</td></tr>';
				}

				$('#pagination').twbsPagination({
					totalPages: Math.ceil(response.total_rows / limit),
					visiblePages: 10,
					onPageClick: function(event, page) {
						list_of_grievances(page);
					},
				});

				$('#grievanceData').html(strTable);
				$('#grievanceData').show();
			} else if (response.data <= 0) {
				$('#loading').hide();

				strTable = '<tr><td colspan="5">' + response.msg + '</td></tr>';

				$('#grievanceData').html(strTable);
				$('#grievanceData').show();
			} else if (response.status == '400') {
				var strTable = '';
				$('#loading').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="5">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#grievanceData').html(strTable);
				$('#grievanceData').show();
			}
		},

		error: function(response) {
			var strTable = '';
			$('#loading').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable +=
				'<td colspan="5"><strong class="text-danger">Connection error</strong></td>';
			strTable += '</tr>';

			$('#grievanceData').html(strTable);
			$('#grievanceData').show();
		},
	});
}
