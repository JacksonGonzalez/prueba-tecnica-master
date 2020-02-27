import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import axios from 'axios'
import i18n from '~/plugins/i18n'
import App from '~/components/App'

import '~/plugins'
import '~/components'
window.axios = require('axios');
Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
