$(document).ready(function() {
    defCalls(); //returns the promise object
});

function defCalls() {
    var def = $.Deferred();
    $.when(pending_approvals(), leave_pending_count(), get_kpi()).done(function() {
        setTimeout(function() {
            def.resolve();
        }, 2000)
    })
    return def.promise();
}

function leave_pending_count() {

    var company_id = localStorage.getItem('company_id');
    var email = localStorage.getItem('email');
    var user_id = localStorage.getItem('user_id');

    $.ajax({
        type: "POST",
        dataType: "json",
        url: api_path + "ess/count_balance_leave",
        data: {
            "company_id": company_id,
            "email": email,
            "user_id": user_id
        },
        timeout: 60000,
        success: function(response) {

            $("#low_itms").html(response.data);
            console.log(response);
        },
        error: function(response) {
            console.log(response);
        }
    });

}




function pending_approvals() {

    $("#pnd_appv").html('0');

}


function get_kpi() {
    $("#kpi_rcdd").html('-');
}