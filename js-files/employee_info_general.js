$(document).ready(function() {
	fetch_employee_details();

	$('#payslip-tab').on('click', () => {
		if ($('#payslip-tab').hasClass('no')) {
			listPayslip(1);
			$('#payslip-tab').removeClass('no');
		}

		// init_echarts();
	});
	$('#salary-tab').on('click', () => {
		if ($('#salary-tab').hasClass('no')) {
			fetch_employee_view_details_salary_info();
			list_employment_payment_type();
			showBankDetails();
			showSalaryDetails();
			$('#salary-tab').removeClass('no');
		}
	});
	$('#leaves-tab').on('click', () => {
		// fetch_employee_view_details_leave_history();

		if ($('#leaves-tab').hasClass('no')) {
			list_employee_leave_history();
			// init_echartsleave();
			listLeaveGraph();
			listAllotDays();
			$('#leaves-tab').removeClass('no');
		}
	});
	// $('#job-title-history-tab').on('click', () => {
	// 	if ($('#job-title-history-tab').hasClass('no')) {
	// 		list_employee_position_history();
	// 		$('#job-title-history-tab').removeClass('no');
	// 	}
	// });
	$('#attendance-tab').on('click', () => {
		if ($('#attendance-tab').hasClass('no')) {
			list_employee_attendance();
			$('#attendance-tab').removeClass('no');
		}
	});
	$('#profile-tab').on('click', () => {
		if ($('#profile-tab').hasClass('no')) {
			showAdditionalInfo();
			listJobTitle();
			fetch_jobTitle();
			load_branch();
			load_employee_type();
			list_all_departments();
			listDepartment();
			fetch_workList();
			showEmployeeDataInfo();
			listWorkShift();

			$('#profile-tab').removeClass('no');
		}
	});
	$('#document-tab').on('click', () => {
		if ($('#document-tab').hasClass('no')) {
			list_doctype();
			list_employee_documents();

			$('#document-tab').removeClass('no');
		}
	});
	$('#essConnect-tab').on('click', () => {
		if ($('#essConnect-tab').hasClass('no')) {
			showConnectedInfo();

			$('#essConnect-tab').removeClass('no');
		}
	});

	$('#edit_basic_btn').on('click', () => {
		edit_employee();
	});
});

$('#edit_emp_date').datepicker({
	dateFormat: 'yy-mm-dd',
});

$('#edit_basic_DOB').datepicker({
	dateFormat: 'yy-mm-dd',
});

// salary info start
function fetch_employee_view_details_salary_info() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = ''; //pathArray[4].replace(/%20/g,' ');
	let user_id = localStorage.getItem('user_id');

	// alert(employee_id);
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/fetch_company_employee_profile',
		data: { employee_id: employee_id },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			// console.log(response);
			$('#page_loader').hide();
			$('#employee_details_display').show();

			var str = '';
			var str2 = '';
			var str3 = '';

			if (response.status == '200') {
				str2 +=
					'<a href="' +
					base_url +
					'employees"><button class="btn btn-default">Back</button></a>';
				str2 +=
					'<a href="' +
					base_url +
					'edit_salary_info?id=' +
					response.data.employee_id +
					'"><button class="btn btn-primary">Edit</button></a>';

				$('#profile_name').html(
					'<b>' + response.data.firstname + ' ' + response.data.lastname + '</b>',
				);

				str3 += '<div id="crop-avatar">';

				str3 +=
					'<img src="' +
					site_url +
					'/files/images/employee_images/mid_' +
					response.data.profile_picture +
					'" alt="...">';
				str3 += '</div>';

				str += '<li><i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'employee_info?id=' +
					response.data.employee_id +
					'">Profile</a></li>';

				str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_employment_info?id=' +
					response.data.employee_id +
					'">Employment Info</a></li>';

				str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_info?id=' +
					response.data.employee_id +
					'">Salary Info</a></li>';

				str += '<li><i class="fa fa-briefcase user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_history?id=' +
					response.data.employee_id +
					'">Payslips</a></li>';

				str += '<li><i class="fa fa-sticky-note user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_leave_history?id=' +
					response.data.employee_id +
					'">Leave History</a></li>';

				str += '<li><i class="fa fa-bars user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_position_history?id=' +
					response.data.employee_id +
					'">Job Title History</a></li>';

				str += '<li><i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'emp_documents?id=' +
					response.data.employee_id +
					'">Documents</a></li>';

				str += '<li><i class="fa fa-bell user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_attendance?id=' +
					response.data.employee_id +
					'">Attendance</a></li>';

				str += '<li>';
				str += '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_profile_pic?id=' +
					response.data.employee_id +
					'">Edit Profile Picture</a>';
				str += '</li>';

				$('#button_link').html(str2);
				$('#picture').html(str3);
				$('#profile_links').html(str);
				$('#profile_links').show();
			} else if (response.status == '400') {
				$('#page_loader').hide();
				$('#employee_details_display').hide();
				$('#employee_error_display').show();
			}
		},
		// objAJAXRequest, strError
		error: function(response) {
			$('#page_loader').hide();
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}
// salary info end

