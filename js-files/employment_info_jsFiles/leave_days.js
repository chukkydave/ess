$(document).ready(() => {
	$('#add_leave_days').on('click', () => {
		$('#leave_days_display').toggle();
	});
	$('#save_allot_btn').on('click', () => {
		// if (isEmptyInput('.add_allot_fields')) {
		addAllotDays();
		// }
	});
	$('#inc-btn').on('click', () => {
		let oldVal = parseInt($('#extra-allot-inp').val());
		let newVal = oldVal + 1;
		$('#extra-allot-inp').val(newVal);
		$('#allot-btns').fadeIn();
	});
	$('#dec-btn').on('click', () => {
		let oldVal = parseInt($('#extra-allot-inp').val());
		let newVal;
		if (oldVal > 0) {
			newVal = oldVal - 1;
		} else {
			newVal = 0;
		}
		$('#extra-allot-inp').val(newVal);
		$('#allot-btns').fadeIn();
	});

	$('#cancel_allot_btn').on('click', () => {
		$('#allot-btns').fadeOut();
	});

	$('#extra-allot-inp').on('change', () => {
		$('#allot-btns').fadeIn();
	});
});

function addAllotDays() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');

	$('#save_allot_btn').hide();
	$('#save_allot_loader').show();

	// var today = new Date();
	// var dd = String(today.getDate()).padStart(2, '0');
	// var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
	// var yyyy = today.getFullYear();

	// today = yyyy + '-' + mm + '-' + dd;

	let allot_no = $('#extra-allot-inp').val();

	let data = {
		// company_id: company_id,
		employee_id: employee_id,
		allotted_days: allot_no,
		// user_id: user_id,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/save_allotted_days`,
		data: data,
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		error: function(res) {
			console.log(res);
			$('#save_allot_loader').hide();
			$('#save_allot_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${res.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#save_allot_loader').hide();
				$('#save_allot_btn').show();

				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: listAllotDays(),
				});
				$('#allot-btns').fadeOut();
			}
		},
	});
}

function listAllotDays() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	// $('#list_allot_table').hide();
	// $('#list_allot_loader').show();

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
			console.log(response.data);

			if (response.data.data.employee_leave_calc) {
				const { employee_leave_calc } = response.data.data;
				let inpu =

						employee_leave_calc.extra_leaves == null ? '0' :
						employee_leave_calc.extra_leaves;
				let allo =

						employee_leave_calc.allotted_leaves == false ? '0' :
						employee_leave_calc.allotted_leaves;
				$('#annual_allowance').html(allo);
				$('#extra-allot-inp').html(inpu);
				$('#total_leave_daysi').html(employee_leave_calc.total_leaves_allotted);

				// $('#list_allot_loader').hide();
				// $('#list_allot_table').show();
			} else {
				$('#annual_allowance').html('No record found');
				$('#extra-allot-inp').val('No record found');
				$('#total_leaves_daysi').html('No record found');
				// $('#list_allot_loader').hide();
				// $('#list_allot_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			// $('#list_allot_loader').hide();
			// $('#list_allot_table').show();
			$('#annual_allowance').html('Error');
			$('#extra-allot-inp').val('Error');
			$('#total_leaves_daysi').html('Error');

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function listLeaveGraph() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	$('#list_graph_table').hide();
	$('#list_graph_loader').show();

	let data = {
		// company_id: company_id,
		employee_id: employee_id,
		// user_id: user_id,
	};

	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/employeeUsedStatPie`,
		data: data,
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		error: function(res) {
			console.log(res);
			// $('#add_allot_loader').hide();
			// $('#add_allot_btn').show();
			// alert('error');
		},
		success: function(res) {
			if (res.status == 200 || res.status == 201) {
				var chartDom = document.getElementById('leave-historys');
				var myChart = echarts.init(chartDom);
				let usedLeaves =

						res.data.used_leaves == null ? 0 :
						res.data.used_leaves;
				var option;
				option = {
					title: {
						text: 'Leave Graph',
						// subtext: '纯属虚构',
						left: 'center',
					},
					tooltip: {
						trigger: 'item',
					},
					legend: {
						orient: 'vertical',
						left: 'left',
					},

					series: [
						{
							type: 'pie',
							radius: '50%',
							data: [
								// {
								// 	value: res.data.total_leaves_within_a_year,
								// 	name: 'Total Leaves',
								// },
								{ value: usedLeaves, name: 'Used Leaves' },
								{ value: res.data.remaining_leaves, name: 'Remaining Leaves' },
							],
							emphasis: {
								itemStyle: {
									shadowBlur: 10,
									shadowOffsetX: 0,
									shadowColor: 'rgba(0, 0, 0, 0.5)',
								},
							},
						},
					],
				};
				option && myChart.setOption(option);
				$('#graph_loading').hide();
				// $('#add_allot_loader').hide();
				// $('#add_allot_btn').show();
				// $('#mod_body').html('Extra days alloted successfully');
				// $('#successModal').modal('show');
				// $('#allot_no').val('');
				// $('#allot_reason').val('');
				// $('#leave_days_display').toggle();
				// listAllotDays();
			}
		},
	});
}

function list_employee_leave_history() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = ''; //pathArray[4].replace(/%20/g,' ');
	let user_id = localStorage.getItem('user_id');

	var page = 1;
	var limit = 10;

	$('#loading').show();
	$('#summaryData').html('');

	$.ajax({
		type: 'GET',
		dataType: 'json',
		url: `${api_path}hrm/new_employee_info?employee_id=${employee_id}`,
		// data: { company_id: company_id, employee_id: employee_id, page: page, limit: limit },
		timeout: 60000,
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);
			$('#loading').hide();
			var strTable = '';

			if (response.status == '200') {
				if (response.data.employee_leave_history.length > 0) {
					var k = 1;

					$(response.data.employee_leave_history).each((i, v) => {
						let resume = moment(v.resumption_date, 'YYYY-MM-DD').format('LL');
						let start = moment(v.leave_start, 'YYYY-MM-DD').format('LL');
						strTable += '<tr>';

						strTable += `<td>${v.leave_type}</td>`;

						strTable += `<td>${start}</td>`;

						strTable += `<td>${resume}</td>`;
						strTable += `<td>${v.days_requested}</td>`;

						strTable += '</tr>';

						k++;
					});
				} else {
					strTable = '<tr><td colspan="4">No record found</td></tr>';
				}

				$('#summaryData').html(strTable);
				$('#summaryData').show();
			} else if (response.status == '400') {
				$('#loading').hide();
				strTable += '<tr>';
				strTable += '<td colspan="4">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#summaryData').html(strTable);
				$('#summaryData').show();
			} else if (response.status == '401') {
				//missing parameters
				var strTable = '';
				$('#loading').hide();
				strTable += '<tr>';
				strTable += '<td colspan="4">Technical Error</td>';
				strTable += '</tr>';

				$('#summaryData').html(strTable);
				$('#summaryData').show();
			}

			$('#loading').hide();
		},

		error: function(response) {
			var strTable = '';
			$('#loading').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable +=
				'<td colspan="4"><strong class="text-danger">Connection error</strong></td>';
			strTable += '</tr>';

			$('#summaryData').html(strTable);
			$('#summaryData').show();
			$('#loading').hide();
		},
	});
}
