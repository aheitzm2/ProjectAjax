<template>
    <div id="Play" class="text-center">
        <div class="container text-center" id="timer"><p style=" font-size: 30px;background-color: white; width: 50px; margin: auto" class="font-weight-bold rounded-circle primary-color">{{ count }}</p></div>
        <br>
        <div class="alert alert-success" role="alert"></div>
        <br>
        <div class="card" style="width: 700px; margin: auto">
            <div class="view overlay">
                <img class="card-img-top" style="width: 700px; height: 500px" id="imgCurrent">
                <a href="#!">
                    <div class="mask rgba-white-slight"></div>
                </a>
            </div>
        </div>
        <br>
        <div id="map" class="z-depth-1-half map-container" style="height: 500px;"></div>
        <br>
        <router-link id="quit" :to="{name: 'homepage'}" class="btn btn-info btn-block sm" style="display: none">Quitter</router-link>
    </div>
</template>

<script>
    import L from 'leaflet'

    export default {
        name: "Play",
        data() {
            return {
                time: 0,
                ville: [],
                D: 500,
                partie: [],
                photo: [],
                cmptPhoto: "",
                marqueur: "",
                points: ""
            }
        },
        methods: {
            timer(){
                this.time+=1;
                this.time<9999 && setTimeout(this.timer,1000);
            },

            getDataFromVille: function () {
                var self=this;
                var lat, lng;

                if(localStorage.token) this.token = localStorage.token;

                var redIcon = L.icon({
                    iconUrl: require('../../../Image/icon.png'),

                    iconSize:     [38, 85], // size of the icon
                    iconAnchor:   [22, 94], // point of the icon which will correspond to marker's location
                    popupAnchor:  [-3, -76] // point from which the popup should open relative to the iconAnchor
                });
                $.post('http://127.0.0.1:8000/ville/find',{ token: localStorage.token},function (data) {
                    if (data.partie.playable===false) self.$router.replace({name: 'gameMenu'});
                    self.ville= data.ville;
                    self.ville.latitude= parseFloat(data.ville.latitude);
                    self.ville.longitude= parseFloat(data.ville.longitude);
                    self.photo= data.photos;
                    self.partie=data.partie;
                    console.log(self.partie.playable);
                    self.cmptPhoto= data.partie.avancement;
                    self.points=data.partie.points;

                    $("#imgCurrent").attr('src', self.getImgURL(self.photo[self.cmptPhoto].path));

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

                        if (self.cmptPhoto+1<=self.photo.length){
                            var positionLieu = L.latLng(self.photo[self.cmptPhoto].latitude, self.photo[self.cmptPhoto].longitude);
                            //alert(positionLieu.distanceTo(self.marqueur));
                            var distance=Math.trunc(positionLieu.distanceTo(self.marqueur));
                            console.log(distance);
                            var pointsTotaux=self.points;
                            var point=0;
                            switch (self.partie.difficulte) {
                                case 1:
                                    if (distance<self.D) point+=5;
                                    else if (distance<(self.D)*2) point+=3;
                                    else if (distance<(self.D)*3) point+=1;
                                    break;
                                case 2:
                                    if (distance<(3./4.)*(self.D)) point+=5;
                                    else if (distance<(3./4.)*(self.D)*2) point+=3;
                                    else if (distance<(3./4.)*(self.D)*3) point+=1;
                                    break;
                                case 3:
                                    if (distance<(1./2.)*(self.D)) point+=5;
                                    else if (distance<(1./2.)*(self.D)*2) point+=3;
                                    else if (distance<(1./2.)*(self.D)*3) point+=1;
                                    break;
                            }
                            if (self.time<=2) point=point*4;
                            else if (self.time<=5) point=point*2;
                            else if (self.time>10) point=0;

                            self.time=0;

                            self.points+=point;
                            pointsTotaux+=point;
                            console.log(self.points);
                            console.log(self.cmptPhoto);

                            $.post('http://127.0.0.1:8000/partie/save',{ avancement: self.cmptPhoto, points: self.points, token:localStorage.token});

                            $('.alert').html("Points actuels : <strong>"+pointsTotaux+"</strong>");
                            self.cmptPhoto++;

                            if (self.cmptPhoto>=self.photo.length){
                                $.post('http://127.0.0.1:8000/partie/save',{ avancement: self.cmptPhoto, points: self.points, token:localStorage.token});
                                $.post('http://127.0.0.1:8000/playable',{token:localStorage.token});
                                $("#imgCurrent").remove();
                                $("#timer").remove();
                                $("#quit").css('display','block');
                            }else{
                                $("#imgCurrent").attr('src', self.getImgURL(self.photo[self.cmptPhoto].path));
                            }
                        }
                        return false; // To disable default popup.
                    });
                })
            },

            getImgURL: function (path) {
                return require('../../../Image/'+path);
            },
        },
        mounted() {
            if (typeof localStorage.token === 'undefined' || localStorage.token===null || localStorage.token==="") this.$router.replace({name: 'gameMenu'});
            this.getDataFromVille();
            this.timer();
        },
        computed: {
            count(){
                    return this.time;
            }
        }
    }
</script>
<style>
    @import "~leaflet/dist/leaflet.css";
</style>