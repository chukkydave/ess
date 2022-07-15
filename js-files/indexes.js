$(document).ready(function() {
	//returns the promise object
	check_if_user_is_exited3();
});

function check_if_user_is_exited3() {
	var url = `${api_path}ess/restrict_ess_action`;

	fetch(url, {
		headers: {
			Authorization: localStorage.getItem('token'),
		},
	})
		.then((response) => response.json())
		.then((response) => {
			// document.getElementById("demoShow").innerHTML = response;
			user_page_access(response.is_employee_existed);
		})
		.catch((error) => {
			console.log(error);
		});
}

function user_page_access(is_exited) {
	console.log(is_exited, 'noooop');
	if (is_exited) {
		$('.hi_user_name').html(localStorage.getItem('firstname'));
		$('#loader_mssg').show();
		$('#ldnuy').hide();
	} else {
		// $("#modal_no_access").modal('show');
		//Settings
		$('#main_display_loader_page').hide();
		$('#main_display').show();
		defCalls();
	}
}

function defCalls() {
	var def = $.Deferred();
	$.when(
		pending_approvals(),
		leave_pending_count(),
		fetch_notice_board(),
		get_kpi(),
	).done(function() {
		setTimeout(function() {
			def.resolve();
		}, 2000);
	});
	return def.promise();
}

function leave_pending_count() {
	var company_id = localStorage.getItem('company_id');
	var email = localStorage.getItem('email');
	var user_id = localStorage.getItem('user_id');

	$.ajax({
		type: 'POST',
		dataType: 'json',
		url: api_path + 'ess/count_balance_leave',
		data: {
			// company_id: company_id,
			email: email,
			// user_id: user_id,
		},
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		timeout: 60000,
		success: function(response) {
			$('#low_itms').html(response.data);
			console.log(response);
		},
		error: function(response) {
			console.log(response);
		},
	});
}

function pending_approvals() {
	var company_id = localStorage.getItem('company_id');
	var email = localStorage.getItem('email');
	var user_id = localStorage.getItem('user_id');

	$.ajax({
		type: 'GET',
		dataType: 'json',
		url: `${api_path}ess/ess_approval_count`,
		timeout: 60000,
		headers: {
			Authorization: localStorage.getItem('token'),
		},
		success: function(response) {
			$('#pnd_appv').html(response.data);
		},
		error: function(response) {
			console.log(response);
			$('#pnd_appv').html(`${response.statusText}`);
		},
	});
}

function get_kpi() {
	$('#kpi_rcdd').html('-');
}

function fetch_notice_board() {
	// $('#sche_msg_error').html('');
	$(`#notice_board`).hide();
	$(`#notice_board_loading`).show();

	let company_id = localStorage.getItem('company_id');
	axios
		.get(`${api_path}hrm/get_notice_board`, {
			params: {
				// company_id: company_id,
				status: 'publish',
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			$('#notice_board_loading').hide();
			$('#notice_board').show();
			if (response.data.data.board_notice.length > 0) {
				let allNotice = '';
				const { board_notice, schedule_notification } = response.data.data;
				board_notice.map((item) => {
					let timer = moment(item.created_at, 'YYYY-MM-DD HH:mm:ss').fromNow();
					allNotice += `<li>
				                    <div class="block" style="margin:0;">

				                        <div class="block_content">
				                            <h2 class="title">
				                                <a>${item.notice_board}</a>
				                            </h2>
				                            <div class="byline">
				                                <span>${timer}</span>
				                            </div>

				                        </div>
				                    </div>
				                </li>`;
				});

				$('#notice_board').html(allNotice);
			} else {
				$('#notice_board').html('No Notices Currently');
			}

			$('#notice_board_loading').hide();
			$('#notice_board').show();
		})
		.catch(function(error) {
			console.log(error);

			$('#notice_board_loading').hide();
			$('#notice_board').show();

			$('#notice_board').html(error.responseJSON.msg);
		})
		.then(function() {
			// always executed
		});

	// var echartDonut = echarts.init(document.getElementById("yearly_sales_report"));
}

document.addEventListener('DOMContentLoaded', function() {
	let company_id = localStorage.getItem('company_id');
	// $('#list_QC_table').hide();
	// $('#list_QC_loader').show();
	let year = new Date().getFullYear();
	let month = new Date().getMonth() + 1;
	let day = new Date().getDate();
	let current_date = `${year}-${month}-${day}`;

	axios
		.get(`${api_path}hrm/calender_events`, {
			params: {
				// company_id: company_id,
				current_date: current_date,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			// const { employee_cv_edu_history } = response.data.data;

			if (response.data.data.length > 0) {
				// $('#list_QC_body').html(qc_list);
				// $('#list_QC_loader').hide();
				// $('#list_QC_table').show();
				let arr = [];
				response.data.data.map((item) => {
					arr.push({
						title: item.holiday_name,
						start: item.holiday_date,
						end: item.holiday_date,
					});
				});
				var calendarEl = document.getElementById('calendarly');
				var calendar = new FullCalendar.Calendar(calendarEl, {
					initialView: 'dayGridMonth',
					// initialDate: new Date(),
					headerToolbar: {
						left: 'prev,next',
						center: 'title',
						// contentHeight: auto,
						// height: '350px',
						right: 'dayGridMonth,timeGridWeek,timeGridDay',
					},

					events: arr,
				});
				calendar.render();
				setTimeout(() => {
					// calendar.updateSize();
					calendar.setOption('height', 350);
				}, 1000);
				// calendar.setOption('height', 700);
			} else {
				var calendarEl = document.getElementById('calendarly');
				var calendar = new FullCalendar.Calendar(calendarEl, {
					initialView: 'dayGridMonth',
					// initialDate: new Date(),
					headerToolbar: {
						left: 'prev,next',
						center: 'title',
						// contentHeight: auto,
						// height: '350px',
						right: 'dayGridMonth,timeGridWeek,timeGridDay',
					},
				});
				calendar.render();
				setTimeout(() => {
					// calendar.updateSize();
					calendar.setOption('height', 350);
				}, 1000);
			}
		})
		.catch(function(error) {
			console.log(error);

			// $('#list_QC_loader').hide();
			// $('#list_QC_table').show();
			// $('#list_QC_body').html(`<tr><td colspan="4" style="color:red;">Error</td></tr>`);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
			// $('.fc-scroller.fc-day-grid-container').css({
			// 	overflow: 'auto !important',
			// 	height: 'auto !important',
			// });
			// setTimeout(() => {
			// 	$('.fc-view-harness-active').css('height', '350px !important');
			// }, 3000);
		});
});
