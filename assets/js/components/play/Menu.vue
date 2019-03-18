<template>
    <div id="Menu">
        <router-link :to="{name: 'gameStart'}" class="btn btn-success btn-block sm">Commencer</router-link>
        <br>
        <router-link :to="{name: 'gameLoad'}" class="btn btn-warning btn-block sm">Charger partie</router-link>
    </div>
</template>
<script>
    export default {
        name: "Menu"
    }
</script>