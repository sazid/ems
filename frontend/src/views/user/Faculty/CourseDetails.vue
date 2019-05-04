<template>
  <div id="faculty">
    <el-row :gutter="20" style="margin-top: 15px">
      <el-col :span="8">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Course Details</span>
            </div>
            <div>
                <h3>Name: {{ course.name }}</h3>
                <p><strong>Code:</strong> {{ course.code }}</p>
                <p><strong>Active:</strong> {{ course.active == 1 ? "Yes" : "No" }}</p>
                <el-button @click="handleRoute('faculty_create_question')" type="primary" size="medium">Create Question</el-button>
                <el-button @click="handleRoute('faculty_save_exam')" type="primary" size="medium">Create Exam</el-button>
            </div>
          </el-card>
        </div>
      </el-col>
      <el-col :span="8">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Exams</span>
            </div>
            <div>
              <el-table
                :data="exams"
                style="width: 100%">
                <el-table-column type="expand">
                  <template slot-scope="props">
                    <p><strong>Name</strong>: {{ props.row.name }}</p>
                    <p><strong>Start</strong>: {{ props.row.start }}</p>
                    <p><strong>End</strong>: {{ props.row.end }}</p>
                  </template>
                </el-table-column>
                <el-table-column
                  label="Name"
                  prop="name">
                </el-table-column>
              </el-table>
            </div>
          </el-card>
        </div>
      </el-col>
      <el-col :span="8">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Students</span>
            </div>
            <div>
                <el-table
                :data="users"
                style="width: 100%">
                <el-table-column type="expand">
                  <template slot-scope="props">
                    <p><strong>Name</strong>: {{ props.row.name }}</p>
                    <p><strong>Username</strong>: {{ props.row.username }}</p>
                    <p><strong>Eamil</strong>: {{ props.row.email }}</p>
                    <p><strong>Active:</strong> {{ props.row.active == 1 ? "Yes" : "No" }}</p>
                  </template>
                </el-table-column>
                <el-table-column
                  label="Name"
                  prop="name">
                </el-table-column>
              </el-table>
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

export default {
  name: 'CourseDetails',

  data() {
    return {
      course: {
        id: -1,
        name: '',
        code: '',
        active: 0,
      },
      exams: [],
      users: [],
    };
  },
  
  methods: {
    handleRoute(name) {
      // console.log(index, row);
      this.$router.push({
        name: name,
        params: {
          course_id: this.$route.params.id,
        }
      });
    },

    getCourseDetails(id) {
      axios.get(`${baseUrlForRoute}/faculty/get_course_details.php`, {
        params: {
          id: this.$route.params.id,
        },
      })
      .then((response) => {
        // this.tableData = response.data.courses;
        let data = response.data;
        this.course = data.course;
        this.exams = data.exams;
        this.users = data.users;
      })
      .catch((error) => {
        console.error(error);
      });
    },
  },

  created() {
    this.getCourseDetails(this.$route.params.id);
  },
}
</script>
