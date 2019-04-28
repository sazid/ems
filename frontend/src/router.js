import Vue from 'vue'
import Router from 'vue-router'
import Home from './views/Home.vue'
import store from '@/store';

Vue.use(Router);

export const baseUrlForRoute = '/ems/app/api';

let userRouteGuard = (userType, next) => {
  if (userType == store.state.user.type)
    next();
  else
    next({ name: 'error_404' });
}

const router = new Router({
  routes: [
    {
      path: '/',
      component: Home,
      children: [
        {
          path: '',
          name: 'admin',
          component: () => import(/* webpackChunkName: "user_admin" */ './views/user/Admin/Admin.vue'),
          beforeEnter: (to, from, next) => { userRouteGuard('admin', next) }
        },
        {
          path: 'admin/save_user',
          name: 'admin_save_user',
          props: true,
          component: () => import(/* webpackChunkName: "admin_save_user" */ './views/user/Admin/SaveUser.vue'),
          beforeEnter: (to, from, next) => { userRouteGuard('admin', next) }
        },
        {
          path: 'admin/faculty_list',
          name: 'admin_faculty_list',
          component: () => import(/* webpackChunkName: "admin_faculty_list" */ './views/user/Admin/FacultyList.vue'),
          beforeEnter: (to, from, next) => { userRouteGuard('admin', next) }
        },
        {
          path: 'admin/student_list',
          name: 'admin_student_list',
          component: () => import(/* webpackChunkName: "admin_student_list" */ './views/user/Admin/StudentList.vue'),
          beforeEnter: (to, from, next) => { userRouteGuard('admin', next) }
        },
        {
          path: 'admin/course_list',
          name: 'admin_course_list',
          component: () => import(/* webpackChunkName: "admin_course_list" */ './views/user/Admin/CourseList.vue'),
          beforeEnter: (to, from, next) => { userRouteGuard('admin', next) }
        },
        {
          path: 'admin/save_course',
          name: 'admin_save_course',
          props: true,
          component: () => import(/* webpackChunkName: "admin_save_course" */ './views/user/Admin/SaveCourse.vue'),
          beforeEnter: (to, from, next) => { userRouteGuard('admin', next) }
        },

        {
          path: 'faculty',
          name: 'faculty',
          component: () => import(/* webpackChunkName: "user_faculty" */ './views/user/Faculty/Faculty.vue'),
          beforeEnter: (to, from, next) => { userRouteGuard('faculty', next) }   
        },
        {
          path: 'faculty_create_question',
          name: 'faculty_create_question',
          props: true,
          component: () => import(/* webpackChunkName: "faculty_create_question" */ './views/user/Faculty/CreateQuestion.vue'),
          beforeEnter: (to, from, next) => { userRouteGuard('faculty', next) }
        },
        {
          path: 'faculty/course_list',
          name: 'faculty_course_list',
          props: true,
          component: () => import(/* webpackChunkName: "faculty_course_list" */ './views/user/Faculty/FacultyCourseList.vue'),
          beforeEnter: (to, from, next) => { userRouteGuard('faculty', next) }
        },
        {
          path: 'faculty/save_exam',
          name: 'faculty_save_exam',
          props: true,
          component: () => import(/* webpackChunkName: "faculty_save_exam" */ './views/user/Faculty/SaveExam.vue'),
          beforeEnter: (to, from, next) => { userRouteGuard('faculty', next) }
        },
        {
          path: 'faculty/course_details',
          name: 'faculty_course_details',
          props: true,
          component: () => import(/* webpackChunkName: "faculty_course_details" */ './views/user/Faculty/CourseDetails.vue'),
          beforeEnter: (to, from, next) => { userRouteGuard('faculty', next) }
        },
        {
          path: 'faculty/exam_list',
          name: 'faculty_exam_list',
          component: () => import(/* webpackChunkName: "faculty_exam_list" */ './views/user/Faculty/ExamList.vue'),
          beforeEnter: (to, from, next) => { userRouteGuard('faculty', next) }
        },
        
        {
          path: 'student',
          name: 'student',
          component: () => import(/* webpackChunkName: "user_student" */ './views/user/Student/Student.vue'),
          beforeEnter: (to, from, next) => { userRouteGuard('student', next) }   
        },
        {
          path: 'exam',
          name: 'exam',
          component: () => import(/* webpackChunkName: "user_exam" */ './views/Exam.vue'),
          beforeEnter: (to, from, next) => { userRouteGuard('student', next) }   
        },
        {
          path: 'about',
          name: 'about',
          component: () => import(/* webpackChunkName: "about" */ './views/About.vue')
        },
        {
          path: '/error_404',
          name: 'error_404',
          component: () => import(/* webpackChunkName: "error_404" */ './views/Error404.vue')
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
