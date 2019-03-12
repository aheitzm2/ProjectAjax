<template>
    <div id="app" style="margin-top: 0%">
        <div class="bar">
            <router-view name="bar"></router-view>
        </div>
        <div class="container">
            <div class="jumbotron">

                <h1>TEST</h1>
                <div class="home">
                    <router-view name="home"></router-view>
                </div>
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
    #app {
        font-family: 'Avenir', Helvetica, Arial, sans-serif;
        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        text-align: center;
        color: #2c3e50;
        margin-top: 60px;
    }
</style>