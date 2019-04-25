<template>
  <el-menu
    :default-active="activeIndex"
    :router="true"
    class="el-menu-demo"
    mode="horizontal"
    menu-trigger="click"
    @select="handleSelect">
      <admin-menu v-if="userType == 'admin'"></admin-menu>

      <faculty-menu v-if="userType == 'faculty'"></faculty-menu>
      
      <student-menu v-if="userType == 'student'"></student-menu>

      <el-submenu index="8" style="float: right;">
        <template slot="title">
          {{ $store.state.user.name }}
        </template>
          <!-- <el-menu-item index="7-1" disabled>
            Profile
          </el-menu-item> -->
          <el-menu-item index="about" :route="{ name: 'about' }">
            About
          </el-menu-item>
          <el-menu-item index="logout" >
            Logout
          </el-menu-item>
      </el-submenu>
    </el-menu>
</template>

<script>
import { baseUrlForRoute } from '@/router';
import AdminMenu from '@/components/Menu/AdminMenu.vue';
import StudentMenu from '@/components/Menu/StudentMenu.vue';
import FacultyMenu from '@/components/Menu/FacultyMenu.vue';

export default {
  name: 'MainNavMenu',
  props: {
    activeIndex: String,
  },
  components: {
    AdminMenu,
    FacultyMenu,
    StudentMenu,
  },
  data() {
    return {
      logoutUrl: `${baseUrlForRoute}/user/logout_user.php`,
      userType: this.$store.state.user.type,
    };
  },
  methods: {
    handleSelect(key, _keyPath) {
      if (key === 'logout') {
        window.location = this.logoutUrl;
      }
    },
  },
};
</script>

<style>
</style>
