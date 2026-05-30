<div
    x-data="{
        map: null,
        marker: null,
        lat: $wire.entangle('data.latitude'),
        lng: $wire.entangle('data.longitude'),
        initMap() {
            if (typeof L === 'undefined') {
                const link = document.createElement('link');
                link.rel = 'stylesheet';
                link.href = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.css';
                document.head.appendChild(link);

                const script = document.createElement('script');
                script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
                script.onload = () => this.setupMap();
                document.head.appendChild(script);
            } else {
                this.setupMap();
            }
        },
        setupMap() {
            let initialLat = parseFloat(this.lat) || -1.2379;
            let initialLng = parseFloat(this.lng) || 116.8529;

            this.map = L.map($refs.mapContainer).setView([initialLat, initialLng], 15);
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '© OpenStreetMap contributors'
            }).addTo(this.map);

            this.marker = L.marker([initialLat, initialLng]).addTo(this.map);

            this.$watch('lat', value => this.updateMarker());
            this.$watch('lng', value => this.updateMarker());
        },
        updateMarker() {
            let newLat = parseFloat(this.lat) || -1.2379;
            let newLng = parseFloat(this.lng) || 116.8529;

            if (this.marker) {
                this.marker.setLatLng([newLat, newLng]);
                this.map.panTo([newLat, newLng]);
            }
        }
    }"
    x-init="initMap()"
    style="width: 100%; height: 350px; border-radius: 0.5rem; overflow: hidden; z-index: 1; border: 1px solid #d1d5db;"
>
    <div x-ref="mapContainer" style="width: 100%; height: 100%;"></div>
</div>
