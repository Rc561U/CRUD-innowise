const modal = document.getElementById("exampleModal");

addEventListener("click", function (event) {
    if (event.target.className === "btn btn-danger") {
        let anchor = document.getElementById('delete_link');
        anchor.href = "users/delete/" + event.target.value;
    }
})



$("#checkAll").click(function(){
    $('input:checkbox').not(this).prop('checked', this.checked);
});

$(function() {
    $("table tbody tr").click(function(e) {
        var u = $(this).data("link");
        if($(e.target).is("td")) {
            window.location.href = u;
        }
    });
});