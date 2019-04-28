<template>
  <div id="faculty">
    <el-row :gutter="20" style="margin-top: 15px">
      <el-col :span="8" :push="8">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Course Details</span>
            </div>
            <div>
                <h3>Name: {{ courseProp.name }}</h3>
                <p>Code: {{ courseProp.code }}</p>
                <p>Active: {{ courseProp.active }}</p>
                <el-button @click="handleRoute('faculty_create_question')" type="primary" size="medium">Create Question</el-button>
                <el-button @click="handleRoute('faculty_save_exam')" type="primary" size="medium">Create Exam</el-button>
            </div>
          </el-card>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import store from '@/store';

export default {
  name: 'CourseDetails',
  props: {
    courseProp: Object,
  },
  methods: {
    handleRoute(name) {
      // console.log(index, row);
      this.$router.push({
        name: name,
        params: {
          courseProp: this.courseProp,
        }
      });
    },
  },
}
</script>
