<?php
// Essas três linhas aqui é pra ver os erros do php. Peguei com IA porque tava dando problema e eu não sabia o que era, mas é só pra desenvolvimento.
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pagina = isset($_GET["paginas"]) ? $_GET["paginas"] : "inicio";

$css_especifico = $pagina . ".css";

require_once "config/database.php";

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
