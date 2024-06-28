const dropzoneWrapId = '#dropzone-wrap'
const dropzoneWrap = document.querySelector(dropzoneWrapId)

const dropzone = new Dropzone(dropzoneWrapId, {
    url: DROPZONE_UPLOAD_URL,
    thumbnailWidth: 50,
    thumbnailHeight: 50,
    parallelUploads: 1,
    previewTemplate: DROPZONE_TEMPLATE,
    maxFilesize: 2, // 2 MB
    autoQueue: false,
    previewsContainer: `${dropzoneWrapId} .dropzone-items`,
    clickable: `${dropzoneWrapId} .dropzone-select`
})

dropzone.on("addedfile", file => {
    file.previewElement.querySelector(".dropzone-start")
        .onclick = () => dropzone.enqueueFile(file)
})

dropzone.on("sending", file => {
    file.previewElement.querySelector(".dropzone-start")
        .setAttribute("disabled", "disabled")
})

dropzoneWrap.querySelector(".dropzone-upload").onclick = () => {
    let files = dropzone.getFilesWithStatus(Dropzone.ADDED)
    dropzone.enqueueFiles(files)
}

dropzoneWrap.querySelector(".dropzone-remove-all").onclick = () => {
    dropzone.removeAllFiles(true)
}