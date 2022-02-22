<template>
  <div class="container my-5">
    <h2>{{ establecimiento.nombre }}</h2>
  </div>
</template>

<script>
  export default {
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
