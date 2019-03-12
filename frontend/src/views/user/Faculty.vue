<template>
  <div id="faculty">
    <h1>Faculty view</h1>

    <el-row :gutter="20" style="margin-top: 15px">
      <el-col :span="8">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Courses</span>
            </div>
            <div v-for="o in 3" :key="o" class="text item">
              {{'Course ' + o }}
            </div>
          </el-card>
        </div>
      </el-col>
      <el-col :span="8">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Exams</span>
            </div>
            <div v-for="o in 8" :key="o" class="text item">
              {{`Exam ${o}: ${(new Date()).toDateString()}`}}
            </div>
          </el-card>
        </div>
      </el-col>
      <el-col :span="8">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Students</span>
            </div>
            <div v-for="o in 20" :key="o" class="text item">
              {{'Student ' + o }}
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
