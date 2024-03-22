<!DOCTYPE html>
<html>
<head>
    <title>Iniciar sesión - IPMaster</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #000;
            color: #fff;
            margin: 0;
            padding: 0;
            text-align: center;
        }
        .container {
            max-width: 400px;
            margin: 0 auto;
            background-color: #000;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        input[type="text"],
        input[type="password"],
        input[type="submit"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            box-sizing: border-box;
            border: 1px solid #ccc;
            border-radius: 5px;
            background-color: #333;
            color: #fff;
        }
        input[type="submit"] {
            background-color: #007bff;
            border: none;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Iniciar sesión</h1>
        <form action="" method="post">
            <input type="text" name="email" placeholder="Correo electrónico" required><br>
            <input type="password" name="contrasena" placeholder="Contraseña" required><br>
            <input type="submit" value="Iniciar sesión">
        </form>
    </div>
    <?php
    session_start();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Configuración de la conexión a la base de datos
        $servername = "localhost"; // Cambia esto si tu servidor MySQL está en un host diferente
        $username = "root";
        $password = "1234";
        $dbname = "crearcuenta"; // Cambia esto por el nombre de tu base de datos

        // Crear conexión
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Verificar la conexión
        if ($conn->connect_error) {
            die("Conexión fallida: " . $conn->connect_error);
        }

        $email = $_POST["email"];
        $contrasena = $_POST["contrasena"];

        // Verificar las credenciales del usuario
        $sql = "SELECT * FROM usuarios WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            if (password_verify($contrasena, $row["contrasena"])) {
                // Iniciar sesión y redirigir a la página principal
                $_SESSION["usuario"] = $row["email"];
                header("Location: dashboard.php");
                exit;
            } else {
                echo "<p>Contraseña incorrecta.</p>";
            }
        } else {
            echo "<p>Usuario no encontrado. Email: $email</p>";
        }

        // Cerrar la conexión
        $conn->close();
    }
    ?>
</body>
</html>
