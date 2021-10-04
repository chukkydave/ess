$(document).ready(function() {
	listPayRunHistory(1);

	let url = window.location.href;
	let params = new URL(url).searchParams;
	let statusi = params.get('status');

	if (statusi.toLocaleLowerCase() === 'pending') {
		$('#buttons_section').show();
	}

	$('input#date_range').daterangepicker({
		autoUpdateInput: false,
	});

	load_employee();

	$('input#date_range').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(
			picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'),
		);
	});

	$('#pay_dates_btn').on('click', addPayDates);
	$('#all_input').keyup(function(event) {
		// skip for arrow keys
		if (event.which >= 37 && event.which <= 40) return;

		// format number
		$(this).val(function(index, value) {
			return value.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
		});
	});
	$('#add_credit').on('click', () => {
		$('#credit_display').toggle();
	});

	$('#add_debit').on('click', () => {
		$('#debit_display').toggle();
	});
	$('#add_creditComponent_btn').on('click', () => {
		let cred_arr = [];
		$('.crediter').map((i, v) => {
			if ($(v).is(':checked')) {
				cred_arr.push($(v).val());
			}
		});

		if (cred_arr.length == 0) {
			alert('No Component Selected');
		} else {
			addCreditComponent();
		}
	});

	$('#add_debitComponent_btn').on('click', () => {
		let deb_arr = [];
		$('.debiter').map((i, v) => {
			if ($(v).is(':checked')) {
				deb_arr.push($(v).val());
			}
		});

		if (deb_arr.length == 0) {
			alert('No Component Selected');
		} else {
			addDebitComponent();
		}
	});
	$(document).on('keyup', '.all_input', addCreditInput);
	$(document).on('change', '.all_input', () => {
		$('#save_pay').show();
	});
	$('#save_pay').on('click', saveSalaryBreakdown);
	$('#add_apprvoer').on('click', addApprovals);
	$('#decline_btnn').on('click', HRDecline);
	$('#approve_btnn').on('click', HRApprove);
	$('#add_appv').on('click', () => {
		$('#appv_display').toggle();
	});

	if (window.navigator.userAgent.indexOf('Trident') >= 0) {
		$(function() {
			// Pointer events in IE10, IE11 can be handled as mousedown.
			$(document).on('mousedown', '.all_input', function() {
				// Only fire the change event if the input is indeterminate.
				if (this.indeterminate) {
					$(this).trigger('change');
				}
			});
		});
	}
	// $('.js-example-basic-single').select2();
	// listApprovers();
});

