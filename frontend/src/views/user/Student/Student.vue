<template>
  <div id="student">
    <h1>Student view</h1>
    <el-button @click="exam" type="warning">Goto ongoing Exam</el-button>

    <el-row :gutter="20" style="margin-top: 15px">
      <el-col :span="12">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Courses</span>
            </div>
            
            <student-course-list></student-course-list>
          </el-card>
        </div>
      </el-col>
      <el-col :span="12">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Exams</span>
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
import store from '@/store';
import StudentCourseList from '@/components/Student/StudentCourseList.vue';

export default {
  components: {
    StudentCourseList,
  },
  data() {
    return {
    }
  },
  methods: {
    exam() {
      this.$router.push({ name: 'student_exam' });
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
