<template>
  <div id="faculty_list">
    <div>
      <el-button
        style="float: right;"
        type="primary"
        size="small"
        @click="createUser">Create User</el-button>
    </div>

    <el-table
      :data="tableData"
      style="width: 100%">
      <el-table-column type="expand">
        <template slot-scope="props">
          <p><strong>Name</strong>: {{ props.row.name }}</p>
          <p><strong>Username</strong>: {{ props.row.username }}</p>
          <p><strong>Email</strong>: {{ props.row.email }}</p>
          <p><strong>Active</strong>: {{ props.row.active == 0 ? "No" : "Yes" }}</p>
        </template>
      </el-table-column>
      <el-table-column
        label="Username"
        prop="username">
      </el-table-column>
      <el-table-column
        label="Name"
        prop="name">
      </el-table-column>
      <el-table-column
        align="right">
        <template slot="header" slot-scope="scope">
          <el-input
            v-model="search"
            size="mini"
            placeholder="Type to search"/>
        </template>
        <template slot-scope="scope">
          <el-button
            size="mini"
            @click="handleEdit(scope.$index, scope.row)">Edit</el-button>
        </template>
      </el-table-column>
    </el-table>
  </div>
</template>

<script>
import { baseUrlForRoute } from '@/router';
import axios from '@/plugins/axios';

export default {
  name: 'FacultyList',
  data() {
    return {
      tableData: [],
      search: '',
    }
  },
  methods: {
    handleEdit(index, row) {
      // console.log(index, row);
      this.$router.push({
        name: 'admin_save_user',
        params: {
          user_prop: row,
        }
      });
    },
  
    createUser() {
      this.$router.push({ name: 'admin_save_user' });
    },
    
    // q - Search query
    getUsers(q = '') {
      axios.get(`${baseUrlForRoute}/admin/get_users.php`, {
        params: {
          type: 'faculty',
          q: q,
        },
      })
      .then((response) => {
        this.tableData = response.data.users;
      })
      .catch((error) => {
        console.error(error);
      });
    },
  },
  created() {
    this.getUsers();
  },
  watch: {
    search(newVal, oldVal) {
      // This should be "debounced" so that the
      // server does not get flooded with requests for every character
      this.getUsers(newVal);
    },
  }
}
</script>
