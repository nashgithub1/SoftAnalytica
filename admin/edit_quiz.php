<?php
session_start();
include "header.php";

// Database connection
$host = "localhost";
$dbname = "login_db";
$username = "root";
$password = "";

$mysqli = new mysqli($host, $username, $password, $dbname);

if ($mysqli->connect_errno) {
    die("Connection error: " . $mysqli->connect_error);
}
if(!isset($_SESSION["admin"])) 
{
    ?>
<script type="text/javascript">
    window.location="index.php";
</script>

<?php
}

$id =  $_GET["id"];
$res = $mysqli->query("SELECT * FROM quiz_category WHERE id=$id");
while($row = mysqli_fetch_array($res)) {
    $quiz_category = $row["category"];
    $quiz_time = $row["quiz_time_in_minutes"];
    $quiz_resource = $row["resource"];
}
?>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Edit Quiz Section</h1>
            </div>
        </div>
    </div>
</div>

<div class="content mt-3">
    <div class="animated fadeIn">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <form name="form1" action="" method="POST">
                        <div class="card-body">
                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header"><strong>Edit Quiz</strong></div>
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="quizname" class="form-control-label">New Quiz Category</label>
                                            <input type="text" placeholder="Add Quiz Category" class="form-control" value="<?php echo $quiz_category; ?>" name="quizname">
                                        </div>
                                        <div class="form-group">
                                            <label for="quiztime" class="form-control-label">Quiz Time in Minutes</label>
                                            <input type="text" placeholder="Quiz Time in Minutes" class="form-control" name="quiztime" value="<?php echo $quiz_time; ?>">
                                        </div>
                                        <div class="form-group">
                                            <label for="quizresource" class="form-control-label">Quiz Resource</label>
                                            <input type="text" placeholder="Resource for before attempt Quiz" class="form-control" value="<?php echo $quiz_resource; ?>" name="quizresource">
                                        </div>
                                        <div class="form-group">
                                            <input type="submit" name="submit1" value="Update Quiz" class="btn btn-success">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
if (isset($_POST["submit1"])) {
    if (!empty($_POST['quizname']) && !empty($_POST['quiztime']) && !empty($_POST['quizresource'])) {
        $quizname = $mysqli->real_escape_string($_POST['quizname']);
        $quiztime = $mysqli->real_escape_string($_POST['quiztime']);
        $quizresource = $mysqli->real_escape_string($_POST['quizresource']);

        $sql = "UPDATE quiz_category SET category = '$quizname', quiz_time_in_minutes = '$quiztime', resource = '$quizresource' WHERE id = $id";

        if ($mysqli->query($sql) === TRUE) {
            // Redirect to quiz_category.php
            echo "<script>window.location.href='quiz_category.php';</script>";
            // Refresh the page to show the updated table (optional)
            // echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    } else {
        echo "<script>alert('Please fill in all fields');</script>";
    }
}
?>

<?php include "footer.php"; ?>
