<template>
  <div id="create-user">
    <el-row :gutter="20"
      type="flex"
      justify="space-around">
      <el-col :span="12">
        <div>
          <div>
            <p>Name</p>
            <el-input placeholder="Name" v-model="user.name"/>
          </div>

          <div style="margin-top: 15px">
            <p>Username</p>
            <el-input placeholder="Usesrname" v-model="user.username"/>
          </div>

          <div style="margin-top: 15px">
            <p>Password</p>
            <el-input placeholder="Password" v-model="user.password" type="password"/>
          </div>

          <div style="margin-top: 15px">
            <p>Confirm Password</p>
            <el-input placeholder="Confirm Password" v-model="user.password2" type="password"/>
          </div>

          <div style="margin-top: 15px">
            <p>Email</p>
            <el-input placeholder="Email" v-model="user.email" type="email"/>
          </div>

          <div style="margin-top: 25px">
            <el-checkbox v-model="user.active" border>Active</el-checkbox>
  
            <el-select v-model="user.type" placeholder="Select">
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
  name: 'SaveUser',
  props: {
    user_prop: Object,
  },
  created() {
    if (this.user_prop) {
      this.user = this.user_prop;
      this.user.active = this.user.active == 0 ? false : true;
    }
  },
  data() {
    return {
      user: {
        id: -1,
        username: '',
        password: '',
        password2: '',
        email: '',
        name: '',
        type: 'student',
        active: true,
      },
      
      userTypeOptions: [{
        value: 'student',
        label: 'Student'
      }, {
        value: 'faculty',
        label: 'Faculty'
      }],
    };
  },
  methods: {
    saveUser() {
      if (!this.validateFields()) return;
      
      axios.post(`${baseUrlForRoute}/admin/save_user.php`, qs.stringify({
        id: this.user.id,
        username: this.user.username,
        password: this.user.password,
        email: this.user.email,
        type: this.user.type,
        name: this.user.name,
        active: this.user.active ? 1 : 0,
      })).then((response) => {
        this.$message({
          message: response.data.message,
          type: response.data.success ? 'success' : 'error',
        });

        // Go back to previous page if successful
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
      if (!this.user.username && this.user.username.length < 3) {
        this.err('Username cannot be less than 3 characters');
        return false;
      }
      else if (!this.user_prop && (!this.user.password || !this.user.password2 || this.user.password.length < 5)) {
        this.err('Passwords cannot be less than 5 characters');
        return false;
      }
      else if (!this.user_prop && (this.user.password !== this.user.password2)) {
        this.err('Passwords do not match');
        return false;
      }
      else if (!this.user.type) {
        this.err('User type must be selected');
        return false;
      }

      return true;
    }
  },
}
</script>
