<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IP Master Equipo 1</title>
    <style>
        body {
            background-color: #000000; /* Fondo negro */
            color: #FFFFFF; /* Letras blancas */
            font-family: Arial, sans-serif;
        }
        #container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        .input-group {
            margin-bottom: 10px;
        }
    </style>
</head>
<body>
    <div id="container">
        <h1>IP Master Equipo 1</h1>

        <!-- Ingreso del primer octeto -->
        <div class="input-group">
            <label for="octeto1">Primer octeto:</label>
            <input type="number" id="octeto1" min="1" max="223" oninput="determinarClaseRedAutomatically()">
            <p id="claseRed"></p>
        </div>

        <!-- Ingreso de los demás octetos -->
        <div class="input-group">
            <label for="octeto2">Segundo octeto:</label>
            <input type="number" id="octeto2" min="0" max="255">
        </div>

        <div class="input-group">
            <label for="octeto3">Tercer octeto:</label>
            <input type="number" id="octeto3" min="0" max="255">
        </div>

        <div class="input-group">
            <label for="octeto4">Cuarto octeto:</label>
            <input type="number" id="octeto4" min="0" max="255">
        </div>

        <!-- Ingreso de la submáscara de red -->
        <div class="input-group">
            <label id="submascaraLabel" for="submascara"></label>
            <input type="text" id="submascara">
        </div>

        <button onclick="calcular()">Calcular</button>
        <button onclick="borrarDatos()">Borrar Datos</button>
        
        <h2>Resultados:</h2>
        <p id="address"></p>
        <p id="netmask"></p>
        <p id="network"></p>
        <p id="hostMinimo"></p>
        <p id="hostMaximo"></p>
        <p id="broadcast"></p>
        
        <button onclick="window.location.href = 'dashboard.php';">Regresar al menú</button>

    </div>

    <script>
        function calcular() {
            var octeto1 = parseInt(document.getElementById("octeto1").value);
            var octeto2 = parseInt(document.getElementById("octeto2").value);
            var octeto3 = parseInt(document.getElementById("octeto3").value);
            var octeto4 = parseInt(document.getElementById("octeto4").value);
            var submascara = document.getElementById("submascara").value;

            if (octeto1 < 1 || octeto1 > 223 || octeto2 < 0 || octeto2 > 255 ||
                octeto3 < 0 || octeto3 > 255 || octeto4 < 0 || octeto4 > 255) {
                alert("Los octetos deben estar en el rango de valores permitidos.");
                return;
            }

            var network = calcularNetwork(octeto1, octeto2, octeto3, octeto4, submascara);
            var hostMinimo = calcularHostMinimo(network);
            var hostMaximo = calcularHostMaximo(network, submascara);
            var broadcast = calcularBroadcast(network, submascara);

            document.getElementById("address").innerText = "Dirección IP: " + octeto1 + "." + octeto2 + "." + octeto3 + "." + octeto4;
            document.getElementById("netmask").innerText = "Máscara de red: " + submascara;
            document.getElementById("network").innerText = "Network: " + network;
            document.getElementById("hostMinimo").innerText = "Host Mínimo: " + hostMinimo;
            document.getElementById("hostMaximo").innerText = "Host Máximo: " + hostMaximo;
            document.getElementById("broadcast").innerText = "Broadcast: " + broadcast;
        }

        function determinarClaseRed(octeto1) {
            if (octeto1 >= 1 && octeto1 <= 126) {
                return "A";
            } else if (octeto1 >= 128 && octeto1 <= 191) {
                return "B";
            } else if (octeto1 >= 192 && octeto1 <= 223) {
                return "C";
            } else {
                return "Clase no reconocida";
            }
        }

        function determinarClaseRedAutomatically() {
            var octeto1 = parseInt(document.getElementById("octeto1").value);
            var claseRed = determinarClaseRed(octeto1);
            document.getElementById("claseRed").innerText = "Clase de Red: " + claseRed;

            // Ajustar el campo de entrada de submáscara según la clase de red
            var submascaraLabel = document.getElementById("submascaraLabel");
            var submascaraInput = document.getElementById("submascara");

            if (claseRed === "A") {
                submascaraLabel.innerText = "Submáscara de red (Formato: X.0.0.0):";
                submascaraInput.placeholder = "Ejemplo: 255.0.0.0";
            } else if (claseRed === "B") {
                submascaraLabel.innerText = "Submáscara de red (Formato: X.X.0.0):";
                submascaraInput.placeholder = "Ejemplo: 255.255.0.0";
            } else if (claseRed === "C") {
                submascaraLabel.innerText = "Submáscara de red (Formato: X.X.X.0):";
                submascaraInput.placeholder = "Ejemplo: 255.255.255.0";
            } else {
                submascaraLabel.innerText = "Submáscara de red:";
                submascaraInput.placeholder = "";
            }
        }

        function borrarDatos() {
            // Limpiar todos los campos de entrada y resultados
            document.getElementById("octeto1").value = "";
            document.getElementById("octeto2").value = "";
            document.getElementById("octeto3").value = "";
            document.getElementById("octeto4").value = "";
            document.getElementById("submascara").value = "";
            document.getElementById("claseRed").innerText = "";
            document.getElementById("address").innerText = "";
            document.getElementById("netmask").innerText = "";
            document.getElementById("network").innerText = "";
            document.getElementById("hostMinimo").innerText = "";
            document.getElementById("hostMaximo").innerText = "";
            document.getElementById("broadcast").innerText = "";
        }

        function calcularNetwork(octeto1, octeto2, octeto3, octeto4, submascara) {
            var network = octeto1 + "." + octeto2 + "." + octeto3 + ".0";
            return network;
        }

        function calcularHostMinimo(network) {
            // Lógica para calcular el host mínimo
            return network;
        }

        function calcularHostMaximo(network, submascara) {
            var octetosSubmascara = submascara.split(".").map(function (octeto) {
                return parseInt(octeto);
            });

            var octetosRed = network.split(".").map(function (octeto) {
                return parseInt(octeto);
            });

            var octetosHostMaximo = octetosRed.map(function (octetoRed, index) {
                return index === 3 ? 255 - octetosSubmascara[index] - 1 : octetoRed;
            });

            return octetosHostMaximo.join(".");
        }

        function calcularBroadcast(network, submascara) {
            var octetosSubmascara = submascara.split(".").map(function (octeto) {
                return parseInt(octeto);
            });

            var octetosRed = network.split(".").map(function (octeto) {
                return parseInt(octeto);
            });

            var octetosBroadcast = octetosRed.map(function (octetoRed, index) {
                return index === 3 ? (octetoRed | ~octetosSubmascara[index]) & 255 : octetoRed;
            });

            return octetosBroadcast.join(".");
        }
    </script>
</body>
</html>