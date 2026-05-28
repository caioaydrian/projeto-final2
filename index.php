<?php
$pagina = isset($_GET["paginas"]) ? $_GET["paginas"] : "inicio";

$css_especifico = $pagina . ".css";

include "templates/header.php";

$rotas = [
    "inicio" => "paginas/inicio.php",
    "servicos" => "paginas/servicos.php",
    "espaco" => "paginas/espaco.php"
];

if (array_key_exists($pagina, $rotas)) {
    include $rotas[$pagina];
} else {
    echo "<main><h1 style='text-align:center; padding:50px;'>Página não encontrada</h1></main>";
}

include "templates/footer.php";
