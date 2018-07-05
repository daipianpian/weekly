<template>
  <div class="sidebar">
  	<el-menu :default-active="$route.path" class="el-menu-vertical-demo" :router="true">
      <el-menu-item index="/home/admin" :class="{'isActive': active}">用户信息</el-menu-item>
      <!-- <el-menu-item  v-if="$route.path == '/home/weekly-datil'" index="/home/weekly-datil" :class="{'isActive': active}">周报详情</el-menu-item> -->
      <el-submenu index="weekly">
        <template slot="title">
          <span>周报管理</span>
        </template>
        <el-menu-item-group>
          <el-menu-item index="/home/weekly">周报列表</el-menu-item>
          <el-menu-item index="/home/weekly-datil">周报详情</el-menu-item>
          <el-menu-item index="/home/edit-weekly">编辑周报</el-menu-item>
        </el-menu-item-group>
      </el-submenu>


      <el-menu-item index="/home/add-weekly" :class="{'isActive': active}">创建周报</el-menu-item>
	</el-menu>
  </div>
</template>

<script>
export default {
  name: '',
  data () {
    return {
      active:true
    }
  },
  components: {
    
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.el-menu-item.is-active {
  color: #409EFF;
  background-color: #ecf5ff;
}
</style>
