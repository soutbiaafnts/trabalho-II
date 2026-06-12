<?= $this -> extend('layouts/default') ?>
<?= $this -> section('content') ?>

    <div class="container w-25 mt-5">
        <h1 class="text-center">Cadastro de Cliente</h1>
        
        <form action="<?= base_url('store')?>" method="post">

            <?php $errors = session('validationErrors') ?? []; ?>
            
            <div class="input-group mb-3">
                <span class="input-group-text">Nome</span>
                <input type="text" value="<?= old('nome') ?>" name="nome"
                    class="form-control <?= isset($errors['nome']) ? 'is-invalid' : '' ?>">
                <?php if (isset($errors['nome'])): ?>
                    <div class="invalid-feedback"><?= $errors['nome'] ?></div>
                <?php endif; ?>
            </div>
            
            <div class="input-group mb-3">
                <span class="input-group-text">CPF</span>
                <input type="text" value="<?= old('cpf') ?>" name="cpf"
                    class="form-control <?= isset($errors['cpf']) ? 'is-invalid' : '' ?>">
                <?php if (isset($errors['cpf'])): ?>
                    <div class="invalid-feedback">
                        <?= $errors['cpf'] ?>
                    </div>
                <?php endif; ?>
            </div>
            
            <div class="input-group mb-3">
                <label class="input-group-text" for="estado">Estado</label>
                <select name="estado_id" id="estado" class="form-select <?= isset($errors['estado_id']) ? 'is-invalid' : '' ?>">
                    <option value="" selected disabled>Selecione um estado</option>
                    <?php foreach ($estados as $estado): ?>
                        <option value="<?= $estado['id'] ?>" <?= old('estado_id') == $estado['id'] ? 'selected' : '' ?>>
                            <?= $estado['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['estado_id'])): ?>
                    <div class="invalid-feedback"><?= $errors['estado_id'] ?></div>
                <?php endif; ?>
            </div>

            <div class="input-group mb-3">
                <label class="input-group-text" for="estado">Município</label>
                <select name="municipio_id" id="municipio" class="form-select <?= isset($errors['municipio_id']) ? 'is-invalid' : '' ?>">
                    <option value="" selected disabled>Selecione um município</option>
                    <?php foreach ($municipios as $municipio): ?>
                        <option value="<?= $municipio['id'] ?>" <?= old('municipio_id') == $municipio['id'] ? 'selected' : '' ?>>
                            <?= $municipio['nome'] ?>
                        </option>
                    <?php endforeach; ?>
                </select>
                <?php if (isset($errors['municipio_id'])): ?>
                    <div class="invalid-feedback"><?= $errors['municipio_id'] ?></div>
                <?php endif; ?>
            </div>
            
            

            <?= csrf_field() ?>

            <div class="container text-center">
                <button class="btn btn-primary">Cadastrar</button>

            </div>
            
        </form>

        <form class="text-center mt-2" action="<?= base_url('list')?>" method="get">
            <button type="submit" class="btn btn-danger ">Voltar</button>
        </form>
    </div>
    
    
    <script>
        const BASE_URL = '<?= base_url() ?>';
        const OLD_MUNICIPIO_ID = '<?= old('municipio_id') ?>';
        const OLD_ESTADO_ID = '<?= old('estado_id') ?>';
    </script>
    
    
    <script src="<?= base_url('js/script.js') ?>" defer></script>

<?= $this -> endSection() ?>