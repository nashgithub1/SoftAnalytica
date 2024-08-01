<?php
session_start();
include "header.php";
$mysqli = include "../database.php";

if(!isset($_SESSION["admin"])) 
{
    ?>
<script type="text/javascript">
    window.location="index.php";
</script>

<?php
}


$id = $_GET["id"];
$id1 = $_GET["id1"];
$question = '';
$opt1='';
$opt2= '';
$opt3= '';
$opt4='';
$answer='';

$res = $mysqli->query("select * from questions where id=$id");
while($row=mysqli_fetch_array($res))
{
    $question = $row["question"];
    $opt1 = $row["option1"];
    $opt2 = $row["option2"];    
    $opt3 = $row["option3"];
    $opt4 = $row["option4"];
        $answer = $row["answer"];
}
?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>Upadte Question with Images</h1>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                          <form name="form1" action="" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                            <div class="col-lg-12">
                            
                            <div class="card">
                                <div class="card-header"><strong>Add New Questions with Images </strong>
                            </div>
                                <div class="card-body card-block">
                                    <div class="form-group">
                                        <label for="company" class="form-control-label">Add Question </label>
                                        <input type="text" placeholder="Add Question" class="form-control" name="fquestion" value="<?php echo $question; ?>" style="color:blue;">

                                    </div>
                                    <div class="form-group">
                                            <img src="<?php echo $opt1 ?>" height="50" width="50"> <br>

                                        <label for="company" class="form-control-label">Add Option1 </label>
                                        <input type="file"  class="form-control"  name="fopt1" style="padding-bottom: 35px;">
                                    </div>
                                    <div class="form-group">
                                    <img src="<?php echo $opt2 ?>" height="50" width="50"> <br>
                                        <label for="company" class="form-control-label">Add Option2 </label>
                                        <input type="file"  class="form-control"  name="fopt2" style="padding-bottom: 35px;">
                                    </div>
                                    <div class="form-group">
                                    <img src="<?php echo $opt3 ?>" height="50" width="50"> <br>
                                        <label for="company" class="form-control-label">Add Option3 </label>
                                        <input type="file" class="form-control"  name="fopt3" style="padding-bottom: 35px;">
                                    </div>
                                    <div class="form-group">
                                    <img src="<?php echo $opt4 ?>" height="50" width="50"> <br>
                                        <label for="company" class="form-control-label">Add Option4 </label>
                                        <input type="file"  class="form-control"  name="fopt4" style="padding-bottom: 35px;">
                                    </div>
                                    <div class="form-group">
                                    <img src="<?php echo $answer ?>" height="50" width="50"> <br>
                                        <label for="company" class="form-control-label">Add Answer </label>
                                        <input type="file"  class="form-control"  name="fanswer" style="padding-bottom: 35px;">
                                    </div>
                                    <div class="form-group">
                                        <input type="submit" name="submit2" value="Update Question" class="btn btn-success">
                                    </div>
                                </div>
                            </div>
                         
                            </div>    

                            </div>
                        </form>
                        </div> 

                    </div>
                    <!--/.col-->

                   

                                            
                                                

                       

                </div>                               
            </div><!-- .animated -->
        </div><!-- .content -->


        <?php 

if(isset($_POST["submit2"]))
{
    $opt1 = $_FILES["fopt1"]["name"];
    $opt2 = $_FILES["fopt2"]["name"];
    $opt3 = $_FILES["fopt3"]["name"];
    $opt4 = $_FILES["fopt4"]["name"];
    $answer = $_FILES["fanswer"]["name"];
    
    $tm = md5(time());
    
    $question = $_POST['fquestion'];
    $updateFields = [];
    
    if($opt1 != "")
    {
        $dst1 = "./opt_images/" . $tm . $opt1;
        $dst_db1 = "opt_images/" . $tm . $opt1;
        move_uploaded_file($_FILES["fopt1"]["tmp_name"], $dst1);
        $updateFields[] = "option1='$dst_db1'";
    }
    
    if($opt2 != "")
    {
        $dst2 = "./opt_images/" . $tm . $opt2;
        $dst_db2 = "opt_images/" . $tm . $opt2;
        move_uploaded_file($_FILES["fopt2"]["tmp_name"], $dst2);
        $updateFields[] = "option2='$dst_db2'";
    }
    
    if($opt3 != "")
    {
        $dst3 = "./opt_images/" . $tm . $opt3;
        $dst_db3 = "opt_images/" . $tm . $opt3;
        move_uploaded_file($_FILES["fopt3"]["tmp_name"], $dst3);
        $updateFields[] = "option3='$dst_db3'";
    }
    
    if($opt4 != "")
    {
        $dst4 = "./opt_images/" . $tm . $opt4;
        $dst_db4 = "opt_images/" . $tm . $opt4;
        move_uploaded_file($_FILES["fopt4"]["tmp_name"], $dst4);
        $updateFields[] = "option4='$dst_db4'";
    }
    
    if($answer != "")
    {
        $dst5 = "./opt_images/" . $tm . $answer;
        $dst_db5 = "opt_images/" . $tm . $answer;
        move_uploaded_file($_FILES["fanswer"]["tmp_name"], $dst5);
        $updateFields[] = "answer='$dst_db5'";
    }

    $mysqli->query("UPDATE questions set question='$_POST[fquestion]' where id=$id");

    ?>
    <script type="text/javascript">
        window.location="add_edit_questions.php?id=<?php echo $id1 ?> ";
    </script>
<?php
    
   
}

        
        ?>
                            
<?php

include "footer.php";


?>