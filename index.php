<?php

// =====================================
// 1. VARIABLES: Datos del estudiante
// =====================================

$alumno = "";
$materia = "";

$nota1 = "";
$nota2 = "";
$nota3 = "";

$promedio = 0;
$estatus = "";
$mensaje = "";
$error = "";

// =====================================
// 2. FUNCIÓN PARA VALIDAR LAS NOTAS
// =====================================

function validarNota(float $nota) {
    return is_numeric($nota) && $nota >= 0 && $nota <= 10;
}

// =====================================
// 3. RECIBIR DATOS DEL FORMULARIO
// =====================================

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $alumno = trim($_POST["alumno"] ?? "");
    $materia = trim($_POST["materia"] ?? "");

    $nota1 = $_POST["nota1"] ?? "";
    $nota2 = $_POST["nota2"] ?? "";
    $nota3 = $_POST["nota3"] ?? "";

    // =====================================
    // 4. VALIDAR INFORMACIÓN
    // =====================================

    if ($alumno == "" || $materia == "") {

        $error = "Debes ingresar el nombre y la materia.";

    } elseif (
        !validarNota($nota1) ||
        !validarNota($nota2) ||
        !validarNota($nota3)
    ) {

        $error = "Las notas deben ser números entre 0 y 10.";

    } else {

        // =====================================
        // 5. CALCULAR PROMEDIO
        // =====================================

        $promedio = round(($nota1 + $nota2 + $nota3) / 3, 2);

        // =====================================
        // 6. DETERMINAR ESTATUS ACADÉMICO
        // =====================================

        if ($promedio >= 6) {

            $estatus = "APROBADO";
            $mensaje = "¡Excelente trabajo, $alumno! Sigue esforzándote y alcanzando tus metas.";

        } else {

            $estatus = "REPROBADO";
            $mensaje = "No te desanimes, $alumno. Cada error es una oportunidad para aprender y mejorar.";

        }
    }
}

?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Sistema de Información Académica</title>

    <link rel="stylesheet" href="styles.css">
</head>

<body>

    <main class="contenedor">

        <h1> Sistema de Información Académica</h1>

        <p class="subtitulo">
            Sistema de evaluación académica
        </p>

        <form method="POST" action="">

            <label for="alumno">Nombre del estudiante</label>

            <input
                id="alumno"
                type="text"
                name="alumno"
                placeholder="Ingresa tu nombre"
                value="<?= htmlspecialchars($alumno) ?>"
                required
            >

            <label for="materia">Nombre de la materia</label>

            <input
                id="materia"
                type="text"
                name="materia"
                placeholder="Ej. Programación PHP"
                value="<?= htmlspecialchars($materia) ?>"
                required
            >

            <label for="nota1">Primera nota parcial</label>

            <input
                id="nota1"
                type="number"
                name="nota1"
                min="0"
                max="10"
                step="0.1"
                placeholder="0 - 10"
                value="<?= htmlspecialchars((string)$nota1) ?>"
                required
            >

            <label for="nota2">Segunda nota parcial</label>

            <input
                id="nota2"
                type="number"
                name="nota2"
                min="0"
                max="10"
                step="0.1"
                placeholder="0 - 10"
                value="<?= htmlspecialchars((string)$nota2) ?>"
                required
            >

            <label for="nota3">Tercera nota parcial</label>

            <input
                id="nota3"
                type="number"
                name="nota3"
                min="0"
                max="10"
                step="0.1"
                placeholder="0 - 10"
                value="<?= htmlspecialchars((string)$nota3) ?>"
                required
            >

            <button type="submit">
                Calcular promedio
            </button>

        </form>

        <?php if ($error != ""): ?>

            <div class="resultado error">
                <?= htmlspecialchars($error) ?>
            </div>

        <?php endif; ?>


        <?php if ($estatus != ""): ?>

            <section class="resultado">

                <h2>Resultado académico</h2>

                <p>
                    <strong>Estudiante:</strong>
                    <?= htmlspecialchars($alumno) ?>
                </p>

                <p>
                    <strong>Materia:</strong>
                    <?= htmlspecialchars($materia) ?>
                </p>

                <p>
                    <strong>Promedio final:</strong>
                    <?= number_format($promedio, 2) ?>
                </p>

                <h2 class="<?= $promedio >= 6 ? 'aprobado' : 'reprobado' ?>">
                    <?= $estatus ?>
                </h2>

                <p class="motivacion">
                    <?= htmlspecialchars($mensaje) ?>
                </p>

            </section>

        <?php endif; ?>

    </main>

</body>

</html>