// payslip start
function list_of_salary_history(page) {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = ''; //pathArray[4].replace(/%20/g,' ');
	let user_id = localStorage.getItem('user_id');
	if (page == '') {
		var page = 1;
	}
	var limit = 5;

	$('#loading').show();
	$('#salaryHistoryData').html('');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/view_company_employee_salary_history',
		data: {
			// company_id: company_id,
			page: page,
			limit: limit,
			employee_id: employee_id,
			// user_id: user_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			console.log(response);
			$('#loading').hide();
			var strTable = '';

			if (response.status == '200') {
				if (response.data.length != 0) {
					var k = 1;
					$.each(response['data']['payment_history'], function(i, v) {
						strTable += '<tr>';

						strTable +=
							'<td>' +
							response['data']['payment_history'][i]['payment_code'] +
							'</td>';

						strTable +=
							'<td>' + response['data']['payment_history'][i]['date'] + '</td>';
						strTable +=
							'<td>' +
							response['data']['payment_history'][i]['payment_type'] +
							'</td>';
						strTable +=
							'<td>' +
							response['data']['payment_history'][i]['credit_debit'] +
							'</td>';
						strTable +=
							'<td>₦' + response['data']['payment_history'][i]['amount'] + '</td>';

						strTable += '</tr>';

						k++;
					});
				} else {
					strTable = '<tr><td colspan="5">No record.</td></tr>';
				}

				$('#pagination').twbsPagination({
					totalPages: Math.ceil(response.total_rows / limit),
					visiblePages: 10,
					onPageClick: function(event, page) {
						list_of_salary_history(page);
					},
				});

				$('#salaryHistoryData').html(strTable);
				$('#salaryHistoryData').show();
			} else if (response.status == '400') {
				$('#loading').hide();
				strTable += '<tr>';
				strTable += '<td colspan="5">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#salaryHistoryData').html(strTable);
				$('#salaryHistoryData').show();
			} else if (response.status == '401') {
				//missing parameters
				var strTable = '';
				$('#loading').hide();
				strTable += '<tr>';
				strTable += '<td colspan="5">Technical Error</td>';
				strTable += '</tr>';

				$('#salaryHistoryData').html(strTable);
				$('#salaryHistoryData').show();
			}

			$('#loading').hide();
		},

		error: function(response) {
			var strTable = '';
			$('#loading').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable +=
				'<td colspan="5"><strong class="text-danger">Connection error</strong></td>';
			strTable += '</tr>';

			$('#salaryHistoryData').html(strTable);
			$('#salaryHistoryData').show();
			$('#loading').hide();
		},
	});
}

