<template>
  <div id="student_course_list">
    <el-table
      :data="tableData"
      style="width: 100%">
      <el-table-column type="expand">
        <template slot-scope="props">
          <p><strong>Name</strong>: {{ props.row.name }}</p>
          <p><strong>Code</strong>: {{ props.row.code }}</p>
          <p><strong>Active</strong>: {{ props.row.active == 0 ? "No" : "Yes" }}</p>
        </template>
      </el-table-column>
      <el-table-column
        label="Name"
        prop="name">
      </el-table-column>
      <el-table-column
        label="Code"
        prop="code">
      </el-table-column>
      <el-table-column
        align="right">
        <template slot="header" slot-scope="scope">
          <el-input
            v-model="search"
            size="mini"
            placeholder="Type to search"/>
        </template>
        <template slot-scope="scope">
          <el-button
            size="mini"
            @click="handleView(scope.$index, scope.row)">View</el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
import { baseUrlForRoute } from '@/router';
import axios from '@/plugins/axios';

export default {
  name: 'StudentCourseList',
  data() {
    return {
      tableData: [],
      search: '',
    }
  },
  methods: {
    handleView(index, row) {
      // console.log(index, row);
      // this.$router.push({
      //   name: 'admin_save_course',
      //   params: {
      //     courseProp: row,
      //   }
      // });
    },
  
    createCourse() {
      // this.$router.push({ name: 'admin_save_course' });
    },
    
    // q - Search query
    getCourses(q = '') {
      axios.get(`${baseUrlForRoute}/student/get_courses.php`, {
        params: {
          q: q,
        },
      })
      .then((response) => {
        this.tableData = response.data.courses;
      })
      .catch((error) => {
        console.error(error);
      });
    },
  },
  created() {
    this.getCourses();
  },
  watch: {
    search(newVal, oldVal) {
      // This should be "debounced" so that the
      // server does not get flooded with requests for every character
      this.getCourses(newVal);
    },
  }
}
</script>
