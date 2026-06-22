<?php
require_once  "config/database.php";

//função pra pegar a categoria do nome do serviço
function extrairCategoria(string $nome)
{
    if (stripos($nome, 'Depilação') !== false) {
        return 'Depilação';
    } elseif (stripos($nome, 'Esmaltação') !== false) {
        return 'Esmaltação';
    } elseif (stripos($nome, 'Corte') !== false || stripos($nome, 'Pintura') !== false || stripos($nome, 'Escova') !== false) {
        return 'Cabelo';
    }
    return 'Outros';
}

//trazer todos os serviços
$servicos_query = $pdo->query("SELECT * FROM servico ORDER BY nome");
$todos_servicos = $servicos_query->fetchAll(PDO::FETCH_ASSOC);

//deixar em categoria única
$categorias = array_unique(array_map('extrairCategoria', array_column($todos_servicos, 'nome')));
sort($categorias);

//aplicar o filtro
$lista_servicos = $todos_servicos;

//filtro por cada categoria
if (!empty($_GET['categoria'])) {
    $categoria_filtro = $_GET['categoria'];
    $lista_servicos = array_filter($lista_servicos, function ($servico) use ($categoria_filtro) {
        return extrairCategoria($servico['nome']) === $categoria_filtro;
    });
}

//filtro pra faixa de preço
$faixa_preco = isset($_GET['faixa_preco']) ? $_GET['faixa_preco'] : '';

if (!empty($faixa_preco)) {
    $faixas = [
        '0-50' => [0, 50],
        '50-100' => [50, 100],
        '100-150' => [100, 150],
        '150+' => [150, 999999]
    ];

    if (isset($faixas[$faixa_preco])) {
        [$preco_min, $preco_max] = $faixas[$faixa_preco];
        $lista_servicos = array_filter($lista_servicos, function ($servico) use ($preco_min, $preco_max) {
            $valor = floatval($servico['valor']);
            return $valor >= $preco_min && $valor <= $preco_max;
        });
    }
}

//resetar sequência do array
$lista_servicos = array_values($lista_servicos);
?>

<main class="container-fluid servicos-main py-5">
    <section class="container">
        <h1 class="text-center mb-4">Nossos Serviços</h1>
        <p class="text-center mb-5">Veja os serviços disponíveis no Lu Fashion Hair.</p>

        <!-- Formulário de Filtros -->
        <div class="filtros-container mb-5 p-4 bg-light rounded">
            <form method="GET" class="row g-3 align-items-end">
                <input type="hidden" name="paginas" value="servicos">

                <div class="col-md-6">
                    <label for="categoria" class="form-label fw-bold">Filtrar por Categoria:</label>
                    <select class="form-select" name="categoria" id="categoria">
                        <option value="">Todas as categorias</option>
                        <?php foreach ($categorias as $cat): ?>
                            <option value="<?php echo htmlspecialchars($cat); ?>"
                                <?php echo (isset($_GET['categoria']) && $_GET['categoria'] === $cat) ? 'selected' : ''; ?>>
                                <?php echo htmlspecialchars($cat); ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="faixa_preco" class="form-label fw-bold">Faixa de Preço:</label>
                    <select class="form-select" name="faixa_preco" id="faixa_preco">
                        <option value="">Todos os preços</option>
                        <option value="0-50" <?php echo (isset($_GET['faixa_preco']) && $_GET['faixa_preco'] === '0-50') ? 'selected' : ''; ?>>
                            R$ 0,00 - R$ 50,00
                        </option>
                        <option value="50-100" <?php echo (isset($_GET['faixa_preco']) && $_GET['faixa_preco'] === '50-100') ? 'selected' : ''; ?>>
                            R$ 50,00 - R$ 100,00
                        </option>
                        <option value="100-150" <?php echo (isset($_GET['faixa_preco']) && $_GET['faixa_preco'] === '100-150') ? 'selected' : ''; ?>>
                            R$ 100,00 - R$ 150,00
                        </option>
                        <option value="150+" <?php echo (isset($_GET['faixa_preco']) && $_GET['faixa_preco'] === '150+') ? 'selected' : ''; ?>>
                            Acima de R$ 150,00
                        </option>
                    </select>
                </div>

                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                    <a href="?paginas=servicos" class="btn btn-secondary">Limpar Filtros</a>
                </div>
            </form>
        </div>

        <!-- Resultado dos filtros -->
        <p class="text-center mb-4 text-muted">
            Exibindo <?php echo count($lista_servicos); ?> de <?php echo count($todos_servicos); ?> serviços
        </p>

        <!-- Lista de serviços filtrados -->
        <div class="servicos-list">
            <?php if (empty($lista_servicos)): ?>
                <p class="text-center py-5">Nenhum serviço encontrado com os filtros selecionados.</p>
            <?php else: ?>
                <?php foreach ($lista_servicos as $servico): ?>
                    <article class="service-item p-4 mb-4 shadow-sm">
                        <div class="service-header d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <h3 class="texto m-0"><?php echo htmlspecialchars($servico['nome']); ?></h3>
                                <small class="text-muted">Categoria: <?php echo htmlspecialchars(extrairCategoria($servico['nome'])); ?></small>
                            </div>
                            <span class="service-price">R$ <?php echo number_format($servico['valor'], 2, ',', '.'); ?></span>
                        </div>
                        <?php if (!empty($servico['duracao_estimada'])): ?>
                            <p class="service-duration mb-2">Duração estimada: <strong><?php echo substr($servico['duracao_estimada'], 0, 5); ?></strong></p>
                        <?php endif; ?>
                        <p class="service-description text-secondary">Um serviço de qualidade com atenção especial aos detalhes e ao seu conforto durante o atendimento.</p>
                    </article>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
    </section>
</main>