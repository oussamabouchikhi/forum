// Make sure to call Vue.use(Vuex) first if using a module system

export default {
    state: {
        title: 'Forum with Laravel & VueJs'
    },
    getters: {
        showTitle (state) {
            return state.title
        }
    }
}