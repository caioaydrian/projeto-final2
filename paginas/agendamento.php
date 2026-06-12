<?php
require_once "config/database.php";

$agendamento_query = $pdo->query(
    "SELECT a.*, c.nome AS cliente_nome, s.nome AS servico_nome
     FROM agendamento a
     JOIN clientes c ON a.id_clientes = c.id
     JOIN servico_agendamento sa on sa.id_agendamento = a.id
     JOIN servico s on sa.id_servico = s.id
     ORDER BY a.data, a.horario"
);
$lista_agendamento = $agendamento_query->fetchAll(PDO::FETCH_ASSOC);

function formatarData(string $data)
{
    return date("d/m/Y", strtotime($data));
}

function formatarHorario(string $horario)
{
    return date("H:i", strtotime($horario));
}

//juntar os serviços por agendamento
function agruparServicosPorAgendamento(array $agendamentos)
{
    $agendamentoAgrupado = [];
    foreach ($agendamentos as $agendamento) {
        $idAgendamento = $agendamento['id'];
        if (!isset($agendamentoAgrupado[$idAgendamento])) {
            $agendamentoAgrupado[$idAgendamento] = [
                'cliente_nome' => $agendamento['cliente_nome'],
                'data' => $agendamento['data'],
                'horario' => $agendamento['horario'],
                'status' => $agendamento['status'],
                'servicos' => []
            ];
        }
        $agendamentoAgrupado[$idAgendamento]['servicos'][] = $agendamento['servico_nome'];
    }
    return array_values($agendamentoAgrupado);
}

$lista_agendamento = agruparServicosPorAgendamento($lista_agendamento);

?>

<main class="container-fluid agendamento-main py-5">
    <section class="container">
        <h1 class="text-center mb-4">Agenda de Atendimento</h1>
        <p class="text-center mb-4">Veja abaixo os agendamentos com o nome do cliente, data em D/M/Y, horário em 24h e status do atendimento.</p>

        <?php if (empty($lista_agendamento)): ?>
            <p class="text-center">Nenhum agendamento encontrado.</p>
        <?php else: ?>
            <div class="table-responsive">
                <table class="table table-bordered table-striped align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Cliente</th>
                            <th>Serviços</th>
                            <th>Data</th>
                            <th>Horário</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($lista_agendamento as $agendamento): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($agendamento['cliente_nome']); ?></td>
                                <td><?php echo htmlspecialchars(implode(', ', $agendamento['servicos'])); ?></td>
                                <td><?php echo formatarData($agendamento['data']); ?></td>
                                <td><?php echo formatarHorario($agendamento['horario']); ?></td>
                                <td><?php echo htmlspecialchars($agendamento['status']); ?></td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        <?php endif; ?>
    </section>
</main>