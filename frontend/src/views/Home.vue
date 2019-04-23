<template>
  <div class="home">
    <el-container>
      <el-header>
        <main-nav-menu :activeIndex="activeIndex"/> 
      </el-header>

      <el-main>
        <router-view></router-view>
      </el-main>
    </el-container>
  </div>
</template>

<script>
// @ is an alias to /src
import MainNavMenu from '@/components/Menu/MainNavMenu.vue';

export default {
  name: 'home',
  components: {
    MainNavMenu
  },
  data() {
    return {
      activeIndex: 'home',
    };
  },
  watch: {
    '$route'(to, from) {
      this.activeIndex = to.name;
    },
  },
  created() {
    this.activeIndex = this.$route.name;
  },
}
</script>
