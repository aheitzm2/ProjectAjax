<template>
    <div id="Score" class="container">
        <h1 class="bounceIn">Page des scores</h1><br>
        <table class="table">
            <thead class="black white-text">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Pseudo</th>
                <th scope="col">Score</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="t in top" class="bounceIn">
                <th scope="row">{{ t.id }}</th>
                <td>{{ t.pseudo }}</td>
                <td>{{ t.points }}</td>
            </tr>
            </tbody>
        </table>
    </div>
</template>
<script>
    export default {
        name: "Score",
        data(){
            return{
                top: [],
                cmpt: 0
            }
        },
        methods: {
            incrementer(){
                this.cmpt++;
            },
            getBestScores(){
                var self=this;
                $.post('http://127.0.0.1:8000/scores/best/find',function (data) {
                    self.top=data.top;
                    var cmpt=1;
                    for (var t in self.top){
                        self.top[t].id=cmpt;
                        cmpt++;
                    }
                });
            }
        },
        created() {
            this.getBestScores();
        }
    }
</script>