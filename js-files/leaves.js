$(document).ready(function() {
	var leave_id;
	load_leave_type();
	list_of_leaves('');

	$('input#leave_start').datepicker({
		dateFormat: 'yy-mm-dd',
	});

	$('input#resumption_date').datepicker({
		dateFormat: 'yy-mm-dd',
	});

	$('input#start_date').datepicker({
		dateFormat: 'yy-mm-dd',
	});

	$('#apply').on('click', display_apply);
	$('#add_leave').on('click', add_employee_leave);

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

	$(document).on('click', '.leave_info', function() {
		leave_id = $(this).attr('id').replace(/lv_/, '');
		fetch_leave_info(leave_id);
	});

	$(document).on('click', '.delete_leave', function() {
		var leave_id = $(this).attr('id').replace(/lev_/, '');
		delete_leave(leave_id);
	});

	$(document).on('click', '.edit_leave_icon', function() {
		leave_id = $(this).attr('id').replace(/leav_/, '');
		fetch_leave_details(leave_id);
	});

	$(document).on('click', '#edit_leave', function() {
		// var warehouse_id = $(this).attr('id').replace(/edt_/,'');
		edit_employee_leave(leave_id);
		// alert(warehouse_id);
	});
});

function load_leave_type() {
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		url: api_path + 'ess/fetch_leave_type',
		type: 'POST',
		data: {
			company_id: company_id,
		},
		dataType: 'json',

		success: function(response) {
			console.log(response);

			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['id'] +
					'">' +
					response['data'][i]['type'] +
					'</option>';
			});
			$('#leave_type').append(options);
			$('#modal_edit_leave #leave_type').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			alert('Connection error');
		},
	});
}

function edit_employee_leave(leave_id) {
	var leave_type = $('#modal_edit_leave #leave_type').val();

	var leave_start = $('#modal_edit_leave #start_date').val();

	var resumption_date = $('#modal_edit_leave #resumption_date').val();
	var comment = $.trim($('#modal_edit_leave #comment1').val());
	var company_id = localStorage.getItem('company_id');
	var email = localStorage.getItem('email');
	var user_id = localStorage.getItem('user_id');

	var blank;

	// alert(warehouse_id);

	$('#modal_edit_leave .required1').each(function() {
		var the_val = $.trim($(this).val());

		if (the_val == '' || the_val == '0') {
			$(this).addClass('has-error');

			blank = 'yes';
		} else {
			$(this).removeClass('has-error');
		}
	});

	if (blank == 'yes') {
		$('#modal_edit_leave #error').html('You have a blank field');

		return;
	}

	// $("#modal_edit_warehouse #error").html("");

	$('#modal_edit_leave #edit_leave').hide();
	$('#modal_edit_leave #edit_leave_loader').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'ess/edit_leave_request',
		data: {
			leave_type: leave_type,
			comment: comment,
			company_id: company_id,
			leave_id: leave_id,
			email: email,
			leave_start: leave_start,
			resumption_date: resumption_date,
			user_id: user_id,
		},

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				$('#modal_edit_leave #error').html('');
				$('#modal_edit_leave #edit_leave_loader').hide();
				$('#modal_edit_leave #edit_leave').show();

				$('#modal_edit_leave #edit_form').hide();
				$('#modal_edit_leave #edit_msg').show();

				$('#modal_edit_leave').on('hidden.bs.modal', function() {
					window.location.reload();
				});
			} else if (response.status == '400') {
				// coder error message

				$('#modal_edit_leave #error').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#modal_edit_leave #error').html(response.msg);
			}
		},

		error: function(response) {
			console.log(response);
			$('#modal_edit_leave #edit_leave_loader').hide();
			$('#modal_edit_leave #edit_leave').show();
			$('#modal_edit_leave #error').html('Connection Error.');
		},
	});
}

