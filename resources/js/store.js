import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        username: null,
        costItems: [],
    },
    getters: {
        username(state) {
            return state.username;
        },
        costItems(state) {
            return state.costItems;
        }
    },
    mutations: {
        GET_USER_NAME(state, payload){
            state.username = payload;
        },
        GET_ALL_COST_ITEMS(state, payload){
            state.costItems = payload;
        },
        addCostItem(state, payload){
            state.costItems.unshift(payload);
        }
    },
    actions: {
        getUserName({commit}){
            axios.get('/get-username').then(
                response => {
                    commit('GET_USER_NAME', response.data.username);
                }
            ).catch(error => {
                console.log(error)
            });
        },
        getAllCostItems({commit}){
            axios.get('/get-all-cost-items').then(
                response => {
                    commit('GET_ALL_COST_ITEMS', response.data.costItems);
                }
            ).catch(error => {
                console.log(error)
            });
        }
    }
});