function listPayRunHistory(page) {
	let company_id = localStorage.getItem('company_id');
	// let id = window.location.search.split('=')[1];
	let url = window.location.href;
	let params = new URL(url).searchParams;
	let id = params.get('id');
	$('#list_payrun_table').hide();
	$('#list_payrun_loader').show();
	$('#list_payrun_table2').hide();
	$('#list_payrun_loader2').show();
	$('#list_payrun_table3').hide();
	$('#list_payrun_loader3').show();
	let limit = 10;
	// let page = 1;
	axios
		.get(`${api_path}hrm/single_pay_run`, {
			params: {
				// company_id: company_id,
				pay_run_id: id,
				page: page,
				limit: limit,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let statuslo;
			let payrun_list;
			let payrun_list2;
			let payrun_list3;
			let payrun_list4;
			const {
				employee,
				schedule_name,
				is_pay_run_active,
				pay_date,
				pay_period_start,
				pay_period_end,
				pay_schedule_id,
				pay_run_name,
			} = response.data.data;
			if (is_pay_run_active == 'active') {
				statuslo = 'Active';
				$('#payrun_statuslo').css({ 'background-color': '#337ab7', color: 'white' });
				$('#whole_loader').hide();
				$('#first_part').show();
			} else {
				statuslo = 'Approved';
				$('#payrun_statuslo').css({ 'background-color': '#5cb85c', color: 'white' });
				$('#whole_loader').hide();
				$('#second_part').show();
			}
			if (employee.length > 0) {
				let grossArr = [];
				let netArr = [];
				let taxArr = [];
				let deducArr = [];

				$('#secret_sche_id').html(pay_schedule_id);
				$(employee).map((i, v) => {
					let net;
					let tax;
					let deduc;
					let gross;
					if (
						v.net_pay == '0' ||
						v.net_pay == '' ||
						v.net_pay == null ||
						v.net_pay == NaN ||
						v.net_pay == '0.00'
					) {
						net = 0;
					} else {
						net = parseFloat(v.net_pay);
					}
					if (
						v.salary == '0' ||
						v.salary == '' ||
						v.salary == null ||
						v.salary == NaN ||
						v.salary == '0.00'
					) {
						gross = 0;
					} else {
						gross = parseFloat(v.salary);
					}
					if (
						v.deduction == '0' ||
						v.deduction == '' ||
						v.deduction == null ||
						v.deduction == NaN ||
						v.deduction == '0.00'
					) {
						deduc = 0;
					} else {
						deduc = parseFloat(v.deduction);
					}
					if (
						v.tax == '0' ||
						v.tax == '' ||
						v.tax == null ||
						v.tax == NaN ||
						v.tax == '0.00'
					) {
						tax = 0;
					} else {
						tax = parseFloat(v.tax);
					}
					payrun_list += `<tr class="even pointer" id="spay_row${v.employee_id}">`;
					payrun_list += `<td>${v.fullname}<br>${v.workshift}</td>`;
					payrun_list += `<td>${v.department}<div>${v.job_title}</div></td>`;
					payrun_list += `<td>${formatToCurrency(parseInt(v.salary))}</td>`;
					payrun_list += `<td>${formatToCurrency(parseInt(deduc))}</td>`;
					payrun_list += `<td>${formatToCurrency(parseInt(tax))}</td>`;
					payrun_list += `<td>${formatToCurrency(parseInt(v.net_pay))}</td>`;
					payrun_list += `<td onClick="getPaySlipDetails(${v.employee_id})"><i class="fas fa-money-check-alt"></i></td>`;
					payrun_list += `</tr>`;
					payrun_list += `<tr id="spay_loader${v.employee_id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;

					netArr.push(net);
					grossArr.push(gross);
					deducArr.push(deduc);
					taxArr.push(tax);

					payrun_list2 += `<tr class="even pointer" id="spay_row${v.employee_id}">`;
					payrun_list2 += `<td>${v.fullname}<br>${v.workshift}</td>`;
					payrun_list2 += `<td>${v.department}<div>${v.job_title}</div></td>`;
					payrun_list2 += `<td>${formatToCurrency(parseInt(v.salary))}</td>`;
					payrun_list2 += `<td>${formatToCurrency(parseInt(deduc))}</td>`;
					payrun_list2 += `<td>${formatToCurrency(parseInt(tax))}</td>`;
					payrun_list2 += `<td>${formatToCurrency(parseInt(v.net_pay))}</td>`;
					payrun_list2 += `<td onClick="getPaySlipDetails2(${v.employee_id})"><i class="fas fa-money-check-alt"></i></td>`;
					payrun_list2 += `</tr>`;
					payrun_list2 += `<tr id="spay_loader${v.employee_id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;

					payrun_list3 += `<tr class="even pointer" id="spay_row${v.employee_id}">`;
					payrun_list3 += `<td>${v.fullname}<br>${v.workshift}</td>`;
					payrun_list3 += `<td>${v.department}<div>${v.job_title}</div></td>`;
					payrun_list3 += `<td>${formatToCurrency(parseInt(v.salary))}</td>`;
					payrun_list3 += `<td>${formatToCurrency(parseInt(deduc))}</td>`;
					payrun_list3 += `<td>${formatToCurrency(parseInt(tax))}</td>`;
					payrun_list3 += `<td>${formatToCurrency(parseInt(v.net_pay))}</td>`;
					payrun_list3 += `<td onClick="getPaySlipDetails2(${v.employee_id})"><i class="fas fa-money-check-alt"></i></td>`;
					payrun_list3 += `</tr>`;
					payrun_list3 += `<tr id="spay_loader${v.employee_id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;

					payrun_list4 += `<tr class="even pointer" id="spay_row${v.employee_id}">`;
					payrun_list4 += `<td>${v.fullname}<br>${v.workshift}</td>`;
					payrun_list4 += `<td>${v.department}<div>${v.job_title}</div></td>`;
					payrun_list4 += `<td>${formatToCurrency(parseInt(v.salary))}</td>`;
					payrun_list4 += `<td>${formatToCurrency(parseInt(deduc))}</td>`;
					payrun_list4 += `<td>${formatToCurrency(parseInt(tax))}</td>`;
					payrun_list4 += `<td>${formatToCurrency(parseInt(v.net_pay))}</td>`;
					payrun_list4 += `<td onClick="getPaySlipDetails2(${v.employee_id})"><i class="fas fa-money-check-alt"></i></td>`;
					payrun_list4 += `</tr>`;
					payrun_list4 += `<tr id="spay_loader${v.employee_id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw"></i></tr>`;
				});
				$('#list_payrun_body').html(payrun_list);
				$('#list_payrun_body2').html(payrun_list2);
				$('#list_payrun_body3').html(payrun_list3);
				$('#list_payrun_body4').html(payrun_list4);
				let totalNet = getArraySum(netArr);
				let totalGross = getArraySum(grossArr);
				let totalDeduc = getArraySum(deducArr);
				let totalTax = getArraySum(taxArr);
				$('#list_payrun_body').append(
					`<tr style="border-top:3px solid; border-bottom:3px solid;">
                    <td></td>
                    <td><b>Total</b></td>
                    <td><b>${formatToCurrency(parseInt(totalGross))}</b></td>
                    <td><b>${formatToCurrency(parseInt(totalDeduc))}</b></td>
                    <td><b>${formatToCurrency(parseInt(totalTax))}</b></td>
                    <td><b>${formatToCurrency(parseInt(totalNet))}</b></td>
                    <td></td>
                    </tr>`,
				);
				$('#list_payrun_body2').append(
					`<tr style="border-top:3px solid; border-bottom:3px solid;">
                    <td></td>
                    <td><b>Total</b></td>
                    <td><b>${formatToCurrency(parseInt(totalGross))}</b></td>
                    <td><b>${formatToCurrency(parseInt(totalDeduc))}</b></td>
                    <td><b>${formatToCurrency(parseInt(totalTax))}</b></td>
                    <td><b>${formatToCurrency(parseInt(totalNet))}</b></td>
                    <td></td>
                    </tr>`,
				);
				$('#list_payrun_body3').append(
					`<tr style="border-top:3px solid; border-bottom:3px solid;">
                    <td></td>
                    <td><b>Total</b></td>
                    <td><b>${formatToCurrency(parseInt(totalGross))}</b></td>
                    <td><b>${formatToCurrency(parseInt(totalDeduc))}</b></td>
                    <td><b>${formatToCurrency(parseInt(totalTax))}</b></td>
                    <td><b>${formatToCurrency(parseInt(totalNet))}</b></td>
                    <td></td>
                    </tr>`,
				);
				$('#list_payrun_body4').append(
					`<tr style="border-top:3px solid; border-bottom:3px solid;">
                    <td></td>
                    <td><b>Total</b></td>
                    <td><b>${formatToCurrency(parseInt(totalGross))}</b></td>
                    <td><b>${formatToCurrency(parseInt(totalDeduc))}</b></td>
                    <td><b>${formatToCurrency(parseInt(totalTax))}</b></td>
                    <td><b>${formatToCurrency(parseInt(totalNet))}</b></td>
                    <td></td>
                    </tr>`,
				);
				$('#pay_date').val(pay_date);
				$('#paydate').html(pay_date);
				if (pay_period_start !== null && pay_period_end !== null) {
					let start = pay_period_start.split('-');
					let end = pay_period_end.split('-');
					$('#date_range').val(
						`${start[0]}/${start[1]}/${start[2]} - ${end[0]}/${end[1]}/${end[2]}`,
					);
					$('#payperiod').html(
						`${start[0]}/${start[1]}/${start[2]} - ${end[0]}/${end[1]}/${end[2]}`,
					);
				}

				$('#namelo').html(schedule_name);
				$('#payrun_name').html(pay_run_name);
				$('#payrun_name2').html(pay_run_name);
				$('#payrun_statuslo').html(statuslo);

				$('#list_payrun_loader').hide();
				$('#list_payrun_table').show();
				$('#list_payrun_loader2').hide();
				$('#list_payrun_table2').show();
				$('#list_payrun_loader3').hide();
				$('#list_payrun_table3').show();
				$('#list_payrun_loader4').hide();
				$('#list_payrun_table4').show();
			} else {
				$('#list_payrun_body').html(`<tr><td colspan="7">No record</td></tr>`);
				$('#list_payrun_loader').hide();
				$('#list_payrun_table').show();
				$('#list_payrun_body2').html(`<tr><td colspan="7">No record</td></tr>`);
				$('#list_payrun_loader2').hide();
				$('#list_payrun_table2').show();
				$('#list_payrun_body3').html(`<tr><td colspan="7">No record</td></tr>`);
				$('#list_payrun_loader3').hide();
				$('#list_payrun_table3').show();
				$('#list_payrun_body4').html(`<tr><td colspan="7">No record</td></tr>`);
				$('#list_payrun_loader4').hide();
				$('#list_payrun_table4').show();
			}
			$('#pagination').twbsPagination({
				totalPages: Math.ceil(response.data.total_rows / limit),
				visiblePages: 10,
				onPageClick: function(event, page) {
					listPayRunHistory(page);
				},
			});
		})
		.catch(function(error) {
			console.log(error, 'eeeeeeeerrrrrrrrrooooottt');
			$('#list_payrun_loader').hide();
			$('#list_payrun_table').show();
			$('#list_payrun_body').html(`<tr><td colspan="7" style="color:red;">Error</td></tr>`);
			$('#list_payrun_loader2').hide();
			$('#list_payrun_table2').show();
			$('#list_payrun_body2').html(`<tr><td colspan="7" style="color:red;">Error</td></tr>`);
			$('#list_payrun_loader3').hide();
			$('#list_payrun_table3').show();
			$('#list_payrun_body3').html(`<tr><td colspan="7" style="color:red;">Error</td></tr>`);
			$('#list_payrun_loader4').hide();
			$('#list_payrun_table4').show();
			$('#list_payrun_body4').html(`<tr><td colspan="7" style="color:red;">Error</td></tr>`);
		})
		.then(function() {
			// always executed
		});
}

function getArraySum(arr) {
	const arrSum = arr.reduce((a, b) => a + b, 0);
	// var total = 0;
	// for (var i in a) {
	// 	total += a[i];
	// }
	// return total;
	return arrSum;
}

function addPayDates() {
	let company_id = localStorage.getItem('company_id');
	// let employee_id = window.location.search.split('=')[1];
	let id = window.location.search.split('=')[1];
	let pay_run_name = $('#payrun_name').val();
	let pay_period = $('#date_range').val();
	let pay_date = $('#pay_date').val();
	let sche_id = $('#secret_sche_id').html();

	$('#pay_dates_btn').hide();
	$('#pay_dates_loader').show();

	let data = {
		pay_schedule_id: sche_id,
		// company_id: company_id,
		date_range: pay_period,

		pay_date: pay_date,
		pay_run_id: id,
		pay_run_name: pay_run_name,
	};
	console.log(data);
	$.ajax({
		type: 'Put',
		dataType: 'json',
		url: `${api_path}hrm/set_pay_period`,
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
			$('#pay_dates_loader').hide();
			$('#pay_dates_btn').show();
			alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#pay_dates_loader').hide();
				$('#pay_dates_btn').show();
			}
		},
	});
}

function getPaySlipDetails(emp_id) {
	// $('#secret_emp_id').html(emp_id);
	let id = window.location.search.split('=')[1];
	$('#edit_payslip_modal').modal('show');
	// showSalaryDetails(emp_id);
	$('#add_creditComponent_btn').attr('data', emp_id);
	$('#add_debitComponent_btn').attr('data', emp_id);
	$('#debit_body').html('');
	$('#credit_body').html('');
	$('#credit_table').html('<tr><td colspan="3">No Salary Component Found</td></tr>');
	$('#debit_table').html('<tr><td colspan="3">No Salary Component Found</td></tr>');
	var company_id = localStorage.getItem('company_id');
	// let employee_id = emp_id;

	$('#credit_loader').show();
	$('#debit_loader').show();
	$('#credit_body').hide();
	$('#debit_body').hide();
	// var page = 1;
	// var limit = 10;

	$.ajax({
		type: 'GET',
		dataType: 'json',
		url: api_path + 'hrm/get_single_employee_slip',
		data: {
			// company_id: company_id,
			employee_id: emp_id,
			pay_run_id: id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,

		success: function(response) {
			console.log(response);

			if (response.status == '200') {
				// $('#loading').hide();
				let credit_checker = '';
				let debit_checker = '';
				let debit_table = '';
				let credit_table = '';

				// amount: "30000.00"
				// breakdown_id: "1"
				// breakdown_name: "Basic Salary"
				// credit_or_debit: "credit"
				// employee_id: "162"
				// formula: "just there"
				// is_checked: "checked"
				// salary_breakdown_type: "35"

				if (response.data) {
					// $('#credit_table').html('');
					// $('#debit_table').html('');
					$(response.data.company_salary).map((i, v) => {
						if (v.credit_or_debit == 'credit' || v.credit_or_debit == 'Credit') {
							credit_checker += `<div style="display:flex;">
                                        <label
                                            class="control-label col-md-6 col-sm-6 col-xs-12"
                                            for="">${v.breakdown_name}
                                        </label>`;
							if (v.pay_slip_is_checked == 'checked') {
								credit_checker += `<div class="col-md-3 col-sm-3 col-xs-6">
                                            <input type="checkbox" onClick="deleteBreakdown(${v.insert_id})" data="${v.pay_slip_id}" id="creddeb_${v.insert_id}" value="${v.insert_id}" checked class="crediter">
                                        </div>`;
								credit_table += ` <tr>
                                                <td>${v.breakdown_name}</td>
                                                <td><input type="number" value="${v.pay_slip_amount}" class="credit_input all_input" data="${v.pay_slip_id}" data-val="${v.insert_id}" data-type="credit"  data-toggle="tooltip" title="${v.formula}"></td>
                                                <td id="delCredDeb_${v.insert_id}" data="${v.pay_slip_id}" onClick="deleteBreakdown2(${v.insert_id})"><i class="fa fa-trash"></i></td>
                                            <tr>`;
							} else {
								credit_checker += `<div class="col-md-3 col-sm-3 col-xs-6">
                                            <input type="checkbox" onClick="deleteBreakdown(${v.insert_id})" data="${v.pay_slip_id}" id="creddeb_${v.insert_id}" value="${v.insert_id}" class="crediter">
                                        </div>`;
							}
							credit_checker += `</div>`;
						} else if (v.credit_or_debit == 'debit' || v.credit_or_debit == 'Debit') {
							debit_checker += `<div style="display:flex;">
                                        <label
                                            class="control-label col-md-6 col-sm-6 col-xs-12"
                                            for="">${v.breakdown_name}
                                        </label>`;
							if (v.pay_slip_is_checked == 'checked') {
								debit_checker += `<div class="col-md-3 col-sm-3 col-xs-6">
                                            <input type="checkbox" onClick="deleteBreakdown(${v.insert_id})" data="${v.pay_slip_id}" id="creddeb_${v.insert_id}" value="${v.insert_id}" checked class="debiter">
                                        </div>`;
								debit_table += `<tr>
                                                <td>${v.breakdown_name}</td>
                                                <td><input type="number" value="${v.pay_slip_amount}" class="debit_input all_input" data="${v.pay_slip_id}" data-val="${v.insert_id}" data-type="debit" data-toggle="tooltip" title="${v.formula}"></td>
                                                <td id="delCredDeb_${v.insert_id}" data="${v.pay_slip_id}" onClick="deleteBreakdown2(${v.insert_id})"><i class="fa fa-trash"></i></td>
                                            <tr>`;
							} else {
								debit_checker += `<div class="col-md-3 col-sm-3 col-xs-6">
                                            <input type="checkbox" onClick="deleteBreakdown(${v.insert_id})" data="${v.pay_slip_id}" id="creddeb_${v.insert_id}" value="${v.insert_id}" class="debiter">
                                        </div>`;
							}
							debit_checker += `</div>`;
						}
					});
					$('#total_debit').val(response.total_debit);
					$('#total_credit').val(response.total_credit);
					$('#net_payment').html(`₦${numberWithCommas(response.net_pay)}`);
					$('#salary_amt').html(`₦${numberWithCommas(response.data.salary)}`);
					$('#salary_type').val(response.data.earning_type);
				} else {
					debit_checker += `<p>No record found</p>`;
					credit_checker += `<p>No record found</p>`;

					// credit_table += `<tr>
					//                     <td colspan="3">No Salary Component Found</td>

					//                 <tr>`;
					// debit_table += `<tr>
					//                     <td colspan="3">No Salary Component Found</td>

					//                 <tr>`;
				}

				$('#debit_body').html(debit_checker);
				$('#credit_body').html(credit_checker);

				if (credit_table !== '') {
					$('#credit_table').html(credit_table);
				}

				if (debit_table !== '') {
					$('#debit_table').html(debit_table);
				}
				$('#credit_loader').hide();
				$('#debit_loader').hide();
				$('#credit_body').show();
				$('#debit_body').show();
			} else if (response.status == '400') {
				$('#debit_body').append(`<p>Error</p>`);
				$('#credit_body').append(`<p>Error</p>`);
				$('#credit_table').append('<tr><td colspan="3">Error</td><tr></tr>');
				$('#debit_table').append('<tr><td colspan="3">Error</td><tr></tr>');
			}
		},

		error: function(response) {
			$('#credit_loader').hide();
			$('#debit_loader').hide();
			$('#credit_body').show();
			$('#debit_body').show();
			$('#debit_body').append(`<p>Error</p>`);
			$('#credit_body').append(`<p>Error</p>`);
			$('#credit_table').append('<tr><td colspan="3">Error</td><tr></tr>');
			$('#debit_table').append('<tr><td colspan="3">Error</td><tr></tr>');
			console.log(response);
		},
	});
}

function getPaySlipDetails2(emp_id) {
	// $('#secret_emp_id').html(emp_id);
	let url = window.location.href;
	let params = new URL(url).searchParams;
	let id = params.get('id');
	$('#view_payslip_modal').modal('show');
	// showSalaryDetails(emp_id);
	// $('#add_creditComponent_btn').attr('data', emp_id);
	// $('#add_debitComponent_btn').attr('data', emp_id);
	// $('#debit_body').html('');
	// $('#credit_body').html('');
	// $('#credit_table').html('<tr><td colspan="3">No Salary Component Found</td></tr>');
	// $('#debit_table').html('<tr><td colspan="3">No Salary Component Found</td></tr>');
	var company_id = localStorage.getItem('company_id');
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
			// company_id: company_id,
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
					$('#com_name').html(response.data.company_name);
					$('#emy_name').html(response.data.fullname);
					$('#depy_name').html(response.data.department);
					$('#joby_name').html(response.data.job_title);
					$('#banky_name').html(response.data.bank_name);
					$('#banky_no').html(response.data.bank_no);
					$('#pay_period_datey').html(response.data.pay_period);
					$('#pay_datey').html(response.data.payment_date);
					$('#gpay').html(`${formatToCurrency(parseInt(response.data.salary))}`);
					$('#npay').html(`${formatToCurrency(parseInt(response.net_pay))}`);
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

function showSalaryDetails(id) {
	let company_id = localStorage.getItem('company_id');
	let employee_id = id;
	// $('#list_workShift_table').hide();
	// $('#list_workShift_loader').show();
	axios
		.get(`${api_path}hrm/new_employee_info`, {
			params: {
				// company_id: company_id,
				employee_id: employee_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			const { employee_data } = response.data.data;

			if (employee_data) {
				const { salary, earning_type } = response.data.data.employee_data;

				let sals = numberWithCommas(salary);
				$('#salary_amt').html(`₦${sals}`);
				$('#salary_type').val(earning_type);

				// $('#list_workShift_loader').hide();
				// $('#list_workShift_table').show();
			} else {
				// $('#list_workShift_body').html(`<tr><td colspan="4">No record</td></tr>`);
				// $('#list_workShift_loader').hide();
				// $('#list_workShift_table').show();
				$('#salaryDetails_error').html(`<span style="color:red;">No record</span>`);
			}
		})
		.catch(function(error) {
			console.log(error);

			// $('#list_workShift_loader').hide();
			// $('#list_workShift_table').show();

			$('#salaryDetails_error').html(`<span style="color:red;">Error loading Data</span>`);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function numberWithCommas(x) {
	return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

function addCreditInput() {
	let arr = [];
	let dArr = [];
	$('.credit_input').map((i, v) => {
		let stato;
		if ($(v).val() == '') {
			stato = 0;
		} else {
			stato = $(v).val();
		}
		arr.push(parseFloat(stato));
	});

	$('.debit_input').map((i, v) => {
		let stat;
		if ($(v).val() == '') {
			stat = 0;
		} else {
			stat = $(v).val();
		}
		dArr.push(parseFloat(stat));
	});

	let totalCredit = getArraySum(arr);
	let totalDedit = getArraySum(dArr);
	let net_pay = totalCredit - totalDedit;

	// console.log(arr, dArr, 'hhfhfhfhfhhfhfhfhffhfhhf');
	// console.log(totalCredit, totalDedit);

	$('#total_debit').val(`₦${numberWithCommas(totalDedit)}`);
	$('#total_credit').val(`₦${numberWithCommas(totalCredit)}`);
	$('#salary_amt').html(`₦${numberWithCommas(totalCredit)}`);
	$('#net_payment').html(`₦${numberWithCommas(net_pay)}`);
}

function addDebitComponent() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = $('#add_debitComponent_btn').attr('data');
	let payrun_id = window.location.search.split('=')[1];

	$('#add_debitComponent_btn').hide();
	$('#add_debitComponent_loader').show();

	let debit_arr = [];

	$('.debiter').map((i, v) => {
		if ($(v).is(':checked')) {
			// debit_arr.push($(v).val());
			debit_arr.push({
				pay_slip_items: $(v).val(),
				pay_slip_item_type: 'debit',
				ischecked: 'checked',
			});
		}
	});

	let data = {
		// company_id: company_id,
		employee_id: employee_id,
		pay_run_id: payrun_id,
		payslips: debit_arr,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/add_break_down_to_pay_slip?pay_run_id=${payrun_id}&employee_id=${employee_id}`,
		data: data,
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(error) {
			console.log(error);
			$('#add_debitComponent_loader').hide();
			$('#add_debitComponent_btn').show();
			alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_debitComponent_loader').hide();
				$('#add_debitComponent_btn').show();
				getPaySlipDetails(employee_id);
				// $('#edit_bank_details_modal').modal('hide');
				// $('#mod_body').html('Salary Account Details Added successfully');
				// $('#successModal').modal('show');
				// showBankDetails();
				// $('#acct_name').val('');
				// $('#bank_name').val('');
				// $('#acct_no').val('');
				// $('#sort_code').val('');
			} else {
				console.log(error);
				$('#add_debitComponent_loader').hide();
				$('#add_debitComponent_btn').show();
				alert('error');
			}
		},
	});
}

function addCreditComponent() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = $('#add_creditComponent_btn').attr('data');
	let payrun_id = window.location.search.split('=')[1];

	$('#add_creditComponent_btn').hide();
	$('#add_creditComponent_loader').show();

	let credit_arr = [];

	$('.crediter').map((i, v) => {
		if ($(v).is(':checked')) {
			credit_arr.push({
				pay_slip_items: $(v).val(),
				pay_slip_item_type: 'credit',
				ischecked: 'checked',
			});
		}
	});

	let data = {
		// company_id: company_id,
		employee_id: employee_id,
		pay_run_id: payrun_id,
		payslips: credit_arr,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/add_break_down_to_pay_slip?pay_run_id=${payrun_id}&employee_id=${employee_id}`,
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
			$('#add_creditComponent_loader').hide();
			$('#add_creditComponent_btn').show();
			alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_creditComponent_loader').hide();
				$('#add_creditComponent_btn').show();
				getPaySlipDetails(employee_id);
				// $('#edit_bank_details_modal').modal('hide');
				// $('#mod_body').html('Salary Account Details Added successfully');
				// $('#successModal').modal('show');
				// showBankDetails();
				// $('#acct_name').val('');
				// $('#bank_name').val('');
				// $('#acct_no').val('');
				// $('#sort_code').val('');
			} else {
				console.log(error);
				$('#add_creditComponent_loader').hide();
				$('#add_creditComponent_btn').show();
				alert('error');
			}
		},
	});
}

function deleteBreakdown(id) {
	if ($(`#creddeb_${id}`).is(':checked')) {
		// alert('hoooooo');
		// if (type == 'credit' || type == 'Credit') {
		// 	addCreditComponent()
		// } else if (type == 'debit' || type == 'Debit') {
		// 	addDebitComponent()
		// }
	} else {
		let ans = confirm('Are you sure you want to delete this breakdown?');
		if (ans) {
			// $(`#qc_row${id}`).hide();
			// $(`#qc_loader${id}`).show();
			let company_id = localStorage.getItem('company_id');
			// let employee_id = window.location.search.split('=')[1];
			let employee_id = $('#add_debitComponent_btn').attr('data');
			let idd = $(`#creddeb_${id}`).attr('data');
			let data = {
				// company_id: company_id,
				pay_slip_id: idd,
				employee_id: employee_id,
			};

			$.ajax({
				type: 'Delete',
				dataType: 'json',
				url: `${api_path}hrm/delete_sinlge_record_payslip`,
				data: data,
				headers: {
					Authorization: localStorage.getItem('token'),
				},

				error: function(res) {
					console.log(res);
					// $(`#qc_loader${id}`).hide();
					// $(`#qc_row${id}`).show();

					alert('error');
				},
				success: function(response) {
					if (response.status == 200 || response.status == 201) {
						getPaySlipDetails(employee_id);
						// $(`#qc_row${id}`).remove();
						// $(`#qc_loader${id}`).remove();
					}
				},
			});
		}
	}
}

function deleteBreakdown2(id) {
	// if ($(`#creddeb_${id}`).is(':checked')) {
	// 	alert('hoooooo');
	// } else {
	let ans = confirm('Are you sure you want to delete this breakdown?');
	if (ans) {
		// $(`#qc_row${id}`).hide();
		// $(`#qc_loader${id}`).show();
		let company_id = localStorage.getItem('company_id');
		let employee_id = $('#add_debitComponent_btn').attr('data');
		// let employee_id = window.location.search.split('=')[1];
		let idd = $(`#delCredDeb_${id}`).attr('data');
		let data = {
			// company_id: company_id,
			pay_slip_id: idd,
			employee_id: employee_id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/delete_sinlge_record_payslip`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				// $(`#qc_loader${id}`).hide();
				// $(`#qc_row${id}`).show();

				alert('error');
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					getPaySlipDetails(employee_id);
					// $(`#qc_row${id}`).remove();
					// $(`#qc_loader${id}`).remove();
				}
			},
		});
	}
	// }
}

