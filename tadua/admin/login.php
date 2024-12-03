<?php
if (isset($_POST['simpan'])) {
    session_start();
    include '../koneksi.php';
    $data_username = $_POST['username'];
    $data_password = $_POST['password'];
    $query = mysqli_query($koneksi, "SELECT * from admin where username='$data_username' AND password='$data_password'");
    if (mysqli_num_rows($query) == 1) {
        $_SESSION['username'] = $data_username;
        $_SESSION['login'] = true;
        header("location:dashboard.php");
    } else {
        echo "
<script>
    alert('Password Salah')
    document.location = 'login.php';
</script>";
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kasir - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-image: url('bg.png');
            background-size: cover;
            background-repeat: no-repeat;
            background-color: #62422F;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .card {
            background-color: rgba(255, 255, 255, 0.4);
            border: none;
            border-radius: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
            width: 100%;
            max-width: 450px;
            padding: 40px;
            backdrop-filter: blur(10px);
            animation: fadeIn 0.8s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .card h1,
        .card h3 {
            color: #4E342E;
            font-weight: bold;
            letter-spacing: 1px;
            text-shadow: 0 0 8px rgba(255, 255, 255, 0.8),
                0 0 16px rgba(255, 255, 255, 0.6),
                0 0 24px rgba(255, 255, 255, 0.4);
        }

        .btn-primary {
            background: linear-gradient(135deg, #FF9800, #F57C00);
            border: none;
            border-radius: 25px;
            padding: 12px 25px;
            transition: background-color 0.3s, transform 0.2s;
        }

        .btn-primary:hover {
            background-color: #e67e22;
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .form-label {
            font-weight: bold;
            color: #4E342E;
        }

        .form-control {
            height: 45px;
            border-radius: 10px;
            border: 1px solid #ddd;
            transition: border-color 0.3s, box-shadow 0.3s;
        }

        .form-control:focus {
            border-color: #FF9800;
            box-shadow: 0 0 8px rgba(255, 152, 0, 0.5);
        }

        input[type="text"],
        input[type="password"] {
            transition: background-color 0.3s, transform 0.2s;
        }

        input[type="text"]:hover,
        input[type="password"]:hover {
            background-color: #f8f8f8;
            transform: translateY(-2px);
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            background-color: #fff;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6">
                <div class="card text-center position-absolute top-50 start-50 translate-middle">
                    <div class="container">
                        <form action="" method="post">
                            <fieldset>
                                <legend>
                                    <h1>WARUNG DJENG NITA</h1>
                                </legend>
                                <legend>
                                    <h3>LOGIN</h3>
                                </legend>
                                <div class="mb-4 mt-4">
                                    <label for="username" class="form-label">Username</label>
                                    <input type="text" name="username" id="username" class="form-control"
                                        placeholder="Masukan nama anda" required>
                                </div>
                                <div class="mb-4">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password" id="password" class="form-control"
                                        placeholder="Masukan password anda" required>
                                </div>
                                <button type="submit" name="simpan" class="btn btn-primary w-100">Login</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>