

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>City_Explorer</title>
    <style>
      @import url('https://fonts.googleapis.com/css2?family=Cormorant:wght@500&display=swap');
   * {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: 'Poppins', sans-serif;
}
body {
  height: 100vh;
  width: 100%;
  display: flex;
  flex-direction: column; /* Set the flex-direction to column */
 background-image: url(pexels-fwstudio-129731.jpg);

}
#navbar {
  display: flex;
  align-items: center;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  background: #fae9fb;
  color: #fff;
  padding: 10px;
  padding-left: 0px;
  z-index: 1000;
}

#navbar::before {
  content: "";
background-color: #EEBF87;
  position: absolute;
  z-index: -1;
  height: 100%;
  width: 100%;
}

#navbar ul {
  display: flex;
}

#navbar ul li {
  list-style-type: none;
}

#navbar ul li a {
  text-decoration: none;
  padding: 8px;
  color: white;
  border-radius: 24px;
}

#navbar ul li a:hover {
  color: red;
  background-color: white;
}

#logo {
  margin-top: 4px;
  margin-left: 4px;
}

#logo img {
  height: 40px;
  width: 100px;
  margin: 6px;
  border: 3px solid white;
  border-radius: 30px;
}

@media screen and (max-width: 410px) {
  #navbar {
    flex-direction: column;
  }
}

.Banglore {
  display: flex;
  flex-wrap: wrap;
   /* Adjusted margin */
  padding: 10px;
}

.city {
  display: flex;
  float: left;
  width: 150px;
  height: 110px;
  box-sizing: border-box;
  padding: 30px;
  margin: 20px;
  margin-top: 0px;
  box-shadow: rgba(0, 0, 0, 0.17) 0px -23px 25px 0px inset, rgba(0, 0, 0, 0.15) 0px -36px 30px 0px inset, rgba(0, 0, 0, 0.1) 0px -79px 40px 0px inset, rgba(0, 0, 0, 0.06) 0px 2px 1px, rgba(0, 0, 0, 0.09) 0px 4px 2px, rgba(0, 0, 0, 0.09) 0px 8px 4px, rgba(0, 0, 0, 0.09) 0px 16px 8px, rgba(0, 0, 0, 0.09) 0px 32px 16px;
  margin-top: 100px;
  align-items: center;
  justify-content: center;
  background-image: linear-gradient(to right, rgba(0, 255, 234, 0.655), rgb(217, 226, 226));
  border-radius: 5px;
  backdrop-filter: blur(10px);
  margin-left: 60px;
}

.city a {
  font-family: 'Times New Roman', Times, serif;
  font-size: 1.5em;
  text-decoration: none;
  color: rgb(16, 14, 14);
  font-weight: bold;
}

.city:hover {
  width: 200px;
  height: 150px;
  transition: 1s;
  -webkit-box-reflect: below -30px linear-gradient(transparent, rgba(233, 48, 11, 0.714));
  box-shadow: 0 0 5px #ffffffbd, 0 0 15px #ffffff, 0 0 25px #8fe3d6, 0 0 100px #bbaab9;
}

.folded-img {
  margin-top: 100px;
  position: relative;
  display: flex;
  width: 100%;
  height: 50%;
  background-image: url('imgbg.jpg');
}


    </style>
</head>
<body>
    <nav id="navbar">
        <div id="logo">
        <a href="home.html">  <img src="Gully-View-11-2-2024.jpg" alt="zomato logo"></a>
        </div>
        <ul>
            <li class="item"><a href="home.html">home</a></li>
            <li class="item"><a href="services.html">services</a></li>
            <li class="item"><a href="contactus.html">contact</a></li>
            <li class="item"><a href="aboutUs.html">about</a></li>
            <li class="item"><a href="food.html">order-food</a></li>
        </ul>
    </nav>
    <hr>
    <div style="margin-top:100px;margin-left:30px;width:250px;height:200px;" class="about-text" >
    <?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';

