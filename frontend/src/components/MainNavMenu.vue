<template>
  <el-menu
    :default-active="activeIndex"
    :router="true"
    class="el-menu-demo"
    mode="horizontal"
    menu-trigger="click"
    @select="handleSelect">
      <el-menu-item index="home" :route="{ name: 'home' }">
        Dashboard
      </el-menu-item>
      <el-menu-item index="about" :route="{ name: 'about' }">
        About
      </el-menu-item>
      <!-- <el-menu-item index="license" :route="{ name: 'license' }">
        License
      </el-menu-item>
      <el-submenu index="3">
        <template slot="title">
          Manage
        </template>
          <el-menu-item index="users" :route="{ name: 'users' }">
            Users
          </el-menu-item>
          <el-menu-item index="teams" :route="{ name: 'teams' }">
            Teams
          </el-menu-item>
          <el-menu-item index="projects" :route="{ name: 'projects' }">
            Projects
          </el-menu-item>
      </el-submenu>
      <el-menu-item index="database" :route="{ name: 'database' }">
        Database
      </el-menu-item>
      <el-menu-item index="framework" disabled>
        Framework
      </el-menu-item>
      <el-menu-item index="server" disabled>
        Server
      </el-menu-item>
      <el-menu-item index="about" :route="{ name: 'about' }">About</el-menu-item>

      -->
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
