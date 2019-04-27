<template>
  <div id="admin">

    <el-row :gutter="20" style="margin-top: 15px">
      <el-col :span="8" :push="8">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Quick Actions</span>
            </div>
            
            <div>
              <el-button @click="$router.push({ name: 'admin_save_user' })" type="primary" size="medium">Create User</el-button>
              <el-button @click="$router.push({ name: 'admin_save_course' })" type="primary" size="medium">Create Course</el-button>
            </div>
          </el-card>
        </div>
      </el-col>
    </el-row>
    
    <!-- <el-row :gutter="20" style="margin-top: 15px">
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
              <el-button
                style="float: right; padding: 3px 0"
                type="text">Manage Faculties</el-button>
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
    </el-row> -->
  </div>
</template>

<script>
import store from '@/store';

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
