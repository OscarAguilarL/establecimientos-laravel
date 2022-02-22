<template>
  <h1>desde establecimiento</h1>
</template>

<script>
  export default {
    mounted() {
      const { id } = this.$route.params
      axios.get(`/api/establecimientos/${id}`).then((resp) => {
        console.log(resp.data)
      })
    },
    computed: {},
  }
</script>

<style>
</style>