function saveSalaryBreakdown() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = $('#add_debitComponent_btn').attr('data');
	let pay_run_id = window.location.search.split('=')[1];

	$('#save_pay').hide();
	$('#save_pay_loader').show();

	let net_pay = $('#net_payment').html().split('₦');
	let net;
	if (net_pay[1].includes(',')) {
		net = net_pay[1].replace(/,/g, '');
	} else {
		net = net_pay[1];
	}

	let emp_breakdown = [];
	$('.all_input').each((i, v) => {
		emp_breakdown.push({
			pay_slip_id: $(v).attr('data'),
			pay_slip_items: $(v).attr('data-val'),
			pay_slip_item_type: $(v).attr('data-type'),
			pay_slip_amount: $(v).val(),
			netpay: net,
			ischecked: 'checked',
		});
	});
	// let obj = { breakdown_id: 9, amount: 5000 };

	let data = {
		// company_id: company_id,
		employee_id: employee_id,
		pay_slips: emp_breakdown,
		pay_run_id: pay_run_id,
	};
	console.log(data);
	$.ajax({
		type: 'Put',
		dataType: 'json',
		url: `${api_path}hrm/update_pay_slip`,
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
			$('#save_pay_loader').hide();
			$('#save_pay').show();
			alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#save_pay_loader').hide();
				$('#edit_payslip_modal').modal('hide');
				listPayRunHistory(1);
				// $('#save_pay').show();
				// $('#mod_body').html('Salary Breakdown Saved successfully');
				// $('#successModal').modal('show');
				// $('#acct_name').val('');
				// $('#bank_name').val('');
				// $('#acct_no').val('');
				// $('#sort_code').val('');
			}
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
		data: { page: page, limit: limit },
		dataType: 'json',
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			// console.log(response);

			var options = '<option></option>';

			$(response.data).each((i, v) => {
				options += `<option value="${v.employee_id}">${v.firstname} ${v.lastname} (${v.position})</option>`;
			});
			$('#empo_name').html(options);
			// $('#employee_name').append(options);
		},
		// jqXHR, textStatus, errorThrown
		error: function(response) {
			alert('Connection error');
		},
	});
}

