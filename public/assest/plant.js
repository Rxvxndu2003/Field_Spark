document.addEventListener('DOMContentLoaded', function () {
    const plantImageInput = document.getElementById('plant-image-input');
    const plantImagesTextarea = document.getElementById('plant-images');
    const attachIcon = document.getElementById('attach-icon');
    const cameraIcon = document.getElementById('camera-icon');
    const imageUploadDiv = document.getElementById('image-upload');

    // Click event for icons to trigger file input
    attachIcon.addEventListener('click', () => plantImageInput.click());
    cameraIcon.addEventListener('click', () => plantImageInput.click());

    // File input change event
    plantImageInput.addEventListener('change', handleFileSelect);

    // Drag and drop events
    imageUploadDiv.addEventListener('dragover', (e) => {
        e.preventDefault();
        imageUploadDiv.classList.add('drag-over');
    });

    imageUploadDiv.addEventListener('dragleave', () => {
        imageUploadDiv.classList.remove('drag-over');
    });

    imageUploadDiv.addEventListener('drop', (e) => {
        e.preventDefault();
        imageUploadDiv.classList.remove('drag-over');
        handleFileSelect(e, e.dataTransfer.files);
    });

    function handleFileSelect(e, files = null) {
        const selectedFiles = files || plantImageInput.files;
        const fileNames = Array.from(selectedFiles).map(file => file.name).join(', ');
        plantImagesTextarea.value = fileNames;
    }
});