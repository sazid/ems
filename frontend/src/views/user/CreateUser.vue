<template>
  <div id="create-user">
    <el-row :gutter="20"
      type="flex"
      justify="space-around">
      <el-col :span="12">
        <div>
          <div>
            <p>Name</p>
            <el-input placeholder="Name" v-model="name"/>
          </div>

          <div style="margin-top: 15px">
            <p>Username</p>
            <el-input placeholder="Usesrname" v-model="username"/>
          </div>

          <div style="margin-top: 15px">
            <p>Password</p>
            <el-input placeholder="Password" v-model="password" type="password"/>
          </div>

          <div style="margin-top: 15px">
            <p>Confirm Password</p>
            <el-input placeholder="Confirm Password" v-model="password2" type="password"/>
          </div>

          <div style="margin-top: 15px">
            <p>Email</p>
            <el-input placeholder="Email" v-model="email" type="email"/>
          </div>

          <div style="margin-top: 15px">
            <p>User type</p>
            <el-select v-model="type" placeholder="Select">
              <el-option
                
                v-for="item in userTypeOptions"
                :key="item.value"
                :label="item.label"
                :value="item.value">
              </el-option>
            </el-select>
          </div>

          <div style="margin-top: 15px">
            <el-button type="primary" @click="saveUser">Save</el-button>
          </div>
        </div>
      </el-col>
    </el-row>
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
      password: '',
      password2: '',
      email: '',
      name: '',
      type: 'Student',
      
      userTypeOptions: [{
        value: 'Student',
        label: 'Student'
      }, {
        value: 'Faculty',
        label: 'Faculty'
      }],
    };
  },
  methods: {
    saveUser() {
      if (!this.validateFields()) return;
      
      axios.post(`${baseUrlForRoute}/admin/create_user.php`, qs.stringify({
        username: this.username,
        password: this.password,
        email: this.email,
        type: this.type,
        name: this.name,
      })).then((response) => {
        console.log(response.data);
        
        this.$message({
          message: response.data.message,
          type: response.data.success ? 'success' : 'error',
        });

        // Go back to previous page
        if (response.data.success)
          this.$router.go(-1);
      });
    },

    err(msg) {
      this.$message({
        message: msg,
        type: 'error'
      });
    },

    validateFields() {
      if (!this.username && this.username.length < 3) {
        this.err('Username cannot be less than 3 characters');
        return false;
      }
      else if (!this.password || !this.password2 || this.password.length < 5) {
        this.err('Passwords cannot be less than 5 characters');
        return false;
      }
      else if (this.password !== this.password2) {
        this.err('Passwords do not match');
        return false;
      }
      else if (!this.type) {
        this.err('User type must be selected');
        return false;
      }

      return true;
    }
  },
}
</script>
