<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Employment Contract</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px; /* Slightly reduced font size */
            line-height: 1.4; /* Reduced line height for compact content */
        }
        h1 {
            text-align: center;
            margin-bottom: 10px; /* Reduced margin */
            font-size: 20px; /* Reduced font size for title */
            font-weight: bold;
        }
        h2 {
            font-size: 16px; /* Reduced font size for headings */
            font-weight: bold;
            margin-top: 15px; /* Slightly reduced margin */
        }
        .contract-container {
            padding: 20px; /* Reduced padding to save space */
            border: 1px solid #ddd;
            border-radius: 10px;
            background-color: #f9f9f9;
            max-width: 800px; /* Max width to ensure compactness */
            margin: auto; /* Center the contract */
        }
        .content {
            margin-top: 15px;
        }
        .section {
            margin-bottom: 15px; /* Reduced margin to save space */
        }
        .signature-section {
            margin-top: 30px;
            display: flex;
            justify-content: space-between;
        }
        .signature img {
            width: 120px; /* Reduced size for signature image */
            height: auto;
        }
        .signature-line {
            width: 150px; /* Reduced signature line width */
            border-bottom: 1px solid #000;
            display: inline-block;
        }
        .text-bold {
            font-weight: bold;
        }
        /* Ensure the contract stays compact */
        @media print {
            body, .contract-container {
                padding: 0;
                margin: 0;
            }
        }
    </style>
</head>
<body>

    <div class="container mt-4">
        <div class="contract-container">
            <h1>Employment Contract</h1>

            <p>Dear <strong>{{ $employee_name }}</strong>,</p>
            <p>We are pleased to offer you the position of <strong>{{ $job_title }}</strong> at <strong>{{ $company_name }}</strong>. Please find below the terms of your employment:</p>

            <!-- Job Title Section -->
            <div class="section">
                <h2>1. Job </h2>
                <p>You will be employed as a <strong>{{ $job_title }}</strong>.</p>
            </div>

            <!-- Salary Section -->
            <div class="section">
                <h2>2. Salary</h2>
                <p>Your annual salary will be <strong>${{ number_format($salary, 2) }}</strong>.</p>
            </div>

            <!-- Benefits Section -->
            <div class="section">
                <h2>3. Benefits</h2>
                <p>The following benefits will be available:</p>
                <ul>
                    <li>{{ $benefits }}</li>
                </ul>
            </div>

            <!-- Optional Start Date -->
            {{-- <!-- <div class="section">
                <h2>4. Start Date</h2>
                <p>Your employment will begin on <strong>{{ $start_date }}</strong>.</p>
            </div> --> --}}

            <!-- Signatures Section -->
            <div class="section">
                <p>Please sign below to confirm your acceptance of this offer.</p>

                <div class="signature-section">
                    <!-- Admin Signature -->
                    <div class="signature">
                        <p><strong>Admin Signature:</strong></p>
                        <img src="{{ $signature }}" alt="Admin Signature">
                    </div>
                <!-- Employee Acceptance Section -->
                <div class="signature mt-4">
                   
                    <p><strong>Employee Signature:</strong></p>
                    @if ($employer_signature)
    <img src="{{ $employer_signature }}" alt="Employer Signature">
@else
    <p>Employer signature not available.</p>
@endif
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
