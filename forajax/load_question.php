<?php
session_start();
$mysqli = include "../database.php";

if (!isset($_SESSION['shuffled_questions'])) {
    $res = $mysqli->query("SELECT * FROM questions WHERE category='$_SESSION[quiz_category]'");
    $questions = array();
    while ($row = mysqli_fetch_array($res)) {
        $questions[] = $row;
    }
    // Shuffle questions
    shuffle($questions);

    // Store shuffled questions and their correct answers in session
    $_SESSION['shuffled_questions'] = $questions;
    $_SESSION['shuffled_answers'] = array_column($questions, 'correct');
}

$queno = $_GET["questionno"];
$shuffled_questions = $_SESSION['shuffled_questions'];

if ($queno > count($shuffled_questions)) {
    echo "over";
    exit;
}

$question_data = $shuffled_questions[$queno - 1];

$question_no = $question_data['question_no'];
$question = $question_data["question"];
$opt1 = $question_data["option1"];
$opt2 = $question_data["option2"];
$opt3 = $question_data["option3"];
$opt4 = $question_data["option4"];
$ans = isset($_SESSION["answer"][$queno]) ? $_SESSION["answer"][$queno] : '';

echo "
<br>
<table>
    <tr>
    <td style='font-weight: bold; font-size: 20px; padding-left: 5px' colspan='2'>
        ({$question_no}){$question}
    </td>
    </tr>
</table>
<table style='margin-left: 20px'>
    <tr>
        <td>
            <input type='radio' name='r1' id='r1' value='{$opt1}' onclick='radioclick(this.value, {$queno})' " . ($ans == $opt1 ? "checked" : "") . ">
        </td>
        <td style='padding-left: 10px'>" . (strpos($opt1, 'images/') !== FALSE ? "<img src='admin/{$opt1}' height='30' width='30'>" : $opt1) . "</td>
    </tr>
    <tr>
        <td>
            <input type='radio' name='r1' id='r1' value='{$opt2}' onclick='radioclick(this.value, {$queno})' " . ($ans == $opt2 ? "checked" : "") . ">
        </td>
        <td style='padding-left: 10px'>" . (strpos($opt2, 'images/') !== FALSE ? "<img src='admin/{$opt2}' height='30' width='30'>" : $opt2) . "</td>
    </tr>
    <tr>
        <td>
            <input type='radio' name='r1' id='r1' value='{$opt3}' onclick='radioclick(this.value, {$queno})' " . ($ans == $opt3 ? "checked" : "") . ">
        </td>
        <td style='padding-left: 10px'>" . (strpos($opt3, 'images/') !== FALSE ? "<img src='admin/{$opt3}' height='30' width='30'>" : $opt3) . "</td>
    </tr>
    <tr>
        <td>
            <input type='radio' name='r1' id='r1' value='{$opt4}' onclick='radioclick(this.value, {$queno})' " . ($ans == $opt4 ? "checked" : "") . ">
        </td>
        <td style='padding-left: 10px'>" . (strpos($opt4, 'images/') !== FALSE ? "<img src='admin/{$opt4}' height='30' width='30'>" : $opt4) . "</td>
    </tr>
</table>";
?>
