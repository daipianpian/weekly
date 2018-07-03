<template>
  <div id="app">
    <!-- 头部导航 start -->
    <header class="header">
      <el-row>
        <el-col :span="18">
          <el-menu default-active="1" class="el-menu-demo" mode="horizontal" @select="">
            <el-menu-item index="1"><i class="el-icon-date"></i>工作周报</el-menu-item>
          </el-menu> 
        </el-col>
        <el-col :span="6">
          <el-menu default-active="0" class="el-menu-demo" mode="horizontal" @select="">
             <el-menu-item index="1">
               <el-button type="primary" @click="loginOut()">退出</el-button>
             </el-menu-item>
           </el-menu> 
        </el-col>
      </el-row>
    </header>
    <!-- 头部导航 end -->

    <main>
        <!-- 左侧导航 -->
        <div class="main-left">
          <sidebar></sidebar>
        </div>

        <!-- 右侧主内容区 -->
        <div class="main-right" >
          <router-view></router-view>
        </div>
    </main>

    <!-- <router-view/> -->
  </div>
</template>

<script>
  import Sidebar from './Sidebar.vue'
  export default {
    name: 'app',
    data() {
      return {
        
      }
    },
    components: {
      Sidebar
    },
    methods: {
      loginOut(){
        var that = this;
        var params = {};
        that.$axios.post('/admin/Login/logout',params,{
            headers: {
              'Content-Type': 'application/json'
            }
        })
        .then(function(res){
            console.log(res);
            var data = res.data;
            console.log(data);
            if(data.status){
              that.$message({
                message: '退出成功',
                type: 'success',
                duration: 1000
              });
              return that.$router.replace('/Login');
            }else{
              that.$message({
                message: '退出失败',
                type: 'error',
                duration: 1000
              });
            }
        })
        .catch(function(error){
            that.$message({
              message: '退出失败',
              type: 'error',
              duration: 1000
            });
            console.log(error);
            return false;
        });
      }
    }
  }
</script>

<style>
  body{margin: 0;}
  #app {
    min-width: 1200px;
    margin: 0 auto;
    font-family: "Helvetica Neue","PingFang SC",Arial,sans-serif;
  }
  /* 头部导航 */
  header{z-index: 1000;min-width: 1200px;transition: all 0.5s ease;  border-top: solid 4px #3091F2;  background-color: #fff;  box-shadow: 0 2px 4px 0 rgba(0,0,0,.12),0 0 6px 0 rgba(0,0,0,.04);  }
  header.header-fixed{position: fixed;top: 0;left: 0;right: 0;}
  header .el-menu-demo{padding-left: 300px!important;}

  /* 主内容区 */
  main{    display: -webkit-box;  display: -ms-flexbox;  display: flex;  min-height: 800px;  border: solid 40px #E9ECF1;  background-color: #FCFCFC;  }
  main .main-left{text-align: center;width: 200px;float: left;}
  main .main-right{-webkit-box-flex: 1;  -ms-flex: 1;  flex: 1;  background-color: #fff; padding: 30px 50px; }
  main .el-menu{background-color: transparent!important;}
</style>
