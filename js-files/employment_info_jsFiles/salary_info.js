$(document).ready(() => {
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

	$('#add_acctDetails_btn').click(() => {
		if (isEmptyInput('.add_acctDetails_fields')) {
			addAcctDetails();
		}
	});

	$('#add_salaryDetails_btn').click(() => {
		if (isEmptyInput('.add_salaryDetails_fields')) {
			addSalaryDetails();
		}
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
	// $('#generate_netPay').on('click', addCreditInput);
	$(document).on('keyup', '.all_input', addCreditInput);
	$(document).on('change', '.all_input', () => {
		$('#save_pay').show();
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

	$('#save_pay').on('click', saveSalaryBreakdown);

	$('input#payperiod_filter').daterangepicker({
		autoUpdateInput: false,
		showDropdowns: true,
	});

	$('input#payperiod_filter').on('apply.daterangepicker', function(ev, picker) {
		$(this).val(
			picker.startDate.format('YYYY/MM/DD') + ' - ' + picker.endDate.format('YYYY/MM/DD'),
		);
	});

	// $('input#payperiod_filter').daterangepicker(
	// 	{
	// 		showDropdowns: true,
	// 		autoUpdateInput: false,
	// 		showCustomRangeLabel: false,
	// 		startDate: '05/27/2021',
	// 		endDate: '06/02/2021',
	// 	},
	// 	function(start, end, label) {
	// 		console.log(
	// 			'New date range selected: ' +
	// 				start.format('YYYY-MM-DD') +
	// 				' to ' +
	// 				end.format('YYYY-MM-DD') +
	// 				' (predefined range: ' +
	// 				label +
	// 				')',
	// 		);
	// 	},
	// );
});

// var input = document.querySelectorAll('.all_input');

// input.indeterminate = true;

// $(input).on('change', function() {
// 	alert('change');
// });

function list_employment_payment_type() {
	$('#debit_body').html('');
	$('#credit_body').html('');
	$('#credit_table').html('<tr><td colspan="3">No Salary Component Found</td></tr>');
	$('#debit_table').html('<tr><td colspan="3">No Salary Component Found</td></tr>');
	var company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');

	$('#credit_loader').show();
	$('#debit_loader').show();
	$('#credit_body').hide();
	$('#debit_body').hide();
	// var page = 1;
	// var limit = 10;

	$.ajax({
		type: 'GET',
		dataType: 'json',
		url: api_path + 'hrm/get_employee_salary_breakdown',
		data: {
			employee_id: employee_id,
		},
		timeout: 60000,
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		success: function(response) {
			console.log(response);

			$('#credit_loader').hide();
			$('#debit_loader').hide();
			$('#credit_body').show();
			$('#debit_body').show();

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

				if (response.data.length > 0) {
					// $('#credit_table').html('');
					// $('#debit_table').html('');
					$(response.data).map((i, v) => {
						if (v.credit_or_debit == 'credit' || v.credit_or_debit == 'Credit') {
							credit_checker += `<div style="display:flex;">
                                        <label
                                            class="control-label col-md-6 col-sm-6 col-xs-12"
                                            for="">${v.breakdown_name}
                                        </label>`;
							if (v.is_checked == 'checked') {
								credit_checker += `<div class="col-md-3 col-sm-3 col-xs-6">
                                            <input type="checkbox" onClick="deleteBreakdown(${v.insert_id})" data="${v.breakdown_id}" id="creddeb_${v.insert_id}" value="${v.insert_id}" checked class="crediter">
                                        </div>`;
								credit_table += ` <tr>
                                                <td>${v.breakdown_name}</td>
                                                <td><input type="number" value="${v.amount}" class="credit_input all_input" data="${v.breakdown_id}"  data-toggle="tooltip" title="${v.formula}"></td>
                                                <td id="delCredDeb_${v.insert_id}" data="${v.breakdown_id}" onClick="deleteBreakdown2(${v.insert_id})"><i class="fa fa-trash"></i></td>
                                            <tr>`;
							} else {
								credit_checker += `<div class="col-md-3 col-sm-3 col-xs-6">
                                            <input type="checkbox" onClick="deleteBreakdown(${v.insert_id})" data="${v.breakdown_id}" id="creddeb_${v.insert_id}" value="${v.insert_id}" class="crediter">
                                        </div>`;
							}
							credit_checker += `</div>`;
						} else if (v.credit_or_debit == 'debit' || v.credit_or_debit == 'Debit') {
							debit_checker += `<div style="display:flex;">
                                        <label
                                            class="control-label col-md-6 col-sm-6 col-xs-12"
                                            for="">${v.breakdown_name}
                                        </label>`;
							if (v.is_checked == 'checked') {
								debit_checker += `<div class="col-md-3 col-sm-3 col-xs-6">
                                            <input type="checkbox" onClick="deleteBreakdown(${v.insert_id})" data="${v.breakdown_id}" id="creddeb_${v.insert_id}" value="${v.insert_id}" checked class="debiter">
                                        </div>`;
								debit_table += `<tr>
                                                <td>${v.breakdown_name}</td>
                                                <td><input type="number" value="${v.amount}" class="debit_input all_input" data="${v.breakdown_id}" data-toggle="tooltip" title="${v.formula}"></td>
                                                <td id="delCredDeb_${v.insert_id}" data="${v.breakdown_id}" onClick="deleteBreakdown2(${v.insert_id})"><i class="fa fa-trash"></i></td>
                                            <tr>`;
							} else {
								debit_checker += `<div class="col-md-3 col-sm-3 col-xs-6">
                                            <input type="checkbox" onClick="deleteBreakdown(${v.insert_id})" data="${v.breakdown_id}" id="creddeb_${v.insert_id}" value="${v.insert_id}" class="debiter">
                                        </div>`;
							}
							debit_checker += `</div>`;
						}
					});
					$('#total_debit').val(response.total_debit);
					$('#total_credit').val(response.total_credit);
					// $('#net_payment').html(`₦${response.net_pay}`);
					$('#net_payment').html(formatToCurrency(response.net_pay));
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

function addDebitComponent() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');

	$('#add_debitComponent_btn').hide();
	$('#add_debitComponent_loader').show();

	let debit_arr = [];

	$('.debiter').map((i, v) => {
		if ($(v).is(':checked')) {
			debit_arr.push($(v).val());
		}
	});
	console.log('aaaaaaaaaaarrrrrrrr', debit_arr);

	let data = {
		employee_id: employee_id,
		breakdown: debit_arr,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/create_employee_salary_breakdown`,
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
			$('#add_debitComponent_loader').hide();
			$('#add_debitComponent_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${error.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_debitComponent_loader').hide();
				$('#add_debitComponent_btn').show();
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: list_employment_payment_type(),
				});
			} else {
				console.log(response);
				$('#add_debitComponent_loader').hide();
				$('#add_debitComponent_btn').show();
				Swal.fire({
					title: 'Error!',
					text: `${response.msg}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			}
		},
	});
}

function addCreditComponent() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');

	$('#add_creditComponent_btn').hide();
	$('#add_creditComponent_loader').show();

	let credit_arr = [];

	$('.crediter').map((i, v) => {
		if ($(v).is(':checked')) {
			credit_arr.push($(v).val());
		}
	});

	let data = {
		employee_id: employee_id,
		breakdown: credit_arr,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/create_employee_salary_breakdown`,
		data: data,
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(error) {
			console.log(error);
			$('#add_creditComponent_loader').hide();
			$('#add_creditComponent_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${error.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_creditComponent_loader').hide();
				$('#add_creditComponent_btn').show();
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: list_employment_payment_type(),
				});
			} else {
				console.log(response);
				$('#add_creditComponent_loader').hide();
				$('#add_creditComponent_btn').show();
				Swal.fire({
					title: 'Error!',
					text: `${response.msg}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
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
			let employee_id = '';
			let user_id = localStorage.getItem('user_id');
			let idd = $(`#creddeb_${id}`).attr('data');
			let data = {
				breakdown_id: idd,
				employee_id: employee_id,
			};

			$.ajax({
				type: 'Delete',
				dataType: 'json',
				url: `${api_path}hrm/delete_employee_salary_breakdown`,
				data: data,
				headers: {
					Authorization: localStorage.getItem('token'),
				},

				error: function(res) {
					console.log(res);
					// $(`#qc_loader${id}`).hide();
					// $(`#qc_row${id}`).show();

					Swal.fire({
						title: 'Error!',
						text: `${res.msg}`,
						icon: 'error',
						confirmButtonText: 'Close',
					});
				},
				success: function(response) {
					if (response.status == 200 || response.status == 201) {
						Swal.fire({
							title: 'Success',
							text: `Success`,
							icon: 'success',
							confirmButtonText: 'Okay',
							onClose: list_employment_payment_type(),
						});
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
		let employee_id = '';
		let user_id = localStorage.getItem('user_id');
		let idd = $(`#delCredDeb_${id}`).attr('data');
		let data = {
			breakdown_id: idd,
			employee_id: employee_id,
		};

		$.ajax({
			type: 'Delete',
			dataType: 'json',
			url: `${api_path}hrm/delete_employee_salary_breakdown`,
			data: data,
			headers: {
				Authorization: localStorage.getItem('token'),
			},

			error: function(res) {
				console.log(res);
				// $(`#qc_loader${id}`).hide();
				// $(`#qc_row${id}`).show();

				Swal.fire({
					title: 'Error!',
					text: `${res.msg}`,
					icon: 'error',
					confirmButtonText: 'Close',
				});
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					Swal.fire({
						title: 'Success',
						text: `Success`,
						icon: 'success',
						confirmButtonText: 'Okay',
						onClose: list_employment_payment_type(),
					});
					// $(`#qc_row${id}`).remove();
					// $(`#qc_loader${id}`).remove();
				}
			},
		});
	}
	// }
}

function addAcctDetails() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');

	$('#add_acctDetails_btn').hide();
	$('#add_acctDetails_loader').show();

	let bank_name = $('#bank_name').val();
	let acct_name = $('#acct_name').val();
	let acct_no = $('#acct_no').val();
	let sort_code = $('#sort_code').val();

	let data = {
		employee_id: employee_id,
		bank_name: bank_name,
		account_name: acct_name,
		account_no: acct_no,
		sort_code: sort_code,
	};
	$.ajax({
		type: 'Put',
		dataType: 'json',
		url: `${api_path}hrm/update_employee_bank_account`,
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
			$('#add_acctDetails_loader').hide();
			$('#add_acctDetails_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${error.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_acctDetails_loader').hide();
				$('#add_acctDetails_btn').show();
				$('#edit_bank_details_modal').modal('hide');
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
					onClose: showBankDetails(),
				});
				// $('#acct_name').val('');
				// $('#bank_name').val('');
				// $('#acct_no').val('');
				// $('#sort_code').val('');
			}
		},
	});
}

function formatToCurrency(amount) {
	if (amount === '0' || amount === '0.0') {
		return '₦' + '0.00';
	} else {
		return '₦' + parseFloat(amount).toFixed(2).replace(/\d(?=(\d{3})+\.)/g, '$&,');
	}
}

function showBankDetails() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	// $('#list_workShift_table').hide();
	// $('#list_workShift_loader').show();
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
			const { employee_data } = response.data.data;

			if (employee_data) {
				const {
					bank_name,
					bank_account_no,
					bank_account_name,
					sort_code,
				} = response.data.data.employee_data;

				$('#banker_name').html(bank_name);
				$('#accounter_name').html(bank_account_name);
				$('#accounter_no').html(bank_account_no);
				$('#sorter_code').html(sort_code);

				$('#bank_name').val(bank_name);
				$('#acct_name').val(bank_account_name);
				$('#acct_no').val(bank_account_no);
				$('#sort_code').val(sort_code);
				// $('#list_workShift_loader').hide();
				// $('#list_workShift_table').show();
			} else {
				// $('#list_workShift_body').html(`<tr><td colspan="4">No record</td></tr>`);
				// $('#list_workShift_loader').hide();
				// $('#list_workShift_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			// $('#list_workShift_loader').hide();
			// $('#list_workShift_table').show();
			$('#edit_acctDetails_error').html(`<p style="color:red;">Error loading Data</p>`);

			$('#acctDetails_error').html(`<p style="color:red;">Error loading Data</p>`);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function addSalaryDetails() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');

	$('#add_salaryDetails_btn').hide();
	$('#add_salaryDetails_loader').show();

	let salary = $('#salary_amt').html().split('₦');
	let type = $('#salary_type').val();

	let result = salary[1].replace(/,/g, '');

	let data = {
		employee_id: employee_id,
		salary: result,
		earning_type: type,
	};
	$.ajax({
		type: 'Put',
		dataType: 'json',
		url: `${api_path}hrm/update_employee_salary`,
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
			$('#add_salaryDetails_loader').hide();
			$('#add_salaryDetails_btn').show();
			Swal.fire({
				title: 'Error!',
				text: `${error.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_salaryDetails_loader').hide();
				$('#add_salaryDetails_btn').show();
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
				});
				// $('#salary_amt').val('');
				// $('#salary_type').val('');
			}
		},
	});
}

function showSalaryDetails() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');
	// $('#list_workShift_table').hide();
	// $('#list_workShift_loader').show();
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
				$('#salaryDetails_error').html(`<span style="color:red;">No record found</span>`);
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

$("input[data-type='currency']").on({
	keyup: function() {
		formatCurrency($(this));
	},
	blur: function() {
		formatCurrency($(this), 'blur');
	},
	change: function() {
		formatCurrency($(this));
	},
});

function formatNumber(n) {
	// format number 1000000 to 1,234,567
	return n.replace(/\D/g, '').replace(/\B(?=(\d{3})+(?!\d))/g, ',');
}

function formatCurrency(input, blur) {
	// appends $ to value, validates decimal side
	// and puts cursor back in right position.
	// let nMinamt = parseInt($("#min_amt").val().replace(/[^0-9\.-]+/g, ""));
	// get input value
	var input_val = input.val();

	// don't validate empty input
	if (input_val === '') {
		return;
	}

	// original length
	var original_len = input_val.length;

	// initial caret position
	var caret_pos = input.prop('selectionStart');

	// check for decimal
	if (input_val.indexOf('.') >= 0) {
		// get position of first decimal
		// this prevents multiple decimals from
		// being entered
		var decimal_pos = input_val.indexOf('.');

		// split number by decimal point
		var left_side = input_val.substring(0, decimal_pos);
		var right_side = input_val.substring(decimal_pos);

		// add commas to left side of number
		left_side = formatNumber(left_side);

		// validate right side
		right_side = formatNumber(right_side);

		// On blur make sure 2 numbers after decimal
		if (blur === 'blur') {
			right_side += '00';
		}

		// Limit decimal to only 2 digits
		right_side = right_side.substring(0, 2);

		// join number by .
		input_val = '₦' + left_side + '.' + right_side;
	} else {
		// no decimal entered
		// add commas to number
		// remove all non-digits
		input_val = formatNumber(input_val);
		input_val = '₦' + input_val;

		// final formatting
		if (blur === 'blur') {
			input_val += '.00';
		}
	}

	// send updated string to input
	input.val(input_val);

	// put caret back in the right position
	var updated_len = input_val.length;
	caret_pos = updated_len - original_len + caret_pos;
	input[0].setSelectionRange(caret_pos, caret_pos);
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

function getArraySum(arr) {
	const arrSum = arr.reduce((a, b) => a + b, 0);
	// var total = 0;
	// for (var i in a) {
	// 	total += a[i];
	// }
	// return total;
	return arrSum;
}

function saveSalaryBreakdown() {
	let company_id = localStorage.getItem('company_id');
	let employee_id = '';
	let user_id = localStorage.getItem('user_id');

	$('#save_pay').hide();
	$('#save_pay_loader').show();

	let net_pay = $('#net_payment').html().split('₦');
	let gross_pay = $('#salary_amt').html().split('₦');
	let net;
	let salary;
	if (net_pay[1].includes(',')) {
		net = net_pay[1].replace(/,/g, '');
	} else {
		net = net_pay[1];
	}

	if (gross_pay[1].includes(',')) {
		salary = gross_pay[1].replace(/,/g, '');
	} else {
		salary = gross_pay[1];
	}

	let earn_type = $('#salary_type').val();

	let emp_breakdown = [];
	$('.all_input').each((i, v) => {
		emp_breakdown.push({ breakdown_id: $(v).attr('data'), amount: $(v).val() });
	});
	// let obj = { breakdown_id: 9, amount: 5000 };

	let data = {
		employee_id: employee_id,
		employee_salary_breakdown: emp_breakdown,
		net_pay: net,
		salary: salary,
		earning_type: earn_type,
	};
	console.log(data);
	$.ajax({
		type: 'Put',
		dataType: 'json',
		url: `${api_path}hrm/update_employee_salary_breakdown`,
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
			Swal.fire({
				title: 'Error!',
				text: `${error.msg}`,
				icon: 'error',
				confirmButtonText: 'Close',
			});
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#save_pay_loader').hide();
				// $('#save_pay').show();
				Swal.fire({
					title: 'Success',
					text: `Success`,
					icon: 'success',
					confirmButtonText: 'Okay',
				});
				// $('#acct_name').val('');
				// $('#bank_name').val('');
				// $('#acct_no').val('');
				// $('#sort_code').val('');
			}
		},
	});
}

// var weeklyPay= getArraySum(payChecks); //sums up to 722
