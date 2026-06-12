<?= $this -> extend('layouts/default') ?>
<?= $this -> section('content') ?>

    <div class="container w-75 mt-5">
        <h1 class="text-center">Lista de Clientes</h1>
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
                    <tr class="align-middle text-center">
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                        <td>@mdo</td>
                        <td>
                            <button class="btn btn-primary">Editar</button>
                            <button class="btn btn-danger">Excluir</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="container d-flex justify-content-center">
                <ul class="pagination">
                    <li class="page-item">
                        <a class="page-link" href="#">Anterior</a>
                    </li>
                    
                    <li class="page-item">
                        <a class="page-link" href="#">1</a>
                    </li>
                    
                    <li class="page-item">
                        <a class="page-link" href="#">2</a>
                    </li>
                    
                    <li class="page-item">
                        <a class="page-link" href="#">Próxima</a>
                    </li>
                    
                </ul>
            </div>

        </div>
    </div>

<?= $this -> endSection() ?>