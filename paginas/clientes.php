<?php
require_once "config/database.php";

$clientes_query = $pdo->query("SELECT * FROM clientes");
$lista_clientes = $clientes_query->fetchAll(PDO::FETCH_ASSOC);

function formatarData(string $data)
{
    $timestamp = strtotime($data);
    return date("d/m/Y", $timestamp);
}

?>

<main class="container-fluid clientes-main py-5">
    <section class="container">
        <h1 class="text-center mb-4">Nossos Clientes</h1>
        <p class="text-center mb-5">Conheça alguns dos clientes atendidos no Lu Fashion Hair.</p>

        <div class="row row-cols-1 row-cols-md-3 g-4">
            <?php foreach ($lista_clientes as $cliente): ?>
                <div class="col">
                    <div class="card h-100 shadow-sm text-center clientes-card">
                        <div class="card-body">
                            <h3 class="texto card-title"><?php echo htmlspecialchars($cliente['nome']); ?></h3>
                            <p class="card-text fs-5 text-secondary"><?php echo htmlspecialchars($cliente['telefone']); ?></p>
                            <p class="card-text fs-5 text-secondary">Nascimento: <?php echo formatarData($cliente['dt_nasc']); ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </section>
</main>