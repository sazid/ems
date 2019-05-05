<template>
  <div id="student">
    <el-card class="box-card">
      <div slot="header">
        <span>{{ exam.name }}</span>
      </div>
      
      <div>
        <p>Start: <strong>{{ exam.start }}</strong></p>
        <p>End: <strong>{{ exam.end }}</strong></p>
      </div>
    </el-card>

    <el-table
      :data="questions"
      style="width: 100%">
      <el-table-column type="expand">
      <template slot-scope="props">
        <el-radio
          v-if="props.row.type === 'mcq'"
          v-for="(o, index) in props.row.options"
          :key="o.value"
          :label="o.value"
          @change="onOptionChange(o, props.row)"
          v-model="props.row.submission.value">

          {{ o.value }}

        </el-radio>

        <div style="margin-top: 15px" v-if="props.row.type === 'descriptive'">
          <el-input
            type="textarea"
            :autosize="{ minRows: 4, maxRows: 8}"
            placeholder="Write your answer here"
            v-model="props.row.submission.value"/>
        </div>

        <div style="margin-top: 15px" v-if="props.row.type === 'file'">
          <p>File upload</p>
          <input type="file" @change="onFileChange($event, props.row)">
        </div>
      </template>
      </el-table-column>
      <el-table-column
        label="Question"
        prop="title">
      </el-table-column>
      <el-table-column
        label="Type"
        prop="type">
      </el-table-column>
      <el-table-column
        align="right">
        <template slot="header" slot-scope="scope">
          <el-button type="primary" size="small">Submit</el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
import { baseUrlForRoute } from '@/router';
import axios from '@/plugins/axios';

export default {
  data() {
    return {
      search: '',
      radio: '',
      description: '',
      exam: {
        id: -1,
        name: '',
        start: '',
        end: '',
      },
      questions: [],
    }
  },

  created() {
    this.loadExam();
  },

  methods: {
    onFileChange(e, row) {
      let files = e.target.files || e.dataTransfer.files;
      if (files.length == 0 || files.length > 1)
        return;

      console.log(e);
      console.log(row);
    },

    onOptionChange(o, row) {
      console.log(o);
      console.log(row);
    },

    loadExam() {
      axios.get(`${baseUrlForRoute}/student/get_exam_data.php`, {
        params: {
          exam_id: this.$route.params.exam_id,
        },
      })
      .then((response) => {
        let d = response.data;
        this.exam = d.exam;
        this.questions = d.questions;
        this.submissions = [];

        d.questions.forEach(q => {
          q.submission = {
            type: q.type,
            value: '',
            submission_time: new Date(),
            user_id: '',
            exam_id: this.exam.id,
            question_id: q.id,
            type: q.type
          };
        });
      })
      .catch((error) => {
        console.error(error);
      });
    },
  },
}
</script>

<style>

</style>
