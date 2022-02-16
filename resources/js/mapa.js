document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector("#mapa")) {
        const lat = 20.273714;
        const lng = -98.947751;

        const mapa = L.map("mapa").setView([lat, lng], 16);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution:
                '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        }).addTo(mapa);

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
        });
    }
});
