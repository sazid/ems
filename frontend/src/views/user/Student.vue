<template>
  <div id="student">
    <h1>Student view</h1>
    <el-button @click="exam" type="warning">Goto ongoing Exam</el-button>

    <el-row :gutter="20" style="margin-top: 15px">
      <el-col :span="12">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Previous exams</span>
            </div>
            <div v-for="o in 3" :key="o" class="text item">
              {{`Exam ${o}: ${(new Date()).toDateString()}`}}
            </div>
          </el-card>
        </div>
      </el-col>
      <el-col :span="12">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Upcoming exams</span>
            </div>
            <div v-for="o in 5" :key="o" class="text item">
              {{`Exam ${o}: ${(new Date()).toDateString()}`}}
            </div>
          </el-card>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  data() {
    return {
    }
  },
  methods: {
    exam() {
      this.$router.push({ name: 'exam' });
    }
  },
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
