
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Payment verification </title>
  <link href="https://fonts.googleapis.com/css2?family=Urbanist:wght@400;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-family: 'Urbanist', sans-serif;
      background: #f7fbfc;
      margin: 0;
      padding: 20px;
    }
    .container {
      max-width: 700px;
      margin: auto;
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 12px 30px rgba(0, 0, 0, 0.1);
    }
    h2 {
      text-align: center;
      color: #007bff;
      margin-bottom: 20px;
    }
    form label {
      display: block;
      margin: 10px 0 5px;
      font-weight: bold;
    }
    form input, form textarea, form select {
      width: 100%;
      padding: 12px;
      margin-bottom: 15px;
      border: 1px solid #ccc;
      border-radius: 6px;
    }
    form button {
      background-color: #007bff;
      color: white;
      padding: 12px;
      border: none;
      width: 100%;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
    }
    form button:hover {
      background-color: #0056b3;
    }
    .btn {
        background-color: #007bff;
      color: white;
      padding: 12px;
      border: none;
      width: 100%;
      font-size: 16px;
      border-radius: 6px;
      cursor: pointer;
      margin-top: 15px;
    }
    .btn:hover {
      background-color: #0056b3;
    }
    a {
      color: white;
      text-decoration: none;
    }
  </style>
</head>
<body>
  <div class="container">
    <h2>Payment Verification </h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST" enctype="multipart/form-data">
      <label for="name">Name</label>
      <input type="text" id="name" name="name" placeholder="Your full name" required />

      <label for="email">Email</label>
      <input type="email" id="email" name="email" placeholder="you@example.com" required />

      <label for="location">Location</label>
      <input type="text" id="location" name="location" placeholder="e.g. Main Street near Park" required />

      <label for="description">Description</label>
      <textarea id="description" name="description" rows="4" placeholder="Brief description of the Payment and please upload image ..." required></textarea>

      <label for="image">Upload Image (Required)</label>
      <input type="file" id="image" required name="image" accept="image/*" />

      <button type="submit" name="submit">Submit Complaint</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['submit'])) {
      // Basic sanitation
      $name = htmlspecialchars($_POST['name']);
      $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
      $location = htmlspecialchars($_POST['location']);
      $type = htmlspecialchars($_POST['type']);
      $description = htmlspecialchars($_POST['description']);

      // Generate a unique tracking ID
      $tracking_id = uniqid('issue_', true);

      // Compose message
      $to = "roadcare@example.com"; // Replace with your actual email
      $subject = "New Road Issue Reported: $type - Tracking ID: $tracking_id";
      $boundary = md5(time());
      $headers = "From: $email\r\n";
      $headers .= "Reply-To: $email\r\n";
      $headers .= "MIME-Version: 1.0\r\n";
      $headers .= "Content-Type: multipart/mixed; boundary=\"{$boundary}\"\r\n";

      $body = "--{$boundary}\r\n";
      $body .= "Content-Type: text/plain; charset=UTF-8\r\n";
      $body .= "Content-Transfer-Encoding: 7bit\r\n\r\n";
      $body .= "Tracking ID: $tracking_id\nName: $name\nEmail: $email\nLocation: $location\nIssue Type: $type\n\nDescription:\n$description\r\n\r\n";

      // Handle file upload if exists
      if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $file_tmp = $_FILES['image']['tmp_name'];
        $file_name = $_FILES['image']['name'];
        $file_type = mime_content_type($file_tmp);
        $file_data = chunk_split(base64_encode(file_get_contents($file_tmp)));

        $body .= "--{$boundary}\r\n";
        $body .= "Content-Type: $file_type; name=\"$file_name\"\r\n";
        $body .= "Content-Disposition: attachment; filename=\"$file_name\"\r\n";
        $body .= "Content-Transfer-Encoding: base64\r\n\r\n";
        $body .= $file_data . "\r\n\r\n";
      }

      $body .= "--{$boundary}--";

      // Send email
      if (mail($to, $subject, $body, $headers)) {
        // Send confirmation email to user with tracking ID
        $confirmation_subject = "Your Road Issue Report - Tracking ID: $tracking_id";
        $confirmation_message = "Thank you for reporting the issue. Your tracking ID is: $tracking_id. We will keep you updated.";
        mail($email, $confirmation_subject, $confirmation_message, "From: no-reply@roadcare.com");

        echo "<p style='color:green;'>Thank you! Your complaint has been submitted. Tracking ID: $tracking_id</p>";
      } else {
        echo "<p style='color:red;'>Sorry, there was a problem sending your report. Please try again.</p>";
      }
    }
    ?>
  </div>
  <button class="btn "> <a href="../index.html"> Home </a></button>
</body>
</html>