function init_echarts() {
	if (typeof echarts === 'undefined') {
		return;
	}
	console.log('init_echarts');

	var theme = {
		color: [
			'#26B99A',
			'#34495E',
			'#BDC3C7',
			'#3498DB',
			'#9B59B6',
			'#8abb6f',
			'#759c6a',
			'#bfd3b7',
		],

		title: {
			itemGap: 8,
			textStyle: {
				fontWeight: 'normal',
				color: '#408829',
			},
		},

		dataRange: {
			color: [
				'#1f610a',
				'#97b58d',
			],
		},

		toolbox: {
			color: [
				'#408829',
				'#408829',
				'#408829',
				'#408829',
			],
		},

		tooltip: {
			backgroundColor: 'rgba(0,0,0,0.5)',
			axisPointer: {
				type: 'line',
				lineStyle: {
					color: '#408829',
					type: 'dashed',
				},
				crossStyle: {
					color: '#408829',
				},
				shadowStyle: {
					color: 'rgba(200,200,200,0.3)',
				},
			},
		},

		dataZoom: {
			dataBackgroundColor: '#eee',
			fillerColor: 'rgba(64,136,41,0.2)',
			handleColor: '#408829',
		},
		grid: {
			borderWidth: 0,
		},

		categoryAxis: {
			axisLine: {
				lineStyle: {
					color: '#408829',
				},
			},
			splitLine: {
				lineStyle: {
					color: [
						'#eee',
					],
				},
			},
		},

		valueAxis: {
			axisLine: {
				lineStyle: {
					color: '#408829',
				},
			},
			splitArea: {
				show: true,
				areaStyle: {
					color: [
						'rgba(250,250,250,0.1)',
						'rgba(200,200,200,0.1)',
					],
				},
			},
			splitLine: {
				lineStyle: {
					color: [
						'#eee',
					],
				},
			},
		},
		timeline: {
			lineStyle: {
				color: '#408829',
			},
			controlStyle: {
				normal: { color: '#408829' },
				emphasis: { color: '#408829' },
			},
		},

		k: {
			itemStyle: {
				normal: {
					color: '#68a54a',
					color0: '#a9cba2',
					lineStyle: {
						width: 1,
						color: '#408829',
						color0: '#86b379',
					},
				},
			},
		},
		map: {
			itemStyle: {
				normal: {
					areaStyle: {
						color: '#ddd',
					},
					label: {
						textStyle: {
							color: '#c12e34',
						},
					},
				},
				emphasis: {
					areaStyle: {
						color: '#99d2dd',
					},
					label: {
						textStyle: {
							color: '#c12e34',
						},
					},
				},
			},
		},
		force: {
			itemStyle: {
				normal: {
					linkStyle: {
						strokeColor: '#408829',
					},
				},
			},
		},
		chord: {
			padding: 4,
			itemStyle: {
				normal: {
					lineStyle: {
						width: 1,
						color: 'rgba(128, 128, 128, 0.5)',
					},
					chordStyle: {
						lineStyle: {
							width: 1,
							color: 'rgba(128, 128, 128, 0.5)',
						},
					},
				},
				emphasis: {
					lineStyle: {
						width: 1,
						color: 'rgba(128, 128, 128, 0.5)',
					},
					chordStyle: {
						lineStyle: {
							width: 1,
							color: 'rgba(128, 128, 128, 0.5)',
						},
					},
				},
			},
		},
		gauge: {
			startAngle: 225,
			endAngle: -45,
			axisLine: {
				show: true,
				lineStyle: {
					color: [
						[
							0.2,
							'#86b379',
						],
						[
							0.8,
							'#68a54a',
						],
						[
							1,
							'#408829',
						],
					],
					width: 8,
				},
			},
			axisTick: {
				splitNumber: 10,
				length: 12,
				lineStyle: {
					color: 'auto',
				},
			},
			axisLabel: {
				textStyle: {
					color: 'auto',
				},
			},
			splitLine: {
				length: 18,
				lineStyle: {
					color: 'auto',
				},
			},
			pointer: {
				length: '90%',
				color: 'auto',
			},
			title: {
				textStyle: {
					color: '#333',
				},
			},
			detail: {
				textStyle: {
					color: 'auto',
				},
			},
		},
		textStyle: {
			fontFamily: 'Arial, Verdana, sans-serif',
		},
	};

	//echart Bar

	if ($('#mainb').length) {
		var company_id = localStorage.getItem('company_id');
		// var pathArray = window.location.pathname.split( '/' );
		var employee_id = ''; //pathArray[4].replace(/%20/g,' ');
		let user_id = localStorage.getItem('user_id');
		var echartBar = echarts.init(document.getElementById('mainb'), theme);

		// $('#employee_details_display').hide();

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: api_path + 'hrm/view_employee_salary_history_for_graph',
			data: { employee_id: employee_id },
			headers: {
				Authorization: localStorage.getItem('token'),
			},
			timeout: 60000,

			success: function(response) {
				$('#employee_details_display').show();

				console.log(response);
				if (response.status == '200') {
					$('#graph_loader').hide();

					if (response.data.length != 0) {
						var list_of_names = [];
						var list_of_values = [];
						$(response.data.payment_history).each(function(index, value) {
							if (value.credit_debit == 'debit') {
								var the_amount = -value.amount;
							} else {
								var the_amount = value.amount;
							}

							list_of_names.push(value.name);
							list_of_values.push({ value: Number(the_amount), label: 'name' });
						});

						echartBar.setOption({
							title: {
								text: 'Employee',
								subtext: 'Salary History',
							},
							tooltip: {
								trigger: 'axis',
								axisPointer: {
									type: 'shadow',
								},
							},
							legend: {
								data: [
									'Income',
								],
							},
							toolbox: {
								show: false,
							},
							calculable: false,
							grid: {
								top: 80,
								bottom: 30,
							},
							xAxis: {
								type: 'value',
								position: 'top',
								splitLine: { lineStyle: { type: 'dashed' } },
							},
							yAxis: {
								type: 'category',
								axisLine: { show: false },
								axisLabel: { show: false },
								axisTick: { show: false },
								splitLine: { show: false },
								data: list_of_names,
							},
							series: [
								{
									name: 'name',
									type: 'bar',
									stack: 'name',
									label: {
										normal: {
											show: true,
											formatter: '{b}',
										},
									},
									data: list_of_values,
								},
							],
						});
					} else {
						//no data available
					}
				} else if (response.status == '400') {
					$('#graph_loader').hide();
					$('#no_recordpay').show();
				}
			},
			// objAJAXRequest, strError
			error: function(response) {
				$('#graph_loader').hide();
			},
		});
	}
}
// payslip end

// leave-history start

