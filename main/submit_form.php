<!-- 
   
<!DOCTYPE html>
<html>
<head>
    <title>Submit Form</title>
    <link rel="stylesheet" href="style.css">
    <style>
        #success_message {
            display: none;
            background-color: #d4edda;
            color: #155724;
            border: 1px solid #c3e6cb;
            padding: 10px;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div id="success_message">
        <strong>Success!</strong> Your message has been sent successfully.
    </div>
   <button align="right" style="background-color:blue;margin-top:20px;width:80px;"><a style="font-weight:bold;color:white;" href="javascript:history.go(-1)">GO BACK</a></button> 
</body>
</html> -->


<?php

// Connect to the database
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "web";

$conn = mysqli_connect($servername, $username, $password, $dbname);

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Retrieve form data
$name = $_POST["name"];
$email = $_POST["email"];
$message = $_POST["message"];

// Insert data into messages table
$sql = "INSERT INTO messages (name, email, message)
VALUES ('$name', '$email', '$message')";

if (mysqli_query($conn, $sql)) {
    // Success message
    echo "<script>
              alert('Message sent successfully');
              document.getElementById('success_message').style.display = 'block';
          </script>";
// SMTP settings for Gmail
$smtp_server = 'smtp.gmail.com';
$smtp_username = 'timertest987@gmail.com';
$smtp_password = 'ffma kkwf mhkq fync';
$smtp_port = 587; // TLS encryption

// Send thank-you email
$to = $email;
$subject = "Thank You for Your Message";
$thank_you_message = "Dear $name,\n\nThank you for your message. We appreciate your feedback.\n\nBest regards,\nGully View";

// Include PHPMailer library
require 'vendor/autoload.php';


$mail = new \PHPMailer\PHPMailer\PHPMailer(true);


try {
    //Server settings
    $mail->isSMTP();
    $mail->Host       = $smtp_server;
    $mail->SMTPAuth   = true;
    $mail->Username   = $smtp_username;
    $mail->Password   = $smtp_password;
    $mail->SMTPSecure = 'tls'; // Enable TLS encryption
    $mail->Port       = $smtp_port;

    //Recipients
    $mail->setFrom('timertest987@gmail.com', 'Gully View');
    $mail->addAddress($to);

    // Content
    $mail->isHTML(true);
    $mail->Subject = $subject;
    $mail->Body    = $thank_you_message;

    $mail->send();
   // echo "<script>
            //  alert('Thank you email sent successfully');
         // </script>";
} catch (Exception $e) {
    echo "<script>
              alert('Failed to send thank you email. Error: ".$mail->ErrorInfo."');
          </script>";
}

}
mysqli_close($conn);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contactus</title>
    <link rel="stylesheet" href="style2.css">

</head>
<body>
     <nav id="navbar">
        <div id="logo">
            <a href="home.html">  <img src="Gully-View-11-2-2024.jpg" alt="zomato logo"></a>
        </div>
        <ul>
            <li class="item"><a href="home.html">Home</a></li>
            <li class="item"><a href="services.html">Services</a></li>
            <li class="item"><a href="contactus.html">Contact</a></li>
            <li class="item"><a href="aboutUs.html">About</a></li>
            <li class="item"><a href="food.html">Order-food</a></li>
        </ul>
    </nav>
    <hr>
    <div class="container">
        <div class="content">
            <div class="image-box">
                <img src="contactus.png" alt="">
            </div>
            <form method="POST" action="submit_form.php">

                <div class="topic">Send us a message</div>
                <div class="input-box">

                    <input type="text"  name="name">
                    <label for="name">Enter your name</label>
                </div>
                <div class="input-box">
                    <input type="text"  name="email">
                    <label for="email">Enter your email</label>
                </div>
                <div class="message-box">
                    <textarea style="padding: 10px;" name="message"></textarea>
                    <label for="message">Enter your message</label>
                </div>
                <div class="input-box">
                    <input type="submit" value="Send Message">
                    
                </div>
            </form>
        </div>
    </div>
</body>
</html>