<template>
  <div id="faculty">
    <el-row :gutter="20" style="margin-top: 15px">
      <el-col :span="6">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Details</span>
            </div>
            <div>
              <p>File name: <strong>code.cpp</strong></p>
              <p>File size: <strong>631B</strong></p>
              <p>Uploaded on: <strong>1:01PM 5/5/2019</strong></p>
            </div>
          </el-card>
        </div>
      </el-col>
      <el-col :span="18">
        <div class="grid-content bg-purple">
          <el-card class="box-card">
            <div slot="header">
              <span>Contents</span>
            </div>
            <div>
              <pre v-highlightjs="file_contents"><code class="c++"></code></pre>
            </div>
          </el-card>
        </div>
      </el-col>
    </el-row>
  </div>
</template>

<script>
import { baseUrlForRoute } from '@/router';
import 'highlight.js/styles/atom-one-light.css';
import axios from '@/plugins/axios';

export default {
  name: 'FileViewer',

  data() {
    return {
      file_contents: '',
    };
  },

  created() {
    axios.get(`${baseUrlForRoute}/faculty/file_viewer.php`)
    .then((response) => {
      // let highlighted = hljs.highlight('cpp', response.data.content).value;
      this.file_contents = response.data.content;
    })
    .catch((error) => {
      console.error(error);
    });
  },
}
</script>
