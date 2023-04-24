<template>
  <nav class="navbar navbar-expand-lg navbar-light bg-light">
    <button
      class="navbar-toggler"
      type="button"
      data-toggle="collapse"
      data-target="#navbarSupportedContent"
      aria-controls="navbarSupportedContent"
      aria-expanded="false"
      aria-label="Toggle navigation"
    >
      <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav mr-auto">
        <li class="nav-item active" v-if="isVisible">
          <router-link
            to="/question"
            class="nav-item nav-link"
            active-class="active"
            exact
            v-if="isVisible"
          >
            Question
          </router-link>
        </li>
        <li class="nav-item" v-if="isVisible">
          <router-link
            to="/logout"
            class="nav-item nav-link"
            active-class="active"
            exact
            @click="handleLogout"
            v-if="isVisible"
          >
            Logout
          </router-link>
        </li>
      </ul>
    </div>
  </nav>
</template>

<script>

export default {
  data() {
    return {
      isVisible: false,
    };
  },
  methods: {
    handleLogout() {
      localStorage.removeItem("APP_SESSION_TOKEN");
      this.isVisible = false;
      router.push("/");

    },
  },

  created() {

    if (localStorage.getItem("APP_SESSION_TOKEN")) {
      this.isVisible = true;
      this.$forceUpdate();
    }
  },
};
</script>
