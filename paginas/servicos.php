<?php
require_once  "config/database.php";


$servicos_query = $pdo->query("SELECT * FROM servico");
$lista_servicos = $servicos_query->fetchAll(PDO::FETCH_ASSOC);

?>

<main class="container mt-5">
    <h1 class="text-center">Nossos Serviços</h1>

    <div class="row row-cols-1 row-cols-md-3 g-4">

        <?php foreach ($lista_servicos as $servico): ?>
            <div class="col">
                <div class="card h-100 shadow-sm text-center" style="border: 1px solid rgba(252, 182, 210, 0.7);">
                    <div class="card-body">
                        <h3 class="texto card-title"><?php echo $servico['nome']; ?></h3>
                        <p class="card-text fs-4 text-danger fw-bold">
                            R$ <?php echo number_format($servico['valor'], 2, ',', '.'); ?>
                        </p>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>

    </div>
</main>