<template>
  <div class="container my-5">
    <h2>Restaurantes</h2>

    <div class="row">
      <div
        class="col-md-4 mt-4"
        v-for="restaurante in this.restaurantes"
        v-bind:key="restaurante.id"
      >
        <div class="card">
          <img
            :src="`storage/${restaurante.imagen_principal}`"
            :alt="restaurante.nombre"
            :title="restaurante.nombre"
            class="card-img-top"
          />
          <div class="card-body">
            <h3 class="card-title text-primary font-weight-bold">{{ restaurante.nombre }}</h3>
            <p class="card-text">{{ restaurante.direccion }}</p>
            <p class="card-text">
              <span class="font-weight-bold">Horario:</span>
              {{ restaurante.apertura }} - {{ restaurante.cierre }}
            </p>

            <a
              href
              class="btn btn-primary d-block"
            >Ver lugar</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
  import axios from 'axios'

  export default {
    mounted() {
      axios.get('/api/categorias/restaurantes').then((resp) => {
        this.$store.commit("AGREGAR_RESTAURANTES", resp.data)
      })
    },
    computed: {
      restaurantes() {
        return this.$store.state.restaurantes
      },
    },
  }
</script>
