<template>
  <div class="container my-5">
    <h2 class="text-center mb-5">{{ establecimiento.nombre }}</h2>
    <div class="row align-items-start">
      <div class="col-md-8">
        <img
          :src="`../storage/${establecimiento.imagen_principal}`"
          :alt="establecimiento.nombre"
          class="img-fluid"
        />
        <p class="mt-5">{{ establecimiento.descripcion }}</p>
      </div>
      <aside class="col-md-4">
        <div>
          <mapa-ubicacion></mapa-ubicacion>
        </div>

        <div class="p-4 bg-primary">
          <h2 class="text-center text-white mt-2 mb-4">Más información</h2>

          <p class="text-white mt-1">
            <span class="font-weight-bold">Ubicación:</span>
            {{ establecimiento.direccion }}
          </p>
          <p class="text-white mt-1">
            <span class="font-weight-bold">Colonia:</span>
            {{ establecimiento.colonia }}
          </p>
          <p class="text-white mt-1">
            <span class="font-weight-bold">Horario:</span>
            {{ establecimiento.apertura }} - {{ establecimiento.cierre }}
          </p>
          <p class="text-white mt-1">
            <span class="font-weight-bold">Teléfono:</span>
            {{ establecimiento.telefono }}
          </p>
        </div>
      </aside>
    </div>
  </div>
</template>

<script>
  import MapaUbicacion from './MapaUbicacion'

  export default {
    components: {
      MapaUbicacion,
    },
    created() {
      const { id } = this.$route.params
      axios.get(`/api/establecimientos/${id}`).then((resp) => {
        this.$store.commit('AGREGAR_ESTABLECIMIENTO', resp.data)
      })
    },
    computed: {
      establecimiento() {
        return this.$store.getters.obtenerEstableciento
      },
    },
  }
</script>
