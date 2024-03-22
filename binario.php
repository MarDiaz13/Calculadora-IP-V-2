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
        h1 {
            font-size: 24px; /* Tamaño de la fuente para h1 */
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
        #conversionContainer {
            margin-top: 10px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div id="container">
        <h1>Calculadora Binaria</h1>

        <label for="numValues">Número de valores:</label>
        <input type="number" id="numValues" min="1" value="2">

        <div id="valuesContainer"></div>

        <button onclick="generarCampos()">Generar Campos</button>

        <h1>Conversión de Valores:</h1>
        <div id="conversionContainer"></div>

        <button onclick="realizarOperacion('Suma', '+')">Sumar</button>
        <button onclick="realizarOperacion('Resta', '-')">Restar</button>
        <button onclick="realizarOperacion('Multiplicación', '*')">Multiplicar</button>
        <button onclick="realizarOperacion('División', '/')">Dividir</button>

        <button onclick="borrarInformacion()">Borrar Información</button>

        <h1>Resultado:</h1>
        <p id="resultadoBinario"></p>
        <p id="resultadoDecimal"></p>
        
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

        function realizarOperacion(operacion, operador) {
            const numValues = parseInt(document.getElementById("numValues").value, 10);
            const values = [];
            const conversions = [];

            for (let i = 1; i <= numValues; i++) {
                const value = parseInt(document.getElementById(`value${i}`).value, 10);

                if (isNaN(value)) {
                    alert(`Ingresa un número válido para el valor ${i}.`);
                    return;
                }

                values.push(value);
                conversions.push(decimalToBinary(value));
            }

            const resultadoDecimal = eval(values.join(operador));
            const resultadoBinario = decimalToBinary(resultadoDecimal);

            mostrarResultado(resultadoBinario, resultadoDecimal);
            mostrarConversiones(conversions);
        }

        function mostrarResultado(resultadoBinario, resultadoDecimal) {
            document.getElementById("resultadoBinario").innerText = `Resultado (Binario): ${resultadoBinario}`;
            document.getElementById("resultadoDecimal").innerText = `Resultado (Decimal): ${resultadoDecimal}`;
        }

        function mostrarConversiones(conversions) {
            const conversionContainer = document.getElementById("conversionContainer");
            conversionContainer.innerHTML = ""; // Limpiar conversiones anteriores

            conversions.forEach((conversion, index) => {
                const paragraph = document.createElement("p");
                paragraph.innerText = `Valor ${index + 1} (Binario): ${conversion}`;
                conversionContainer.appendChild(paragraph);
            });
        }

        function decimalToBinary(decimal) {
            return decimal.toString(2);
        }

        function borrarInformacion() {
            const valuesContainer = document.getElementById("valuesContainer");
            valuesContainer.innerHTML = ""; // Limpiar campos de valores

            document.getElementById("resultadoBinario").innerText = "";
            document.getElementById("resultadoDecimal").innerText = "";

            const conversionContainer = document.getElementById("conversionContainer");
            conversionContainer.innerHTML = ""; // Limpiar conversiones
        }
    </script>
</body>
</html>
