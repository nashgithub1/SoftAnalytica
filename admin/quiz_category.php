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

?>

<div class="breadcrumbs">
    <div class="col-sm-4">
        <div class="page-header float-left">
            <div class="page-title">
                <h1>Add Quiz</h1>
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
                                    <div class="card-header"><strong>Add Quiz Section</strong></div>
                                    <div class="card-body card-block">
                                        <div class="form-group">
                                            <label for="quizname" class="form-control-label">New Quiz Category</label>
                                            <input type="text" placeholder="Add Quiz Category" class="form-control" name="quizname">
                                        </div>
                                        <div class="form-group">
                                            <label for="quiztime" class="form-control-label">Quiz Time in Minutes</label>
                                            <input type="text" placeholder="Quiz Time in Minutes" class="form-control" name="quiztime">
                                        </div>
                                        <div class="form-group">
                                            <label for="quizresource" class="form-control-label">Quiz Resource</label>
                                             <input type="url" placeholder="Resource for before attempt Quiz" class="form-control" name="quizresource" required>
                                        </div>

                                        <div class="form-group">
                                            <input type="submit" name="submit1" value="Add Quiz" class="btn btn-success">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="card">
                                    <div class="card-header">
                                        <strong class="card-title">Quiz Categories</strong>
                                    </div>
                                    <div class="card-body">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">#</th>
                                                    <th scope="col">Quiz Name</th>
                                                    <th scope="col">Quiz Time</th>
                                                    <th scope="col">Edit</th>
                                                    <th scope="col">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $count = 0;
                                                $result = $mysqli->query("SELECT * FROM quiz_category");
                                                while($row=mysqli_fetch_array($result))
                                                {
                                                    $count = $count+1;
                                                    ?>

                                                             <tr>
                                                                <th scope="row"><?php echo $count; ?> </th>
                                                                <td><?php echo $row['category']; ?> </td>
                                                                <td><?php echo $row['quiz_time_in_minutes']; ?> </td>
                                                                <td><a href="edit_quiz.php?id=<?php echo $row["id"]; ?>">Edit</a></td>
                                                                <td><a href="delete.php?id=<?php echo $row["id"]; ?>">Delete</a></td>
                                                            </tr>

                                                            <?php

                                                }

                                                ?>

                                                
                                                
                                            
                                            </tbody>
                                        </table>
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
    if (!empty($_POST['quizname']) && !empty($_POST['quiztime'])) {
        $quizname = $mysqli->real_escape_string($_POST['quizname']);
        $quiztime = $mysqli->real_escape_string($_POST['quiztime']);
        $quizresource = $mysqli->real_escape_string($_POST['quizresource']);

        $sql = "INSERT INTO quiz_category (category, quiz_time_in_minutes, resource) VALUES ('$quizname', '$quiztime', '$quizresource')";

        if ($mysqli->query($sql) === TRUE) {
            echo "<script>alert('Quiz added successfully!!!');
            window.location.href= window.location.href;
            </script>";
            // Refresh the page to show the updated table
            echo "<meta http-equiv='refresh' content='0'>";
        } else {
            echo "Error: " . $sql . "<br>" . $mysqli->error;
        }
    } else {
        echo "<script>alert('Please fill in all fields');</script>";
    }
}
?>

<?php include "footer.php"; ?>
