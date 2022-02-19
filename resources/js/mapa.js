import { OpenStreetMapProvider } from "leaflet-geosearch";

const provider = new OpenStreetMapProvider();
const apikey =
    "AAPKc6216aeeb78e46a9b32bc276975c33958YuDQzS6ENQWt2wfPXuDnFMrDwGd2q9IUttbQkXXTjE8PH1HCLkJNP9sKYBsnfFP";

document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector("#mapa")) {
        const options = {
            enableHighAccuracy: true,
            timeout: 5000,
            maximumAge: 0,
        };

        let mapa;
        let geocodeService;
        let markers;
        let marker;

        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(success, error, options);
        }

        function success({ coords }) {
            const { latitude, longitude } = coords;

            const lat =
                document.querySelector("#lat").value === ""
                    ? latitude
                    : document.querySelector("#lat").value;

            const lng =
                document.querySelector("#lng").value === ""
                    ? longitude
                    : document.querySelector("#lng").value;

            mapa = L.map("mapa").setView([lat, lng], 16);
            //Geocode service
            geocodeService = L.esri.Geocoding.geocodeService({
                apikey,
            });
            // buscador de direcciones
            const buscador = document.querySelector("#formbuscador");

            // eliminar pines previos
            markers = new L.featureGroup().addTo(mapa);

            // buscador.addEventListener("input", buscarDireccion);
            buscador.addEventListener("blur", buscarDireccion);

            L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
                attribution:
                    '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
            }).addTo(mapa);

            // agregar el pin
            marker = new L.marker([lat, lng], {
                draggable: true,
                autoPan: true,
            }).addTo(mapa);

            // agregar a la capa
            markers.addLayer(marker);

            reubicarPin(marker);
        }

        function error(err) {
            console.warn(`ERROR(${err.code}): ${err.message}`);
        }

        function reubicarPin(marker) {
            // detectar el movimiento del marker
            marker.on("moveend", (e) => {
                const { lat, lng } = e.target.getLatLng();

                // centrar automaticamente
                mapa.panTo(new L.LatLng(lat, lng));

                // reverse geocoding, cuando el usuario reubica el pin
                geocodeService
                    .reverse()
                    .latlng({ lat, lng }, 16)
                    .run((err, result) => {
                        if (err) console.log(err);

                        marker.bindPopup(result.address.LongLabel);
                        marker.openPopup();

                        // llenar los campos
                        llenarInputs(result);
                    });
            });
        }

        function buscarDireccion(e) {
            let timerId;
            clearTimeout(timerId);
            timerId = setTimeout(() => {
                provider
                    .search({ query: `${e.target.value} Hidalgo MX` })
                    .then((result) => {
                        if (result) {
                            // limpiar los pines previos
                            markers.clearLayers();

                            // reverse geocoding, cuando el usuario reubica el pin
                            geocodeService
                                .reverse()
                                .latlng(result[0].bounds[0], 16)
                                .run((err, resultGeocode) => {
                                    if (err) console.log(err);

                                    // llenar los inputs
                                    llenarInputs(resultGeocode);

                                    // centrar el mapa
                                    mapa.setView(resultGeocode.latlng);

                                    // agregar el pin
                                    marker = new L.marker(
                                        resultGeocode.latlng,
                                        {
                                            draggable: true,
                                            autoPan: true,
                                        }
                                    ).addTo(mapa);

                                    // asignar el contenedor de markers el nuevo pin
                                    markers.addLayer(marker);

                                    // mover el pin
                                    reubicarPin(marker);
                                });
                        }
                    })
                    .catch(console.log);
            }, 800);
        }

        function llenarInputs(result) {
            document.querySelector("#direccion").value =
                result.address.Address || "";
            document.querySelector("#colonia").value =
                result.address.Neighborhood || "";
            document.querySelector("#lat").value = result.latlng.lat || "";
            document.querySelector("#lng").value = result.latlng.lng || "";
        }
    }
});
