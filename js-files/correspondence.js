$(document).ready(() => {
	getCorrespondence('');
	$('#add_corres_btn').on('click', () => {
		if (isEmptyInput('.add_corres_fields')) {
			sendMessage();
		}
	});
});

const url_here = window.location.href;
const params_here = new URL(url_here).searchParams;
const exitId = params_here.get('exitId');
const user_idm = localStorage.getItem('user_id');

function getCorrespondence(page) {
	let company_id = localStorage.getItem('company_id');
	// let user_id = localStorage.getItem('user_id');
	if (page == '') {
		var page = 1;
	}
	var limit = 100;
	$('#list_term_table').hide();
	$('#list_term_loader').show();
	axios
		.get(`${api_path}hrm/get_exit_correspondence`, {
			params: {
				company_id: company_id,
				exit_id: exitId,
				page: page,
				limit: limit,
			},
		})
		.then(function(response) {
			let corres_list = '';

			if (response.data.data.length > 0) {
				$(response.data.data).map((i, v) => {
					let datey = moment(v.created_at, 'YYYY-MM-DD HH:mm:ss').format('LLL');
					if (v.user_id !== user_idm.toString()) {
						corres_list += `<div class="incoming_msg">
                                            <div class="incoming_msg_img"> <img
                                                    src="https://ptetutorials.com/images/user-profile.png" alt="sunil">
                                            </div>
                                            <div class="received_msg">
                                                <h5>${v.fullname}</h5>
                                                <div class="received_withd_msg">
                                                    <p>${v.correspondence_msg}</p>
                                                    <span class="time_date">${datey}</span>
                                                </div>
                                            </div>
                                        </div>`;
					} else {
						corres_list += `<div class="outgoing_msg">
                                            <div class="sent_msg">
                                                <p>${v.correspondence_msg}</p>
                                                <span class="time_date"> ${datey}</span>
                                            </div>
                                        </div>`;
					}
				});
				$('#list_corres_body').html(corres_list);
				$('#list_corres_loader').hide();
				$('#list_corres_table').show();
			} else {
				$('#list_corres_body').html(`<h3>No correspondence message yet!</h3>`);
				$('#list_corres_loader').hide();
				$('#list_corres_table').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_corres_loader').hide();
			$('#list_corres_table').show();
			$('#list_corres_body').html(`<h3 style="color:red;">${error.responseJSON.msg}</h3>`);
		})
		.then(function() {
			// always executed
		});
}

function sendMessage() {
	let company_id = localStorage.getItem('company_id');
	// let employee_id = $('#employee_idr').html();
	$('#add_corres_btn').hide();
	$('#add_corres_loader').show();

	let msg = $('#corres_msg').val();

	let data = {
		company_id: company_id,
		user_id: user_idm,
		correspondence_msg: msg,
		exit_id: exitId,
	};
	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}hrm/create_exit_correspondence`,
		data: data,
		// headers: {
		// 	Accept: 'application/json',
		// 	'Content-Type': 'application/json',
		// 	// Authorization: `Bearer ${authy}`,
		// },
		error: function(res) {
			console.log(res);
			$('#add_corres_loader').hide();
			$('#add_corres_btn').show();
			alert(res.msg);
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_corres_loader').hide();
				$('#add_corres_btn').show();
				$('#corres_msg').val('');
				getCorrespondence('');

				// $('#edit_nok_modal').modal('hide');

				// $('#mod_body').html('Next Of Kin Edit Successful');
				// $('#successModal').modal('show');
				// listNOK();
			}
		},
	});
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
