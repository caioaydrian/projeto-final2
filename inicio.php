<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados empresariais</title>
    <link rel="stylesheet" href="css/header.css">
    <link rel="stylesheet" href="css/inicio.css">
    <link rel="stylesheet" href="css/global.css">
</head>
<script>
window.addEventListener("DOMContentLoaded", function() {

    if (localStorage.getItem("darkMode") === "true") {
        document.body.classList.add("dark-mode");
        const img = document.getElementById("mode-toggle");
        if (img) {
            img.src = "light-mode.png";
            img.alt = "Modo claro";
        }
    }
});

function toggleMode() {
    const body = document.body;
    const img = document.getElementById("mode-toggle");

    body.classList.toggle("dark-mode");

    if (body.classList.contains("dark-mode")) {
        localStorage.setItem("darkMode", "true");
        img.src = "light-mode.png";
        img.alt = "Modo claro";
    } else {
        localStorage.setItem("darkMode", "false");
        img.src = "dark-mode.png";
        img.alt = "Modo escuro";
    }
}
</script>
<body>
    <header>
        <nav>
            <ul>
                <li>
                    <img id="mode-toggle" src="primeiro-site/dark-mode.png" alt="Alternar modo" onclick="toggleMode()">
                </li>
                <li><a href="inicio.php">Início</a></li>
                <li><a href="planos.php">Planos</a></li>
                <li><a href="regioes.php">Regiões</a></li>
            </ul>
        </nav>
    </header>
        <h1>Dados empresariais</h1>
</body>
</html>