<template>
  <div id="create-user">
    <el-row :gutter="20"
      type="flex"
      justify="space-around">
      <el-col :span="12">
        <div>
          <div>
            <p>Username</p>
            <el-input placeholder="Usesrname" v-model="username"/>
          </div>

          <div style="margin-top: 15px">
            <p>Password</p>
            <el-input placeholder="Password" v-model="password" type="password"/>
          </div>

          <div style="margin-top: 15px">
            <p>Email</p>
            <el-input placeholder="Email" v-model="email" type="email"/>
          </div>

          <div style="margin-top: 15px">
            <p>User type</p>
            <el-select v-model="value" placeholder="Select">
            <el-option
              v-for="item in options"
              :key="item.value"
              :label="item.label"
              :value="item.value">
            </el-option>
          </el-select>
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
      username: '',
      password: '',
      email: '',
      name: '',
      options: [{
        value: 'Student',
        label: 'Student'
      }, {
        value: 'Faculty',
        label: 'Faculty'
      }],
      value: ''
    };
  },
}
</script>

<style>

</style>
