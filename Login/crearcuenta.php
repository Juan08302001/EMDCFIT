<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cuenta</title>
    <link rel="stylesheet" href="../css/inicio.css">
    <link rel="icon" href="../img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        body {
            background-size: cover;
            background-position: center;
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
            height: 95%;
            width: 100%;
            max-width: 600px;
            margin-top: 10px;
            background-color: #000;
        }

        .login-box h2 {
            margin-bottom: 20px;
            color: #fff;
            text-align: center;
        }

        .form-label {
            color: #fff;
            font-weight: bold;
        }

        .input-group-text {
            background-color: #555;
            color: #fff;
        }

        .form-control {
            border-radius: 10px;
        }

        .btn-primary {
            background-color: #424949;
            border: none;
            color: white;
            border-radius: 10px;
            padding: 10px 20px;
            width: 100%;
        }

        .btn-primary:hover {
            background-color: #616A6B;
        }

        .link {
            color: red;
            text-align: center;
            display: block;
        }

        .link:hover {
            color: #fff;
            text-decoration: none;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin-top: 15px;
        }

        .col-md-6 {
            padding: 0 10px;
        }

    </style>
</head>
<body>
<div class="container">
    <div class="login-box">
        <h2>Crear cuenta</h2>
        <form action="\EMDC FIT\controladores\crear cuenta.php" method="POST" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombre" class="form-label"><i class="bi bi-person"></i> Nombre completo:</label>
                        <input type="text" id="nombre" name="nombre" class="form-control" placeholder="Ingrese el nombre completo" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="direccion" class="form-label"><i class="bi bi-geo-alt"></i> Dirección:</label>
                        <input type="text" id="direccion" name="direccion" class="form-control" placeholder="Ingrese la dirección" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="telefono" class="form-label"><i class="bi bi-phone"></i> Teléfono:</label>
                        <input type="tel" id="telefono" name="telefono" class="form-control" placeholder="Ingrese el teléfono" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email" class="form-label"><i class="bi bi-envelope"></i> Correo Electrónico:</label>
                        <input type="email" id="email" name="email" class="form-control" placeholder="Ingrese el correo electrónico" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="fecha_nacimiento" class="form-label"><i class="bi bi-calendar"></i> Fecha de Nacimiento:</label>
                        <input type="date" id="fecha_nacimiento" name="fecha_nacimiento" class="form-control" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="genero" class="form-label"><i class="bi bi-person-arms-up"></i> Género:</label>
                        <select id="genero" name="genero" class="form-control" required>
                            <option value="masculino">Masculino</option>
                            <option value="femenino">Femenino</option>
                            <option value="otro">Otro</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="nombreusuario" class="form-label"><i class="bi bi-person-check"></i> Nombre de usuario:</label>
                        <input type="text" id="nombreusuario" name="usuario" class="form-control" placeholder="Ingrese el nombre de usuario" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="clave" class="form-label"><i class="bi bi-lock"></i> Clave:</label>
                        <input type="password" id="clave" name="clave" class="form-control" placeholder="Ingrese su clave" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="confirmarclave" class="form-label"><i class="bi bi-lock"></i> Confirmar clave:</label>
                        <input type="password" id="confirmarclave" name="confirmar_clave" class="form-control" placeholder="Confirme su clave" required>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="foto" class="form-label"><i class="bi bi-camera"></i> Foto:</label>
                        <input type="file" id="foto" name="foto" class="form-control">
                    </div>
                </div>
            </div>
            <div class="form-group">
                <input type="submit" value="Registrar" class="btn btn-primary">
            </div>
        </form>
        <div class="form-group text-center mt-3">
            <a href="../index.php" class="link">¿Ya tienes una cuenta? Inicia sesión aquí</a>
        </div>
    </div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
