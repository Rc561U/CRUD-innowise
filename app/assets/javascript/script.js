addEventListener("click", function (event) {
    if (event.target.id === "monoDelete") {
        let anchor = document.getElementById('delete_link');
        anchor.href = "users/delete/" + event.target.value;
    }
})

// select all
$("#checkAll").click(function () {
    $('input:checkbox').not(this).prop('checked', this.checked);
});


// select table
$(function () {
    $("table tbody tr").click(function (e) {
        var u = $(this).data("link");
        if ($(e.target).is("td")) {
            window.location.href = u;
        }
    });
});


// delete multiple user's data
$('#multiple_delete').click(function () {
    var myarray = [];
    $('input:checkbox:checked').each(function () {
        if ($(this).val()) {
            myarray.push($(this).val());
        }
    });
    $.ajax({
        type: "POST",
        url: "api/users/delete",
        data: JSON.stringify(myarray),
        contentType: "application/json",
        success: function (data) {
            if (data) {
                location.reload();
            }
        }

    });
});


// enable delete button if checkbox is checked
$('.form-check-input').click(function () {
    //check if checkbox is checked
    if ($(this).is(':checked')) {
        $('#MultiDelete').removeAttr('disabled'); //enable input
    } else {
        $('#MultiDelete').attr('disabled', true); //disable input
    }
});


