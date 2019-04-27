<template>
  <div id="create-user">
    <el-row :gutter="20"
      type="flex"
      justify="space-around">
      <el-col :span="12">
        <div>
          <div>
            <p>Question</p>
            <el-input placeholder="Question title" v-model="question.title"/>
          </div>

          <div style="margin-top: 15px">
            <el-select v-model="question.type" placeholder="Select type">
            <el-option
              v-for="item in options"
              :key="item.value"
              :label="item.label"
              :value="item.value">
            </el-option>
          </el-select>
          </div>

          <div v-if="question.type == 'mcq'" style="margin-top: 15px">
            <el-input v-for="(o, index) in question.mcq_options" :key="index" :placeholder="'Option ' + (index + 1)" v-model="question.mcq_options[index]" style="margin-top: 5px">
              <template slot="prepend">{{ index + 1 }}</template>
              <template slot="append">
                <el-button @click="question.mcq_options = question.mcq_options.filter(item => item !== o)">REMOVE</el-button>
              </template>
            </el-input>

            <el-button style="margin-top: 15px" size="mini" @click="question.mcq_options.push('')">Add Option</el-button>
          </div>

          <div style="margin-top: 15px">
            <el-button type="primary" @click="save">Save</el-button>
          </div>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import { baseUrlForRoute } from '@/router';
import axios from '@/plugins/axios';
import qs from 'qs';

export default {
  props: {
    courseProp: Object,
    questionProp: Object,
  },
  
  data() {
    return {
      question: {
        id: -1,
        mcq_options: ['', ''],
        title: '',
        type: '',
      },
      options: [{
        value: 'mcq',
        label: 'MCQ'
      }, {
        value: 'descriptive',
        label: 'Descriptive'
      }, {
        value: 'file',
        label: 'File'
      }],
    };
  },

  methods: {
    err(msg) {
      this.$message({
        message: msg,
        type: 'error'
      });
    },
    
    save() {
      if (!this.validateFields()) return;

      axios.post(`${baseUrlForRoute}/faculty/save_question.php`, qs.stringify({
        id: this.question.id,
        title: this.question.title,
        mcq_options: this.question.mcq_options,
        type: this.question.type,
        // course_id: 1,
        course_id: this.courseProp.id,
      })).then((response) => {
        this.$message({
          message: response.data.message,
          type: response.data.success ? 'success' : 'error',
        });

        // Go back to previous page if successful
        if (response.data.success)
          this.$router.go(-1);
      });
    },
    
    validateFields() {
      if (this.question.mcq_options.length < 3 && this.question.type == 'mcq') {
        this.err('There must be at least two options for MCQ.');
        return false;
      } else if (this.question.title.length < 3) {
        this.err('Title must be greater than 3 characters');
        return false;
      } else if (!this.question.type) {
        this.err('Please select the question type.');
        return false;
      }

      return true;
    }
  },
}
</script>

<style>

</style>
