<template>
  <div id="faculty_list">
    <el-table
      ref="multipleTable"
      :data="tableData"
      style="width: 100%"
      @selection-change="handleSelectionChange">
      
      <el-table-column
        type="selection"
        width="55">
      </el-table-column>

      <el-table-column
        label="Username"
        prop="username">
      </el-table-column>
      <el-table-column
        label="Name"
        prop="name">
      </el-table-column>
    </el-table>
    <div style="margin-top: 20px">
      <el-button @click="clearSelection()">Clear selection</el-button>
    </div>
  </div>
</template>

<script>
import { baseUrlForRoute } from '@/router';
import axios from '@/plugins/axios';

export default {
  name: 'UserSelect',
  props: {
    userType: String,
    selectedUsers: Array,
  },
  data() {
    return {
      tableData: [],
      search: '',
      multipleSelection: [],
    }
  },
  methods: {
    // q - Search query
    getUsers(q = '') {
      axios.get(`${baseUrlForRoute}/admin/get_users.php`, {
        params: {
          type: this.userType,
          q: q,
        },
      })
      .then((response) => {
        this.tableData = response.data.users;
        this.tableData.forEach(user => {
          if (this.selectedUsers.includes(user.id)) {
            setTimeout(() => {
              this.$refs.multipleTable.toggleRowSelection(user);
            }, 300);
          }
        });
      })
      .catch((error) => {
        console.error(error);
      });
    },

    clearSelection(rows) {
      this.$refs.multipleTable.clearSelection();
    },

    toggleSelection(rows) {
      if (rows) {
        rows.forEach(row => {
          this.$refs.multipleTable.toggleRowSelection(row);
        });
      } else {
        this.$refs.multipleTable.clearSelection();
      }
    },
    
    handleSelectionChange(val) {
      this.multipleSelection = val;
    }
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