function generateQRCode($row) {
    // Your existing QR code generation code here
    $name = isset($row['name']) ? $row['name'] : 'N/A';
    $email = isset($row['email']) ? $row['email'] : 'N/A';
    $phone = isset($row['phone']) ? $row['phone'] : 'N/A';
    $date = isset($row['date']) ? $row['date'] : 'N/A';
    $time = isset($row['time']) ? $row['time'] : 'N/A';
    $num_tickets = isset($row['num_tickets']) ? $row['num_tickets'] : 'N/A';
    $ticket_price = isset($row['ticket_price']) ? $row['ticket_price'] : '10';
    $total_price = isset($row['total_price']) ? $row['total_price'] : 'N/A';
  
    $data = "Welcome To Banashankari\nName: $name\nEmail: $email\nPhone: $phone\nDate: $date\nTime: $time\nNumber of Tickets: $num_tickets\nTicket_price: $ticket_price\nTotal Price: $total_price";
    $url = "https://chart.googleapis.com/chart?cht=qr&chs=150x150&chl=" . urlencode($data);
  
    // Get QR code image data
    $qrCodeData = file_get_contents($url);
    return $qrCodeData;
}

function generateTicketPDF($data, $qrCodeData) {
    $pdf = new TCPDF();
    $pdf->SetCreator(PDF_CREATOR);
    $pdf->SetAuthor('City Explorer');
    $pdf->SetTitle('Your Ticket');
    $pdf->SetMargins(10, 10, 10);
    $pdf->SetAutoPageBreak(true, 10);
    $pdf->AddPage();

    $html = '<h1>Ticket Details</h1>';
    foreach ($data as $key => $value) {
        $html .= "<p><strong>$key:</strong> $value</p>";
    }

    // Add QR code image to HTML
    $html .= '<img src="data:image/png;base64,' . base64_encode($qrCodeData) . '" />';

    $pdf->writeHTML($html, true, false, true, false, '');
    return $pdf->Output('ticket.pdf', 'S');
}

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
$phone = $_POST["phone"];
$date = $_POST["date"];
$time = $_POST["time"];
$num_tickets = $_POST["num_tickets"];
$ticket_price = 10; // constant price per ticket
$total_price = $num_tickets * $ticket_price;

// Insert data into tickets table
$sql = "INSERT INTO tickets (name, email, phone, date, time, num_tickets, ticket_price, total_price)
        VALUES ('$name', '$email', '$phone', '$date', '$time', '$num_tickets', 10, '$total_price')";

if (mysqli_query($conn, $sql)) {
    // Generate ticket PDF
    $ticketData = [
        'Name' => $name,
        'Email' => $email,
        'Phone' => $phone,
        'Date' => $date,
        'Time' => $time,
        'Number of Tickets' => $num_tickets,
        'Ticket Price' => 'Rs' . $ticket_price,
        'Total Price' => 'Rs' . $total_price
    ];

    // Generate QR code image data
    $qrCodeData = generateQRCode($_POST);

    // Generate ticket PDF with QR code embedded
    $pdfContent = generateTicketPDF($ticketData, $qrCodeData);

    // Create a new PHPMailer instance
    $mail = new PHPMailer(true);

    try {
        // SMTP configuration
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'timertest987@gmail.com';
        $mail->Password = 'ffma kkwf mhkq fync';
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Sender and recipient details
        $mail->setFrom('timertest987@gmail.com', 'Gully View');
        $mail->addAddress($email, $name);

        // Email subject and body
        $mail->Subject = 'Your Ticket';
        $mail->Body = 'Please find your ticket attached.';

        // Attach PDF to email
        $mail->addStringAttachment($pdfContent, 'ticket.pdf');

        // Send email
        $mail->send();
        echo 'Email sent successfully';
        echo "<a href=\"view.html\">View Ticket</a>\n";
    } catch (Exception $e) {
        echo 'Email could not be sent. Mailer Error: ' . $mail->ErrorInfo;
    }
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

// Close database connection
mysqli_close($conn);
?>



    </div>
    </body>
    </html>
