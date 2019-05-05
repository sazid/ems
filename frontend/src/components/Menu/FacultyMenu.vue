<template>
  <fragment>
    <el-menu-item index="faculty" :route="{ name: 'faculty' }">
      Dashboard
    </el-menu-item>
    <el-menu-item index="faculty_course_list" :route="{ name: 'faculty_course_list' }">
      Courses
    </el-menu-item>
    <el-menu-item index="faculty_exam_list" :route="{ name: 'faculty_exam_list' }">
      Exams
    </el-menu-item>
    <el-menu-item index="faculty_file_viewer" :route="{ name: 'faculty_file_viewer' }">
      File Viewer
    </el-menu-item>
  </fragment>
</template>

<script>
export default {
  name: 'FacultynMenu',
};
</script>

<style>

</style>
