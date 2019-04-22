import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import store from '@/store';

Vue.use(Router);

export const baseUrlForRoute = '/ems/app/api';

const router = new Router({
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
          component: () => import(/* webpackChunkName: "user_student" */ './views/user/Student.vue'),    
        },
        {
          path: 'exam',
          name: 'exam',
          component: () => import(/* webpackChunkName: "user_exam" */ './views/Exam.vue'),    
        },
        {
          path: 'about',
          name: 'about',
          component: () => import(/* webpackChunkName: "about" */ './views/About.vue')
        },
        {
          path: 'create_user',
          name: 'create_user',
          component: () => import(/* webpackChunkName: "create_user" */ './views/user/CreateUser.vue')
        },
        {
          path: 'create_question',
          name: 'create_question',
          component: () => import(/* webpackChunkName: "create_question" */ './views/CreateQuestion.vue')
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

router.beforeEach((to, from, next) => {
  store.dispatch('getUserSession')
    .then(_ => {
      if (store.state.loggedIn) {
        if (to.name == 'login')
          next({ path: '/' });
        else
          next();
      } else {
        if (to.name != 'login')
          next({ name: 'login' });
        else
          next();
      }
    })
    .catch(_ => {
      next({ name: 'login' });
    });
});

export default router;
