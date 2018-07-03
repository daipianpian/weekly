<template>
  <div class="weekly">
    <el-button type="primary" @click="addWeekly()">创建</el-button>
	
	<div class="weekly-info">
		<p v-if="!weeklyList.length"><strong>还没有任何计划</strong></p>
		<el-table
		    :data="weeklyList"
		    stripe
		    style="width: 100%">
		    <el-table-column
		      prop="id"
		      label="序号(ID)" align="center">
		    </el-table-column>
		    <el-table-column
		      prop="adminName"
		      label="创建者" align="center">
		    </el-table-column>
		    <el-table-column
		      prop="startTime"
		      label="开始日期" align="center">
		    </el-table-column>
		    <el-table-column
		      prop="endTime"
		      label="结束日期" align="center">
		    </el-table-column>
		    <el-table-column
		      prop="weekOfYear"
		      label="第几周" align="center">
		    </el-table-column>
		    <el-table-column
		      prop="weeklyDatil"
		      label="周报详情" align="center">
		      <template slot-scope="scope">
		      	<div class="weekly-datil" v-html="scope.row.weeklyDatil" @click="toWeeklyDatil(scope.row.id)"></div>
		      </template>
		    </el-table-column>
		    <!-- <el-table-column
		      prop="thisWeekWork"
		      label="这周完成工作" align="center">
		      <template slot-scope="scope">
		      	<div v-html="scope.row.thisWeekWork"></div>
		      </template>
		    </el-table-column>
		    <el-table-column
		      label="下周工作计划" align="center">
		      <template slot-scope="scope">
		      	<div v-html="scope.row.nextWeekWork"></div>
		      </template>
		    </el-table-column> -->
		    <el-table-column
		      prop="collaboration"
		      label="需协调与帮助" align="center">
		    </el-table-column>
		    <el-table-column label="操作" align="center">
		      <template slot-scope="scope">
		        <el-button
		          size="mini"
		          @click="handleEdit(scope.row.id)">编辑</el-button>
		        <el-button
		          size="mini"
		          type="danger"
		          @click="handleDelete(scope.row.id)">删除</el-button>
		      </template>
		    </el-table-column>
		</el-table>


	</div>
  </div>
</template>

<script>
export default {
  data () {
    return {
    	weeklyList: []
    }
  },
  created() {
  	this.fetchData();
  },
  methods: {
  	fetchData() {
  		var that = this;
	    that.$axios.get('/admin/Weekly/getWeekly')
	    .then(function(res){
		  var data = res.data;
	      that.weeklyList = data.data;
		})
		.catch(function(error){
		  console.log(error)
		});
  	},
	addWeekly() {
    	return this.$router.replace('add-weekly');
    },
    handleEdit(index, row) {
	    console.log(index, row);
	},
	handleDelete(id) {
	    console.log(id);
	    var that = this;
	    var params = {
	    	id: id
	    };
	    that.$axios.post('/admin/Weekly/deleteWeekly',params,{
	        headers: {
	          'Content-Type': 'application/json'
	        }
      	})
      	.then(function(res){
        	console.log(res);
        	var data = res.data;
        	var status = data.status;
        	if(status){
        		that.fetchData();
        	}
      	})
      	.catch(function(error){
        	console.log(error)
      	});
	},
	toWeeklyDatil(id){
	    return this.$router.push(
	    	{path:'weekly-datil',query:{ id:id }}
	    );
	}
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.weekly-datil{color: #409EFF;cursor: pointer;}
</style>
