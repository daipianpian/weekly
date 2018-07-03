<template>
  <div>
  	<el-row>
  	  <el-col :span="6"><div class="grid-content">序号(ID)</div></el-col>
  	  <el-col :span="18"><div class="grid-content">{{weeklyDatil.id}}</div></el-col>
  	</el-row>
    <el-row>
      <el-col :span="6"><div class="grid-content">创建者</div></el-col>
      <el-col :span="18"><div class="grid-content">{{weeklyDatil.adminName}}</div></el-col>
    </el-row>
    <el-row>
      <el-col :span="6"><div class="grid-content">开始日期</div></el-col>
      <el-col :span="18"><div class="grid-content">{{weeklyDatil.startTime}}</div></el-col>
    </el-row>
  </div>
</template>

<script>
export default {
  name: '',
  data () {
    return {
      id: this.$route.query.id,
      weeklyDatil: {}
    }
  },
  created() {
    this.fetchData();
  },
  methods: {
    fetchData() {
      var that = this;
      var params = {
        id: that.id
      };
      that.$axios.post('/admin/Weekly/getWeeklyDatil',params,{
          headers: {
            'Content-Type': 'application/json'
          }
        })
        .then(function(res){
          console.log(res);
          var data = res.data;
          var status = data.status;
          if(status){
            that.weeklyDatil = data.data;
          }
        })
        .catch(function(error){
          console.log(error)
        });
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
