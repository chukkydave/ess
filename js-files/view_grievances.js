$(document).ready(function() {
	fetch_grievance_info();
	viewProceedings();
});
function fetch_grievance_info() {
	let grievance_id = window.location.search.split('=')[1];
	var company_id = localStorage.getItem('company_id');

	// $('#gr_' + grievance_id).hide();
	// $('#loader11_' + grievance_id).show();

	$.ajax({
		type: 'POST',
		dataType: 'json',
		cache: false,
		url: api_path + 'ess/view_single_grievance',
		data: {
			company_id: company_id,
			grievance_id: grievance_id,
		},

		success: function(response) {
			console.log(response);

			// $('#loader11_' + grievance_id).hide();
			// $('#gr_' + grievance_id).show();

			if (response.status == '200') {
				var monthNames = [
					'Jan',
					'Feb',
					'Mar',
					'Apr',
					'May',
					'Jun',
					'Jul',
					'August',
					'Sep',
					'Oct',
					'Nov',
					'Dec',
				];

				var s = new Date(response.data.incident_date);
				var month = s.getMonth();
				var datestring = s.getDate() + '/' + monthNames[month] + '/' + s.getFullYear();

				let doc;

				if (response.data.document === null || response.data.document === '') {
					doc = 'No document Uploaded';
				} else {
					doc = `<a target="_blank" href="${window.location
						.origin}/files/images/greviance_document/${response.data
						.document}">View Document</a>`;
				}

				$('#griev_code').html(response.data.g_code);
				$('#griev_type').html(capitalizeFirstLetter(response.data.gri_type));
				$('#griev_from').html(response.data.g_by_full_name);
				$('#griev_aganist').html(response.data.g_against_full_name);
				$('#griev_date').html(datestring);
				$('#griev_report').html(response.data.incident);
				$('#griev_branch').html(response.data.branch_name);
				$('#desc_text').val(response.data.grievance_proceeding_description);
				$('#griev_doc').html(doc);

				// $('#modal_view_g #g_type').html(response.data.gri_type);
				// $('#modal_view_g #incident_date').html(datestring);
				// $('#modal_view_g #approval').html();
				// $('#modal_view_g #report').html(response.data.incident);
				// $('#modal_view_g #response').html();
				// $('#modal_view_g #branch').html();

				// $('#modal_view_g').modal('show');
			}
		},

		error: function(response) {
			// $('#loader11_' + grievance_id).hide();
			// $('#gr_' + grievance_id).show();
			alert('Connection Error.');
		},
	});
}

function capitalizeFirstLetter(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}

