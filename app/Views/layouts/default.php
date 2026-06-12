<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <title>Trabalho Prático II</title>
</head>

<body>

    <?= $this->renderSection('content') ?>

    <div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 1100">

        <?php if (session()->getFlashdata('success')): ?>
            <div class="toast align-items-center text-bg-success border-0" role="alert" aria-live="assertive"
                aria-atomic="true" data-bs-delay="4000">
                <div class="d-flex">
                    <div class="toast-body"><?= session()->getFlashdata('success') ?></div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>

        <?php if (session()->getFlashdata('error')): ?>
            <div class="toast align-items-center text-bg-danger border-0" role="alert" aria-live="assertive"
                aria-atomic="true" data-bs-delay="4000">
                <div class="d-flex">
                    <div class="toast-body"><?= session()->getFlashdata('error') ?></div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast"
                        aria-label="Close"></button>
                </div>
            </div>
        <?php endif; ?>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI"
        crossorigin="anonymous"></script>

    <script>
        document.querySelectorAll('.toast').forEach(function (el) {
            new bootstrap.Toast(el).show();
        });
    </script>

</body>

</html>