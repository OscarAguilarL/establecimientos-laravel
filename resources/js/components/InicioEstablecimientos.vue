<template>
  <div>
    <router-view></router-view>
    <categoria-cafe></categoria-cafe>
    <categoria-restaurante></categoria-restaurante>
    <categoria-hotel></categoria-hotel>
  </div>
</template>

<script>
  import CategoriaCafe from './CategoriaCafe'
  import CategoriaHotel from './CategoriaHotel'
  import CategoriaRestaurante from './CategoriaRestaurante'

  export default {
    components: {
      CategoriaCafe,
      CategoriaRestaurante,
      CategoriaHotel,
    },
  }
</script>