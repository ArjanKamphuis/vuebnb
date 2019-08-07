import axios from 'axios';
import Vue from 'vue';
import Vuex from 'vuex';
import router from './router';

Vue.use(Vuex);

axios.defaults.headers.common = {
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': window.csrf_token  
};

export default new Vuex.Store({
    state: {
        saved: [],
        listing_summaries: [],
        listings: [],
        auth: false
    },
    mutations: {
        TOGGLE_SAVED(state, id) {
            const index = state.saved.findIndex(saved => saved === id);
            if (index === -1) {
                state.saved.push(id);
            } else {
                state.saved.splice(index, 1);
            }
        },
        ADD_DATA(state, { route, data }) {
            if (data.auth) {
                state.auth = data.auth;
            }
            if (route === 'listing') {
                state.listings.push(data.listing);
            } else {
                state.listing_summaries = data.listings;
            }
        }
    },
    actions: {
        toggleSaved({ commit, state }, id) {
            if (state.auth) {
                axios.patch('/api/user/toggle_saved', { id }).then(() => commit('TOGGLE_SAVED', id));
            } else {
                router.push('/login');
            }
        }
    },
    getters: {
        getListing: state => id => state.listings.find(listing => id == listing.id)
    }
});