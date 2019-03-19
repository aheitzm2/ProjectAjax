<template>
    <div id="Game">
        <h1>Commencer à jouer !</h1>
        <div class="jumbotron animated zoomInDown" style="background-color: lightgray">
            <router-view name="gameContent"></router-view>
        </div>
    </div>
</template>
<script>
    export default {
        name: "Game"
    }
</script>