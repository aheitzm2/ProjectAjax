<template>
    <div id="GameStart" class="jumbotron text-center">
        <h1>Informations</h1>
        <form action="#" method="post" class="text-center p-5">
            <div class="md-form form-lg">
                <input type="text" id="inputPseudo" class="form-control form-control-lg" required name="pseudo">
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
            <div class="form-group">
                <button type="submit" class="fast animated bounce btn btn-success btn-block" @click="getAllVilles">Commencer</button>
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
                }
            }
        },
        methods: {
            getAllVilles: function () {

            }
        },
        mounted: {

        }
    }
</script>