import Vue from 'Vue';
import Vuex from 'Vuex';
import auth from './modules/auth';

Vue.use(Vuex)

export default new Vuex.Store({
    modules: {
        auth
    }
})