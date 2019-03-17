import Vue from 'vue'
import Vuex from 'vuex'
import axios from '@/plugins/axios';
import { baseUrlForRoute } from '@/router';

Vue.use(Vuex)

export default new Vuex.Store({
  state: {
    loggedIn: false,
    user: {
      name: '',
      type: '',
    },
  },
  mutations: {
    SET_LOGGED_IN_STATUS(state, status) {
      state.loggedIn = status;
    },
    SET_USER(state, user) {
      state.user = user;
    }
  },
  actions: {
    getUserSession(context) {
      return axios.post(`${baseUrlForRoute}/user/verify_session.php`)
        .then((response) => {
          let data = response.data;
          
          context.commit('SET_LOGGED_IN_STATUS', data.loggedIn);
          context.commit('SET_USER', {
            name: data.name,
            type: data.type,
          });

          return data;
        });
    },
  }
});
