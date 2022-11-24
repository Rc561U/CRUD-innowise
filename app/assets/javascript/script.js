$(function() {
    $("table tbody tr").click(function(e) {
        var u = $(this).data("link");
        console.log(e)
        if($(e.target).is("td")) {
            window.location.href = u;
        }
    });
});

const modal = document.getElementById("myModal");
const span = document.getElementById("close");

span.onclick = function () {
    modal.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

addEventListener("click", function (event) {

    if (event.target.className === "btn btn-dark") {
        modal.style.display = "block";
        let anchor = document.getElementById('delete_link');
        anchor.href = "users/delete/" + event.target.value;
    }
})