<template>
  <div id="login">
    <el-container>
      <el-main>
        <el-row
          type="flex"
          class="login-form"
          justify="space-around">
          <el-col :span="6">
            <div>
              <h1>Exam Management System</h1>

              <el-input
                style="margin-top: 15px;"
                placeholder="Username"
                @keyup.enter.native="login"
                v-model="username" />
              
              <el-input
                style="margin-top: 15px"
                placeholder="Password"
                v-model="password"
                @keyup.enter.native="login"
                type="password" />

                <el-button
                  @click="login"
                  type="primary"
                  style="margin-top: 15px">Login</el-button>
            </div>
          </el-col>
        </el-row>
      </el-main>

      <el-footer>
        <div class="footer">
          <p>
            &copy; Mohammed Sazid Al Rashid
          </p>
        </div>
      </el-footer>
    </el-container>
  </div>
</template>

<script>
import axios from '@/plugins/axios';
import qs from 'qs';

export default {
  data() {
    return {
        username: '',
        password: ''
    };
  },
  methods: {
    login() {
      axios.post('/ems/app/api/user/verify_user.php', qs.stringify({
        username: this.username,
        password: this.password
      })).then((data) => {
        if (data.data.success) {
          this.$store.commit('SET_LOGGED_IN_STATUS', true);
          this.$store.commit('SET_USER', {
            name: data.data.name[0],
            type: data.data.type[0],
          });

          this.$message({
            message: 'Login successful',
            type: 'success'
          });

          setTimeout(() => this.$router.push({ name: 'admin' }), 1000);
        } else {
          this.$message({
            message: 'Failed to login',
            type: 'error'
         });
        }
      });
    },
  },
}
</script>

<style>
.login-form {
  margin-top: 100px;
}

.footer {
  font-size: 0.8em;
  position: fixed;
  text-align: center;
  left: 0;
  bottom: 0;
  width: 100%;
  background-color: rgb(36, 36, 36);
  color: rgb(238, 238, 238);
}
</style>
