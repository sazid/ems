import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'

Vue.use(Router)

export default new Router({
  routes: [
    {
      path: '/',
      component: Home,
      children: [
        // {
        //   path: '',
        //   name: 'home',
        //   component: () => import(/* webpackChunkName: "home" */ './views/user/Admin.vue')      
        // },
        {
          path: '',
          name: 'admin',
          component: () => import(/* webpackChunkName: "user_admin" */ './views/user/Admin.vue')      
        },
        {
          path: 'faculty',
          name: 'faculty',
          component: () => import(/* webpackChunkName: "user_faculty" */ './views/user/Faculty.vue')      
        },
        {
          path: 'student',
          name: 'student',
          component: () => import(/* webpackChunkName: "user_student" */ './views/user/Student.vue')      
        },
        {
          path: 'about',
          name: 'about',
          // route level code-splitting
          // this generates a separate chunk (about.[hash].js) for this route
          // which is lazy-loaded when the route is visited.
          component: () => import(/* webpackChunkName: "about" */ './views/About.vue')
        }
      ],
    },
    {
      path: '/login',
      name: 'login',
      component: () => import(/* webpackChunkName: "login" */ './views/Login.vue')
    }
  ]
});
