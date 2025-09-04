<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Account Deactivated - LearnHub</title>
    <link rel="icon" type="image/png" href="./uploads/icons/favicon2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css"
    integrity="sha512-DxV+EoADOkOygM4IR9yXP8Sb2qwgidEmeqAEmDKIOfPRQZOWbXCzLC6vjbZyy0vPisbH2SyW27+ddLVCN+OMzQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #fca3aaff, #863139ff);
            font-family: Arial, sans-serif;
        }
        .card {
            border: none;
            border-radius: 15px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.15);
            max-width: 450px;
            text-align: center;
        }
        .icon {
            font-size: 60px;
            color: #dc3545;
        }
        .btn-custom {
            background: #dc3545;
            border: none;
        }
        .btn-custom:hover {
            background: #ce3141ff;
        }
    </style>
</head>
<body>
    <div class="card p-4">
        <div class="icon mb-3">
            <i class="fa-solid fa-user-slash"></i>
        </div>
        <h3 class="text-danger">Account Deactivated</h3>
        <p class="text-muted">Your account has been deactivated.<br>
        Please contact the administrator for further assistance.</p>
        <p class="text-muted">Email : support@learnhub.com</p>
        
        <div class="d-flex justify-content-center gap-3 mt-4">
            <a href="index.php" class="btn btn-secondary">Go Home</a>
            <a href="mailto:support@learnhub.com" class="btn btn-custom text-white">Contact Support</a>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/42e3c9e674.js" crossorigin="anonymous"></script>
</body>
</html>
