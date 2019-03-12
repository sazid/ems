<template>
  <el-menu
    :default-active="activeIndex"
    :router="true"
    class="el-menu-demo"
    mode="horizontal"
    menu-trigger="click"
    @select="handleSelect">
      <el-menu-item index="admin" :route="{ name: 'admin' }">
        Admin
      </el-menu-item>
      <el-menu-item index="faculty" :route="{ name: 'faculty' }">
        Faculty
      </el-menu-item>
      <el-menu-item index="student" :route="{ name: 'student' }">
        Student
      </el-menu-item>
      <el-menu-item index="about" :route="{ name: 'about' }">
        About
      </el-menu-item>
      <el-submenu index="8" style="float: right;">
        <template slot="title">
          User
        </template>
          <el-menu-item index="7-1" disabled>
            Profile
          </el-menu-item>
          <el-menu-item index="logout">
            Logout
          </el-menu-item>
      </el-submenu>
    </el-menu>
</template>

<script>
export default {
  name: 'MainNavMenu',
  props: {
    activeIndex: String,
  },
  data() {
    return {
      logoutUrl: `${process.env.BASE_URL}/logout_user`,
    };
  },
  methods: {
    // eslint-disable-next-line no-unused-vars
    handleSelect(key, keyPath) {
      if (key === 'logout') {
        window.location = this.logoutUrl;
      }
    },
  },
};
</script>

<style>
</style>
