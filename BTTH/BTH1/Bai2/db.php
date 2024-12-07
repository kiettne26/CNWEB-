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

    <?php


    // Kiểm tra xem file đã được upload chưa
    if (isset($_FILES['quizFile']) && $_FILES['quizFile']['error'] === UPLOAD_ERR_OK) {
        // Lấy đường dẫn tạm thời của file
        $tmpFilePath = $_FILES['quizFile']['tmp_name'];

        // Đọc nội dung file
        $questions = file($tmpFilePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

        $current_question = [];
        $questions_data = [];
        foreach ($questions as $line) {
            if (strpos($line, "Câu") === 0) {
                if (!empty($current_question)) {
                    $questions_data[] = $current_question;
                }
                $current_question = [$line];
            } elseif (strpos($line, "Đáp án:") !== false) {
                $current_question[] = $line;
            } else {
                $current_question[] = $line;
            }
        }
        if (!empty($current_question)) {
            $questions_data[] = $current_question;
        }
        $conn->query("DELETE FROM answers");
        $conn->query("DELETE FROM questions");
        // Lưu dữ liệu vào cơ sở dữ liệu
        foreach ($questions_data as $question) {
            // Lưu câu hỏi

            $question_text = $question[0]; // Lấy câu hỏi từ dòng đầu tiên
            $stmt = $conn->prepare("INSERT INTO questions (question_text) VALUES (?)");
            $stmt->bind_param("s", $question_text);
            $stmt->execute();

            // Lấy ID câu hỏi
            $question_id = $conn->insert_id;

            // Xác định đáp án đúng
            $correct_answer = "";
            foreach ($question as $line) {
                if (strpos($line, "Đáp án:") !== false) {
                    $correct_answer = trim(substr($line, strpos($line, ":") + 1)); // Lấy ký tự sau "Đáp án:"
                }
            }

            // Lưu các đáp án
            for ($i = 1; $i <= 4; $i++) {
                $answer_text = trim($question[$i]);
                $is_correct = (substr($answer_text, 0, 1) === $correct_answer) ? 1 : 0;

                $stmt = $conn->prepare("INSERT INTO answers (question_id, answer_text, is_correct) VALUES (?, ?, ?)");
                $stmt->bind_param("isi", $question_id, $answer_text, $is_correct);
                $stmt->execute();
            }
        }

        echo "<h1 class=\"text-center text-success fw-bold mt-5\">Dữ liệu đã được lưu vào cơ sở dữ liệu!</h1>";
    } else {
        echo "Lỗi khi upload file!";
    }

    $conn->close();

    ?>
    <?php
    include 'footer.php';
    ?>
</body>