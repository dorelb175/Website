function Check1() {
    var x = document.getElementsByName("radio1");
    if (x[1].checked) {
        return true;
    }
    else
        return false;
}

function Write1() {
    var x = document.getElementsByName("radio1");
    if (x[1].checked)
        document.getElementById('q1').innerHTML = "<span style='color:green'>התשובה נכונה</span>";
    else
        document.getElementById('q1').innerHTML = "<span style='color:red'>התשובה לא נכונה</span>";
}

function Check2() {
    var x = document.getElementsByName("radio2");
    if (x[0].checked) {
        return true;
    }
    else
        return false;
}

function Write2() {
    var x = document.getElementsByName("radio2");
    if (x[0].checked)
        document.getElementById('q2').innerHTML = "<span style='color:green'>התשובה נכונה</span>";
    else
        document.getElementById('q2').innerHTML = "<span style='color:red'>התשובה לא נכונה</span>";
}

function Check3() {
    var x = document.getElementsByName("radio3");
    if (x[2].checked) {
        return true;
    }
    else
        return false;
}

function Write3() {
    var x = document.getElementsByName("radio3");
    if (x[2].checked)
        document.getElementById('q3').innerHTML = "<span style='color:green'>התשובה נכונה</span>";
    else
        document.getElementById('q3').innerHTML = "<span style='color:red'>התשובה לא נכונה</span>";
}

function Check4() {
    var x = document.getElementsByName("radio4");
    if (x[1].checked) {
        return true;
    }
    else
        return false;
}

function Write4() {
    var x = document.getElementsByName("radio4");
    if (x[1].checked)
        document.getElementById('q4').innerHTML = "<span style='color:green'>התשובה נכונה</span>";
    else
        document.getElementById('q4').innerHTML = "<span style='color:red'>התשובה לא נכונה</span>";
}

function Check5() {
    var x = document.getElementsByName("radio5");
    if (x[3].checked) {
        return true;
    }
    else
        return false;
}

function Write5() {
    var x = document.getElementsByName("radio5");
    if (x[3].checked)
        document.getElementById('q5').innerHTML = "<span style='color:green'>התשובה נכונה</span>";
    else
        document.getElementById('q5').innerHTML = "<span style='color:red'>התשובה לא נכונה</span>";
}

function Check6() {
    var x = document.getElementsByName("radio6");
    if (x[2].checked) {
        return true;
    }
    else
        return false;
}

function Write6() {
    var x = document.getElementsByName("radio6");
    if (x[2].checked)
        document.getElementById('q6').innerHTML = "<span style='color:green'>התשובה נכונה</span>";
    else
        document.getElementById('q6').innerHTML = "<span style='color:red'>התשובה לא נכונה</span>";
}

function check() {
    countAnswers();
    if (Check1() && Check2() && Check3() && Check4() && Check5() && Check6()) {
        window.alert("כל הכבוד! ענית על כל השאלות נכון");
        return true;
    }
    else {
        Write1();
        Write2();
        Write3();
        Write4();
        Write5();
        Write6();
        return false;
    }

    return true;
}
function countAnswers() {
    var count = 0;
    if (Check1()) count++;
    if (Check2()) count++;
    if (Check3()) count++;
    if (Check4()) count++;
    if (Check5()) count++;
    if (Check6()) count++;
    window.alert("ענית על " + count.toString() + " שאלות נכון");
}