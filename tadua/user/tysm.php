<?php
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KASIR - Warung Djeng Nita</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        body {
            background-image: url('../bg.jpeg');
            background-size: cover;
            background-repeat: no-repeat;
            color: #fff;
            font-family: 'Poppins', sans-serif;
            margin: 0;
            padding: 0;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.85);
            border: none;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
            transition: all 0.4s ease;
        }

        .card:hover {
            transform: translateY(-10px);
            box-shadow: 0 12px 28px rgba(0, 0, 0, 0.35);
        }

        .card-title {
            font-size: 2.5rem;
            font-weight: 600;
            color: #4E342E;
        }

        .text {
            font-size: 1.1rem;
            color: #333;
        }

        .card-body {
            text-align: center;
        }

        .btn {
            background-color: #8B4513;
            border: none;
            border-radius: 30px;
            padding: 12px 25px;
            font-size: 1.2rem;
            color: white;
            font-weight: 600;
            transition: background-color 0.3s, transform 0.3s ease;
        }

        .btn:hover {
            background-color: #A0522D;
            transform: translateY(-2px);
        }

        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: rgba(0, 0, 0, 0.6);
            color: #fff;
            text-align: center;
            padding: 10px 0;
            font-size: 0.9rem;
        }

        .container {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            width: 100%;
            max-width: 500px;
            padding: 30px;
        }

        .d-grid .btn {
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="card text-center">
                    <div class="card-body">
                        <h5 class="card-title">WARUNG DJENG NITA</h5>
                        <p class="text">TERIMAKASIH, SELAMAT MENIKMATI HINDANGAN ANDA</p>
                    </div>
                    <div class="card-footer">
                        <div class="d-grid gap-2">
                            <a href="dashboard.php" class="btn">kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="footer"><p>&copy; 2024 Warung Djeng Nita. All Rights Reserved.</p></div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
