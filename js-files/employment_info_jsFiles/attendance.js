$(document).ready(() => {
	let date = new Date();
	let monther = date.getMonth();

	$('#atten_month_filter').val(monther);

	$('#atten_filter').on('click', list_employee_attendance);
});

// attendance start
function list_employee_attendance() {
	var company_id = localStorage.getItem('company_id');
	// var pathArray = window.location.pathname.split( '/' );
	var employee_id = ''; //pathArray[4].replace(/%20/g,' ');
	let user_id = localStorage.getItem('user_id');

	var page = 1;
	var limit = 10;

	$('#loading_atten').show();
	$('#attData').html('');

	let month = parseInt($('#atten_month_filter').val()) + 1;
	let year = $('#atten_year_filter').val();
	let data = {
		company_id: company_id,
		employee_id: employee_id,
		page: page,
		limit: limit,
		filter_month: month,
		filter_year: year,
		user_id: user_id,
	};
	console.log(data);

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'hrm/list_of_employee_attendances',
		data: data,
		timeout: 60000,

		success: function(response) {
			// console.log(response);
			$('#loading_atten').hide();
			var strTable = '';

			if (response.status == '200') {
				if (response.data.length > 0) {
					var k = 1;

					$(response.data).each((i, v) => {
						let clock_in;
						let clock_out;
						let date;
						let work_hours;

						if (v.date == '') {
							date = '"';
						} else {
							date = v.date;
						}

						if (v.clock_out == '') {
							clock_out = '"';
						} else {
							clock_out = v.clock_out;
						}

						if (v.clock_in == '') {
							clock_in = '"';
						} else {
							clock_in = v.clock_in;
						}

						if (v.work_hours == '') {
							work_hours = '"';
						} else {
							work_hours = v.work_hours;
						}
						strTable += `<tr>`;
						strTable += `<td>${date}</td>`;
						strTable += `<td>${clock_in}</td>`;
						strTable += `<td>${clock_out}</td>`;
						strTable += `<td>${work_hours}</td>`;
						// strTable += `<td></td>`;
						strTable += `</tr>`;
						k++;
					});
				} else {
					strTable = '<tr><td colspan="5">No record.</td></tr>';
				}

				$('#attData').html(strTable);
				$('#attData').show();
			} else if (response.status == '400') {
				$('#loading_atten').hide();
				strTable += '<tr>';
				strTable += '<td colspan="5">' + response.msg + '</td>';
				strTable += '</tr>';

				$('#attData').html(strTable);
				$('#attData').show();
			} else if (response.status == '401') {
				//missing parameters
				var strTable = '';
				$('#loading_atten').hide();
				strTable += '<tr>';
				strTable += '<td colspan="5">Technical Error</td>';
				strTable += '</tr>';

				$('#attData').html(strTable);
				$('#attData').show();
			}

			$('#loading_atten').hide();
		},

		error: function(response) {
			var strTable = '';
			$('#loading_atten').hide();
			// alert(response.msg);
			strTable += '<tr>';
			strTable +=
				'<td colspan="5"><strong class="text-danger">Connection error!</strong></td>';
			strTable += '</tr>';

			$('#attData').html(strTable);
			$('#attData').show();
			$('#loading_atten').hide();
		},
	});
}
// attendance end
