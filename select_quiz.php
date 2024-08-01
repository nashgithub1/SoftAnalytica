<?php
session_start();

if (!isset($_SESSION["user_id"])) {
?>

<script type="text/javascript">
    window.location = "login.php";
</script>

<?php
}
?>

<?php 
$mysqli = include "database.php";
include "headerwithouttimer.php";
?>

<div class="row" style="">
    <div class="col-lg-6 col-lg-push-3" style="min-height: 600px; background-color: White;">
        <?php
        $res = $mysqli->query("SELECT * FROM quiz_category");

        while ($row = mysqli_fetch_array($res)) {
            if (in_array($row["id"], ["6", "7", "8"])) {
                continue;
            }

            $category = $row["category"];
            $time = $row["quiz_time_in_minutes"];
            $resource = $row["resource"];
        ?>
            <input type="button" class="btn btn-success form-control quiz-btn" value="<?php echo $category; ?>" style="margin-top:10px; background-color:blue; color:white" data-category="<?php echo $category; ?>" data-time="<?php echo $time; ?>" data-resource="<?php echo $resource; ?>">
        <?php
        }
        ?>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="quizModal" tabindex="-1" role="dialog" aria-labelledby="quizModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content" style="background-color: #EDF9EB; text-align: center;"> <!-- Change background color and center align text -->
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title" id="quizModalLabel" style="margin: 0 auto;">Quiz Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="position: absolute; right: 15px; top: 15px;">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body" style="padding: 2rem;">
                <p id="quizName" style="margin-bottom: 1rem;"></p>
                <p id="quizTime" style="margin-bottom: 1rem;"></p>
                <div id="quizResource" style="margin-bottom: 1rem;"></div>
            </div>
            <div class="modal-footer" style="border-top: none;">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" style="margin-right: auto;">Close</button>
                <button type="button" class="btn btn-primary" id="startQuiz" style="margin-left: auto;">Start Quiz</button>
            </div>
        </div>
    </div>
</div>

<?php include "footer.php"; ?>

<script type="text/javascript">
    $(document).ready(function () {
        $('.quiz-btn').on('click', function () {
            var category = $(this).data('category');
            var time = $(this).data('time');
            var resource = $(this).data('resource');
            
            $('#quizName').text('Quiz: ' + category);
            $('#quizTime').text('Time: ' + time + ' minutes');
            
            var resourceArray = resource.split(',');
            var resourceHtml = 'Resource:<br>';
            resourceArray.forEach(function (url) {
                resourceHtml += '<a href="' + url.trim() + '" target="_blank">' + url.trim() + '</a><br>';
            });
            $('#quizResource').html(resourceHtml);
            
            $('#quizModal').modal('show');

            $('#startQuiz').off('click').on('click', function () {
                set_exam_type_session(category);
            });
        });
    });

    function set_exam_type_session(quiz_category) {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function () {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                window.location = "dashboard.php";
            }
        };
        xmlhttp.open("GET", "forajax/set_quiz_type_session.php?quiz_category=" + quiz_category, true);
        xmlhttp.send(null);
    }
</script>
