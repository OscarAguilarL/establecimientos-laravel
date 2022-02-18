document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector("div#dropzone")) {
        Dropzone.autoDiscover = false;

        const dropzone = new Dropzone("div#dropzone", {
            url: "/imagenes/store",
            dictDefaultMessage: "Sube hasta 10 imágenes",
            maxFiles: 10,
            required: true,
            acceptedFiles: ".png,.jpg,.gif,.bmp,.jpeg",
            addRemoveLinks: true,
            dictRemoveFile: "Eliminar imágen",
            dictCancelUpload: "Cancelar subida",
            headers: {
                "X-CSRF-TOKEN": document.querySelector("meta[name=csrf-token]")
                    .content,
            },

            success: function (file, resp) {
                console.log(resp);
                file.nombreServidor = resp.archivo;
            },
            sending: function (file, xhr, formData) {
                formData.append("uuid", document.querySelector("#uuid").value);
                console.log("enviando");
            },
            removedfile: function (file, resp) {
                console.log(file);
            },
        });
    }
});
