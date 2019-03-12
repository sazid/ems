<template>
  <div id="login">
    <el-container>
      <el-header>
        <div id="header">
          <!-- <h1 style="text-align: center; font-size: 1.6em;">Exam Management System</h1> -->
        </div>
      </el-header>
      
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
                v-model="username" />
              
              <el-input
                style="margin-top: 15px"
                placeholder="Password"
                v-model="password"
                type="password" />

                <el-button
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
export default {
  data() {
    return {
        username: '',
        password: ''
    };
  }
}
</script>

<style>
.login-form {
  margin-top: 100px;
}

.header {
  position: fixed;
  text-align: center;
  left: 0;
  top: 0;
  width: 100%;
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
