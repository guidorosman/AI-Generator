<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Cover Letter - PHP Developer</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      margin: 0;
      padding: 20px;
      color: #333;
    }
    .container {
      max-width: 800px;
      margin: auto;
      background: #fff;
      padding: 30px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      line-height: 1.6;
    }
    .contact-info {
      text-align: right;
      font-size: 0.9em;
      margin-bottom: 20px;
    }
    .content {
      margin-bottom: 25px;
    }
    .signature {
      margin-top: 30px;
      text-align: right;
    }
  </style>
</head>
<body>
  <div class="container">
    <!-- Contact Information -->
    <div class="contact-info">
      <p>{{ $cvData['fullname'] }}</p>
      <p>{{ $cvData['email'] }} | {{ $cvData['phone'] }}</p>
      <p>{{ \Carbon\Carbon::now()->format('d/m/Y') }}</p>
    </div>
    
    <!-- Cover Letter Content -->
    <div class="content">
      <p>Dear Hiring Manager,</p>
      {!! nl2br(e($clData)) !!}
    </div>
    
    <!-- Signature -->
    <div class="signature">
      <p>Sincerely,</p>
      <p>{{ $cvData['fullname'] }}</p>
    </div>
  </div>
</body>
</html>
