<?= $this -> extend('layouts/default') ?>
<?= $this -> section('content') ?>

    <div class="container w-25 mt-5">
        <h1 class="text-center">Cadastro de Cliente</h1>
        
        <form action="<?= base_url('/cadastro')?>" method="post">

            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">Nome</span>
                <input type="text" value="<?= isset($user) ? $user['nome'] : '' ?>" name="nome" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>
            
            <div class="input-group mb-3">
                <span class="input-group-text" id="inputGroup-sizing-default">CPF</span>
                <input type="text" value="<?= isset($user) ? $user['cpf'] : '' ?>" name="cpf" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-default">
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="estado">Estado</label>
                <select name="estado" class="form-select" id="estado">
                    <option selected>Selecione um estado</option>

                    <?php foreach ($estados as $estado): ?>
                        <option value="<?= $estado['id'] ?>" <?= isset($user) && $user['estado_id'] == $estado['id'] ? 'selected' : '' ?>>
                            <?= $estado['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="municipio">Município</label>
                <select name="municipio" class="form-select" id="municipio">
                    <option selected>Selecione um município</option>

                </select>
            </div>

            <?= csrf_field() ?>

            <div class="container text-center">
                <button class="btn btn-primary">Cadastrar</button>
                <button class="btn btn-danger"><a href="<?= base_url('clientes') ?>">Voltar</a></button>
            </div>

        </form>
    </div>
    
    
    <script>
        //Cria uma constante chamada BASE_URL
        const BASE_URL = '<?= base_url() ?>';
    </script>
    
    
    <script src="<?= base_url('js/script.js') ?>" defer></script>

<?= $this -> endSection() ?>