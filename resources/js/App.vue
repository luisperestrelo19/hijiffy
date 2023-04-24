<template>
  <AppNav/>
  <router-view />
</template>

<script>
import AppNav from "./components/NavLink.vue";
import { reactive, ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";
export default {
  components: {
    AppNav,
  },
};
</script>
