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
          <el-upload
            class="upload-demo"
            action="app/api/student/file_upload.php"
            drag
            :on-preview="handlePreview"
            :on-remove="handleRemove"
            :before-remove="beforeRemove"
            :on-change="onFileChange"
            :multiple="false"
            :limit="1"
            :on-exceed="handleExceed"
            :file-list="props.row.submission.files">
            <i class="el-icon-upload"></i>
            <div class="el-upload__text">Drop file here or <em>click to upload</em></div>
            <div slot="tip" class="el-upload__tip">Please upload files with proper extensions</div>
          </el-upload>
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
    handleRemove(file, fileList) {
      console.log(file, fileList);
    },

    handlePreview(file) {
      console.log(file);
    },

    handleExceed(files, fileList) {
      // this.$message.warning(`The limit is 3, you selected ${files.length} files this time, add up to ${files.length + fileList.length} totally`);
      this.$message.warning(`You can only upload 1 file for each question`);
    },

    beforeRemove(file, fileList) {
      return this.$confirm(`Cancel the transfert of ${ file.name } ?`);
    },

    onFileChange(file, fileList) {
      if (!file || !file.response || !file.response.success)
        return;

      console.log(file.response.file_name);
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

        for (let i = 0; i < this.questions.length; ++i) {
          this.questions[i] = Object.assign({}, this.questions[i], {
            submission: {
              type: this.questions[i].type,
              value: '',
              files: [],
              submission_time: new Date(),
              user_id: '',
              exam_id: this.exam.id,
              question_id: this.questions[i].id,
              type: this.questions[i].type
            }
          });
        }
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
