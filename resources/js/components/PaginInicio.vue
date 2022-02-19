<template>
  <div>
    <categoria-cafe></categoria-cafe>
    <categoria-restaurante></categoria-restaurante>
  </div>
</template>

<script>
  import CategoriaCafe from './CategoriaCafe'
  import CategoriaRestaurante from './CategoriaRestaurante'

  export default {
    components: {
      CategoriaCafe,
      CategoriaRestaurante,
    },
  }
</script>