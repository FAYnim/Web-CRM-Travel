<?php
    include '../../config.php';

    $redir_failed = "../../login";
    $redir_success = "../../index";

    $email = $_POST['inp-email'];
    $password = $_POST['inp-password'];

    $sql = mysqli_query($koneksi, "SELECT * FROM user WHERE email = '$email' AND pw = '$password'");
    if($sql == true) {
        $rows = mysqli_num_rows($sql);

        if($rows > 0) {
            $result = mysqli_fetch_assoc($sql);
            $pass_from_db = $result['pw'];

            if($password === $pass_from_db) {
                $_SESSION['login'] = true;
                header("Location: $redir_success");
            } else {
                header("Location: $redir_failed");
            }

        } else {
            header("Location: $redir_failed");
        }
    } else {
        header("Location: $redir_failed");
    }
?>
