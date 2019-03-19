<template>
    <div id="GameStart" class="jumbotron nom-center">
        <h1>Informations</h1>
        <form action="#" method="post" class="nom-center p-5">
            <div class="md-form form-lg">
                <input type="nom" id="inputPseudo" class="form-control form-control-lg" required name="pseudo">
                <label for="inputPseudo">Pseudo</label>
            </div>
            <br>
            <label>Difficulté de la partie :</label>
            <div class="container">
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="diff1" name="difficulte" value="1">
                    <label for="diff1" class="custom-control-label">Niveau 1</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="diff2" name="difficulte" value="2">
                    <label for="diff2" class="custom-control-label">Niveau 2</label>
                </div>
                <div class="custom-control custom-radio">
                    <input type="radio" class="custom-control-input" id="diff3" name="difficulte" value="3">
                    <label for="diff3" class="custom-control-label">Niveau 3</label>
                </div>
            </div>
            <br>
            <select class="custom-select">
                <option selected>Sélectionnez une ville</option>
                <option v-for="v in ville" v-bind:value="v.nom">{{ v.nom }}</option>
            </select>
            <br>
            <hr>
            <div class="form-group">
                <button type="submit" class="fast animated bounce btn btn-success btn-block">Commencer</button>
            </div>
        </form>
    </div>
</template>

<script>
    export default {
        name: "Start",
        data() {
            return {
                form: {
                    pseudo:"",
                    difficulte:"",
                    ville: [
                        { nom: 'One', value: 'A' },
                        { nom: 'Two', value: 'B' },
                        { nom: 'Three', value: 'C' }
                    ]
                }
            }
        },
        methods: {
            getAllVilles: function () {
                $.getJSON('http://127.0.0.1:8000/ville/getAll', function (data) {
                    //this.ville = data.villes
                })
            }
        },
        mounted() {
            this.getAllVilles()
        }
    }
</script>