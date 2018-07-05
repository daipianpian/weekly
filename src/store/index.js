import Vue from 'vue'
import Vuex from 'vuex'
import mutations from './mutations'
import actions from './actions'

Vue.use(Vuex);

const state = {
	totalTime: 0,
	list: [],
	isBill: 0  // 显示含税商品还是不含税商品，0-不含税，1-含税
}

export default new Vuex.Store({
	state,
	mutations,
	actions
})

