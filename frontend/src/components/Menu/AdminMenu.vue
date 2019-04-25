<template>
  <fragment>
    <el-menu-item index="admin" :route="{ name: 'admin' }">
      Dashboard
    </el-menu-item>

    <el-menu-item index="admin_course_list" :route="{ name: 'admin_course_list' }">
      Courses
    </el-menu-item>

    <el-menu-item index="admin_faculty_list" :route="{ name: 'admin_faculty_list' }">
      Faculties
    </el-menu-item>

    <el-menu-item index="admin_student_list" :route="{ name: 'admin_student_list' }">
      Students
    </el-menu-item>
  </fragment>
</template>

<script>
export default {
  name: 'AdminMenu',
};
</script>

<style>

</style>
