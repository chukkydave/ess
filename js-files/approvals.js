$(document).ready(function() {
	pending_approvals_list('');
	$(document).on('click', '.approval_info_details', function() {
		var id = $(this).attr('id').replace(/apprv_id_/, '');
		view_approval_details(id);
	});
	$(document).on('click', '.approve_or_decline', function() {
		var id = $(this).attr('id').replace(/apprv_id_/, '');
		var idt = $(this).attr('data');
		$('#approve_or_decline_decision').modal('show');
		$('.approve_this').attr('data', idt);
		// approve_or_decline(id);
	});

	$(document).on('click', '.approve_this', function() {
		var decision = $(this).attr('id');
		let app_id = $(this).attr('data');
		do_the_action(decision, app_id);
	});
	$(document).on('change', '#sort_type', () => {
		// let order = $('#order_by').val();
		// if ($('#sort_type').val() === 'pay_run') {
		// 	$('#payrunDetails').show();
		// } else {
		// 	$('#payrunDetails').hide();
		// }
		pending_approvals_list('');
	});
});

function do_the_action(decision, app_id) {
	$('#apprrv_btns').hide();
	$('#lda_apprva').show();

	var company_id = localStorage.getItem('company_id');
	var email = localStorage.getItem('email');
	var user_id = localStorage.getItem('user_id');
	var date_acted = '';

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'ess/ess_approval_or_decline',
		data: {
			// company_id: company_id,
			email: email,
			// user_id: user_id,
			decision: decision,
			app_id: app_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,
		success: function(response) {
			if (response.status == '200') {
				if (decision == 'yes') {
					$('#checkdgood').show();
					setTimeout(() => {
						Swal.fire({
							title: 'Success',
							text: `Success`,
							icon: 'success',
							confirmButtonText: 'Okay',
							onClose: window.location.reload(),
						});
					}, 2000);
				} else if (decision == 'declined') {
					$('#checkdx').show();
					setTimeout(() => {
						Swal.fire({
							title: 'Success',
							text: `Success`,
							icon: 'success',
							confirmButtonText: 'Okay',
							onClose: window.location.reload(),
						});
					}, 2000);
				}
			} else if (response.status == '400') {
				Swal.fire({
					title: 'Error!',
					text: `${response.msg}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			}

			$('#lda_apprva').hide();
			console.log(response);
		},
		error: function(response) {
			console.log(response);
			$('#lda_apprva').hide();
			$('#apprrv_btns').show();
			Swal.fire({
				title: 'Error!',
				text: `${response.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
	});
}

function view_approval_details(id) {
	$('.dtl_of_app').hide();
	$('#loader_for_dtls').show();
	$('.dtl_vl').html('');

	$('#apprrv_btns').show(); //reset the apprv button to show
	$('#lda_apprva').hide(); //reset loader to hidden

	$('#view_approval_details').modal('show');
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'ess/view_ess_approval',
		data: {
			// company_id: company_id,
			app_id: id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,
		success: function(response) {
			if (response.status == '200') {
				let request_date;
				if (response.data.request_date === '0000-00-00 00:00:00') {
					request_date = '';
				} else {
					request_date = moment(response.data.request_date, 'YYYY-MM-DD HH:mm:ss').format(
						'LL',
					);
				}
				let comments = response.data.comment.replace('↵', '').trim();
				$('.dtl_of_app').show();
				$('#applc_type').html(response.data.app_type);
				$('#applc_code').html(response.data.code);
				$('#applc_date').html(request_date);
				$('#applc_comment').html(comments);
				$('#applc_by').html(response.data.firstname + ' ' + response.data.lastname);
				$('#applc_leave_start').html(format_a_date(response.data.start_date));
				$('#applc_leave_end').html(format_a_date(response.data.resume_date));

				// if(response.data.decision == "pending"){
				//   $("#apprrv_btns").show();
				// }else{
				//   $("#apprrv_btns").hide();
				// }
			} else if (response.status == '400') {
			}
			$('#loader_for_dtls').hide();
			console.log(response);
		},
		error: function(response) {
			console.log(response);
			alert('Error');
		},
	});
}

function pending_approvals_list(page) {
	var company_id = localStorage.getItem('company_id');
	var user_id = localStorage.getItem('user_id');
	var email = localStorage.getItem('email');
	let sort_type = $('#sort_type').val();

	if (page == '') {
		var page = 1;
	}
	var limit = 10;

	$('#loading').show();
	$('#leaveData').html('');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'ess/list_employee_approvals',
		data: {
			// user_id: user_id,
			// company_id: company_id,
			page: page,
			limit: limit,
			email: email,
			sort_type: sort_type,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			console.log(response);

			var strTable = '';

			if (response.status == '200') {
				$('#loading').hide();

				if (response.data.length > 0) {
					var k = 1;

					$.each(response.data, function(i, v) {
						var aprvv_status = '';
						let startDatey = moment(v.request_time, 'YYYY-MM-DD HH:mm:ss').format('LL');

						if (v.app_type === 'Payment Approval') {
							if (v.decision == 'pending') {
								aprvv_status =
									'<i class="fa fa-exclamation-triangle fa-2x" style="color: orange"></i>';
								strTable += `<tr>`;
								strTable += `<td>${k++}</td>`;
								strTable += `<td>${startDatey}</td>`;
								strTable += `<td>${v.app_type}</td>`;
								strTable += `<td>${aprvv_status}</td>`;
								strTable += `<td><a href="payrun?id=${v.app_id}&status=${v.decision}&aID=${v.use_as_approval_id}" class="btn btn-primary btn-xs" id="apprv_id_${v.app_id}><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title=""></i> View</a>
									</td>`;
								strTable += `</tr>`;
							} else if (v.decision == 'yes') {
								aprvv_status =
									'<i class="fa fa-check fa-2x" style="color: green"></i>';
								strTable += `<tr>`;
								strTable += `<td>${k++}</td>`;
								strTable += `<td>${startDatey}</td>`;
								strTable += `<td>${v.app_type}</td>`;
								strTable += `<td>${aprvv_status}</td>`;
								strTable += `<td><a href="payrun?id=${v.app_id}&status=${v.decision}&aID=${v.use_as_approval_id}" class="btn btn-primary btn-xs" id="apprv_id_${v.app_id}><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title=""></i> View</a>
									</td>`;
								strTable += `</tr>`;
							} else if (v.decision == 'declined') {
								aprvv_status =
									'<i class="fa fa-times fa-2x" style="color: red"></i>';
								strTable += `<tr>`;
								strTable += `<td>${k++}</td>`;
								strTable += `<td>${startDatey}</td>`;
								strTable += `<td>${v.app_type}</td>`;
								strTable += `<td>${aprvv_status}</td>`;
								strTable += `<td><a href="payrun?id=${v.app_id}&status=${v.decision}&aID=${v.use_as_approval_id}" class="btn btn-primary btn-xs" id="apprv_id_${v.app_id}><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title=""></i> View</a>
									</td>`;
								strTable += `</tr>`;
							} else if (v.decision == 'not_approved') {
								aprvv_status =
									'<i class="fa fa-exclamation-triangle fa-2x" style="color: orange"></i>';
								strTable += `<tr>`;
								strTable += `<td>${k++}</td>`;
								strTable += `<td>${startDatey}</td>`;
								strTable += `<td>${v.app_type}</td>`;
								strTable += `<td>${aprvv_status}</td>`;
								strTable += `<td><a href="payrun?id=${v.app_id}&status=${v.decision}&aID=${v.use_as_approval_id}" class="btn btn-primary btn-xs" id="apprv_id_${v.app_id}><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title=""></i> View</a>
									</td>`;
								strTable += `</tr>`;
							} else if (v.decision == 'approve') {
								aprvv_status =
									'<i class="fa fa-check fa-2x" style="color: green"></i>';
								strTable += `<tr>`;
								strTable += `<td>${k++}</td>`;
								// strTable += `<td>${format_a_date_time(v.request_time)}</td>`;
								strTable += `<td>${startDatey}</td>`;
								strTable += `<td>${v.app_type}</td>`;
								strTable += `<td>${aprvv_status}</td>`;
								strTable += `<td><a href="payrun?id=${v.app_id}&status=${v.decision}&aID=${v.use_as_approval_id}" class="btn btn-primary btn-xs" id="apprv_id_${v.app_id}><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title=""></i> View</a>
									</td>`;
								strTable += `</tr>`;
							}
						} else if (v.app_type === 'exit approval') {
							if (v.decision == 'pending') {
								aprvv_status =
									'<i class="fa fa-exclamation-triangle fa-2x" style="color: orange"></i>';
								strTable +=
									'<tr> <td>' +
									k++ +
									'</td><td>' +
									startDatey +
									'</td> <td>' +
									capitalizeFirstLetter(v.app_type) +
									'</td><td>' +
									aprvv_status +
									'</td>';
								strTable += `<td> <a href="view_exit_details?ex=${v.use_as_approval_id}&us=${v.request_from}&status=${v.decision}&app_id=${v.app_id}" class="btn btn-primary btn-xs"><i class="fa fa-folder" data-toggle="tooltip" data-placement="top" title=""></i> View</a>   </td ></tr > `;
							} else if (v.decision == 'approved') {
								aprvv_status =
									'<i class="fa fa-check fa-2x" style="color: green"></i>';
								strTable +=
									'<tr> <td>' +
									k++ +
									'</td><td>' +
									startDatey +
									'</td> <td>' +
									capitalizeFirstLetter(v.app_type) +
									'</td><td>' +
									aprvv_status +
									'</td>';
								strTable += `<td> <a href="view_exit_details?ex=${v.use_as_approval_id}&us=${v.request_from}&status=${v.decision}&app_id=${v.app_id}" class="btn btn-primary btn-xs"><i class="fa fa-folder" data-toggle="tooltip" data-placement="top" title=""></i> View</a>   </td ></tr > `;
							} else if (v.decision == 'declined') {
								aprvv_status =
									'<i class="fa fa-times fa-2x" style="color: red"></i>';
								strTable +=
									'<tr> <td>' +
									k++ +
									'</td><td>' +
									startDatey +
									'</td> <td>' +
									capitalizeFirstLetter(v.app_type) +
									'</td><td>' +
									aprvv_status +
									'</td><td><a class="approval_info_details btn btn-primary btn-xs"  id="apprv_id_' +
									v.app_id +
									'"><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title=""></i> View</a> </td></tr>';
							} else if (v.decision == 'not_approved') {
								aprvv_status =
									'<i class="fa fa-times fa-2x" style="color: red"></i>';
								strTable +=
									'<tr> <td>' +
									k++ +
									'</td><td>' +
									startDatey +
									'</td> <td>' +
									capitalizeFirstLetter(v.app_type) +
									'</td><td>' +
									aprvv_status +
									'</td><td><a class="approval_info_details btn btn-primary btn-xs"  id="apprv_id_' +
									v.app_id +
									'"><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title=""></i> View</a> </td></tr>';
							}
						} else {
							if (v.decision == 'pending') {
								aprvv_status =
									'<i class="fa fa-exclamation-triangle fa-2x" style="color: orange"></i>';
								strTable +=
									'<tr> <td>' +
									k++ +
									'</td><td>' +
									startDatey +
									'</td> <td>' +
									v.app_type +
									'</td><td>' +
									aprvv_status +
									'</td><td><a class="approval_info_details btn btn-primary btn-xs"  id="apprv_id_' +
									v.app_id +
									'"><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title=""></i> View</a>  <a class="approve_or_decline btn btn-success btn-xs" data="' +
									v.app_id +
									'"  id="venIn_' +
									v.app_id +
									'"><i  class="fa fa-align-justify"  data-toggle="tooltip" data-placement="top" title="Act"></i> Act</a> </td></tr>';
							} else if (v.decision == 'yes') {
								aprvv_status =
									'<i class="fa fa-check fa-2x" style="color: green"></i>';
								strTable +=
									'<tr> <td>' +
									k++ +
									'</td><td>' +
									startDatey +
									'</td> <td>' +
									v.app_type +
									'</td><td>' +
									aprvv_status +
									'</td><td><a class="approval_info_details btn btn-primary btn-xs"  id="apprv_id_' +
									v.app_id +
									'"><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title=""></i> View</a>   </td></tr>';
							} else if (v.decision == 'declined') {
								aprvv_status =
									'<i class="fa fa-times fa-2x" style="color: red"></i>';
								strTable +=
									'<tr> <td>' +
									k++ +
									'</td><td>' +
									startDatey +
									'</td> <td>' +
									v.app_type +
									'</td><td>' +
									aprvv_status +
									'</td><td><a class="approval_info_details btn btn-primary btn-xs"  id="apprv_id_' +
									v.app_id +
									'"><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title=""></i> View</a> </td></tr>';
							} else if (v.decision == 'not_approved') {
								aprvv_status =
									'<i class="fa fa-times fa-2x" style="color: red"></i>';
								strTable +=
									'<tr> <td>' +
									k++ +
									'</td><td>' +
									startDatey +
									'</td> <td>' +
									v.app_type +
									'</td><td>' +
									aprvv_status +
									'</td><td><a class="approval_info_details btn btn-primary btn-xs"  id="apprv_id_' +
									v.app_id +
									'"><i  class="fa fa-folder"  data-toggle="tooltip" data-placement="top" title=""></i> View</a> </td></tr>';
							}
						}
						k++;
					});

					$('#approvalData').html(strTable);

					$('#pagination').twbsPagination({
						totalPages: Math.ceil(response.total_rows / limit),
						visiblePages: 10,
						onPageClick: function(event, page) {
							pending_approvals_list(page);
						},
					});
				} else {
					strTable = '<tr><td colspan="5">No record found</td></tr>';
				}

				$('#approvalData').html(strTable);
				$('#approvalData').show();
			} else if (response.status == 400) {
				console.log(response.status);
				var strTable = '';
				$('#loading').hide();
				// alert(response.msg);
				strTable += '<tr>';
				strTable += '<td colspan="5">' + response.msg + '</td>';
				strTable += '</tr>';

				alert(strTable);
				$('#approvalData').html(strTable);
				$('#approvalData').show();
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

			$('#approvalData').html(strTable);
			$('#approvalData').show();
		},
	});
}

function capitalizeFirstLetter(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}
