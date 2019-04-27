<template>
  <div id="save_course">
    <el-row :gutter="20">
      <el-col :span="8">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Course Details</span>
            </div>
            
            <div>
              <div>
                <p>Course Name</p>
                <el-input placeholder="Course Name" v-model="course.name"/>
              </div>

              <div style="margin-top: 15px">
                <p>Course Code</p>
                <el-input placeholder="Course Code" v-model="course.code"/>
              </div>

              <div style="margin-top: 25px">
                <el-checkbox v-model="course.active" border>Active</el-checkbox>
              </div>

              <div style="margin-top: 15px">
                <el-button type="primary" @click="saveCourse">Save</el-button>
              </div>
            </div>
          </el-card>
        </div>
      </el-col>
      
      <el-col :span="8" v-if="courseProp">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Facluties</span>
            </div>
            
            <div>
              <user-select user-type="faculty"></user-select>
            </div>
          </el-card>
        </div>
      </el-col>

      <el-col :span="8" v-if="courseProp">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Students</span>
            </div>
            
            <div>
              <user-select user-type="student"></user-select>
            </div>
          </el-card>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import UserSelect from '@/components/UserSelect.vue';

export default {
  components: {
    UserSelect,
  },

  props: {
    courseProp: Object,
  },
  
  created() {
    if (this.courseProp) {
      this.course = this.courseProp;
      this.course.active = this.course.active == 0 ? false : true;
    }
  },
  
  data() {
    return {
      course: {
        id: -1,
        name: '',
        code: '',
        active: '',
      },
    };
  },

  methods: {
    saveCourse() {

    },
  }
}
</script>
