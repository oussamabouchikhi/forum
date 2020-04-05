import axios from 'axios';
import Cookies from 'js-cookie';
import * as types from '../mutations_types';

// State
const state = {
    user: null,
    token: Cookies.get("token")
}

// Getters
const getters = {
    user: state => state.user,
    token: state => state.token,
    check: state => state.user != null
}

// Mutations
const mutations = {
    [types.SAVE_TOKEN] ( state, { token, remember } ) {
        state.token = token;
        // token expires in 365 days if remeber_me is checked
        Cookies.set("tpken", token, { expires: remember ? 365 : null })
    },
    [types.FETCH_USER_SUCCESS] (state, { user } ) {
        state.user = user.data;
    },
    [types.FETCH_USER_FAILURE] (state) {
        state.token = null;
        Cookies.remove("token");
    },
    [types.LOGOUT] (state) {
        state.user = null;
        state.token = null;
        Cookies.remove("token");
    }
};


// Actions
const actions = {
    saveToken ( {commit}, payload) {
        commit(types.SAVE_TOKEN, payload);
    },
    async fetchUser ( {commit} ) {

        try {

            const {data} = await axios.get('/api/v1/auth/user');
            commit( types.FETCH_USER_SUCCESS, {user: data} )
            
        } catch (error) {

            commit( types.FETCH_USER_FAILURE )

        }

    }
}

export default {
    namespaced: true,
    state,
    getters,
    mutations,
    actions
}