function fetch_leave_details(leave_id) {
	var company_id = localStorage.getItem('company_id');
	var email = localStorage.getItem('email');
	var user_id = localStorage.getItem('user_id');

	$('#leav_' + leave_id).hide();
	$('#loader12_' + leave_id).show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'ess/view_leave_status',
		data: {
			leave_id: leave_id,
			email: email,
			company_id: company_id,
			user_id: user_id,
		},

		success: function(response) {
			var str = '';
			console.log(response);

			$('#modal_edit_leave #error').html('');

			$('#modal_edit_leave .required').each(function() {
				var the_val = $.trim($(this).val());

				$(this).removeClass('has-error');
			});

			$('#loader12_' + leave_id).hide();
			$('#leav_' + leave_id).show();

			if (response.status == '200') {
				$('#modal_edit_leave #leave_type').val(response.data.leave_type_id);
				$('#modal_edit_leave #start_date').val(response.data.start_date);
				$('#modal_edit_leave #resumption_date').val(response.data.resume);
				// $("#modal_edit_leave #approval").val( response.data.approval);
				$('#modal_edit_leave #comment1').val(response.data.comment);

				$('#modal_edit_leave').modal('show');
			}
		},

		error: function(response) {
			$('#loader12_' + leave_id).hide();
			$('#leav_' + leave_id).show();
			alert('Connection Error.');
		},
	});
}

function add_employee_leave() {
	var leave_type = $('#leave_type').val();
	var leave_start = $('#leave_start').val();
	var resumption_date = $('#resumption_date').val();
	var days_requested = $('#days_requested').val();
	var comment = $('#comment').val();
	var company_id = localStorage.getItem('company_id');
	var email = localStorage.getItem('email');
	var user_id = localStorage.getItem('user_id');

	var blank;

	// alert(warehouse_id);

	$('.required').each(function() {
		var the_val = $.trim($(this).val());

		if (the_val == '' || the_val == '0') {
			$(this).addClass('has-error');

			blank = 'yes';
		} else {
			$(this).removeClass('has-error');
		}
	});

	if (blank == 'yes') {
		$('#error_leave').html('You have a blank field');

		return;
	}

	if (Date.parse(resumption_date) < Date.parse(leave_start)) {
		//start is less than End
		$('#error_leave').html('Wrong date interval!');

		// alert('wrong');

		return;
	} else {
		// alert('right')
	}

	// return;
	// $("#modal_edit_warehouse #error").html("");

	$('#add_leave').hide();
	$('#loading_app').show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'ess/request_leave',
		data: {
			leave_type: leave_type,
			leave_start: leave_start,
			company_id: company_id,
			email: email,
			resumption_date: resumption_date,
			days_requested: days_requested,
			comment: comment,
			user_id: user_id,
		},

		success: function(response) {
			console.log(response);

			$('#error_leave').html('');
			$('#loading_app').hide();
			$('#add_leave').show();

			if (response.status == '200') {
				$('#modal_leave').modal('show');

				$('#modal_leave').on('hidden.bs.modal', function() {
					window.location.reload();
					// window.location.href = base_url+"incoming";
				});
			} else if (response.status == '400') {
				// coder error message

				$('#error_leave').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#error_leave').html(response.msg);
			}
		},

		error: function(response) {
			console.log(response);
			$('#loading_app').hide();
			$('#add_leave').show();
			$('#error_leave').html('Connection Error.');
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

function fetch_leave_info(leave_id) {
	var company_id = localStorage.getItem('company_id');
	var email = localStorage.getItem('email');
	var user_id = localStorage.getItem('user_id');

	$('#lv_' + leave_id).hide();
	$('#loader11_' + leave_id).show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'ess/view_leave_status',
		data: {
			leave_id: leave_id,
			company_id: company_id,
			email: email,
			user_id: user_id,
		},

		success: function(response) {
			console.log(response);

			$('#loader11_' + leave_id).hide();
			$('#lv_' + leave_id).show();

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

				var d = new Date(response.data.resume);
				var monthIndex = d.getMonth();
				var datestring12 =
					d.getDate() + '/' + monthNames[monthIndex] + '/' + d.getFullYear();

				var s = new Date(response.data.start_date);
				var month = s.getMonth();
				var datestring = s.getDate() + '/' + monthNames[month] + '/' + s.getFullYear();

				let start;
				let end;
				if (response.data.resume === '0000-00-00') {
					end = '';
				} else {
					end = moment(response.data.resume, 'YYYY-MM-DD').format('LL');
				}

				if (response.data.start_date === '0000-00-00') {
					start = '';
				} else {
					start = moment(response.data.start_date, 'YYYY-MM-DD').format('LL');
				}

				$('#modal_view_leave #leave_type').html(response.data.leave_type);
				$('#modal_view_leave #start_date').html(start);
				$('#modal_view_leave #resumption_date').html(end);
				$('#modal_view_leave #view_days_requested').html(response.data.days_requested);

				if (response.data.approval == 'yes') {
					// aprvv_status = '<i class="fa fa-exclamation-triangle fa-2x" style="color: orange"></i>';
					$('#modal_view_leave #approval').html(
						'<i class="fa fa-check fa-2x" style="color: green"></i>',
					);
				} else if (response.data.approval == 'no') {
					// aprvv_status = '<i class="fa fa-exclamation-triangle fa-2x" style="color: orange"></i>';
					$('#modal_view_leave #approval').html(
						'<i class="fa fa-exclamation-triangle fa-2x" style="color: orange"></i>',
					);
				} else if (response.data.approval == 'declined') {
					// aprvv_status = '<i class="fa fa-exclamation-triangle fa-2x" style="color: orange"></i>';
					$('#modal_view_leave #approval').html(
						'<i class="fa fa-times fa-2x" style="color: red"></i>',
					);
				}

				$('#modal_view_leave #comment').html(response.data.comment);

				$('#modal_view_leave').modal('show');
			}
		},

		error: function(response) {
			$('#loader11_' + leave_id).hide();
			$('#lv_' + leave_id).show();
			alert('Connection Error.');
		},
	});
}

