<template>
  <div id="student_exam_list">
    <el-table
      :data="tableData"
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

      <el-table-column
        align="right">
        <template slot="header" slot-scope="scope">
          <el-input
            v-model="search"
            size="mini"
            placeholder="Type to search"/>
        </template>
        <!-- <template slot-scope="scope">
          <el-button
            size="mini"
            @click="handleEdit(scope.$index, scope.row)">Edit</el-button>
        </template> -->
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
import { baseUrlForRoute } from '@/router';
import axios from '@/plugins/axios';

export default {
  name: 'ExamList',
  data() {
    return {
      tableData: [],
      search: '',
    }
  },
  methods: {
    handleEdit(index, row) {
      // console.log(index, row);
      this.$router.push({
        name: 'faculty_save_exam',
        params: {
          examProp: row,
        }
      });
    },
    
    // q - Search query
    getExams(q = '') {
      axios.get(`${baseUrlForRoute}/student/get_exams.php`, {
        params: {
          q: q,
        },
      })
      .then((response) => {
        this.tableData = response.data.exams;
      })
      .catch((error) => {
        console.error(error);
      });
    },
  },
  created() {
    this.getExams();
  },
  watch: {
    search(newVal, oldVal) {
      // This should be "debounced" so that the
      // server does not get flooded with requests for every character
      this.getExams(newVal);
    },
  }
}
</script>
