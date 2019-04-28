<template>
  <div id="student">
    <h1>Exam view</h1>
    <p>Time remaining: <strong>1hr:15m</strong></p>
    <el-table
      :data="tableData"
      style="width: 100%">
      <el-table-column type="expand">
      <template slot-scope="props">
        <div v-if="props.row.type === 'mcq'">
          <el-radio v-model="radio" label="1">PHP_SELF</el-radio>
          <el-radio v-model="radio" label="2">SERVER_NAME</el-radio>
          <el-radio v-model="radio" label="3">HTTP_HOST</el-radio>
          <el-radio v-model="radio" label="4">SCRIPT_NAME</el-radio>
        </div>

        <div style="margin-top: 15px" v-if="props.row.type === 'descriptive'">
          <el-input
            type="textarea"
            :autosize="{ minRows: 4, maxRows: 8}"
            placeholder="Write your answer here"
            v-model="description"/>
        </div>

        <div style="margin-top: 15px" v-if="props.row.type === 'file'">
          <p>File upload</p>
          <input type="file">
        </div>
      </template>
      </el-table-column>
      <el-table-column
        label="Question"
        prop="title">
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
export default {
  data() {
    return {
      search: '',
      radio: '1',
      description: '',
      tableData: [{
        title: 'Which of the following gives the path of the current script in PHP?',
        type: 'mcq',
        answers: [],
      }, {
        title: 'What is Internet?',
        type: 'descriptive',
      }, {
        title: 'Describe about different sort functions in PHP',
        type: 'descriptive',
      }, {
        title: 'Write code to handle form submission and display the error on the form.',
        type: 'file',
      }]
    }
  }
}
</script>

<style>

</style>
