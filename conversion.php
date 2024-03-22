<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calculadora Binaria</title>
    <style>
        body {
            background-color: #000000; /* Fondo negro */
            color: #FFFFFF; /* Letras blancas */
            font-family: Arial, sans-serif;
            text-align: center;
            margin: 0; /* Elimina el margen predeterminado del cuerpo */
            padding: 0; /* Elimina el relleno predeterminado del cuerpo */
        }
        #container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
        }
        input {
            width: 80%;
            padding: 10px;
            margin-bottom: 10px;
        }
        button {
            background-color: #00BFFF; /* Color azul claro */
            color: #FFFFFF; /* Letras blancas */
            padding: 10px 20px;
            font-size: 18px;
            cursor: pointer;
        }
        button:hover {
            background-color: #009ACD; /* Color azul oscuro al pasar el mouse */
        }
        #conversionContainer {
            margin-top: 20px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div id="container">
        <h1>Calculadora Binaria</h1>

        <label for="numValues">Número de valores a convertir:</label>
        <input type="number" id="numValues" min="1">

        <div id="valuesContainer"></div>

        <button onclick="generarCampos()">Generar Campos</button>

        <div id="conversionContainer"></div>

        <button onclick="convertirValoresABinario()">Convertir a Binario</button>
        
        <button onclick="window.location.href = 'dashboard.php';">Regresar al menú</button>
    </div>

    <script>
        function generarCampos() {
            const numValues = parseInt(document.getElementById("numValues").value, 10);

            if (isNaN(numValues) || numValues < 1) {
                alert("Ingresa un número válido para la cantidad de valores.");
                return;
            }

            const valuesContainer = document.getElementById("valuesContainer");
            valuesContainer.innerHTML = ""; // Limpiar campos anteriores

            for (let i = 1; i <= numValues; i++) {
                const input = document.createElement("input");
                input.type = "number";
                input.id = `value${i}`;
                input.placeholder = `Número ${i}`;
                valuesContainer.appendChild(input);
            }
        }

        function convertirValoresABinario() {
            const numValues = parseInt(document.getElementById("numValues").value, 10);
            const conversions = [];

            for (let i = 1; i <= numValues; i++) {
                const value = parseInt(document.getElementById(`value${i}`).value, 10);

                if (isNaN(value)) {
                    alert(`Ingresa un número válido para el valor ${i}.`);
                    return;
                }

                conversions.push(decimalToBinary(value));
            }

            mostrarConversiones(conversions);
        }

        function mostrarConversiones(conversions) {
            const conversionContainer = document.getElementById("conversionContainer");
            conversionContainer.innerHTML = ""; // Limpiar conversiones anteriores

            conversions.forEach((conversion, index) => {
                const paragraph = document.createElement("p");
                paragraph.innerText = `Número ${index + 1} (Binario): ${conversion}`;
                conversionContainer.appendChild(paragraph);
            });
        }

        function decimalToBinary(decimal) {
            return decimal.toString(2);
        }
    </script>
</body>
</html>