function fetch_employee_view_details_leave_history() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = ''; //pathArray[4].replace(/%20/g,' ');
	let user_id = localStorage.getItem('user_id');

	// alert(employee_id);
	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/fetch_company_employee_profile',
		data: { employee_id: employee_id },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			// console.log(response);
			$('#page_loader').hide();
			$('#employee_details_display').show();

			var str = '';
			var str2 = '';
			var str3 = '';

			if (response.status == '200') {
				str2 +=
					'<a href="' +
					base_url +
					'employees"><button class="btn btn-default">Back</button></a>';
				str2 +=
					'<a href="' +
					base_url +
					'edit_job_titles?id=' +
					response.data.employee_id +
					'"><button class="btn btn-primary">Edit</button></a>';

				$('#profile_name').html(
					'<b>' + response.data.firstname + ' ' + response.data.lastname + '</b>',
				);

				str3 += '<div id="crop-avatar">';

				str3 +=
					'<img src="' +
					site_url +
					'/files/images/employee_images/mid_' +
					response.data.profile_picture +
					'" alt="...">';
				str3 += '</div>';

				str += '<li><i class="fa fa-map-marker user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'employee_info?id=' +
					response.data.employee_id +
					'">Profile</a></li>';

				str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_employment_info?id=' +
					response.data.employee_id +
					'">Employment Info</a></li>';

				str += '<li><i class="fa fa-building user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_info?id=' +
					response.data.employee_id +
					'">Salary Info</a></li>';

				str += '<li><i class="fa fa-briefcase user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_salary_history?id=' +
					response.data.employee_id +
					'">Payslips</a></li>';

				str += '<li><i class="fa fa-sticky-note user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_leave_history?id=' +
					response.data.employee_id +
					'">Leave History</a></li>';

				str += '<li><i class="fa fa-bars user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_position_history?id=' +
					response.data.employee_id +
					'">Job Title History</a></li>';

				str += '<li><i class="fa fa-folder user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'emp_documents?id=' +
					response.data.employee_id +
					'">Documents</a></li>';

				str += '<li><i class="fa fa-bell user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'view_attendance?id=' +
					response.data.employee_id +
					'">Attendance</a></li>';

				str += '<li>';
				str += '<i class="fa fa-pencil user-profile-icon"></i>&nbsp;&nbsp;';
				str +=
					'<a href="' +
					base_url +
					'edit_profile_pic?id=' +
					response.data.employee_id +
					'">Edit Profile Picture</a>';
				str += '</li>';

				$('#button_link').html(str2);
				$('#picture').html(str3);
				$('#profile_links').html(str);
				$('#profile_links').show();
			} else if (response.status == '400') {
				$('#page_loader').hide();
				$('#employee_details_display').hide();
				$('#employee_error_display').show();
			}
		},
		// objAJAXRequest, strError
		error: function(response) {
			$('#page_loader').hide();
			$('#employee_details_display').hide();
			$('#employee_error_display').show();
		},
	});
}

