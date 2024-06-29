const dropzoneWrapId = '#dropzone-wrap'
const dropzoneWrap = document.querySelector(dropzoneWrapId)

const dropzone = new Dropzone(dropzoneWrapId, {
    url: DROPZONE_UPLOAD_URL,
    thumbnailWidth: 50,
    thumbnailHeight: 50,
    parallelUploads: 1,
    previewTemplate: DROPZONE_TEMPLATE,
    maxFilesize: 1, // 1 MB
    resizeWidth: 1280,
    resizeHeight: 720,
    resizeQuality: 1.0,
    maxFiles: 5,
    acceptedFiles: 'image/*',
    autoQueue: false,
    previewsContainer: `${dropzoneWrapId} .dropzone-items`,
    clickable: `${dropzoneWrapId} .dropzone-select`,
    dictFileTooBig: "O arquivo é muito grande ({{filesize}}MiB). Tamanho máximo permitido é {{maxFilesize}}MiB.",
    dictMaxFilesExceeded: "Você não pode carregar mais arquivos."
})

dropzone.on("addedfile", file => {
    file.previewElement.querySelector(".dropzone-start")
        .onclick = () => dropzone.enqueueFile(file)
})

dropzone.on("sending", file => {
    file.previewElement.querySelector(".dropzone-start")
        .setAttribute("disabled", "disabled")

    file.previewElement.querySelector(".progress")
        .classList.remove('d-none')
})

dropzone.on("success", file => {
    file.previewElement.querySelector(".dropzone-start")
        .classList.add('d-none')

    file.previewElement.querySelector(".dropzone-cancel")
        .classList.add('d-none')
        
    file.previewElement.querySelector(".progress")
        .classList.add('d-none')

    if (file.previewElement) {
      return file.previewElement.classList.add("dz-success")
    }
})

dropzoneWrap.querySelector(".dropzone-upload").onclick = () => {
    let files = dropzone.getFilesWithStatus(Dropzone.ADDED)
    dropzone.enqueueFiles(files)
}

dropzoneWrap.querySelector(".dropzone-remove-all").onclick = () => {
    dropzone.removeAllFiles(true)
}

IMAGE_EXISTS.map(image => {
    dropzone.displayExistingFile(image.filedata, image.url); 
})