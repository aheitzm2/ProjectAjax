<template>
    <div id="Play">
        <div id="map" style="height: 500px;"></div>

        <img v-for="p in photo" :src="getImgURL(p.path)" alt="pas d'image"><br>
    </div>
</template>

<script>
    import L from 'leaflet'

    export default {
        name: "Play",
        data() {
            return {
                ville: [],
                villeNom: this.$route.query.ville,
                photo: [],
                cmptPhoto: 0,
                marqueur: ""
            }
        },
        methods: {
            getDataFromVille: function () {
                var self=this;
                var lat, lng;

                if(localStorage.token) this.token = localStorage.token;
                console.log(localStorage.token);

                var redIcon = L.icon({
                    iconUrl: require('../../../Image/icon.png'),

                    iconSize:     [38, 85], // size of the icon
                    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
                    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
                });

                $.post('http://127.0.0.1:8000/ville/find',{ ville: self.villeNom},function (data) {
                    self.ville= data.ville;
                    self.ville.latitude= parseFloat(data.ville.latitude);
                    self.ville.longitude= parseFloat(data.ville.longitude);
                    self.photo= data.photos;
                    var i;
                    for (i=0;i<self.photo.length;i++){
                        self.photo[i].latitude=parseFloat(self.photo[i].latitude);
                        self.photo[i].longitude=parseFloat(self.photo[i].longitude);
                    }
                    let mymap = L.map('map').setView([self.ville.latitude, self.ville.longitude], 14);
                    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                        maxZoom: 18,
                        id: 'mapbox.streets',
                        accessToken: 'pk.eyJ1IjoiZWxkb2luIiwiYSI6ImNqdGlsYjFpNDBtOXA0NHF6bHp5Y2VvOWcifQ.0_-qSgHr2utDqTEamQFcKg'
                    }).addTo(mymap);
                    mymap.addEventListener('mousemove', function(ev) {
                        lat = ev.latlng.lat;
                        lng = ev.latlng.lng;
                    });

                    document.getElementById("map").addEventListener("contextmenu", function (event) {
                        event.preventDefault();
                        self.marqueur=L.latLng(lat, lng);
                        // Add marker
                        L.marker([lat, lng],{icon: redIcon}).addTo(mymap);
                        //alert(lat + ' - ' + lng);

                        self.calculPoints();

                        return false; // To disable default popup.
                    });
                })
            },

            getImgURL: function (path) {
                return require('../../../Image/'+path);
            },

            calculPoints(){
                var positionLieu = L.latLng(this.photo[this.cmptPhoto].latitude, this.photo[this.cmptPhoto].longitude);
                alert(positionLieu.distanceTo(this.marqueur));
            }
        },
        mounted() {
            this.getDataFromVille();
        }
    }
</script>
<style>
    @import "~leaflet/dist/leaflet.css";
</style>