function init_echartsleave() {
	if (typeof echarts === 'undefined') {
		return;
	}
	console.log('init_echarts');

	var theme = {
		color: [
			'#26B99A',
			'#34495E',
			'#BDC3C7',
			'#3498DB',
			'#9B59B6',
			'#8abb6f',
			'#759c6a',
			'#bfd3b7',
		],

		title: {
			itemGap: 8,
			textStyle: {
				fontWeight: 'normal',
				color: '#408829',
			},
		},

		dataRange: {
			color: [
				'#1f610a',
				'#97b58d',
			],
		},

		toolbox: {
			color: [
				'#408829',
				'#408829',
				'#408829',
				'#408829',
			],
		},

		tooltip: {
			backgroundColor: 'rgba(0,0,0,0.5)',
			axisPointer: {
				type: 'line',
				lineStyle: {
					color: '#408829',
					type: 'dashed',
				},
				crossStyle: {
					color: '#408829',
				},
				shadowStyle: {
					color: 'rgba(200,200,200,0.3)',
				},
			},
		},

		dataZoom: {
			dataBackgroundColor: '#eee',
			fillerColor: 'rgba(64,136,41,0.2)',
			handleColor: '#408829',
		},
		grid: {
			borderWidth: 0,
		},

		categoryAxis: {
			axisLine: {
				lineStyle: {
					color: '#408829',
				},
			},
			splitLine: {
				lineStyle: {
					color: [
						'#eee',
					],
				},
			},
		},

		valueAxis: {
			axisLine: {
				lineStyle: {
					color: '#408829',
				},
			},
			splitArea: {
				show: true,
				areaStyle: {
					color: [
						'rgba(250,250,250,0.1)',
						'rgba(200,200,200,0.1)',
					],
				},
			},
			splitLine: {
				lineStyle: {
					color: [
						'#eee',
					],
				},
			},
		},
		timeline: {
			lineStyle: {
				color: '#408829',
			},
			controlStyle: {
				normal: { color: '#408829' },
				emphasis: { color: '#408829' },
			},
		},

		k: {
			itemStyle: {
				normal: {
					color: '#68a54a',
					color0: '#a9cba2',
					lineStyle: {
						width: 1,
						color: '#408829',
						color0: '#86b379',
					},
				},
			},
		},
		map: {
			itemStyle: {
				normal: {
					areaStyle: {
						color: '#ddd',
					},
					label: {
						textStyle: {
							color: '#c12e34',
						},
					},
				},
				emphasis: {
					areaStyle: {
						color: '#99d2dd',
					},
					label: {
						textStyle: {
							color: '#c12e34',
						},
					},
				},
			},
		},
		force: {
			itemStyle: {
				normal: {
					linkStyle: {
						strokeColor: '#408829',
					},
				},
			},
		},
		chord: {
			padding: 4,
			itemStyle: {
				normal: {
					lineStyle: {
						width: 1,
						color: 'rgba(128, 128, 128, 0.5)',
					},
					chordStyle: {
						lineStyle: {
							width: 1,
							color: 'rgba(128, 128, 128, 0.5)',
						},
					},
				},
				emphasis: {
					lineStyle: {
						width: 1,
						color: 'rgba(128, 128, 128, 0.5)',
					},
					chordStyle: {
						lineStyle: {
							width: 1,
							color: 'rgba(128, 128, 128, 0.5)',
						},
					},
				},
			},
		},
		gauge: {
			startAngle: 225,
			endAngle: -45,
			axisLine: {
				show: true,
				lineStyle: {
					color: [
						[
							0.2,
							'#86b379',
						],
						[
							0.8,
							'#68a54a',
						],
						[
							1,
							'#408829',
						],
					],
					width: 8,
				},
			},
			axisTick: {
				splitNumber: 10,
				length: 12,
				lineStyle: {
					color: 'auto',
				},
			},
			axisLabel: {
				textStyle: {
					color: 'auto',
				},
			},
			splitLine: {
				length: 18,
				lineStyle: {
					color: 'auto',
				},
			},
			pointer: {
				length: '90%',
				color: 'auto',
			},
			title: {
				textStyle: {
					color: '#333',
				},
			},
			detail: {
				textStyle: {
					color: 'auto',
				},
			},
		},
		textStyle: {
			fontFamily: 'Arial, Verdana, sans-serif',
		},
	};

	//echart Bar

	if ($('#leave-history').length) {
		var company_id = localStorage.getItem('company_id');
		// var pathArray = window.location.pathname.split( '/' );
		var employee_id = ''; //pathArray[4].replace(/%20/g,' ');
		let user_id = localStorage.getItem('user_id');
		var echartBar = echarts.init(document.getElementById('leave-history'), theme);

		// $('#employee_details_display').hide();

		$.ajax({
			type: 'POST',
			dataType: 'json',
			url: api_path + 'hrm/view_employee_leave_history_for_graph',
			data: { employee_id: employee_id },
			headers: {
				Authorization: localStorage.getItem('token'),
			},
			timeout: 60000,

			success: function(response) {
				$('#graph_loading').hide();
				$('#employee_details_display').show();

				console.log(response);
				if (response.status == '200') {
					if (response.data.length != 0) {
						var list_of_names = [];
						var list_of_value_used = [];
						var list_of_values_remaining = [];
						$(response.data.leave_history).each(function(index, value) {
							list_of_names.push(value.name);
							list_of_value_used.push({
								value: Number(value.real_days_used),
								label: 'name',
							});
							list_of_values_remaining.push({
								value: Number(value.remaining_days),
								label: 'name',
							});
						});

						echartBar.setOption({
							title: {
								text: 'Employee',
								subtext: 'Leave History',
							},
							tooltip: {
								trigger: 'axis',
								axisPointer: {
									type: 'shadow',
								},
							},
							legend: {
								data: [
									'Used Days',
									'Remaining Days',
								],
							},
							grid: {
								left: '3%',
								right: '4%',
								bottom: '3%',
								containLabel: true,
							},
							xAxis: {
								type: 'value',
							},
							yAxis: {
								type: 'category',
								data: list_of_names,
							},
							series: [
								{
									name: 'Used Days',
									type: 'bar',
									stack: 'name',
									label: {
										normal: {
											show: true,
											position: 'insideRight',
										},
									},
									data: list_of_value_used,
								},
								{
									name: 'Remaining Days',
									type: 'bar',
									stack: 'name',
									label: {
										normal: {
											show: true,
											position: 'insideRight',
										},
									},
									data: list_of_values_remaining,
								},
							],
						});
					}
				} else if (response.status == '400') {
					// alert('error');
					$('#graph_loading').hide();
					$('#no_record').show();
				}
			},
			// objAJAXRequest, strError
			error: function(response) {
				// alert('error');
				$('#graph_loading').hide();
				// $('#employee_details_display').hide();
				// $('#employee_error_display').show();
			},
		});
	}
}

function isEmptyInput(first) {
	let isEmpty = false;
	$(first).each(function() {
		var input = $.trim($(this).val());
		if (input.length === 0 || input === '0') {
			$(this).addClass('has-error');
			isEmpty = true;
		} else {
			$(this).removeClass('has-error');
			// isEmpty = false;
		}
	});
	if (isEmpty === true) {
		return false;
	} else {
		return true;
	}
}
// leave history end

// jobtitle history start
// function list_employee_position_history() {
// 	var company_id = localStorage.getItem('company_id');
// 	// var pathArray = window.location.pathname.split( '/' );
// 	var employee_id = localStorage.getItem('user_id'); //pathArray[4].replace(/%20/g,' ');

// 	$('#loading_job').show();
// 	// $("#positionHistoryData").html('');

// 	$.ajax({
// 		type: 'POST',
// 		dataType: 'json',
// 		url: api_path + 'hrm/list_company_employee_positions_history',
// 		data: { company_id: company_id, employee_id: employee_id },
// 		timeout: 60000,

// 		success: function(response) {
// 			console.log(response);
// 			$('#loading_job').hide();
// 			var strTable = '';

// 			if (response.status == '200') {
// 				if (response.data.length > 0) {
// 					var k = 1;
// 					$.each(response['data'], function(i, v) {
// 						strTable += '<tr>';

// 						strTable += '<td>' + response['data'][i]['position_name'] + '</td>';