function listApprovers() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = $('#add_debitComponent_btn').attr('data');
	let pay_run_id = window.location.search.split('=')[1];

	$('#appv_table').hide();
	$('#appv_loader').show();

	axios
		.get(`${api_path}hrm/list_payrun_approval`, {
			params: {
				// company_id: company_id,
				pay_run_id: pay_run_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then((response) => {
			let appv_list = '';
			let appv_list2 = '';
			if (response.data.data.length > 0) {
				$(response.data.data).each((i, v) => {
					let received;
					let action;
					if (v.created_at === '0000-00-00 00:00:00' || v.created_at === null) {
						received = '';
					} else {
						received = moment(v.created_at, 'YYYY-MM-DD HH:mm:ss').format('LL');
					}

					if (v.date_acted === '0000-00-00 00:00:00' || v.date_acted === null) {
						action = '';
					} else {
						action = moment(v.date_acted, 'YYYY-MM-DD HH:mm:ss').format('LL');
					}
					appv_list += `<tr id="appv_div${v.approval_id}">`;
					appv_list += `<td><div class="profile_pic"><img src="${site_url}/files/images/employee_images/sml_${v.picture}" " alt="..." width="50"></div></td>`;
					appv_list += `<td><b>${v.fullname} (${v.job_title})</b><br>Date Received: ${received} <br>Date Of Action: ${action}</td>`;
					if (v.pay_run_approval_status == 'not_approved') {
						appv_list += `<td><i class="fa fa-times-circle" style="color: red; font-size: 15px;"></i></td>`;
					} else if (v.pay_run_approval_status == 'approved') {
						appv_list += `<td><i class="fa fa-check-circle" style="color: green; font-size: 15px;"></i></td>`;
					}
					appv_list += `<td onClick="deleteAppvrover(${v.approval_id})"><i  class="fa fa-trash-o"  data-toggle="tooltip" data-placement="top" title="Delete Approver"></i></td>`;
					appv_list += `</tr>`;
					appv_list += `<tr id="appv_del_loader${v.approval_id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-2x"></i></td></tr>`;

					appv_list2 += `<tr id="appv_div${v.approval_id}">`;
					appv_list2 += `<td><div class="profile_pic"><img src="${site_url}/files/images/employee_images/sml_${v.picture}" " alt="..." width="50"></div></td>`;
					appv_list2 += `<td><b>${v.fullname} (${v.job_title})</b><br>Date Received: ${received} <br>Date Of Action: ${action}</td>`;
					if (v.pay_run_approval_status == 'not_approved') {
						appv_list2 += `<td><i class="fa fa-times-circle" style="color: red; font-size: 15px;"></i></td>`;
					} else if (v.pay_run_approval_status == 'approved') {
						appv_list2 += `<td><i class="fa fa-check-circle" style="color: green; font-size: 15px;"></i></td>`;
					}
					appv_list2 += `</tr>`;
					appv_list2 += `<tr id="appv_del_loader${v.approval_id}" style="display:none;"><td colspan="4"><i class="fa fa-spinner fa-spin fa-fw fa-2x"></i></td></tr>`;
				});
			} else {
				appv_list += `<tr><td colspan="4">No record found<td><tr>`;
				appv_list2 += `<tr><td colspan="3">No record found<td><tr>`;
			}
			$('#appv_body').html(appv_list);
			$('#appv_loader').hide();
			$('#appv_table').show();

			$('#appv_body2').html(appv_list2);
			$('#appv_loader2').hide();
			$('#appv_table2').show();
		})
		.catch((error) => {
			$('#appv_body').html(`<tr><td colspan="4" style="color:red;">${error}<td><tr>`);
			$('#appv_loader').hide();
			$('#appv_table').show();

			$('#appv_body2').html(`<tr><td colspan="3" style="color:red;">${error}<td><tr>`);
			$('#appv_loader2').hide();
			$('#appv_table2').show();
		})
		.then(() => {});
}

function addApprovals() {
	let company_id = localStorage.getItem('company_id');
	let pay_run_id = window.location.search.split('=')[1];
	let approvals = $('#empo_name').val();
	let arr = [];
	console.log(approvals);
	approvals.map((id) => {
		arr.push({ approval_id: id });
	});

	$('#add_apprvoer').hide();
	$('#add_apprvoer_loader').show();

	let data = {
		// company_id: company_id,
		pay_run_id: pay_run_id,
		approvals: arr,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/create_payrun_approval`,
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
			$('#add_apprvoer_loader').hide();
			$('#add_apprvoer').show();
			alert('error');
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_apprvoer_loader').hide();
				$('#add_apprvoer').show();
				// $('#empo_name').val('');
				$('#appv_display').toggle();
				listApprovers();
			} else {
				console.log(error);
				$('#add_apprvoer_loader').hide();
				$('#add_apprvoer').show();
				alert('error');
			}
		},
	});
}

function deleteAppvrover(id) {
	let ans = confirm('Are you sure you want to delete this Approver?');
	if (ans) {
		$(`#appv_div${id}`).hide();
		$(`#appv_del_loader${id}`).show();
		let company_id = localStorage.getItem('company_id');

		let data = {
			// company_id: company_id,
			approval_id: id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/remove_pay_run_approval`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				$(`#appv_del_loader${id}`).hide();
				$(`#appv_div${id}`).show();

				alert('error');
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					// getPaySlipDetails(employee_id);
					$(`#appv_div${id}`).remove();
					$(`#appv_del_loader${id}`).remove();
				}
			},
		});
	}
}

