<template>
    <div id="Play">
        <div id="map" style="height: 500px;"></div>
    </div>
</template>
<script>
    import L from 'leaflet'

    export default {
        name: "Play",
        mounted() {
            let mymap = L.map('map').setView([47.639613, 6.863610], 13);
            L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                maxZoom: 18,
                id: 'mapbox.streets',
                accessToken: 'pk.eyJ1IjoiZWxkb2luIiwiYSI6ImNqdGlsYjFpNDBtOXA0NHF6bHp5Y2VvOWcifQ.0_-qSgHr2utDqTEamQFcKg'
            }).addTo(mymap);
        }
    }
</script>
<style>
    @import "~leaflet/dist/leaflet.css";
</style>