// 						strTable += '<td>' + response['data'][i]['from_date'] + '</td>';
// 						strTable += '<td>' + response['data'][i]['to_date'] + '</td>';

// 						strTable += '</tr>';

// 						k++;
// 					});
// 				} else {
// 					strTable = '<tr><td colspan="3">No record.</td></tr>';
// 				}

// 				$('#positionHistoryData').html(strTable);
// 				$('#positionHistoryData').show();
// 			} else if (response.status == '400') {
// 				$('#loading_job').hide();
// 				strTable += '<tr>';
// 				strTable += '<td colspan="3">' + response.msg + '</td>';
// 				strTable += '</tr>';

// 				$('#positionHistoryData').html(strTable);
// 				$('#positionHistoryData').show();
// 			} else if (response.status == '401') {
// 				//missing parameters
// 				var strTable = '';
// 				$('#loading_job').hide();
// 				strTable += '<tr>';
// 				strTable += '<td colspan="3">Technical Error</td>';
// 				strTable += '</tr>';

// 				$('#positionHistoryData').html(strTable);
// 				$('#positionHistoryData').show();
// 			}

// 			$('#loading_job').hide();
// 		},

// 		error: function(response) {
// 			var strTable = '';
// 			$('#loading_job').hide();
// 			// alert(response.msg);
// 			strTable += '<tr>';
// 			strTable += '<td colspan="3">Connection error</td>';
// 			strTable += '</tr>';

// 			$('#documentData').html(strTable);
// 			$('#documentData').show();
// 			$('#loading_job').hide();
// 		},
// 	});
// }
// job title history end

// attendance start

// function list_employee_attendance() {
// 	var company_id = localStorage.getItem('company_id');
// 	// var pathArray = window.location.pathname.split( '/' );
// 	var employee_id = ''; //pathArray[4].replace(/%20/g,' ');
// 	let user_id = localStorage.getItem('user_id');

// 	var page = 1;
// 	var limit = 10;

// 	$('#loading_atten').show();
// 	$('#attData').html('');

// 	$.ajax({
// 		type: 'POST',
// 		dataType: 'json',
// 		url: api_path + 'hrm/list_of_employee_attendances',
// 		data: {
// 			company_id: company_id,
// 			employee_id: employee_id,
// 			page: page,
// 			limit: limit,
// 			user_id: user_id,
// 		},
// 		timeout: 60000,

// 		success: function(response) {
// 			console.log(response);
// 			$('#loading_atten').hide();
// 			var strTable = '';

// 			if (response.status == '200') {
// 				if (response.data.length > 0) {
// 					var k = 1;
// 					$.each(response['data'], function(i, v) {
// 						strTable += '<tr>';

// 						strTable += '<td width="25%">' + response['data'][i]['date'] + '</td>';
// 						strTable += '<td>' + response['data'][i]['clock_in'] + '</td>';
// 						strTable += '<td>' + response['data'][i]['clock_out'] + '</td>';
// 						strTable += '<td>' + response['data'][i]['work_hours'] + '</td>';

// 						strTable += '<td></td>';

// 						strTable += '</tr>';

// 						k++;
// 					});
// 				} else {
// 					strTable = '<tr><td colspan="5">No record.</td></tr>';
// 				}

// 				$('#attData').html(strTable);
// 				$('#attData').show();
// 			} else if (response.status == '400') {
// 				$('#loading_atten').hide();
// 				strTable += '<tr>';
// 				strTable += '<td colspan="5">' + response.msg + '</td>';
// 				strTable += '</tr>';

// 				$('#attData').html(strTable);
// 				$('#attData').show();
// 			} else if (response.status == '401') {
// 				//missing parameters
// 				var strTable = '';
// 				$('#loading_atten').hide();
// 				strTable += '<tr>';
// 				strTable += '<td colspan="5">Technical Error</td>';
// 				strTable += '</tr>';

// 				$('#attData').html(strTable);
// 				$('#attData').show();
// 			}

// 			$('#loading_atten').hide();
// 		},

// 		error: function(response) {
// 			var strTable = '';
// 			$('#loading_atten').hide();
// 			// alert(response.msg);
// 			strTable += '<tr>';
// 			strTable +=
// 				'<td colspan="5"><strong class="text-danger">Connection error!</strong></td>';
// 			strTable += '</tr>';

// 			$('#attData').html(strTable);
// 			$('#attData').show();
// 			$('#loading_atten').hide();
// 		},
// 	});
// }
// attendance end

// documents start

// documents end
function load_employee_type() {
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		url: api_path + 'hrm/list_of_company_employment_types',
		type: 'POST',
		data: {},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		dataType: 'json',

		success: function(response) {
			// $('#page_loader').hide();
			// $('#employee_details_display').show();

			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['type_id'] +
					'">' +
					response['data'][i]['type_name'] +
					'</option>';

				emp_type = response['data'][i]['type_id'];
			});
			$('#edit_emp_type').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			// $('#page_loader').hide();
			// $('#employee_details_display').hide();
			// $('#employee_error_display').show();
		},
	});
}

