<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Users</title>
</head>

<body>
    <div class="contai">
        <table class="table">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>CPF</th>
                <th>Estado ID</th>  
                <th>Municipio ID</th>
            </tr>
            <?php foreach ($clientes as $cliente): ?>
                <tr>
                    <td><?= $cliente['id'] ?></td>
                    <td><?= $cliente['nome'] ?></td>
                    <td><?= $cliente['cpf'] ?></td>
                    <td><?= $cliente['estado_id'] ?></td>  
                    <td><?= $cliente['municipio_id'] ?></td>
                    <td><?= anchor('cliente/edit/' . $cliente['id'], 'Edit',[ 'onclick' => "return confirm('Deseja realmente excluir este cliente?')"]) ?></td>
                    <td><?= anchor('cliente/delete/' . $cliente['id'], 'Delete', ['onclick' => "return confirm('Deseja realmente excluir este cliente?')"]) ?></td>

                </tr>
            <?php endforeach; ?>
        </table>
        <?= $pager->links() ?>
    </div>
</body>

</html>

<script>
    //Cria uma constante chamada BASE_URL
    const BASE_URL = '<?= base_url() ?>';
</script>


<script src="<?= base_url('js/validation.js') ?>" defer></script>