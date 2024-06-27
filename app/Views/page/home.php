<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>ci-dropzonejs</title>

    <?= link_tag('https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css') ?>
    <?= link_tag('https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css') ?>
    <style>
        .progress {
            height: 8px;
        }

        .btn-close:focus,
        .btn-play {
            box-shadow: none;
            border: none!important;
        }

        .img-50 {
            width: 50px;
            height: 50px;
            object-fit: cover;
            object-position: center;
        }
    </style>
</head>
<body>

    <div id="dropzonejs" class="container my-4">
        
        <!-- Botões de controle -->
        <div class="d-flex justify-content-end gap-2 mb-4">
            <button id="btn-buscar-fotos" class="btn btn-primary" type="button"><i class="bi bi-cloud-upload"></i> Buscar Fotos</button>
            <button class="btn btn-linght border dropzone-upload" type="button"><i class="bi bi-play"></i> Enviar Tudo</button>
            <button class="btn btn-linght border dropzone-remove-all" type="button"><i class="bi bi-x-lg"></i> Cancelar Tudo</button>
        </div>
        <!-- ./Botões de controle -->

        <!-- Lista de arquivos enviados -->
        <ul class="list-group">
            <li class="list-group-item d-flex gap-3 align-items-center px-2 dropzone-item">
                <img class="rounded img-50  " src="https://placehold.co/50" />

                <div class="flex-fill">
                    <p class="mb-0"><span data-dz-name>some_image_file_name.jpg</span> <strong>(<span data-dz-size>340kb</span>)</strong></p>
                    <div class="text-danger" data-dz-errormessage></div>
                </div>

                <div class="progress col-2">
                    <div class="progress-bar" data-dz-uploadprogress></div>
                </div>

                <button type="button" class="dropzone-start p-0 ms-3 btn btn-play"><i class="bi fs-3 link-secondary bi-play"></i></button>
                <button type="button" class="dropzone-cancel p-3 btn-close" style="display: none;" data-dz-remove></button>
                <button type="button" class="dropzone-delete p-3 btn-close" data-dz-remove></button>
            </li>
        </ul>
        <!-- ./Lista de arquivos enviados -->

    </div>

    <?= script_tag('https://unpkg.com/dropzone@5/dist/min/dropzone.min.js') ?>
    <script>
       
    </script>
</body>
</html>