function delete_leave(leave_id) {
	var company_id = localStorage.getItem('company_id');
	var email = localStorage.getItem('email');
	var user_id = localStorage.getItem('user_id');

	var ans = confirm('Are you sure you want to delete this leave?');
	if (!ans) {
		return;
	}

	$('#row_' + leave_id).hide();
	$('#loader_row_' + leave_id).show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'ess/delete_leave_request',
		data: {
			company_id: company_id,
			email: email,
			leave_id: leave_id,
			user_id: user_id,
		},
		timeout: 60000, // sets timeout to one minute
		// objAJAXRequest, strError

		error: function(response) {
			$('#loader_row_' + leave_id).hide();
			$('#row_' + leave_id).show();

			alert('connection error');
		},

		success: function(response) {
			// console.log(response);
			if (response.status == '200') {
				// $('#row_'+user_id).hide();
			} else if (response.status == '401') {
			}

			$('#loader_row_' + leave_id).hide();
		},
	});
}

function convertDateForIos(date) {
	var arr = date.split(/[- :]/);
	date = new Date(arr[0], arr[1] - 1, arr[2], arr[3], arr[4]);
	return date;
}

function formatAMPM(date) {
	var hours = date.getHours();
	var minutes = date.getMinutes();
	var ampm =

			hours >= 12 ? 'pm' :
			'am';
	hours = hours % 12;
	hours =
		hours ? hours :
		12; // the hour '0' should be '12'
	minutes =

			minutes < 10 ? '0' + minutes :
			minutes;
	var strTime = hours + ':' + minutes + ' ' + ampm;
	return strTime;
}

