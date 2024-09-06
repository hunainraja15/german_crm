<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employment Contract</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.6;
        }
        h1, h2 {
            text-align: center;
        }
        .content {
            margin: 20px 0;
        }
        .section {
            margin-bottom: 20px;
        }
        .signature {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <h1>Employment Contract</h1>

    <div class="content">
        <p>Dear <strong>{{ $employee_name }}</strong>,</p>
        <p>We are pleased to offer you the position of <strong>{{ $job_title }}</strong> at <strong>{{ $company_name }}</strong>. Please find below the details of your employment:</p>

        <div class="section">
            <h2>Job Title</h2>
            <p>{{ $job_title }}</p>
        </div>

        <div class="section">
            <h2>Salary</h2>
            <p>${{ number_format($salary, 2) }} per annum.</p>
        </div>

        <div class="section">
            <h2>Benefits</h2>
            <p>{{ $benefits }}</p>
        </div>

        {{-- <div class="section">
            <h2>Start Date</h2>
            <p>{{ $start_date }}</p>
        </div> --}}

        <p>We look forward to your contribution to our team. Please sign below to accept this offer.</p>
        <div class="signature">
            <p><strong>Admin Signature:</strong> <img src="{{ $signature }}" alt="signature"></p>
        </div>
        

        <div class="signature">
            <p><strong>Employer Signature:</strong> ________________________</p>
           
        </div>
    </div>
</body>
</html>