function load_branch() {
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		url: api_path + 'hrm/list_of_company_branches',
		type: 'POST',
		data: {},
		dataType: 'json',
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			// $('#employee_details_display').show();

			var options = '';

			$.each(response['data'], function(i, v) {
				options +=
					'<option value="' +
					response['data'][i]['branch_id'] +
					'">' +
					response['data'][i]['branch_name'] +
					'</option>';

				bra_type = response['data'][i]['branch_id'];
			});
			$('#edit_emp_branch').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			// $('#page_loader').hide();
			// $('#employee_details_display').hide();
			// $('#employee_error_display').show();
		},
	});
}

function list_employee_position_history() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = ''; //pathArray[4].replace(/%20/g,' ');
	let user_id = localStorage.getItem('user_id');

	$('#job_title_loader').show();
	// $("#positionHistoryData").html('');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_company_employee_positions_history',
		data: { employee_id: employee_id },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			console.log(response);
			$('#job_title_loader').hide();
			var strTable = '';

			if (response.status == '200') {
				if (response.data.length > 0) {
					var k = 1;
					$.each(response['data'], function(i, v) {
						strTable += '<tr>';

						strTable += `<td>${v.position_name} <span class="greent_${i}_trial"></span></td>`;

						strTable += '<td>' + response['data'][i]['from_date'] + '</td>';
						strTable += '<td>' + response['data'][i]['to_date'] + '</td>';
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

						k++;
					});
				} else {
					strTable = '<tr><td colspan="3">No record.</td></tr>';
				}

				$('#positionHistoryData').html(strTable);
				$('#positionHistoryData').show();
			} else if (response.status == '400') {
				$('#job_title_loader').hide();
				strTable += '<tr>';
				strTable += '<td colspan="3">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#positionHistoryData').html(strTable);
				$('#positionHistoryData').show();
			} else if (response.status == '401') {
				//missing parameters
				var strTable = '';
				$('#job_title_loader').hide();
				strTable += '<tr>';
				strTable += '<td colspan="3">Technical Error</td>';
				strTable += '</tr>';

				$('#positionHistoryData').html(strTable);
				$('#positionHistoryData').show();
			}

			$('#job_title_loader').hide();
		},

		error: function(response) {
			var strTable = '';
			$('#job_title_loader').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable += '<td colspan="3">Connection error</td>';
			strTable += '</tr>';

			// $('#documentData').html(strTable);
			// $('#documentData').show();
			$('#positionHistoryData').html(strTable);
			$('#positionHistoryData').show();
			$('#job_title_loader').hide();
		},
	});
}

function toggleStuffs(elem) {
	$(elem).toggle();
}

function list_all_departments() {
	var company_id = localStorage.getItem('company_id');

	$.ajax({
		url: api_path + 'hrm/list_of_company_departments',
		type: 'POST',
		data: { page: 1, limit: 100 },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		dataType: 'json',

		success: function(response) {
			// console.log(response);
			// $('#employee_details_display').show();
			if (response.status == 200 || response.status == 201) {
				var options = '';

				$.each(response['data'], function(i, v) {
					options +=
						'<option value="' +
						response['data'][i]['department_id'] +
						'">' +
						response['data'][i]['department_name'] +
						'</option>';
				});
				$('#edit_dept_name').append(options);
				$('#dept_name').append(options);
			} else {
				console.log(response);
				$('#edit_dept_name').append(`<option>Error</option>`);
				$('#dept_name').append(`<option>Error</option>`);
			}
		},
		// jqXHR, textStatus, errorThrown
		error(response) {
			console.log(response);
			$('#edit_dept_name').append(`<option>Error</option>`);
			$('#dept_name').append(`<option>Error</option>`);
			// $('#employee_details_display').hide();
			// $('#employee_error_display').show();
		},
	});
}

// basic info start

function viewBasicInfo() {
	$('#edit_basic_error').html('');
	$('#edit_basic_btn').hide();
	$('#edit_basic_loader').show();
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = ''; //pathArray[4].replace(/%20/g,' ');
	let user_id = localStorage.getItem('user_id');

	$.ajax({
		type: 'GET',
		dataType: 'json',
		url: api_path + 'hrm/new_employee_info',
		data: { employee_id: employee_id },
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		// timeout: 60000,

		success: function(response) {
			if (response.status == '200') {
				$('#edit_basic_firstname').val(response.data.employee_data.firstname);
				$('#edit_basic_lastname').val(response.data.employee_data.lastname);
				$('#edit_basic_gender').val(response.data.employee_data.gender);
				$('#edit_basic_middlename').val(response.data.employee_data.middlename);
				$('#edit_basic_DOB').val(response.data.employee_data.dob);
				$('#edit_basic_marital_status').val(response.data.employee_data.marital_status);
				$('#edit_basic_phone').val(response.data.employee_data.phone);
				$('#edit_basic_address').val(response.data.employee_data.residential_address);
				$('#edit_basic_email').val(response.data.employee_data.email);
				$('#edit_basic_religion').val(response.data.employee_data.religion);
				$('#edit_basic_next_of_kin').val(response.data.employee_data.next_of_kin);
				$('#edit_basic_status').val(response.data.employee_data.active_status);

				$('#edit_basic_loader').hide();
				$('#edit_basic_btn').show();
			} else if (response.status == '400') {
				$('#edit_basic_loader').hide();
				$('#edit_basic_btn').show();

				$('#edit_basic_error').html(response);
			}
		},
		// objAJAXRequest, strError
		error: function(response) {
			$('#edit_basic_loader').hide();
			$('#edit_basic_btn').show();

			$('#edit_basic_error').html(response);
		},
	});
}

