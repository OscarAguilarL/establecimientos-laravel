<template>
  <div class="mapa">
    <l-map
      :zoom="zoom"
      :center="center"
      :options="mapOptions"
    >
      <l-tile-layer
        :url="url"
        :attribution="attribution"
      ></l-tile-layer>
      <l-marker
        v-for="establecimiento in establecimientos"
        :key="establecimiento.id"
        :lat-lng="obtenerCoordenadas(establecimiento)"
      >
        <l-tooltip>
          <div>{{ establecimiento.nombre }}</div>
        </l-tooltip>
      </l-marker>
    </l-map>
  </div>
</template>

<script>
  import { latLng } from 'leaflet'
  import { LMap, LTileLayer, LMarker, LTooltip, LIcon } from 'vue2-leaflet'

  export default {
    components: {
      LMap,
      LTileLayer,
      LMarker,
      LTooltip,
      LIcon,
    },
    data() {
      return {
        zoom: 13,
        center: latLng(20.666332695977, -103.392177745699),
        url: 'https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png',
        attribution:
          '&copy; <a href="http://osm.org/copyright">OpenStreetMap</a> contributors',
        currentZoom: 11.5,
        currentCenter: latLng(20.666332695977, -103.392177745699),
        showParagraph: false,
        mapOptions: {
          zoomSnap: 0.5,
        },
        showMap: true,
      }
    },
    created() {
      axios.get('/api/establecimientos').then((resp) => {
        this.$store.commit('AGREGAR_ESTABLECIMIENTOS', resp.data)
      })
    },
    computed: {
      establecimientos() {
        return this.$store.getters.obtenerEstablecientos
      },
    },
    methods: {
      obtenerCoordenadas(establecimiento) {
        const { lat, lng } = establecimiento
        return { lat, lng }
      },
    },
  }
</script>

<style scoped>
.mapa {
  height: 400px;
  width: 100%;
}
</style>