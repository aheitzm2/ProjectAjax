<template>
    <div id="GameStart" class="jumbotron nom-center">
        <h1>Informations</h1>
        <div class="alert alert-danger" id="error" role="alert" style="display: none"></div>
        <form action="#" method="post" class="nom-center p-5">
            <div class="md-form form-lg">
                <input type="text" id="inputPseudo" class="form-control form-control-lg" required name="pseudo" v-model="pseudo" @change="verifPseudo()">
                <label for="inputPseudo">Pseudo</label>
            </div>
            <br>
            <label>Difficulté de la partie :</label>
            <div class="container">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="diff1" name="difficulte" value="1" v-model="checkboxDiff" checked>
                    <label for="diff1" class="custom-control-label">Niveau 1</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="diff2" name="difficulte" value="2" v-model="checkboxDiff">
                    <label for="diff2" class="custom-control-label">Niveau 2</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="diff3" name="difficulte" value="3" v-model="checkboxDiff">
                    <label for="diff3" class="custom-control-label">Niveau 3</label>
                </div>
            </div>
            <br>
            <select id="selectVille" class="custom-select" required v-model="villeValue" @change="verifVille()">
                <option v-for="v in villes" :value="v.nom">{{ v.nom }}</option>
            </select>
            <br>
            <hr>
            <div class="form-group">
                <input type="button" class="fast animated bounce btn btn-success btn-block" @click="startPartie" value="Commencer">
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Start",
        data() {
            return {
                pseudo: "",
                partie:[],
                token:"",
                checkboxDiff:"",
                villeValue:"",
                villes: [],
                error: 0
            }
        },
        methods: {
            verifPseudo(){
                if ($('#inputPseudo').val()===null){
                    $('#error').html('Veuillez rentrer un pseudo.');
                    $('#error').css('display','block');
                    this.error=1;
                }
                else if(($('#inputPseudo').val()).length<3){
                    $('#error').html('Veuillez rentrer un pseudo de plus de 2 caractères.');
                    $('#error').css('display','block');
                    this.error=1;
                }
                else{
                    this.error=0;
                    $('#error').css('display','none');
                }
            },
            verifVille(){
                if($('#selectVille').val()===null){
                    $('#error').html('Veuillez selectionner une ville.');
                    $('#error').css('display','block');
                    this.error=1;
                }
                else{
                    this.error=0;
                    $('#error').css('display','none');
                }
            },

            getAllVilles: function () {
                var self=this;
                $.get('http://127.0.0.1:8000/ville/getAll', function (data) {
                    self.villes= data.villes;
                })  .done(function() {
                    console.log( self.villes );
                })
            },
            startPartie: function(){
                var self=this;
                $.post('http://127.0.0.1:8000/create/partie',{ pseudo: self.pseudo, difficulte: self.checkboxDiff, ville: self.villeValue },function (data) {
                    self.partie=data.partie;
                    self.token=data.token;
                    localStorage.token=data.token;
                });
                self.verifPseudo();
                self.verifVille();
                if (self.error===0){
                    setTimeout(function () {
                        self.$router.replace({name: 'gamePlay'});
                    }, 50);
                }
            }
        },
        created() {
            this.getAllVilles()
        },
        watch:{
            token(newName) {
                localStorage.token = newName;
            }
        }
    }
</script>