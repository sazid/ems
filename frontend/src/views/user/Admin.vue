<template>
  <div id="admin">
    <h3>Welcome, Admin!</h3>
    <el-row :gutter="20">
      <el-col :span="8">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Courses</span>
              <el-button style="float: right; padding: 3px 0" type="text">Manage Course</el-button>
            </div>
            <div v-for="o in 5" :key="o" class="text item">
              {{'List item ' + o }}
            </div>
          </el-card>
        </div>
      </el-col>
      <el-col :span="8">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Faculties</span>
              <el-button style="float: right; padding: 3px 0" type="text">Manage Faculties</el-button>
            </div>
            <div v-for="o in 5" :key="o" class="text item">
              {{'List item ' + o }}
            </div>
          </el-card>
        </div>
      </el-col>
      <el-col :span="8">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Students</span>
              <el-button style="float: right; padding: 3px 0" type="text">Manage Students</el-button>
            </div>
            <div v-for="o in 5" :key="o" class="text item">
              {{'List item ' + o }}
            </div>
          </el-card>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {

}
</script>

<style>
.text {
  font-size: 14px;
}

.item {
  margin-bottom: 18px;
}
</style>