function HRApprove() {
	let ans = confirm('Are you sure you want to approve this payrun?');
	if (ans) {
		$(`#approve_btnn`).hide();
		$(`#approvee_loader`).show();
		let company_id = localStorage.getItem('company_id');
		// let pay_run_id = window.location.search.split('=')[1];
		let url = window.location.href;
		let params = new URL(url).searchParams;
		let pay_run_id = params.get('id');
		let user_id2 = localStorage.getItem('user_id');
		let user_id = params.get('aID');

		let data = {
			// company_id: company_id,
			approval_status: 'approve',
			approval_id: user_id,
			approval_person: user_id2,
			pay_run_id: pay_run_id,
		};

		$.ajax({
			type: 'Put',
			dataType: 'json',
			url: `${api_path}hrm/approve_pay_run`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				$(`#approvee_loader`).hide();
				$(`#approve_btnn`).show();

				alert('error');
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					// getPaySlipDetails(employee_id);
					// $(`#approve_btnn`).remove();
					// $(`#approvee_loader`).hide();
					$('#buttons_section').hide();
					alert('Success');
					// window.location.reload()
				}
			},
		});
	}
}

function HRDecline() {
	let ans = confirm('Are you sure you want to decline this Payrun?');
	if (ans) {
		$(`#decline_btnn`).hide();
		$(`#declinee_loader`).show();
		let company_id = localStorage.getItem('company_id');
		let url = window.location.href;
		let params = new URL(url).searchParams;
		let pay_run_id = params.get('id');
		let user_id2 = localStorage.getItem('user_id');
		let user_id = params.get('aID');

		let data = {
			// company_id: company_id,
			approval_status: 'decline',
			approval_id: user_id,
			approval_person: user_id2,
			pay_run_id: pay_run_id,
		};

		$.ajax({
			type: 'Put',
			dataType: 'json',
			url: `${api_path}hrm/approve_pay_run`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				$(`#declinee_loader`).hide();
				$(`#decline_btnn`).show();

				alert('Error');
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					// getPaySlipDetails(employee_id);
					// $(`#declinee_loader`).hide();
					// $(`#decline_btnn`).show();
					$('#buttons_section').hide();
					alert('Success');
				}
			},
		});
	}
}

function formatToCurrency(amount) {
	if (amount === 0 || amount === 0.0) {
		return amount;
	} else {
		return '₦' + amount.toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
	}
}
