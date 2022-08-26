require('./bootstrap');

import { createApp } from 'vue'
import sendingForm from './Components/sendingForm.vue';

const app = createApp({})

app.component('sending-form',sendingForm)

app.mount('#app')