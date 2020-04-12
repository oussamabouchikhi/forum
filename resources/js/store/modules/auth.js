import axios      from "axios";
import Cookies    from "js-cookie";
import * as types from "../mutations_types";

// State
const state = {
    user:     null,
    token:    Cookies.get("token"),
    auth_err: null,
    loading:  false,
    isLogged: false
}


// Getters
const getters = {
    user:      state => state.user,
    token:     state => state.token,
    check:     state => state.isLogged,
    authError: state => state.auth_err,
    isLoading: state => state.loading
}

// Mutations
const mutations = {
    [types.LOGIN] (state) {
        state.loading  = true;
        state.auth_err = null;
        state.isLogged = false;
    },
    [types.LOGIN_SUCCESS] ( state, { token, remember } ) {
        state.loading  = false; // hide loading spinner
        state.auth_err = null;  // no authentication errors
        state.token    = token; // get token
        state.isLogged = true;
        // Save token in cookies
        // token expires in 365 days if remeber_me is checked
        Cookies.set("token", token, { expires: remember ? 365 : null });
    },
    [types.LOGIN_FAILURE] ( state, { error } ) {
        state.loading  = false; // hide loading spinner
        state.auth_err = error;  // get authentication errors
        state.isLogged = false;
    },
    [types.FETCH_USER_SUCCESS] (state, { user } ) {
        state.user     = user.data; // Get user data
        state.isLogged = true;
    },
    [types.FETCH_USER_FAILURE] (state) {
        state.token    = null;
        state.isLogged = false;
        Cookies.remove("token"); // remove token from cookies
    },
    [types.LOGOUT] (state) {
        state.user     = null;
        state.token    = null;
        state.isLogged = false;
        Cookies.remove("token");
    }
};


// Actions
const actions = {
    login ( {commit} ) {
        commit(types.LOGIN); // execute the mutation LOGIN
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