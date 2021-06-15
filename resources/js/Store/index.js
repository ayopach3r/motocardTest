import Vue from "vue";
import Vuex from "vuex";
import {dispatch} from "../../../../socialme/vendor/livewire/livewire/js/util";

Vue.use(Vuex);

const store = new Vuex.Store({
    state: {
        starships: [],
        pilots: []
    },

    getters: {
        starships(state) {
            return state.starships;
        },

        pilots(state) {
            return state.pilots;
        }
    },

    mutations: {
        updateStarships(state, payload) {
            state.starships = payload;
        },

        updatePilots(state, payload) {
            state.pilots = payload;
        },
    },

    actions: {
        getStarships(context) {
            axios.get('/starships').then((response) => {
                context.commit('updateStarships', response.data);
            });
        },

        getPilots(context) {
            axios.get('/pilots').then((response) => {
                context.commit('updatePilots', response.data);
            });
        },

        removePilot(context, payload) {
            axios.post('/starships/' + payload.starship_id + '/removePilot', payload).then((response) => {
                context.commit('updateStarships', response.data);
            });
        },

        addPilot(context, payload) {
            axios.post('/starships/' + payload.starship_id + '/addPilot', payload).then((response) => {
                if (response.data.length > 0) {
                    context.commit('updateStarships', response.data);
                }
            });
        },
    }
});

export default store;
