<template>
  <div id="save_course">
    <el-row :gutter="20">
      <el-col :span="10">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Exam Details</span>
            </div>
            
            <div>
              <div>
                <p>Exam Name</p>
                <el-input placeholder="Exam Name" v-model="exam.name"/>
              </div>

              <div style="margin-top: 25px">
               <el-date-picker
                  v-model="datetime_range"
                  type="datetimerange"
                  range-separator="To"
                  start-placeholder="Start"
                  end-placeholder="End">
                </el-date-picker>
              </div>

              <div style="margin-top: 15px">
                <el-button type="primary" @click="saveExam">Save</el-button>
              </div>
            </div>
          </el-card>
        </div>
      </el-col>
      
      <el-col :span="14" v-if="examProp">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Questions</span>
            </div>
            
            <div>
              <question-select :selected-questions="exam.questions" :course-prop="courseProp" @question-selected="questionsSelected"></question-select>
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

import QuestionSelect from '@/components/Faculty/QuestionSelect.vue';

export default {
  name: 'SaveExam',
  
  components: {
    QuestionSelect,
  },

  props: {
    examProp: Object,
    courseProp: Object,
  },
  
  created() {
    if (this.examProp) {
      this.examn = this.examProp;
    }
  },
  
  data() {
    return {
      datetime_range: [new Date(), new Date()],
      exam: {
        id: -1,
        name: '',
        course_id: this.courseProp.id,
        start: new Date(),
        end: new Date(),
        questions: [],
      },
      questions: [],
    };
  },

  methods: {
    questionsSelected(questions) {
      this.questions = questions;
      this.exam.questions = questions;
    },

    saveExam() {
      if (!this.validateFields()) return;

      axios.post(`${baseUrlForRoute}/faculty/save_exam.php`, qs.stringify({
        id: this.exam.id,
        name: this.exam.name,
        start: this.datetime_range[0],
        end: this.datetime_range[1],
        course_id: this.courseProp.id,
        questions: this.exam.questions,
      })).then((response) => {
        this.$message({
          message: response.data.message,
          type: response.data.success ? 'success' : 'error',
        });

        if (response.data.success) {
          this.exam.id = response.data.id;
          this.examProp = this.exam;
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
      if (this.exam.name.length < 3) {
        this.err('Exam name cannot be less than 3 characters');
        return false;
      } else if (this.datetime_range[0] >= this.datetime_range[1]) {
        this.err('Invalid start or end time.');
        return false;
      }

      return true;
    }
  }
}
</script>
