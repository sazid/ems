<template>
  <div id="faculty_list">
    <el-table
      ref="multipleTable"
      :data="tableData"
      style="width: 100%"
      @selection-change="handleSelectionChange">
      
      <el-table-column
        type="selection"
        width="55">
      </el-table-column>

      <el-table-column
        label="Title"
        prop="title">
      </el-table-column>
      <el-table-column
        label="Type"
        prop="type">
      </el-table-column>
    </el-table>
    <div style="margin-top: 20px">
      <el-button @click="clearSelection()">Clear selection</el-button>
    </div>
  </div>
</template>

<script>
import { baseUrlForRoute } from '@/router';
import axios from '@/plugins/axios';

export default {
  name: 'QuestionSelect',
  props: {
    // selectedQuestions: Array,
    courseId: String,
    examId: String,
  },
  data() {
    return {
      tableData: [],
      search: '',
      multipleSelection: [],
    }
  },
  methods: {
    // q - Search query
    getQuestions(q = '') {
      axios.get(`${baseUrlForRoute}/faculty/get_questions.php`, {
        params: {
          course_id: this.courseId,
          exam_id: this.examId,
        },
      })
      .then((response) => {
        this.tableData = response.data.questions;
        setTimeout(() => {
          // this.toggleSelection(response.data.selected);
          this.tableData.forEach(question => {
            response.data.selected.forEach(q => {
              if (q.id == question.id) {
                this.$refs.multipleTable.toggleRowSelection(question);
              }
            });
          });
        }, 300);
      })
      .catch((error) => {
        console.error(error);
      });
    },

    clearSelection(rows) {
      this.$refs.multipleTable.clearSelection();
    },

    toggleSelection(rows) {
      if (rows) {
        rows.forEach(row => {
          this.$refs.multipleTable.toggleRowSelection(row);
        });
      } else {
        this.$refs.multipleTable.clearSelection();
      }
    },
    
    handleSelectionChange(val) {
      this.multipleSelection = val;
      this.$emit('question-selected', val);
    }
  },
  created() {
    this.getQuestions();
  },
  watch: {
    search(newVal, oldVal) {
      // This should be "debounced" so that the
      // server does not get flooded with requests for every character
      this.getQuestions(newVal);
    },
  }
}
</script>
