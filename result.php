<?php 
session_start();
$mysqli = include "database.php";
$date = date("Y-m-d H:i:s");
$_SESSION["end_time"] = date("Y-m-d H:i:s", strtotime($date . "+ $_SESSION[quiz_time] minutes"));
include "headerwithouttimer.php";
?>

<div class="row" style="">
    <div class="col-lg-6 col-lg-push-3" style="min-height: 500px; background-color: White;">
        <?php
        $correct = 0;
        $wrong = 0;

        if (isset($_SESSION['answer'])) {
            $shuffled_questions = $_SESSION['shuffled_questions'];
            $correct_answers = array_column($shuffled_questions, 'answer'); // Get the correct answers from the shuffled questions
            
            for ($i = 1; $i <= sizeof($_SESSION['answer']); $i++) {
                $user_answer = $_SESSION['answer'][$i];
                $correct_answer = $correct_answers[$i - 1]; // Get the correct answer for the shuffled question

                if ($user_answer == $correct_answer) {
                    $correct++;
                } else {
                    $wrong++;
                }
            }
        }

        $res = $mysqli->query("SELECT * FROM questions WHERE category='$_SESSION[quiz_category]'");
        $count = $res->num_rows; // Get the count of total questions

        echo "<br><br>";
        echo "<center>";
        echo "Total Questions=" . $count;
        echo "<br>";
        echo "Correct Answer=" . $correct;
        echo "<br>";
        echo "Wrong Answer=" . $wrong;
        echo "</center>";
        echo "<br><br>";
        echo "<center>";
        
        // Add the form with a submit button
        echo '<form action="select_quiz.php" method="post">';
        echo '<input type="submit" class="btn btn-primary" value="Next">';
        echo '</form>';
        echo "</center>";

        // Save results to the database
        if (isset($_SESSION["quiz_start"])) {
            $date = date("Y-m-d");
            $mysqli->query("INSERT INTO quiz_results (id, user_name, quiz_type, total_question, correct_answer, wrong_answer, quiz_time) VALUES (NULL, '$_SESSION[user_name]', '$_SESSION[quiz_category]', '$count', '$correct', '$wrong', '$date')");
            unset($_SESSION["quiz_start"]); // Move this inside the if block to ensure it's unset
            ?>
            <script type="text/javascript">
                window.location.href = window.location.href;
            </script>
            <?php
        }
        ?>
    </div>
</div>

<?php
include "footer.php";
?>
