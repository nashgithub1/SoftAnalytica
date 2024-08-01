
<?php
session_start();

if(!isset($_SESSION["user_id"]) )
{
    ?>

    <script type="text/javascript">
        window.location="login.php";
    </script>

    <?php
}
?>

<?php 
$mysqli = include "database.php";
include "headerwithouttimer.php";
?>
        <div class="row" style="">

            <div class="col-lg-6 col-lg-push-3" style="min-height: 500px; background-color: White;">
                <?php

$res = $mysqli->query("SELECT * FROM quiz_category");
while ($row = mysqli_fetch_array($res)) {
    if (in_array($row["id"], ["7"])) {
        ?>
        <input type="button" class="btn btn-success form-control" value="<?php echo $row["category"]; ?>" style="margin-top:10px; background-color:blue; color:white" onclick="set_exam_type_session(this.value);">

        <?php
    }
    else {
        continue; 

    }

}
                ?>
            </div>   
        </div>

       <?php
include "footer.php";
       ?>

       <script type="text/javascript">
            function set_exam_type_session(quiz_category)
            {
                var xmlhttp=new XMLHttpRequest();
                xmlhttp.onreadystatechange=function(){
                    if (xmlhttp.readyState==4 && xmlhttp.status==200)
                    {
                        window.location="dash_it2.php";
                    }
                };
                xmlhttp.open("GET", "forajax/set_quiz_type_session.php?quiz_category="+ quiz_category, true);
                xmlhttp.send(null);
            }

       </script>

