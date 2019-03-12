<template>
  <div class="about">
    <el-row
      type="flex"
      class="login-form"
      justify="space-around">
      <el-col :span="6">
        <el-card class="box-card">
          <div slot="header">
            <span>Exam Management System</span>
            <!-- <el-button style="float: right; padding: 3px 0" type="text">Operation button</el-button> -->
          </div>
          <div class="text item">
            <p>Mohammed Sazid Al Rashid</p>
            <p><a href="https://github.com/sazid/ems">Project Page</a></p>
          </div>
        </el-card>
      </el-col>
    </el-row>
  </div>
</template>

<style>
.text {
  font-size: 14px;
}

.item {
  margin-bottom: 18px;
}
</style>
