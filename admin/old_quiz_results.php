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

?>

        <div class="breadcrumbs">
            <div class="col-sm-4">
                <div class="page-header float-left">
                    <div class="page-title">
                        <h1>View All Results</h1>
                    </div>
                </div>
            </div>
            
        </div>

        <div class="content mt-3">
            <div class="animated fadeIn">


                <div class="row">
                    <div class="col-lg-12">
                        <div class="card">
                          
                            <div class="card-body">

                            <center>

                                <h1> Old Quiz Results</h1>

                            </center>
                    <?php 
                    $count = 0;
                    $res = $mysqli->query("SELECT * from quiz_results  order by id desc");
                    $count = mysqli_num_rows($res);

    if ($count == 0) 
    
    {
        ?>
            <center>
                <h1> No Results Found!!!!</h1>
            </center>

        <?php   
    }
    else{
        echo "<table class=\"table table-bordered\" id=\"resultTable\">";

        echo "<tr style='background-color: #006df0; color: white'>";
        echo "<th>"; echo  "User Name";  echo "</th>";
        echo "<th>"; echo  "Quiz Type";  echo "</th>";
        echo "<th>"; echo  "Total Questions";  echo "</th>";
        echo "<th>"; echo  "Correct Answer Num";  echo "</th>";
        echo "<th>"; echo  "Wrong Answer Num";  echo "</th>";
        echo "<th>"; echo  "Quiz Time";  echo "</th>";
        echo "<tr>";

        while ($row = mysqli_fetch_array($res))
        {
            echo "<tr>";
        echo "<td>";    echo  $row["user_name"];         echo "</td>";
        echo "<td>";    echo  $row["quiz_type"];         echo "</td>";
        echo "<td>";    echo  $row["total_question"];    echo "</td>";
        echo "<td>";    echo  $row["correct_answer"];    echo "</td>";
        echo "<td>";    echo  $row["wrong_answer"];     echo "</td>";
        echo "<td>";    echo  $row["quiz_time"];          echo "</td>";
            echo "<tr>";
        }
        echo "</table>";
    }

                    ?>



               
            </div>
        </div>



                                
                            </div>
                        </div> 

                    </div>
                    <!--/.col-->

                   

                                            
                                                

                       

                </div>                               
            </div><!-- .animated -->
        </div><!-- .content -->
                            
<?php

include "footer.php";


?>