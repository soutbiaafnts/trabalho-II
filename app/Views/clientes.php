<?= $this->extend('layouts/default') ?>
<?= $this->section('content') ?>

<div class="container w-75 mt-5 align-center">
    <h1 class="text-center">Lista de Clientes</h1>

    <div class="container text-center">
        <form action="<?= base_url('cadastro') ?>" method="get">
            <button type="submit" class="btn btn-success ">Adicionar Cliente</button>
        </form>

    </div>

    <hr>

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
                        <td><?= $cliente['estado'] ?></td>
                        <td><?= $cliente['municipio'] ?></td>
                        <td class="d-flex justify-content-center gap-2">
                            <button type="button" class="btn btn-danger btn-deletar" data-id="<?= $cliente['id'] ?>"
                                data-nome="<?= esc($cliente['nome']) ?>" data-bs-toggle="modal"
                                data-bs-target="#modalDeletar">
                                Excluir
                            </button>

                            <a href="<?= base_url('editar/' . $cliente['id']) ?>" class="btn btn-primary">
                                Editar
                            </a>
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

</div>

<!-- Modal -->
<div class="modal fade" id="modalDeletar" tabindex="-1" aria-labelledby="modalDeletarLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header bg-danger text-white">
                <h5 class="modal-title" id="modalDeletarLabel">Confirmar exclusão</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                Deseja realmente excluir o cliente <strong id="modalNomeCliente"></strong>?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <form id="formDeletar" method="post">
                    <?= csrf_field() ?>
                    <button type="submit" class="btn btn-danger">Excluir</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.querySelectorAll('.btn-deletar').forEach(function (btn) {
        btn.addEventListener('click', function () {
            const id = this.dataset.id;
            const nome = this.dataset.nome;

            document.getElementById('modalNomeCliente').textContent = nome;
            document.getElementById('formDeletar').action = '<?= base_url('delete/') ?>' + id;
        });
    });
</script>

<?= $this->endSection() ?>