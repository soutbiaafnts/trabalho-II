<?= $this -> extend('layouts/default') ?>
<?= $this -> section('content') ?>

    <div class="container w-75 mt-5">
        <h1 class="text-center">Lista de Clientes</h1>
        
        <hr>

        <div class="container text-center mb-3">
            <button class="btn btn-success">Adicionar Cliente</button>
        </div>
        

        <div class="">
            <table class="table table-striped table-hover table-bordered table-light">
                <thead>
                    <tr class="text-center">
                        <th scope="col">#ID</th>
                        <th scope="col">Nome</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Estado</th>
                        <th scope="col">Município</th>
                        <th scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($clientes as $cliente): ?>
                        <tr class="align-middle text-center">
                            <th scope="row"><?= $cliente['id'] ?></th>
                            <td><?= $cliente['nome'] ?></td>
                            <td><?= $cliente['cpf'] ?></td>
                            <td><?= $cliente['estado_id'] ?></td>
                            <td><?= $cliente['municipio_id'] ?></td>
                            <td>
                                <button class="btn btn-primary">Editar</button>
                                <button class="btn btn-danger">Excluir</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <div class="container d-flex justify-content-center">
                <ul class="pagination">
                    <?= $pager->links() ?>
                </ul>
            </div>

        </div>
    </div>

<?= $this -> endSection() ?>