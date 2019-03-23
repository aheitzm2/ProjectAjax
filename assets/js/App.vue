<template>
    <div id="app" style="margin-top: 0%">
        <div class="bar">
            <router-view name="bar"></router-view>
        </div>
        <div class="container">
            <div class="jumbotron">
                    <router-view name="home"></router-view>
                    <router-view name="game"></router-view>
                    <router-view name="content"></router-view>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'app'
    }
</script>

<style>
</style>