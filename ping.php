<?php
/**
 * ping.php - diagnostico de conectividade.
 *
 * Faz um ping ICMP (4 pacotes) para o host informado, que por padrao e
 * 8.8.8.8, e tambem mede a latencia por TCP em portas comuns, para o caso
 * de o comando ping nao estar liberado no servidor.
 *
 * Uso: ping.php  ou  ping.php?host=google.com
 */

/**
 * Abre uma conexao TCP e devolve o tempo gasto em milissegundos.
 */
function testarPorta($host, $porta, $timeout = 3)
{
    $inicio = microtime(true);
    $errno = 0;
    $errstr = '';
    $fp = @fsockopen($host, (int) $porta, $errno, $errstr, $timeout);
    $ms = (microtime(true) - $inicio) * 1000;

    if ($fp) {
        fclose($fp);
        return array('ok' => true, 'ms' => $ms, 'erro' => '');
    }

    return array(
        'ok' => false,
        'ms' => $ms,
        'erro' => $errstr !== '' ? $errstr : 'sem resposta em ' . $timeout . 's',
    );
}

/**
 * Executa o comando de ping tentando os mecanismos disponiveis no servidor.
 * Devolve array(saida, codigo).
 */
function executarPing($cmd)
{
    $saida = '';
    $codigo = -1;

    if (function_exists('exec')) {
        $linhas = array();
        $codigo = 0;
        @exec($cmd . ' 2>&1', $linhas, $codigo);
        $saida = trim(implode("\n", $linhas));
        if ($saida !== '') {
            return array($saida, $codigo);
        }
    }

    if (function_exists('shell_exec')) {
        $retorno = @shell_exec($cmd . ' 2>&1');
        if (is_string($retorno) && trim($retorno) !== '') {
            return array(trim($retorno), 0);
        }
    }

    if (function_exists('proc_open')) {
        $descritores = array(
            1 => array('pipe', 'w'),
            2 => array('pipe', 'w'),
        );
        $processo = @proc_open($cmd, $descritores, $pipes);
        if (is_resource($processo)) {
            $out = isset($pipes[1]) ? stream_get_contents($pipes[1]) : '';
            $err = isset($pipes[2]) ? stream_get_contents($pipes[2]) : '';
            if (isset($pipes[1])) {
                fclose($pipes[1]);
            }
            if (isset($pipes[2])) {
                fclose($pipes[2]);
            }
            $codigo = proc_close($processo);
            $saida = trim($out . "\n" . $err);
            if ($saida !== '') {
                return array($saida, $codigo);
            }
        }
    }

    return array($saida, $codigo);
}

$host = isset($_GET['host']) ? trim((string) $_GET['host']) : '8.8.8.8';

$valido = ($host !== '') && (
    filter_var($host, FILTER_VALIDATE_IP) !== false
    || preg_match('/^[a-zA-Z0-9]([a-zA-Z0-9\-\.]{0,251}[a-zA-Z0-9])?$/', $host) === 1
);

$saidaPing = '';
$codigoPing = -1;
$pingExecutado = false;
$aviso = '';

if (!$valido) {
    $aviso = 'Host invalido. Informe um IP (ex.: 8.8.8.8) ou um dominio (ex.: google.com).';
} else {
    $cmd = (stripos(PHP_OS, 'WIN') === 0)
        ? 'ping -n 4 -w 2000 ' . escapeshellarg($host)
        : 'ping -c 4 -W 2 ' . escapeshellarg($host);

    list($saidaPing, $codigoPing) = executarPing($cmd);
    $pingExecutado = ($saidaPing !== '');
}

if ($valido && !$pingExecutado) {
    $aviso = 'O comando ping nao devolveu saida neste servidor (pode estar desabilitado pelas configuracoes de PHP ou pela hospedagem). O teste TCP abaixo mede a latencia para o mesmo destino.';
}

$testes = array();
if ($valido) {
    $testes[443] = testarPorta($host, 443);
    $testes[53] = testarPorta($host, 53);
}

$hostSeguro = htmlspecialchars($host, ENT_QUOTES, 'UTF-8');
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ping - <?php echo $hostSeguro; ?></title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
</head>
<body>
<div class="container">
    <div class="page-header">
        <h1>Diagnostico de conectividade <small>ping</small></h1>
    </div>

    <div class="panel panel-default">
        <div class="panel-heading">Destino</div>
        <div class="panel-body">
            <form class="form-inline" method="get" action="ping.php">
                <div class="form-group">
                    <label class="sr-only" for="host">Host</label>
                    <input type="text" class="form-control" id="host" name="host"
                           value="<?php echo $hostSeguro; ?>" placeholder="8.8.8.8">
                </div>
                <button type="submit" class="btn btn-primary">Testar</button>
            </form>
            <p class="help-block">
                IP ou dominio. O teste e feito a partir do servidor onde o sistema esta rodando,
                em <?php echo date('d/m/Y H:i:s'); ?>.
            </p>
        </div>
    </div>

    <?php if ($aviso !== ''): ?>
        <div class="alert alert-warning"><?php echo htmlspecialchars($aviso, ENT_QUOTES, 'UTF-8'); ?></div>
    <?php endif; ?>

    <?php if ($pingExecutado): ?>
        <div class="panel <?php echo $codigoPing === 0 ? 'panel-success' : 'panel-danger'; ?>">
            <div class="panel-heading">
                Ping ICMP para <?php echo $hostSeguro; ?>
                <?php if ($codigoPing === 0): ?>
                    <span class="label label-success">respondeu</span>
                <?php else: ?>
                    <span class="label label-danger">sem resposta</span>
                <?php endif; ?>
            </div>
            <div class="panel-body">
                <pre><?php echo htmlspecialchars($saidaPing, ENT_QUOTES, 'UTF-8'); ?></pre>
            </div>
        </div>
    <?php endif; ?>

    <?php if ($valido): ?>
        <div class="panel panel-default">
            <div class="panel-heading">Latencia por TCP</div>
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Porta</th>
                        <th>Status</th>
                        <th>Tempo</th>
                        <th>Detalhe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($testes as $porta => $resultado): ?>
                        <tr>
                            <td><?php echo (int) $porta; ?></td>
                            <td>
                                <?php if ($resultado['ok']): ?>
                                    <span class="label label-success">aberta</span>
                                <?php else: ?>
                                    <span class="label label-danger">sem resposta</span>
                                <?php endif; ?>
                            </td>
                            <td><?php echo number_format($resultado['ms'], 1, ',', '.'); ?> ms</td>
                            <td><?php echo htmlspecialchars($resultado['erro'], ENT_QUOTES, 'UTF-8'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    <?php endif; ?>
</div>
<script src="js/bootstrap.min.js"></script>
</body>
</html>
