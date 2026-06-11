<?php
require_once  "config/database.php";


$clientes_query = $pdo->query("SELECT * FROM clientes");
$lista_clientes = $clientes_query->fetchAll(PDO::FETCH_ASSOC);

function formatarData(string $data)
{
    $timestamp = strtotime($data);
    return date("d/m/Y", $timestamp);
}

?>

<main class="container mt-5">
    <h1 class="text-center">Nossos Clientes</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">

        <?php foreach ($lista_clientes as $cliente): ?>
            <div class="col">
                <div class="card h-100 shadow-sm text-center" style="border: 1px solid rgba(252, 182, 210, 0.7);">
                    <div class="card-body">
                        <h3 class="texto card-title"><?php echo $cliente['nome']; ?></h3>
                        <p class="card-text fs-5 text-secondary">
                            <?php echo $cliente['telefone']; ?>
                        </p>
                        <p class="card-text fs-5 text-secondary">
                            <?php echo formatarData($cliente['dt_nasc']); ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</main>