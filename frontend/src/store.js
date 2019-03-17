import Vue from 'vue'
import Vuex from 'vuex'

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

  }
})
