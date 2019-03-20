import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        username: null
    },
    getters: {
        username(state) {
            return state.username;
        }
    },
    mutations: {
        GET_USER_NAME(state, payload){
            state.username = payload;
        }
    },
    actions: {
        getUserName({commit}){
            axios.get('/get_username').then(
                response => {
                    commit('GET_USER_NAME', response.data.username);
                }
            ).catch(error => {
                console.log(error)
            });
        },
    }
});