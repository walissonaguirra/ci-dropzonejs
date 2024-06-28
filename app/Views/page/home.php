<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ci-dropzonejs</title>

    <?= link_tag('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css') ?>
    <?= link_tag('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css') ?>
    <?= link_tag('css/page/home.css') ?>
</head>
<body>

    <div id="dropzone-wrap" class="container my-4">
        
        <!-- Botões de controle -->
        <div class="text-end mb-4">

            <button class="dropzone-select btn btn-success" type="button">
                Carregar Fotos
            </button>
            
            <button class="dropzone-upload btn btn-primary" type="button">
                Enviar Tudo
            </button>
            
            <button class="dropzone-remove-all btn btn-warning" type="button">
                Cancelar Tudo
            </button>

        </div>
        <!-- ./Botões de controle -->

        <!-- Lista de arquivos enviados -->
        <ul class="dropzone-items list-group">

        </ul>
        <!-- ./Lista de arquivos enviados -->

        <span class="form-text text-muted">O tamanho máximo do arquivo é de 1MB e o número máximo de arquivos é 5.</span>    
    </div>

    <?= script_tag('https://unpkg.com/dropzone@5/dist/min/dropzone.min.js') ?>
    <script>
        const DROPZONE_UPLOAD_URL = '<?= url_to('upload') ?>'
        const DROPZONE_TEMPLATE = `
            <li class="dropzone-item list-group-item px-2">
                <div class="d-flex gap-1 align-items-center">
                    <img class="rounded img-50" data-dz-thumbnail/>

                    <div class="flex-fill">
                        <p class="mb-0"><span data-dz-name></span> <strong>(<span data-dz-size></span>)</strong></p>
                        <div class="text-danger" data-dz-errormessage></div>
                    </div>

                    <div class="progress col-2 me-2 d-none">
                        <div class="progress-bar" data-dz-uploadprogress></div>
                    </div>

                    <button type="button" class="dropzone-start btn btn-primary">Enviar</button>
                    <button type="button" class="dropzone-cancel btn btn-warning" data-dz-remove>Cancelar</button>
                </div>
            </li>
        `
    </script>
    <?= script_tag('js/page/home.js') ?>
</body>
</html>