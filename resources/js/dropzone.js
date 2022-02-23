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
            init: function () {
                const galeria = document.querySelectorAll(".galeria");
                if (galeria.length) {
                    galeria.forEach((img) => {
                        const imagenPublicada = {};
                        imagenPublicada.size = 1;
                        imagenPublicada.name = img.value;
                        imagenPublicada.nombreServidor = img.value;

                        this.options.addedfile.call(this, imagenPublicada);
                        this.options.thumbnail.call(
                            this,
                            imagenPublicada,
                            `/storage/${imagenPublicada.name}`
                        );

                        imagenPublicada.previewElement.classList.add(
                            "dz-success"
                        );
                        imagenPublicada.previewElement.classList.add(
                            "dz-complete"
                        );
                    });
                }
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

                axios
                    .post("/imagenes/destroy", {
                        imagen: file.nombreServidor,
                    })
                    .then(() => {
                        file.previewElement.parentNode.removeChild(
                            file.previewElement
                        );
                    });
            },
        });
    }
});
