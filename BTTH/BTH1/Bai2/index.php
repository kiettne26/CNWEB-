<!DOCTYPE html>

<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#ffffff" />
    <title>Câu hỏi Ôn tập</title>
    <link rel="stylesheet" href="./css/bootstrap.min.css" />
    <link rel="stylesheet" href="./plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="./plugins/fontawesome/css/all.min.css" />
    <link rel="stylesheet" href="./plugins/alertify/alertify.min.css" />
    <link rel="stylesheet" href="./css/line-awesome.min.css" />
    <link rel="stylesheet" href="./css/material.css" />
    <link rel="stylesheet" href="./css/dataTables.bootstrap4.min.css" />
    <link rel="stylesheet" href="./plugins/toastr/toatr.css" />
    <link rel="stylesheet" href="./css/bootstrap-datetimepicker.min.css" />
    <link rel="stylesheet" href="./plugins/select2/css/select2.min.css" />
    <link rel="stylesheet" href="./css/style.css" />
    <link rel="stylesheet" href="./css/report.css" />
    <link rel="stylesheet" href="./css/cropper.min.css" />
    <link rel="stylesheet" href="./css/custom-sidebar.css" />
    <link rel="stylesheet" href="./css/custom.style.css" />
</head>

<body>
    <?php
    require 'dbconnect.php';
    ?>
    <?php
    include 'header.php';
    ?>
    <div class="container mt-5">

    </div>


    <div class="container mt-5">
        <?php


        echo "<div class='container mt-5'>";
        echo "<h1 class='text-center'>Bài kiểm tra trắc nghiệm</h1>";

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $score = 0;

            $result = $conn->query("SELECT * FROM questions");

            while ($row = $result->fetch_assoc()) {
                $question_id = $row['id'];

                $answer_result = $conn->query("SELECT * FROM answers WHERE question_id = $question_id AND is_correct = TRUE");
                $correct_answer = $answer_result->fetch_assoc();

                if (isset($_POST["question" . $question_id]) && $_POST["question" . $question_id] === $correct_answer['answer_text']) {
                    $score++;
                }
            }

            echo "<div class='alert fs-5 alert-success text-center'>";
            echo "Bạn trả lời đúng <strong>$score</strong> câu.";
            echo "</div>";
            echo '<div class="text-end">';
            echo "<a href='index.php' class='btn btn-primary'>Làm lại</a>";
            echo '</div>';
        } else {
            echo "<form method='POST' action=''>";

            $questions = $conn->query("SELECT * FROM questions");

            while ($question = $questions->fetch_assoc()) {
                $question_id = $question['id'];
                $question_text = htmlspecialchars($question['question_text'], ENT_QUOTES, 'UTF-8');

                echo "<div class='card mb-4'>";
                echo "<div class='card-header'><strong>$question_text</strong></div>";
                echo "<div class='card-body'>";

                $answers = $conn->query("SELECT * FROM answers WHERE question_id = $question_id");

                while ($answer = $answers->fetch_assoc()) {
                    $answer_text = htmlspecialchars($answer['answer_text'], ENT_QUOTES, 'UTF-8');
                    $answer_value = htmlspecialchars(substr($answer_text, 0, 1), ENT_QUOTES, 'UTF-8');

                    echo "<div class='form-check'>";
                    echo "<input class='form-check-input' type='radio' name='question" . $question_id . "' value='" . $answer_text . "' id='question" . $question_id . $answer_value . "'>";
                    echo "<label class='form-check-label' for='question" . $question_id . $answer_value . "'>" . $answer_text . "</label>";
                    echo "</div>";
                }

                echo "</div>";
                echo "</div>";
            }

            echo '<div class="text-end"><button type="submit" class="btn btn-primary">Nộp bài</button></div>';
            echo "</form>";
        }

        $conn->close();
        ?>



</body>
<?php
include 'footer.php';
?>
<script src="./js/jquery-3.7.1.min.js"></script>
<script src="./js/jquery.mask.js"></script>
<script src="./js/bootstrap.bundle.min.js"></script>
<script src="./js/jquery.slimscroll.min.js"></script>
<script src="./js/jquery.dataTables.min.js"></script>
<script src="./js/dataTables.bootstrap4.min.js"></script>
<script src="./js/dataTables.fixedColumns.js"></script>
<script src="./js/fixedColumns.dataTables.js"></script>
<script src="./plugins/toastr/toastr.min.js"></script>
<script src="./plugins/toastr/toastr.js"></script>
<script src="./plugins/alertify/alertify.min.js"></script>
<script src="./js/layout.js"></script>
<script src="./js/const.js"></script>
<script src="./js/toast.js"></script>
<script src="./js/config.js"></script>
<script src="./js/report.js"></script>
<script src="./js/notification.js"></script>
<script src="./js/date-util.js"></script>
<script src="./js/moment.min.js"></script>
<script src="./js/moment-vi.js"></script>
<script src="./js/bootstrap-datetimepicker.min.js"></script>
<script src="./js/datetime-moment.js"></script>
<script src="./plugins/select2/js/select2.min.js"></script>
<script src="./js/uc-helpers.js"></script>
<script src="./js/ucform-helpers.js"></script>
<script src="./js/custom.js"></script>
<script src="./js/cropper.js"></script>
<script src="./js/uuid.js"></script>
<script src="./js/JsBarcode.all.min.js"></script>
<script src="./js/lodash.min.js"></script>

</html>