export default {
    namespaced: true,

    state: () => ({
        user: {},
    }),

    mutations: {

        STORE_USER(state, user) {
            state.user = user;
        }

    },

    actions: {}
}