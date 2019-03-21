import Router from 'vue-router';
import Home from '../components/Home';
import Navbar from '../components/Navbar';

import Game from '../components/play/Game';
import Start from '../components/play/Start';
import Menu from '../components/play/Menu';
import Load from "../components/play/Load";
import Play from "../components/play/Play";

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'homepage',
            components: {
                home: Home,
                bar: Navbar
            }
        },
        {
            path: '/vue/play/games',
            name: 'game',
            components: {
                game: Game,
                bar: Navbar
            },
            children: [
                {
                    path:'menu',
                    name: 'gameMenu',
                    components: {
                        gameContent: Menu
                    }
                },
                {
                    path:'start',
                    name: 'gameStart',
                    components: {
                        gameContent: Start,
                        bar: Navbar
                    }
                },
                {
                    path:'load',
                    name: 'gameLoad',
                    components: {
                        gameContent: Load
                    }
                },
                {
                    path:'play',
                    name: 'gamePlay',
                    components: {
                        gameContent: Play
                    }
                }
            ]
        }
    ]
})