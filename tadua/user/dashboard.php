<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KASIR - Warung DJENG NITA</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-image: url('bg.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-color: #6B4423;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
            margin: 0;
        }

        .navbar {
            background-color: #4E342E;
            color: white;
            padding: 10px 0;
        }

        .navbar .navbar-brand {
            font-weight: bold;
            color: white;
        }

        .navbar .navbar-nav .nav-link {
            color: white;
            font-weight: bold;
            margin-right: 15px;
        }

        .navbar .navbar-nav .nav-link:hover {
            color: #FFB74D;
        }

        .desain {
            background-image: url('https://source.unsplash.com/1600x900/?village');
            background-size: cover;
            background-position: center;
            height: 70vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            text-align: center;
            position: relative;
        }

        .desain .card {
            background-color: rgba(255, 255, 255, 0.85);
            border-radius: 15px;
            padding: 40px;
            color: #4E342E;
            max-width: 700px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.3);
            text-shadow: none;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .desain .card:hover {
            transform: scale(1.05);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.4);
        }

        .desain h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .desain p {
            font-size: 1.4rem;
        }

        .btn-primary {
            background-color: #FFB74D;
            border: none;
            font-weight: bold;
            border-radius: 25px;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #FFAB40;
        }

        .footer {
            text-align: center;
            color: white;
            padding: 20px;
            background-color: #4E342E;
            font-size: 1rem;
            margin-top: auto;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg">
        <div class="container-fluid">
            <a class="navbar-brand"><h1>Warung DJENG NITA</h1></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
    </nav>

    <div class="desain">
        <div class="card">
            <h1>SELAMAT DATANG DI RESTORAN WARUNG DJENG NITA</h1>
            <p>selamat menikmati hidangan kami semoga memuaskan</p>
            <a href="isidata.php" class="btn btn-primary mt-4">pesan menu →</a>
        </div>
    </div>

    <footer class="footer">
        <p>&copy; 2024 Warung DJENG NITA | All Rights Reserved</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
