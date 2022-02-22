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
      <l-tile-layer>
        <l-tooltip></l-tooltip>
      </l-tile-layer>
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
  }
</script>

<style scoped>
.mapa {
  height: 600px;
  width: 100%;
}
</style>