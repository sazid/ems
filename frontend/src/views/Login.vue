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
import { baseUrlForRoute } from '@/router';
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
      axios.post(`${baseUrlForRoute}/user/verify_user.php`, qs.stringify({
        username: this.username,
        password: this.password
      })).then((response) => {
        let data = response.data;

        if (data.success) {
          this.$message({
            message: 'Login successful',
            type: 'success'
          });

          setTimeout(() => {
            let routeName = '';

            switch(data['userType']) {
              case 'admin':
                routeName = 'admin';
                break;

              case 'faculty':
                routeName = 'faculty';
                break;

              case 'student':
                routeName = 'student';
                break;

              default:
                routeName = 'admin';
            }

            this.$router.push({ name: routeName });
          }, 1000);
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
