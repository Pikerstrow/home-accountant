import Vue from 'vue';
import Vuex from 'vuex';

Vue.use(Vuex);

export const store = new Vuex.Store({
    state: {
        username: null,
        costDirections: [],
        currentDaysExpenses: []
    },
    getters: {
        username(state) {
            return state.username;
        },
        costDirections(state) {
            return state.costDirections;
        },
        currentDaysExpenses(state){
            return state.currentDaysExpenses;
        }
    },
    mutations: {
        GET_USER_NAME(state, payload){
            state.username = payload;
        },
        GET_ALL_COST_DIRECTIONS(state, payload){
            state.costDirections = payload;
        },
        GET_CURRENT_DAY_EXPENSES(state, payload){
            state.currentDaysExpenses = payload;
        },
        addCostDirection(state, payload){
            state.costDirections.push(payload);
        },
        addCurrentDayExpense(state, payload){
            state.currentDaysExpenses.push(payload);
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
        getAllCostDirections({commit}){
            axios.get('/get-all-cost-directions').then(
                response => {
                    commit('GET_ALL_COST_DIRECTIONS', response.data.costDirections);
                }
            ).catch(error => {
                console.log(error)
            });
        },
        getCurrentDaysExpenses({commit}){
            axios.get('/get-current-day-expenses').then(
                response => {
                    commit('GET_CURRENT_DAY_EXPENSES', response.data.currentDayExpenses);
                }
            ).catch(error => {
                console.log(error)
            });
        }
    }
});