import './bootstrap';
import Dropzone from 'dropzone';

Dropzone.autoDiscover = false;

const dropzone = new Dropzone('#dropzone', {
    dictDefaultMessage: 'Sube aquí tu imagen',
    acceptedFiles: ".png, .jpg, .jpeg, .gif",
    addRemoveLinks: true,
    dictRemoveFile: "Borrar archivo",
    maxFiles: 1,
    uploadMultiple: false,

    init: function () {
        const inputImagen = document.querySelector('[name="imagen"]');
        if (inputImagen && inputImagen.value.trim()) {
            const imagenPublicada = { 
                name: inputImagen.value, 
                size: 1234, // Tamaño ficticio, solo para evitar errores
                type: 'image/jpeg' // Ajusta el tipo según el formato real
            };

            // Agregar la imagen como si hubiera sido subida
            this.emit("addedfile", imagenPublicada);
            this.emit("thumbnail", imagenPublicada, `/storage/imagenes/${imagenPublicada.name}`);
            
            // Marcar la imagen como subida correctamente
            if (imagenPublicada.previewElement) {
                imagenPublicada.previewElement.classList.add('dz-success', 'dz-complete');
            }
        }
    }
});

// Eventos de Dropzone
dropzone.on('sending', function (file, xhr, formData) {
    console.log("Enviando archivo:", file);
});

dropzone.on('success', function (file, response) {
    console.log("Respuesta del servidor:", response);
    document.querySelector('[name="imagen"]').value = response.imagen;
});

dropzone.on('error', function (file, message) {
    console.log("Error:", message);
});

dropzone.on('removedfile', function (file) {
    console.log('Archivo eliminado');
    document.querySelector('[name="imagen"]').value = "";
});
