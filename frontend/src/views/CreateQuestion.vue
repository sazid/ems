<template>
  <div id="create-user">
    <el-row :gutter="20"
      type="flex"
      justify="space-around">
      <el-col :span="12">
        <div>
          <div>
            <p>Question</p>
            <el-input placeholder="Question title" v-model="title"/>
          </div>

          <div style="margin-top: 15px">
            <el-select v-model="type" placeholder="Select type">
            <el-option
              v-for="item in options"
              :key="item.value"
              :label="item.label"
              :value="item.value">
            </el-option>
          </el-select>
          </div>

          <div v-if="type == 'MCQ'" style="margin-top: 15px">
            <el-input v-for="o in mcq_options" :key="o" :placeholder="'Option ' + o" v-model="title" style="margin-top: 5px">
              <template slot="prepend">{{ o }}</template>
            </el-input>

            <el-button style="margin-top: 15px" size="mini" @click="mcq_options.push(mcq_options.length + 1)">Add Option</el-button>
          </div>

          <div style="margin-top: 15px">
            <el-button type="primary">Save</el-button>
          </div>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
      title: '',
      type: '',
      radio: '',
      mcq_options: [1, 2],
      options: [{
        value: 'MCQ',
        label: 'MCQ'
      }, {
        value: 'Descriptive',
        label: 'Descriptive'
      }, {
        value: 'File',
        label: 'File'
      }],
      value: ''
    };
  },
}
</script>

<style>

</style>
