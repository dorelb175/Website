$(document).ready(function () {
    $("#extras").hide();
	$("#Comments").fadeIn(700);
    $("#addComment").click(function () {
        $("#addCom").slideToggle('slow');
    });

    $("#showExtras").click(function () {
        $("#extras").slideToggle('slow');
    });

    $("#showComments").click(function () {
        $("#Comments").slideToggle('slow');
    });
});

//Check Form
function check() {
    var name = document.getElementById("name").value;
    var msg = document.getElementById("msg").value;
    if ((name.length != 0 && name != " ") && (msg.length != 0 && msg != " ")) {
        document.getElementById("Error").innerHTML = "";
        return true;
    }
    else {
        document.getElementById("Error").innerHTML = "<img class='warn' src='Buttons/warning.png' alt='Warning' />&nbsp;<span style='color:red'>נא למלא את הכל השדות</span>";
        return false;
    }
}