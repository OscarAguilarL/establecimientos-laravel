document.addEventListener("DOMContentLoaded", () => {
    if (document.querySelector("#mapa")) {
        const lat = 20.273714;
        const lng = -98.947751;

        const mapa = L.map("mapa").setView([lat, lng], 18);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution:
                '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        }).addTo(mapa);

        // agregar el pin
        const marker = new L.marker([lat, lng]);
        marker.addTo(mapa);
    }
});