function viewProceedings() {
	// $('#edit_nok_error').html('');
	// $('#edit_nok_modal').modal('show');
	// $('#edit_nok_btn').hide();
	// $('#edit_nok_loader').show();

	let company_id = localStorage.getItem('company_id');
	let id = window.location.search.split('=')[1];
	let page = 1;
	let limit = 10;
	// let user_id = localStorage.getItem('user_id');
	axios
		.get(`${api_path}hrm/get_proceeding_header`, {
			params: {
				grievance_id: id,
				company_id: company_id,
				// page: page,
				// limit: limit,
			},
		})
		.then(function(response) {
			let comment = '';
			console.log(response.data.data);
			if (response.data.data.length > 0) {
				$(response.data.data).each((i, v) => {
					if (v.is_comment_allowed === 'allowed') {
						comment += `<div>`;
						comment += `<h2><strong>${v.header}<strong></h2>`;

						if (v.comments.length > 0) {
							comment += `<ul class="messages">`;
							$(v.comments).each((i, v) => {
								comment += `<li><div class="message_wrapper">
                                        <h4 class="heading">${v.fullname}</h4>
                                        <div class="col-md-12 col-sm-12">
                                            <blockquote>
                                                <p>${v.comments}</p>
                                            </blockquote>
                                        </div>
                                        <br />
                                        ${
											v.documents ? `<p class="url">
                                            <span class="fs1 text-info" aria-hidden="true" data-icon=""></span>
                                            <a target="_blank" href="${window.location
												.origin}/files/images/greviance_document/${v.documents}"><i class="fa fa-paperclip"></i> View File</a>
                                        </p>` :
											''}
                                        
                                    </div></li>`;
							});
							comment += `</ul>`;
						}
						comment += `<div class="btn-group">
                                    <button class="btn" data-toggle="collapse"
                                        data-target="#collapseExample${v.proceeding_id}" aria-expanded="false"
                                        aria-controls="collapseExample" type="button"><i class="fa fa-comment"></i>
                                        Comment</button>
                                </div>
                                <br>`;
						comment += `<div class="col-md-12 col-sm-12 col-xs-12 collapse" id="collapseExample${v.proceeding_id}"
                                    style="padding-left: 0; margin-top: 10px;">
                                    <textarea cols="5" id="comment_text${v.proceeding_id}" class="form-control col-md-7 col-xs-12">

                                    </textarea>
                                    <div>
                                        <input type="file" id="comment_file${v.proceeding_id}" class="form-control col-md-7 col-xs-12"
                                            style="border:none;">
                                    </div>


                                    <div class="text-danger" id="comment_error${v.proceeding_id}">


                                    </div>

                                    <div style="margin-top:10px;">
                                        <button class="btn btn-primary btn-sm" id="add_comment_btn${v.proceeding_id}" onClick="addComment(${v.proceeding_id})">Save</button>
                                        <i class="fa fa-spinner fa-spin fa-fw fa-3x" style="display: none;"
                                            id="add_comment_loader${v.proceeding_id}"></i>
                                    </div>
                                </div>`;
						comment += `</div><hr>`;
					} else {
						// comment += `<div>`
						comment += `<div><h2><strong>${v.header}<strong></h2></div><hr>`;

						// comment += `</div>`
					}
				});
			} else {
				comment += `<div style="margin:20px;">No Proceedings Yet</div>`;
			}

			$('#proceeding_section').html(comment);
		})
		.catch(function(error) {
			alert(error);

			// $('#edit_nok_loader').hide();
			// $('#edit_nok_btn').show();

			// $('#edit_nok_error').html(error);
		})
		.then(function() {
			// always executed
		});
}

function addComment(proceedings_id) {
	$('#comment_error').html('');
	let company_id = localStorage.getItem('company_id');
	let grievance_id = window.location.search.split('=')[1];
	let comment_by = localStorage.getItem('user_id');
	let comment = $(`#comment_text${proceedings_id}`).val().trim();
	console.log(typeof comment);
	if (comment.length < 1) {
		$(`#comment_error${proceedings_id}`).html('Empty field');
		return;
	} else {
		$(`#add_comment_btn${proceedings_id}`).hide();
		$(`#add_comment_loader${proceedings_id}`).show();

		let upImage = document.querySelector(`#comment_file${proceedings_id}`).files[0];

		let data = new FormData();
		data.append('file', upImage);
		data.append('greviance_id', grievance_id);
		data.append('proceedings_id', proceedings_id);
		data.append('comment_by', comment_by);
		// data.append('greviance_against', greviance_against);
		data.append('company_id', company_id);
		data.append('comments', comment);

		$.ajax({
			type: 'POST',
			dataType: 'json',
			cache: false,
			url: `${api_path}ess/create_or_update_proceedings`,
			processData: false,
			contentType: false,
			headers: {
				enctype: 'multipart/form-data',
			},
			data: data,

			error: function(error) {
				console.log(error);
				$(`#add_comment_loader${proceedings_id}`).hide();
				$(`#add_comment_btn${proceedings_id}`).show();
				alert('error');
			},
			success: function(response) {
				if (response.status == 200 || response.status == 201) {
					$(`#add_comment_loader${proceedings_id}`).hide();
					$(`#add_comment_btn${proceedings_id}`).show();
					$(`#comment_text${proceedings_id}`).val('');
					$(`#collapseExample${proceedings_id}`).removeClass('in');
					viewProceedings();
					// $('#desc_text').val('');

					// $('#NOK_display').toggle();

					// viewProceedings();
				}
			},
		});
	}
}
