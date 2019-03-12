import Router from 'vue-router';
import Home from '../components/Home';
import Navbar from '../components/Navbar';

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'homepage',
            components: {
                home:Home,
                bar:Navbar
            }
        }
    ]
})