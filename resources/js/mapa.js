document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector("#mapa")) {
        const lat = 20.273714;
        const lng = -98.947751;

        const mapa = L.map("mapa").setView([lat, lng], 16);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution:
                '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        }).addTo(mapa);

        //Geocode service
        const geocodeService = L.esri.Geocoding.geocodeService({
            apikey: "AAPKc6216aeeb78e46a9b32bc276975c33958YuDQzS6ENQWt2wfPXuDnFMrDwGd2q9IUttbQkXXTjE8PH1HCLkJNP9sKYBsnfFP",
        });

        // agregar el pin
        let marker;
        marker = new L.marker([lat, lng], {
            draggable: true,
            autoPan: true,
        }).addTo(mapa);

        // detectar el movimiento del marker
        marker.on("moveend", (e) => {
            const { lat, lng } = e.target.getLatLng();
            console.log(lat, lng);

            // centrar automaticamente
            mapa.panTo(new L.LatLng(lat, lng));

            // reverse geocoding, cuando el usuario reubica el pin
            geocodeService
                .reverse()
                .latlng({ lat, lng }, 16)
                .run((err, result) => {
                    if (err) console.log(err);

                    console.log(result.address);

                    marker.bindPopup(result.address.LongLabel);
                    marker.openPopup();
                });
        });
    }
});
