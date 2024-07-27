<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-size: cover;
            background-position: center;
            background-color: gray;
        }

        .container {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }

        .login-box {
            box-shadow: 0 0 10px rgba(226, 223, 223, 0.3);
            border-radius: 10px;
            padding: 30px;
            margin-top: 30px;
            background-color: #000;
        }

        .login-box h2 {
            margin-bottom: 20px;
            color: #fff;
        }

        .form-label {
            color: #fff;
        }

        .input-group-text {
            background-color: #555;
            color: #fff;
        }

        .form-control {
            border-radius: 0 10px 10px 0;
        }

        .btn-primary {
            background-color: #424949;
            border: none;
            border-radius: 10px;
            padding: 10px 20px;
        }

        .btn-primary:hover {
            background-color: #616A6B;
        }

        .link {
            color: red;
        }

        .link:hover {
            color: #fff;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="col-md-6">
            <div class="login-box">
                <h2>Recuperar contraseña</h2>
                <?php
                if ($_SERVER["REQUEST_METHOD"] == "POST") {
                    $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
                    
                    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $to = 'tuemail@dominio.com';  // Cambia esto a tu dirección de correo
                        $subject = 'Solicitud de cambio de contraseña';
                        $message = "El usuario con el correo electrónico " . $email . " ha solicitado un cambio de contraseña.";
                        $headers = 'From: noreply@tusitio.com' . "\r\n" .
                                   'Reply-To: noreply@tusitio.com' . "\r\n" .
                                   'X-Mailer: PHP/' . phpversion();
                        
                        if (mail($to, $subject, $message, $headers)) {
                            echo "<p style='color: green;'>Solicitud enviada con éxito.</p>";
                        } else {
                            echo "<p style='color: red;'>Error al enviar la solicitud. Inténtalo de nuevo.</p>";
                        }
                    } else {
                        echo "<p style='color: red;'>Dirección de correo no válida.</p>";
                    }
                }
                ?>
                <form action="" method="post">
                    <div class="form-group">
                        <label for="email" class="form-label"><i class="bi bi-envelope"></i> Correo electrónico</label>
                        <input type="email" class="form-control" id="email" name="email" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Enviar solicitud</button>
                </form>
                <div class="form-group-link">
                    <a href="../index.php" class="link">Volver al inicio de sesión</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
