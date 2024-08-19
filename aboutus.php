<!-- for send message on email -->
<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $message = htmlspecialchars($_POST['message']);

    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = 0;                       // Enable verbose debug output
        $mail->isSMTP();                            // Send using SMTP
        $mail->Host       = 'smtp.gmail.com';     // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                   // Enable SMTP authentication
        $mail->Username   = 'afzalsaifee221@gmail.com'; // SMTP username
        $mail->Password   = 'zgca jysp glaq monf';        // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS; // Enable TLS encryption; PHPMailer::ENCRYPTION_SMTPS also accepted
        $mail->Port       = 587;                    // TCP port to connect to

        //Recipients
        $mail->setFrom($email, $name);
        $mail->addAddress('afzalsaifee221@gmail.com');     // Add a recipient

        // Content
        $mail->isHTML(true);                        // Set email format to HTML
        $mail->Subject = 'New Contact Form Submission';
        $mail->Body    = "Name: $name<br>Email: $email<br>Message: $message";
        $mail->AltBody = "Name: $name\nEmail: $email\nMessage: $message";

        $mail->send();
        echo '<script> alert("Message has been sent");</script>';
    
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us</title>
    <?php include("boot-css.php"); ?>
    
    <style>
        body {
            /* font-family: 'Arial', sans-serif; */
            background-color: #f8f9fa;
        }
        
        .about-header {
            text-align: center;
            margin-bottom: 40px;
        }
        .about-header h1 {
            font-size: 3rem;
            margin-bottom: 10px;
            color: #3C4559;
        }
        .about-header p {
            font-size: 1.2rem;
            color: #555;
            color: #3C4559;
        }
       
        .card-group {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
        }
        .card {
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            flex: 1 1 calc(33% - 20px);
            max-width: calc(33% - 20px);
            margin: 10px 0;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.2);
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .card:hover img {
            transform: scale(1.1);
        }
        .card-body {
            padding: 20px;
        }
        .card-body h5 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #3C4559;
        }
        .card-body p {
            font-size: 1rem;
            color: #3C4559;
        }
        .team {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
        }
        .team-member {
            margin: 20px;
            text-align: center;
        }
        .team-member img {
            border-radius: 50%;
            width: 150px;
            height: 150px;
            object-fit: cover;
            transition: transform 0.3s ease;
        }
        .team-member:hover img {
            transform: scale(1.1);
        }
        .team-member h6 {
            margin-top: 10px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #3C4559;
        }
        .team-member p {
            color: #777;
        }
        .testimonials {
            margin-top: 40px;
        }
        .testimonials-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .testimonial {
            margin: 20px 0;
            padding: 20px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .testimonials-header h1,.testimonials-header h1 p{
            color: #3C4559;
        }
        .testimonial p {
            font-size: 1rem;
            color: #3C4559;
        }
        .testimonial h6 {
            margin-top: 10px;
            font-size: 1.2rem;
            font-weight: bold;
            color: #3C4559;
        }
        .contact-form {
            margin-top: 40px;
        }
        .contact-form-header {
            text-align: center;
            margin-bottom: 20px;
        }
        .contact-form-header h1,.contact-form-header h1 p {
            color: #3C4559;
        }
        .contact-form form {
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .contact-form input,
        .contact-form textarea {
            width: 100%;
            max-width: 600px;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        .contact-form button {
            padding: 10px 20px;
            background-color: #3C4559;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .contact-form button:hover {
            background-color: #2a3242;
        }
    </style>
</head>
<body>
    <?php include("header.php"); ?>
    

    <div class="container" style=" max-width: 1200px;
            margin: 20px auto;
            padding: 20px;">
        <div class="about-header">
            <h1>About Us</h1>
            <p>Learn more about our mission, values, and the team that makes everything possible.</p>
        </div>
        <div class="card-group">
            <div class="card">
                <img src="image/mission.png" alt="Vision">
                <div class="card-body">
                    <h5>Our Vision</h5>
                    <p>We envision a world where local commerce thrives, and every transaction is simple, secure, and rewarding for both parties involved.</p>
                </div>
            </div>
            <div class="card">
                <img src="image/vision.png" alt="Mission">
                <div class="card-body">
                    <h5>Our Mission</h5>
                    <p>Our mission is to revolutionize the way people buy and sell products by providing a seamless, user-friendly platform that connects buyers and sellers locally.</p>
                </div>
            </div>
            <div class="card">
                <img src="image/value.png" alt="Values">
                <div class="card-body">
                    <h5>Our Values</h5>
                    <p>Integrity, transparency, and customer-centricity are at the core of everything we do. We strive to uphold these values in all our interactions and decisions.</p>
                </div>
            </div>
        </div>
        
        <div class="about-header">
            <h1>Our Team</h1>
            <p>Meet the passionate individuals behind our platform.</p>
        </div>
        <div class="team">
            <div class="team-member">
                <img src="image/men1.jpg" alt="Team Member 1">
                <h6>John Doe</h6>
                <p>CEO & Founder</p>
            </div>
            <div class="team-member">
                <img src="image/men2.avif" alt="Team Member 2">
                <h6>Jane Smith</h6>
                <p>Chief Marketing Officer</p>
            </div>
            <div class="team-member">
                <img src="image/men.jpg" alt="Team Member 3">
                <h6>Sam Wilson</h6>
                <p>Chief Technology Officer</p>
            </div>
        </div>

        <div class="testimonials">
            <div class="testimonials-header">
                <h1>Testimonials</h1>
                <p>Hear from our satisfied customers and partners.</p>
            </div>
            <div class="testimonial">
                <p>"This platform has completely changed the way I buy and sell products. It's user-friendly and reliable!"</p>
                <h6>Emily R.</h6>
            </div>
            <div class="testimonial">
                <p>"I've been able to reach more customers and grow my business thanks to this amazing service!"</p>
                <h6>Michael T.</h6>
            </div>
        </div>

        <div class="contact-form">
            <div class="contact-form-header">
                <h1>Contact Us</h1>
                <p>We'd love to hear from you! Reach out to us with any questions or feedback.</p>
            </div>
            <form action="aboutus.php" method="POST">
                <input type="text" name="name" placeholder="Your Name" required>
                <input type="email" name="email" placeholder="Your Email" required>
                <textarea name="message" placeholder="Your Message" rows="5" required></textarea>
                <button type="submit">Send Message</button>
            </form>
        </div>
    </div>
    
    <?php include("footer.php"); ?>
    <?php include("boot-script.php"); ?>
</body>
</html>
