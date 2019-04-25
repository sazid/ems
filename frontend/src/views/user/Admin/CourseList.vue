<template>
  <div id="faculty_list">
    <div>
      <el-button
        style="float: right;"
        type="primary"
        size="small"
        @click="createCourse">Create Course</el-button>
    </div>

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
            @click="handleEdit(scope.$index, scope.row)">Edit</el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
import { baseUrlForRoute } from '@/router';
import axios from '@/plugins/axios';

export default {
  name: 'CourseList',
  data() {
    return {
      tableData: [],
      search: '',
    }
  },
  methods: {
    handleEdit(index, row) {
      // console.log(index, row);
    //   this.$router.push({
    //     name: 'admin_save_user',
    //     params: {
    //       user_prop: row,
    //     }
    //   });
    },
  
    createCourse() {
    //   this.$router.push({ name: 'admin_save_user' });
    },
    
    // q - Search query
    getCourses(q = '') {
      axios.get(`${baseUrlForRoute}/admin/get_courses.php`, {
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