function list_of_leaves(page) {
	var company_id = localStorage.getItem('company_id');
	var email = localStorage.getItem('email');
	var user_id = localStorage.getItem('user_id');
	if (page == '') {
		var page = 1;
	}
	var limit = 50;

	$('#loading').show();
	$('#leaveData').html('');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'ess/list_of_ess_leaves',
		data: {
			company_id: company_id,
			page: page,
			limit: limit,
			email: email,
			user_id: user_id,
		},
		timeout: 60000,

		success: function(response) {
			console.log(response);

			var strTable = '';
			var aprvv_status = '';

			if (response.status == '200') {
				$('#loading').hide();
				if (response.data.length > 0) {
					var k = 1;
					$.each(response['data'], function(i, v) {
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

						var d = new Date(response['data'][i]['start']);
						var monthIndex = d.getMonth();
						var start =
							d.getDate() + '/' + monthNames[monthIndex] + '/' + d.getFullYear();

						var f = new Date(response['data'][i]['finish']);
						var month = f.getMonth();
						var finish = f.getDate() + '/' + monthNames[month] + '/' + f.getFullYear();

						var e = new Date(response['data'][i]['insert_date']);
						var monthInsert = e.getMonth();
						var insert =
							e.getDate() + '/' + monthNames[monthInsert] + '/' + e.getFullYear();

						var insertDate = convertDateForIos(response['data'][i]['insert_date']);

						if (response['data'][i]['leave_status'] == 'no') {
							aprvv_status =
								'<i class="fa fa-exclamation-triangle fa-2x" style="color: orange"></i>';

							strTable += '<tr id="row_' + response['data'][i]['id'] + '">';
							strTable += '<td>' + response['data'][i]['code'] + '</td>';
							strTable += '<td>' + insert + ' ' + formatAMPM(insertDate) + '</td>';
							strTable += '<td>' + response['data'][i]['type'] + '</td>';

							// strTable += '<td>'+datestring+'</td>';
							// strTable += '<td>' + start + '</td>';
							// +response['data'][i]['Vendor']+
							// strTable += '<td>'+parseInt(response['data'][i]['qty']).toLocaleString()+'</td>';
							// strTable += '<td>' + finish + '</td>';
							strTable +=
								'<td><i class="fa fa-exclamation-triangle fa-2x" style="color: orange"></td>';

							// strTable +=
							// 	'<td valign="top"><a class="leave_info btn btn-primary btn-xs"  id="lv_' +
							// 	response['data'][i]['id'] +
							// 	'"><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title="View Leave info"></i> View</a>';

							// strTable +=
							// 	'<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader11_' +
							// 	response['data'][i]['id'] +
							// 	'"></i>&nbsp;&nbsp;';

							// strTable +=
							// 	'<a class="edit_leave_icon btn btn-info btn-xs"id="leav_' +
							// 	response['data'][i]['id'] +
							// 	'"><i  class="fa fa-pencil"  data-toggle="tooltip" data-placement="top" title="Edit Leave Type"></i> Edit</a>&nbsp;&nbsp;';

							// strTable +=
							// 	'<i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader12_' +
							// 	response['data'][i]['id'] +
							// 	'"></i>&nbsp;&nbsp;';

							// strTable +=
							// 	'<a class="delete_leave btn btn-danger btn-xs" style="cursor: pointer;" id="lev_' +
							// 	response['data'][i]['id'] +
							// 	'"><i  class="fa fa-trash"  data-toggle="tooltip" data-placement="top" title="Delete Leave Type"></i> Delete</a>';

							// strTable +=
							// 	'<a style="cursor: pointer;" class="btn btn-default btn-xs"><i  class="fa fa-arrow-down"  data-toggle="tooltip" data-placement="top" title="Downlod"></i> Download</a>';

							// strTable += '</td>';

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
                                            <a class="dropdown-item leave_info" id="lv_${v.id}">
                                                <i class="fa fa-folder" data-toggle="tooltip" data-placement="top" title="View Leave info"></i>  View
                                            </a>
                                            <i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader11_${v.id}"></i>
                                        </li>
                                        <!--<li>
                                            <a class="dropdown-item edit_leave_icon" id="leav_${v.id}">
                                                <i class="fa fa-pencil" data-toggle="tooltip" data-placement="top" title="Edit Leave Type"></i>  Edit
                                            </a>
                                            <i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader12_${v.id}"></i>
                                        </li>-->
                                        <li style="cursor: pointer;">
                                            <a class="dropdown-item delete_leave" id="lev_${v.id}">
                                                <i class="fa fa-trash" data-toggle="tooltip" data-placement="top" title="Delete Leave Type"></i>  Delete
                                            </a>
                                        </li>
                                        <!--<li style="cursor: pointer;">
                                            <a class="dropdown-item">
                                                <i class="fa fa-arrow-down"  data-toggle="tooltip" data-placement="top" title="Downlod"></i>  Download
                                            </a>
                                        </li>-->
                                    </ul>
                                </div>
                            </td>`;

							strTable += '</tr>';

							strTable +=
								'<tr style="display: none;" id="loader_row_' +
								response['data'][i]['id'] +
								'">';
							strTable +=
								'<td colspan="5"><i class="fa fa-spinner fa-spin fa-fw fa-2x"  id="loading"></i>';
							strTable += '</td>';
							strTable += '</tr>';
						} else if (response['data'][i]['leave_status'] == 'yes') {
							aprvv_status = '<i class="fa fa-check fa-2x" style="color: green"></i>';

							strTable += '<tr id="row_' + response['data'][i]['id'] + '">';
							strTable += '<td>' + response['data'][i]['code'] + '</td>';
							strTable += '<td>' + insert + ' ' + formatAMPM(insertDate) + '</td>';
							strTable += '<td>' + response['data'][i]['type'] + '</td>';

							// strTable += '<td>'+datestring+'</td>';
							// strTable += '<td>' + start + '</td>';
							// +response['data'][i]['Vendor']+
							// strTable += '<td>'+parseInt(response['data'][i]['qty']).toLocaleString()+'</td>';
							// strTable += '<td>' + finish + '</td>';
							strTable +=
								'<td><i class="fa fa-check fa-2x" style="color: green"></i></td>';

							strTable += `<td valign="top">
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
                                            <a class="dropdown-item leave_info" id="lv_${v.id}">
                                                <i class="fa fa-folder" data-toggle="tooltip" data-placement="top" title="View Leave info"></i>  View
                                            </a>
                                            <i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader11_${v.id}"></i>
                                        </li>
                                        
                                        <!--<li style="cursor: pointer;">
                                            <a class="dropdown-item">
                                                <i class="fa fa-arrow-down"  data-toggle="tooltip" data-placement="top" title="Downlod"></i>  Download
                                            </a>
                                        </li>-->
                                    </ul>
                                </div>
                            </td>`;

							strTable += '</tr>';
						} else if (response['data'][i]['leave_status'] == 'declined') {
							aprvv_status = '<i class="fa fa-times fa-2x" style="color: red"></i>';

							strTable += '<tr id="row_' + response['data'][i]['id'] + '">';
							strTable += '<td>' + response['data'][i]['code'] + '</td>';
							strTable += '<td>' + insert + ' ' + formatAMPM(insertDate) + '</td>';
							strTable += '<td>' + response['data'][i]['type'] + '</td>';

							// strTable += '<td>'+datestring+'</td>';
							// strTable += '<td>' + start + '</td>';
							// +response['data'][i]['Vendor']+
							// strTable += '<td>'+parseInt(response['data'][i]['qty']).toLocaleString()+'</td>';
							// strTable += '<td>' + finish + '</td>';
							strTable +=
								'<td><i class="fa fa-times fa-2x" style="color: red"></i></td>';

							strTable += `<td valign="top">
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
                                            <a class="dropdown-item leave_info" id="lv_${v.id}">
                                                <i class="fa fa-folder" data-toggle="tooltip" data-placement="top" title="View Leave info"></i>  View
                                            </a>
                                            <i  class="fa fa-spinner fa-spin fa-1x fa-fw" aria-hidden="true" style="display: none;" id="loader11_${v.id}"></i>
                                        </li>
                                        
                                        <!--<li style="cursor: pointer;">
                                            <a class="dropdown-item">
                                                <i class="fa fa-arrow-down"  data-toggle="tooltip" data-placement="top" title="Downlod"></i>  Download
                                            </a>
                                        </li>-->
                                    </ul>
                                </div>
                            </td>`;

							strTable += '</tr>';
						}

						k++;
					});
				} else {
					strTable = '<tr><td colspan="5">' + response.msg + '</td></tr>';
				}

				$('#pagination').twbsPagination({
					totalPages: Math.ceil(response.total_rows / limit),
					visiblePages: 10,
					onPageClick: function(event, page) {
						list_of_leaves(page);
					},
				});

				$('#leaveData').html(strTable);
				$('#leaveData').show();
			} else if (response.data <= 0) {
				$('#loading').hide();

				strTable = '<tr><td colspan="5">' + response.msg + '</td></tr>';

				$('#leaveData').html(strTable);
				$('#leaveData').show();
			} else if (response.status == '400') {
				var strTable = '';
				$('#loading').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="5">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#leaveData').html(strTable);
				$('#leaveData').show();
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

			$('#leaveData').html(strTable);
			$('#leaveData').show();
		},
	});
}
