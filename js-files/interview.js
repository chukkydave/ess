$(document).ready(() => {
	$('#add_res_btn').on('click', sendInterviewResponse);
	$('#add_resDraft_btn').on('click', sendInterviewResponseDraft);
});

const user_id = localStorage.getItem('user_id');
const url = window.location.href;
const params = new URL(url).searchParams;
const exit_id = params.get('id');
const sending_status = params.get('status');
const company_id = localStorage.getItem('company_id');
// alert(sending_status);

if (sending_status === 1 || sending_status === '1') {
	// $('#sche_whole_div').hide();
	$('#list_interview_div').show();
	listInterviewQuestionAndAnswer();
} else if (sending_status === 2 || sending_status === '2') {
	$('#sche_whole_div').show();
	// $('#list_interview_div').hide();
	viewSchedule();
} else if (sending_status === 0 || sending_status === '0') {
	$('#sche_zero').show();
}

function listInterviewQuestionAndAnswer() {
	$('#list_interview_div').hide();
	$('#list_interview_loader').show();
	axios
		.get(`${api_path}ess/get_employee_question`, {
			params: {
				// company_id: company_id,
				// user_id: user_id,
				exit_id: exit_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let interview_list = '';
			// const { employee_cv_work_history } = response.data.data;
			if (response.data.data.length > 0) {
				$(response.data.data).map((i, v) => {
					interview_list += `<div class='col-md-9 col-sm-9 col-xs-9'>
                                <span style="font-size:1.3em;">${v.interview_questions}</span>
                                <div class="form-group">
                                    <div>
                                        <textarea type='text' data="${v.exit_question_id}" id="res_${v.exit_question_id}" class="form-control check_ques"
                                            style="border-radius:7px;">${v.response}</textarea>
                                    </div>
                                </div>
                            </div>`;
				});
				$('#interview_list').html(interview_list);
				// $('#list_interview_body').html(interview_list);
				$('#list_interview_loader').hide();
				$('#list_interview_div').show();
			} else {
				$('#interview_list').html(
					`<div class='col-md-9 col-sm-9 col-xs-9'>No Interview Question yet</div>`,
				);
				$('#list_interview_loader').hide();
				$('#list_interview_div').show();
			}
		})
		.catch(function(error) {
			console.log(error);

			$('#list_interview_loader').hide();
			$('#list_interview_div').show();
			$('#interview_list').html(
				`<div class='col-md-9 col-sm-9 col-xs-9'>Error loading Interview Questions</div>`,
			);

			// $('#edit_QC_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function sendInterviewResponseDraft() {
	$('#res_error').html('');

	let response = [];

	$('.check_ques').map((i, v) => {
		response.push({ question_id: $(v).attr('data'), response: $(v).val() });
	});
	// if (response.length === 0) {
	// 	$('#quest_error').html('No Interview response selected');
	// 	return;
	// }
	$('#add_resDraft_btn').hide();
	$('#add_res_loader').show();

	let data = {
		// user_id: user_id,
		// company_id: company_id,
		exit_id: exit_id,
		questionaire: response,
		response_state: 'draft',
	};

	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}ess/submit_questionaire`,
		data: data,
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		error: function(res) {
			console.log(res);
			$('#add_res_loader').hide();
			$('#add_resDraft_btn').show();
			// alert(res.responseJSON.msg);
			$('#res_error').html(res.responseJSON.msg);
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_res_loader').hide();
				$('#add_resDraft_btn').show();
				listInterviewQuestionAndAnswer();
			}
		},
	});
}

function sendInterviewResponse() {
	$('#res_error').html('');

	let response = [];

	$('.check_ques').map((i, v) => {
		response.push({ question_id: $(v).attr('data'), response: $(v).val() });
	});
	// if (response.length === 0) {
	// 	$('#quest_error').html('No Interview response selected');
	// 	return;
	// }
	$('#add_res_btn').hide();
	$('#add_res_loader').show();

	let data = {
		// user_id: user_id,
		// company_id: company_id,
		exit_id: exit_id,
		questionaire: response,
		response_state: 'completed',
	};

	$.ajax({
		type: 'Post',
		dataType: 'json',
		url: `${api_path}ess/submit_questionaire`,
		data: data,
		headers: {
			Authorization: localStorage.getItem('token'),
		},

		error: function(res) {
			console.log(res);
			$('#add_res_loader').hide();
			$('#add_res_btn').show();
			// alert(res.responseJSON.msg);
			$('#res_error').html(res.responseJSON.msg);
		},
		success: function(response) {
			if (response.status == 200 || response.status == 201) {
				$('#add_res_loader').hide();
				$('#add_res_btn').show();
				listInterviewQuestionAndAnswer();
			}
		},
	});
}

function viewSchedule() {
	$('#sche_msg_error').html('');
	$(`#msg_div`).hide();
	$(`#msg_loader`).show();

	axios
		.get(`${api_path}ess/get_emloyee_schedule`, {
			params: {
				exit_id: exit_id,
				// user_id: user_id,
				// company_id: company_id,
			},
			headers: {
				Authorization: localStorage.getItem('token'),
			},
		})
		.then(function(response) {
			let { document, note } = response.data.data;
			$('#sche_msg').html(note);
			if (document !== '') {
				$('#sche_file').show();
				$('#sche_btnn').show();
				$('#sche_file').attr('href', document);
			}

			$('#msg_loader').hide();
			$('#msg_div').show();
		})
		.catch(function(error) {
			console.log(error);

			$('#msg_loader').hide();
			$('#msg_div').show();

			$('#sche_msg_error').html(error.responseJSON.msg);
		})
		.then(function() {
			// always executed
		});
}
