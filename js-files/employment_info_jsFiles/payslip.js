$(document).ready(() => {
	$('#slip_filter').on('click', () => {
		listPayslip(1);
	});
});
function listPayslip(page) {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	$('#list_slip_table').hide();
	$('#list_slip_loader').show();
	let limit = 10;
	let date_range = $('#payperiod_filter').val();
	axios
		.get(`${api_path}hrm/approve_employee_payslip`, {
			params: {
				employee_id: employee_id,
				date_range: date_range,
				page: page,
				limit: limit,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let slip_list;

			if (response.data.data.length > 0) {
				$(response.data.data).map((i, v) => {
					let arr = v.pay_period.split(' ');
					let start = moment(arr[0], 'YYYY-MM-DD').format('LL');
					let end = moment(arr[2], 'YYYY-MM-DD').format('LL');
					slip_list += `<tr class="even pointer" id="slip_row${v.pay_run_id}">`;
					slip_list += `<td>${v.pay_run_name}</td>`;
					slip_list += `<td>${start} - ${end}</td>`;
					slip_list += `<td><i onClick="viewslip(${v.pay_run_id})" class="fa fa-eye">View Payslip</i></td>`;
					// slip_list += `<td>
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
					// 			<li onClick="viewslip(${v.id})">
					// 				<a class="dropdown-item">
					// 					<i class="fa fa-pencil" /> Edit
					// 				</a>
					// 			</li>
					// 			<li onClick="deleteslip(${v.id})">
					// 				<a class="dropdown-item">
					// 					<i class="fa fa-trash" /> Delete
					// 				</a>
					// 			</li>
					// 		</ul>
					// 	</div></td>`;
					slip_list += `</tr>`;
					slip_list += `<tr id="slip_loader${v.pay_run_id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});

				$('#list_slip_body').html(slip_list);
				$('#list_slip_loader').hide();
				$('#list_slip_table').show();
			} else {
				$('#list_slip_body').html(`<tr><td colspan="3">No record found</td></tr>`);
				$('#list_slip_loader').hide();
				$('#list_slip_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_slip_loader').hide();
			$('#list_slip_table').show();
			$('#list_slip_body').html(`<tr><td colspan="3" style="color:red;">Error</td></tr>`);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function viewslip(id) {
	// $('#secret_emp_id').html(emp_id);
	let emp_id = '';
	$('#view_payslip_modal').modal('show');
	// showSalaryDetails(emp_id);
	// $('#add_creditComponent_btn').attr('data', emp_id);
	// $('#add_debitComponent_btn').attr('data', emp_id);
	// $('#debit_body').html('');
	// $('#credit_body').html('');
	// $('#credit_table').html('<tr><td colspan="3">No Salary Component Found</td></tr>');
	// $('#debit_table').html('<tr><td colspan="3">No Salary Component Found</td></tr>');
	var company_id = localStorage.getItem('company_id');
	let user_id = localStorage.getItem('user_id');
	// let employee_id = emp_id;

	$('#credit_loader2').show();
	$('#credit_body2').hide();
	$('#debit_loader2').show();
	$('#debit_body2').hide();
	// var page = 1;
	// var limit = 10;

	$.ajax({
		type: 'GET',
		dataType: 'json',
		url: api_path + 'hrm/get_single_employee_slip',
		data: {
			employee_id: emp_id,
			pay_run_id: id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			console.log(response);

			// $('#credit_loader').hide();
			// $('#debit_loader').hide();
			// $('#credit_body').show();
			// $('#debit_body').show();

			if (response.status == '200') {
				let debit_table = '';
				let credit_table = '';

				if (response.data) {
					$(response.data.company_salary).map((i, v) => {
						if (v.credit_or_debit == 'credit' || v.credit_or_debit == 'Credit') {
							if (v.pay_slip_is_checked == 'checked') {
								// credit_table += ` <tr>
								//                 <td>${v.breakdown_name}</td>
								//                 <td><input type="number" value="${v.pay_slip_amount}" class="credit_input all_input" data="${v.pay_slip_id}" data-val="${v.insert_id}" data-type="credit"  data-toggle="tooltip" title="${v.formula}"></td>
								//                 <td id="delCredDeb_${v.insert_id}" data="${v.pay_slip_id}" onClick="deleteBreakdown2(${v.insert_id})"><i class="fa fa-trash"></i></td>
								//             <tr>`;
								credit_table += `<tr>
                                                <td><strong>${v.breakdown_name}</strong> <span class="float-right">${v.pay_slip_amount}</span></td>
                                            </tr>`;
							}
						} else if (v.credit_or_debit == 'debit' || v.credit_or_debit == 'Debit') {
							if (v.pay_slip_is_checked == 'checked') {
								// debit_table += `<tr>
								//                 <td>${v.breakdown_name}</td>
								//                 <td><input type="number" value="${v.pay_slip_amount}" class="debit_input all_input" data="${v.pay_slip_id}" data-val="${v.insert_id}" data-type="debit" data-toggle="tooltip" title="${v.formula}"></td>
								//                 <td id="delCredDeb_${v.insert_id}" data="${v.pay_slip_id}" onClick="deleteBreakdown2(${v.insert_id})"><i class="fa fa-trash"></i></td>
								//             <tr>`;
								debit_table += `<tr>
                                                <td><strong>${v.breakdown_name}</strong> <span
                                                        class="float-right">${v.pay_slip_amount}</span></td>
                                            </tr>`;
							}
						}
					});
					let arr = response.data.pay_period.split(' ');
					let start = moment(arr[0], 'YYYY-MM-DD').format('LL');
					let end = moment(arr[1], 'YYYY-MM-DD').format('LL');
					let datm = moment(response.data.payment_date, 'YYYY-MM-DD').format('LL');
					$('#com_name').html(response.data.company_name);
					$('#emy_name').html(response.data.fullname);
					$('#depy_name').html(response.data.department);
					$('#joby_name').html(response.data.job_title);
					$('#banky_name').html(response.data.bank_name);
					$('#banky_no').html(response.data.bank_no);
					$('#pay_period_datey').html(`${start} - ${end}`);
					$('#pay_datey').html(datm);
					$('#gpay').html(`₦${numberWithCommas(response.data.salary)}`);
					$('#npay').html(`₦${numberWithCommas(response.net_pay)}`);
					// $('#total_credit').val(response.total_credit);
					// $('#net_payment').html(`₦${numberWithCommas(response.net_pay)}`);
					// $('#salary_amt').html(`₦${numberWithCommas(response.data.salary)}`);
					// $('#salary_type').val(response.data.earning_type);
				} else {
				}

				if (credit_table !== '') {
					$('#credit_table2').html(credit_table);
					$('#credit_loader2').hide();
					$('#credit_body2').show();
				} else {
					$('#credit_table2').html(
						'<tr><strong><td colspan="1">No Earnings</td></strong><tr></tr>',
					);
					$('#credit_loader2').hide();
					$('#credit_body2').show();
				}
				if (response.total_credit !== null) {
					$('#credit_table2').append(
						`<tr>
                    <td><strong>Total Earnings:</strong> <span class="float-right"><strong>₦${numberWithCommas(
						response.total_credit,
					)}</span></strong></td>
                    </tr>`,
					);
				} else {
					$('#credit_table2').append(
						`<tr>
                    <td><strong>Total Earnings:</strong> <span class="float-right"><strong>₦0</span></strong></td>
                    </tr>`,
					);
				}

				if (debit_table !== '') {
					$('#debit_table2').html(debit_table);
					$('#debit_loader2').hide();
					$('#debit_body2').show();
				} else {
					$('#debit_table2').html(
						'<tr><strong><td colspan="1">No Deductions</td></strong><tr></tr>',
					);
					$('#debit_loader2').hide();
					$('#debit_body2').show();
				}

				if (response.total_debit !== null) {
					$('#debit_table2').append(
						`<tr>
				    <td><strong>Total Deductions:</strong> <span class="float-right"><strong>₦${numberWithCommas(
						response.total_debit,
					)}</span></strong></td>
				    </tr>`,
					);
				} else {
					$('#debit_table2').append(
						`<tr>
				    <td><strong>Total Deductions:</strong> <span class="float-right"><strong>₦0</span></strong></td>
				    </tr>`,
					);
				}
			} else if (response.status == '400') {
				$('#credit_table2').append('<tr><td colspan="1">Error</td><tr></tr>');
				$('#debit_table2').append('<tr><td colspan="1">Error</td><tr></tr>');
			}
		},

		error: function(response) {
			$('#credit_table2').append('<tr><td colspan="1">Error</td><tr></tr>');
			$('#debit_table2').append('<tr><td colspan="1">Error</td><tr></tr>');
			console.log(response);
			$('#credit_loader2').hide();
			$('#debit_loader2').hide();
			$('#credit_body2').show();
			$('#debit_body2').show();
		},
	});
}
