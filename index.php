<?php

    // Check if User Coming From A Request

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        
        // Assign Variables

        $user = filter_var($_POST['username'], FILTER_SANITIZE_STRING);
        $mail = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
        $subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
        $msg = filter_var($_POST['message'], FILTER_SANITIZE_STRING);

        // Creating Array of Errors

        $formErrors = array();

        if (strlen($user) <= 3) {
            $formErrors[] = 'Name Must be Larger Than <strong>3</strong> Characters';
        }

        if (strlen($msg) < 7) {
            $formErrors[] = 'Message Can\'t be less Than <strong>10</strong> Characters';
        }

        // If No Errors Send The Email [ mail(To, Subject, Message, Headers, Parameters) ]
        
        $headers = 'From: ' . $mail . '\r\n';
        $myEmail = 'mazenmo7amed2812010@gmail.com';
        $sub = 'Contact Form';
        
        if (empty($formErrors)) {

            mail($myEmail, $sub, $msg, $headers);

        }

    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mazen Contact Form</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/contact.css">
    <script src="https://kit.fontawesome.com/366daf9551.js" crossorigin="anonymous"></script>
</head>
<body>

    <!-- Start Form -->

    <div class="container">
        <h1 class="text-center">Contact Me</h1>
        <form class="contact-form" action="<?php echo $_SERVER['PHP_SELF'] ?>" method="POST">
            <?php if (! empty($formErrors)) { ?>
            <div class="alert alert-danger" role="alert">
                <?php
                    foreach($formErrors as $error) {
                        echo $error . '<br/>';
                    }
                ?>
            </div>
            <?php } ?>
            <div class="form-group">
                <input class="username form-control" type="text" name="username" placeholder="Name" value="<?php if (isset($user)) { echo $user; } ?>"/>
                <i class="fa fa-user fa-fw"></i>
                <span class="asterisx">*</span>
                <div class="alert alert-danger custom-alert">
                    Name Must Be Larger Than <strong>3</strong> Characters
                </div>
            </div>
            <div class="form-group">
                <input class="email form-control" type="email" name="email" placeholder="Email" value="<?php if (isset($mail)) { echo $mail; } ?>"/>
                <i class="fa fa-envelope fa-fw"></i>
                <span class="asterisx">*</span>
                <div class="alert alert-danger custom-alert">
                    Email Can't Be <strong>Empty</strong>
                </div>
            </div>
            <input class="form-control" type="text" name="subject" placeholder="Subject" value="<?php if (isset($subject)) { echo $subject; } ?>"/>
            <i class="fa fa-envelope-open-text"></i>
            <div class="form-group">
                <textarea class="message form-control" name="message" placeholder="Message" value="<?php if (isset($msg)) { echo $msg; } ?>"></textarea>
                <span class="asterisx">*</span>
                <div class="alert alert-danger custom-alert">
                    Message Can't be less Than <strong>7</strong> Characters
                </div>
            </div>
            <input class="btn btn-success" type="submit" value="Send Message" />
            <i class="fa fa-send fa-fw send-icon"></i>
        </form>
    </div>

    <!-- End Form -->


    <script src="js/jquery-1.12.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="custom.js"></script>
</body>
</html>