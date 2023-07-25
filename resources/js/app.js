import {createApp,ref } from "vue";
import Welcome from "@/Welcome.vue";

const app = createApp(Welcome, {
    vehicles: ref([]), // Initialize vehicles as a reactive ref with an empty array
  });
  
  app.mount("#app");