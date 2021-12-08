import * as lodash from 'lodash';
window._ = lodash;

window.axios = require('axios');
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

