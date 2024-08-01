<?php 
session_start();

include "header.php";
if (!isset($_SESSION["user_name"])) {
    ?>
        <script type="text/javascript">
            window.location.href = "login.php";
        </script>
    <?php
}
?>

<div class="row">
    <div class="col-lg-6 col-lg-push-3" style="min-height: 500px; background-color: White;">
        <br>
        <div class="row">
            <br>
            <div class="col-lg-2 col-lg-push-10">
                <div id="current_que" style="float:left">0</div>
                <div  style="float:left">/</div>
                <div id="total_que" style="float:left">0</div>
            </div>

            <div class="row" style="margin: top 30px;">
                <div class="row">
                    <div class="col-lg-10 col-lg-push-1" style="min-height: 300px; background-color:white" id="load_questions"></div>
                </div>
            </div>

            <div class="row" style="margin-top:10px">
                <div class="col-lg-6 col-lg-push-3" style="min-height: 50px;">
                    <div class="col-lg-12 text-center">
                        <input type="button" class="btn btn-warning" value="Previous" onclick="load_previous();">&nbsp;
                        <input type="button" class="btn btn-success" value="Next" onclick="load_next();">&nbsp;
                    </div>
                </div>
            </div>

            <div class="row" style="margin-top:10px">
                <div class="col-lg-12 text-center" id="navigation_buttons">
                    <!-- Navigation buttons will be dynamically inserted here -->
                </div>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    var questionno = 1;
    load_questions(questionno);

    function load_total_que() {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("total_que").innerHTML = xmlhttp.responseText;
                createNavigationButtons(xmlhttp.responseText);
            }
        };
        xmlhttp.open("GET", "forajax_it/load_total_que.php", true);
        xmlhttp.send(null);
    }

    function createNavigationButtons(totalQuestions) {
        var navigationButtonsDiv = document.getElementById("navigation_buttons");
        navigationButtonsDiv.innerHTML = "";
        for (var i = 1; i <= totalQuestions; i++) {
            var button = document.createElement("button");
            button.innerHTML = "Question " + i;
            button.classList.add("btn", "btn-primary");
            button.style.margin = "5px";
            button.setAttribute("onclick", "load_specific_question(" + i + ")");
            navigationButtonsDiv.appendChild(button);
        }
    }

    function load_questions(questionno) {
        document.getElementById("current_que").innerHTML = questionno;
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                if (xmlhttp.responseText == "over") {
                    window.location = "result_it1.php";
                } else {
                    document.getElementById("load_questions").innerHTML = xmlhttp.responseText;
                    load_total_que();
                    load_answer(questionno);  // Load the saved answer for the current question
                }
            }
        };
        xmlhttp.open("GET", "forajax_it/load_question.php?questionno=" + questionno, true);
        xmlhttp.send(null);
    }

    function radioclick(radiovalue, questionno) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                // Answer saved, do nothing here
            }
        };
        xmlhttp.open("GET", "forajax_it/save_answer_in_session.php?questionno=" + questionno + "&value1=" + radiovalue, true);
        xmlhttp.send(null);
    }

    function load_previous() {
        if (questionno == "1") {
            load_questions(questionno);
        } else {
            questionno = eval(questionno) - 1;
            load_questions(questionno);
        }
    }

    function load_next() {
        questionno = eval(questionno) + 1;
        load_questions(questionno);
    }

    function load_specific_question(qno) {
        questionno = qno;
        load_questions(questionno);
    }

    function load_answer(questionno) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                var savedAnswer = xmlhttp.responseText;
                if (savedAnswer) {
                    var radios = document.getElementsByName('option'); // Update this name as per your actual radio button name
                    for (var i = 0; i < radios.length; i++) {
                        if (radios[i].value == savedAnswer) {
                            radios[i].checked = true;
                            break;
                        }
                    }
                }
            }
        };
        xmlhttp.open("GET", "forajax_it/load_saved_answer.php?questionno=" + questionno, true);
        xmlhttp.send(null);
    }

    load_total_que();
</script>

<?php
include "footer.php";
?>