function edit_employee() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = ''; //pathArray[3].replace(/%20/g,' ');
	// let user_id = localStorage.getItem('user_id');
	// var employment_type = $('#employment_type').val();
	var firstname = $('#edit_basic_firstname').val();
	var lastname = $('#edit_basic_lastname').val();
	var middlename = $('#edit_basic_middlename').val();
	// var employment_date = $('#employment_date').val();
	var email = $('#edit_basic_email').val();
	// var position = $('#position').val();
	var dob = $('#edit_basic_DOB').val();
	var gender = $('#edit_basic_gender').val();
	var religion = $('#edit_basic_religion').val();
	var phone = $('#edit_basic_phone').val();
	var marital_status = $('#edit_basic_marital_status').val();
	var residential_address = $('#edit_basic_address').val();
	var next_of_kin = $('#edit_basic_next_of_kin').val();
	var status = $('#edit_basic_status').val();
	var user_id = localStorage.getItem('user_id');

	$('#edit_basic_btn').hide();
	$('#edit_basic_loader').show();
	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'hrm/edit_company_employee_profile',
		data: {
			firstname: firstname,
			lastname: lastname,
			middlename: middlename,
			email: email,
			// company_id: company_id,
			employee_id: employee_id,
			// user_id: user_id,
			gender: gender,
			religion: religion,
			phone: phone,
			residential_address: residential_address,
			marital_status: marital_status,
			next_of_kin: next_of_kin,
			dob: dob,
			status: status,
			// user_id: user_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			$('#employee_details_display').show();
			if (response.status == '200') {
				// $('#modal_update').modal('show');
				$('#edit_basic_modal').modal('hide');
				$('#mod_body').html('Basic Info Edit Successful');
				$('#successModal').modal('show');
				fetch_employee_details();
				$('#edit_basic_modal').on('hidden.bs.modal', function() {
					// do something…
					// window.location.reload();
					// window.location.href = base_url+"/erp/hrm/employees";

					$('#edit_basic_firstname').val('');
					$('#edit_basic_lastname').val('');
					$('#edit_basic_middlename').val('');
					$('#edit_basic_email').val('');
					$('#edit_basic_DOB').val('');
					$('#edit_basic_gender').val('');
					$('#edit_basic_religion').val('');
					$('#edit_basic_phone').val('');
					$('#edit_basic_marital_status').val('');
					$('#edit_basic_address').val('');
					$('#edit_basic_next_of_kin').val('');
					$('#edit_basic_status').val('');
				});
			} else if (response.status == '400') {
				// coder error message

				$('#edit_basic_error').html('Technical Error. Please try again later.');
			} else if (response.status == '401') {
				//user error message

				$('#edit_basic_error').html(response.msg);
			}

			$('#edit_basic_loader').hide();
			$('#edit_basic_btn').show();
		},
		// objAJAXRequest, strError
		error: function(response) {
			$('#edit_basic_loader').hide();
			$('#edit_basic_btn').show();
			$('#edit_basic_error').html(response.msg);
			// $('#update_emp').show();
			// $('#update_loader').hide();
			// $('#update_error').html("Connection Error.");
		},
	});
}

Dropzone.options.employeepictureform = {
	maxFiles: 1,
	accept: function(file, done) {
		if (file.type != 'image/jpeg' && file.type != 'image/png' && file.type != 'image/gif') {
			alert('You are allowed to drag only images');
		} else {
			done();
		}
	},
	init: function() {
		this.on('maxfilesexceeded', function(file) {
			alert('No more files please!');
		});

		// this.on("sending", function(file, xhr, data) {
		//     data.append("company_id", $.session.get('id'));
		// });

		this.on('sending', function(file, xhr, formData) {
			formData.append('company_id', localStorage.getItem('company_id'));

			// var pathArray = window.location.pathname.split( '/' );
			// var employment_type_id = $.urlParam('id');
			formData.append('employee_id', $.urlParam('id'));
		});
	},
	success: function(file, response) {
		// var obj = jQuery.parseJSON(response);
		// if (obj.status == '200') {
		// 	$('#pflpct').attr('src', '');
		// 	$('#pflpct').attr(
		// 		'src',
		// 		site_url +
		// 			'/files/images/employee_images/mid_' +
		// 			obj.data.image_name +
		// 			'?t=' +
		// 			new Date().getTime(),
		// 	);
		// 	$('#pflpct').attr('width', '250px');
		// }
		// console.log(obj);

		this.on('complete', function(file) {
			this.removeAllFiles();
		});

		$('#edit_proPic_modal').modal('hide');
		$('#mod_body').html('Image Upload Successful');
		$('#successModal').modal('show');
		fetch_employee_details();
	},
};
// basic info end
