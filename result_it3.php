
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

        if (isset($_SESSION["answer"])) {
            for ($i = 1; $i <= sizeof($_SESSION["answer"]); $i++) { // Removed the semicolon after the for loop
                $answer = '';
                $res = $mysqli->query("SELECT * FROM questions WHERE category='$_SESSION[quiz_category]' AND question_no=$i");
                while ($row = mysqli_fetch_array($res)) {
                    $answer = $row["answer"];
                }
                if (isset($_SESSION["answer"][$i])) {
                    if ($answer == $_SESSION["answer"][$i]) {
                        $correct++;
                    } else {
                        $wrong++;
                    }
                } else {
                    $wrong++;
                }
            }
        }

        $res = $mysqli->query("SELECT * FROM questions WHERE category='$_SESSION[quiz_category]'");
        $count = $res->num_rows; // Changed to num_rows to get the count of rows instead of fields

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
        echo '<form action="initialtestcomplete.php" method="post">';
        echo '<input type="submit" class="btn btn-primary" value="Next">';
        echo '</form>';

        echo "</center>";
    


        ?>
    </div>
</div>

<?php
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



include "footer.php";
?>

