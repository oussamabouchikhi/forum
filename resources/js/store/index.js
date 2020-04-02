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