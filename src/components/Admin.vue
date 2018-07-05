<template>
  <div>
  	<div class="">用户信息123</div>
    <div>用户信息页isBill = {{isBill}}</div>
    <!-- <el-switch
      v-model="value2"
      active-color="#13ce66"
      inactive-color="#ff4949">
    </el-switch> -->
  </div>
</template>

<script>
export default {
  name: '',
  data () {
    return {
      value2: true
    }
  },
  computed: {
      isBill: {
        get: function () {
          return this.$store.state.isBill
        },
        set: function () {
        }
      }
  },
  components: {
    
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>

</style>
