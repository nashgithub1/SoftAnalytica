<?php 
session_start();
$mysqli = include "database.php";
include "headerwithouttimer.php";
if(!isset($_SESSION["user_name"]))
{
    ?>
        <script type="text/javascript">
            window.location-"login.php";
        </script>
    <?php
}
?>


        <div class="row" style="">

            <div class="col-lg-6 col-lg-push-3" style="min-height: 500px; background-color: White;">
<center>





</center>
                    <?php 
                    $count = 0;
                    $res = $mysqli->query("SELECT * from quiz_results where user_name='$_SESSION[user_name]' order by id desc");
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

<center>
            <button onclick="downloadPDF()">Download as PDF</button>
        </center>

               
            </div>
        </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
<script>
async function downloadPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Convert the HTML table to canvas
    const element = document.getElementById("resultTable");
    const canvas = await html2canvas(element);

    // Get image data from the canvas
    const imgData = canvas.toDataURL('image/png');
    const imgProps = doc.getImageProperties(imgData);
    const pdfWidth = doc.internal.pageSize.getWidth();
    const pdfHeight = (imgProps.height * pdfWidth) / imgProps.width;

    // Add the image to the PDF
    doc.addImage(imgData, 'PNG', 0, 0, pdfWidth, pdfHeight);

    // Save the PDF
    doc.save('quiz_results.pdf');
}
</script>



       <?php
include "footer.php";
       ?>