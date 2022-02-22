<template>
  <div>
    <h2 class="col-md-4">Galería de Imágenes</h2>

    <ul class="row list-unstyled mt-4">
      <li
        class="col-md-4 mb-4"
        v-for="imagen in imagenes"
        :key="imagen.id"
      >
        <a
          :href="`/storage/${imagen.ruta_imagen}`"
          data-lightbox="imagenes"
          :data-title="nombre"
        >
          <img
            class="img-fluid"
            :src="`/storage/${imagen.ruta_imagen}`"
            :alt="nombre"
          />
        </a>
      </li>
    </ul>
  </div>
</template>

<script>
  import Lightbox from 'lightbox2'

  export default {
    props: {
      nombre: String,
    },
    computed: {
      imagenes() {
        return this.$store.getters.obtenerImagenes
      },
    },
  }
</script>

<style>
@import 'https://cdnjs.cloudflare.com/ajax/libs/lightbox2/2.11.3/css/lightbox.min.css';
</style>