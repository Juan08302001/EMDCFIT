<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="icon" href="./img/favicon.ico" type="image/x-icon">

    <link rel="stylesheet" href="./css/inicio.css">
</head>
<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 mb-4 mb-md-0">
                <div class="login-box">
                    <h2>Bienvenido!</h2>
                    <p>Por favor, ingrese a su cuenta.</p>
                    <form action="./controladores/login.php" method="post">
                    <div class="form-group">
    <label for="usuario">Usuario</label>
    <input type="text" id="usuario" placeholder="Ingresa tu usuario" name="usuario">
</div>
<div class="form-group">
    <label for="clave">Clave</label>
    <input type="password" id="clave" placeholder="Ingresa tu clave" name="clave">
</div>

                        <button type="submit" class="login-button">Login</button>
                    </form>
                    <div class="form-group-link">
                        <a href="./Login/olvidecontra.php" class="link">¿Olvidaste tu contraseña?</a>
                    </div>
                    <div class="form-group-link">
                        <a href="./Login/crearcuenta.php" class="link">Crear cuenta</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="image-container">
                    <img src="./img/fitness.png" alt="Login Image">
                </div>
            </div>
        </div>
    </div>
</body>
</html>
