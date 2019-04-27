<template>
  <div id="save_course">
    <el-row :gutter="20">
      <el-col :span="8">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Course Details</span>
            </div>
            
            <div>
              <div>
                <p>Course Name</p>
                <el-input placeholder="Course Name" v-model="course.name"/>
              </div>

              <div style="margin-top: 15px">
                <p>Course Code</p>
                <el-input placeholder="Course Code" v-model="course.code"/>
              </div>

              <div style="margin-top: 25px">
                <el-checkbox v-model="course.active" border>Active</el-checkbox>
              </div>

              <div style="margin-top: 15px">
                <el-button type="primary" @click="saveCourse">Save</el-button>
              </div>
            </div>
          </el-card>
        </div>
      </el-col>
      
      <el-col :span="8" v-if="courseProp">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Facluties</span>
            </div>
            
            <div>
              <user-select user-type="faculty" :selected-users="course.users" @user-selected="facultiesSelected"></user-select>
            </div>
          </el-card>
        </div>
      </el-col>

      <el-col :span="8" v-if="courseProp">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Students</span>
            </div>
            
            <div>
              <user-select user-type="student" :selected-users="course.users" @user-selected="studentsSelected"></user-select>
            </div>
          </el-card>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import { baseUrlForRoute } from '@/router';
import axios from '@/plugins/axios';
import qs from 'qs';

import UserSelect from '@/components/UserSelect.vue';

export default {
  components: {
    UserSelect,
  },

  props: {
    courseProp: Object,
  },
  
  created() {
    if (this.courseProp) {
      this.course = this.courseProp;
      this.course.active = this.course.active == 0 ? false : true;
    }
  },
  
  data() {
    return {
      course: {
        id: -1,
        name: '',
        code: '',
        active: '',
        users: [],
      },
      faculties: [],
      students: [],
    };
  },

  methods: {
    studentsSelected(users) {
      this.students = users;
    },

    facultiesSelected(users) {
      this.faculties = users;
    },
    
    saveCourse() {
      if (!this.validateFields()) return;

      let mergedUsers = this.faculties.concat(this.students);

      axios.post(`${baseUrlForRoute}/admin/save_course.php`, qs.stringify({
        id: this.course.id,
        name: this.course.name,
        code: this.course.code,
        active: this.course.active ? 1 : 0,
        users: mergedUsers,
      })).then((response) => {
        this.$message({
          message: response.data.message,
          type: response.data.success ? 'success' : 'error',
        });

        if (response.data.success) {
          this.course.id = response.data.id;
          this.courseProp = this.course;
        }
      });
    },

    err(msg) {
      this.$message({
        message: msg,
        type: 'error'
      });
    },

    validateFields() {
      if (this.course.name.length < 5) {
        this.err('Course name cannot be less than 5 characters');
        return false;
      } else if (this.course.code.length < 1) {
        this.err('Course code cannot be empty');
        return false;
      }

      return true;
    }
  }
}
</script>
