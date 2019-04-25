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
        {
          path: '',
          name: 'admin',
          component: () => import(/* webpackChunkName: "user_admin" */ './views/user/Admin/Admin.vue')   
        },
        {
          path: 'admin/save_user',
          name: 'admin_save_user',
          props: true,
          component: () => import(/* webpackChunkName: "admin_save_user" */ './views/user/Admin/SaveUser.vue')
        },
        {
          path: 'admin/faculty_list',
          name: 'admin_faculty_list',
          component: () => import(/* webpackChunkName: "admin_faculty_list" */ './views/user/Admin/FacultyList.vue')
        },
        {
          path: 'admin/student_list',
          name: 'admin_student_list',
          component: () => import(/* webpackChunkName: "admin_student_list" */ './views/user/Admin/StudentList.vue')
        },
        {
          path: 'admin/course_list',
          name: 'admin_course_list',
          component: () => import(/* webpackChunkName: "admin_course_list" */ './views/user/Admin/CourseList.vue')
        },

        {
          path: 'faculty',
          name: 'faculty',
          component: () => import(/* webpackChunkName: "user_faculty" */ './views/user/Faculty/Faculty.vue')      
        },
        {
          path: 'student',
          name: 'student',
          component: () => import(/* webpackChunkName: "user_student" */ './views/user/Student/Student.vue'),    
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

router.beforeEach((to, _from, next) => {
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
