<template>
  <div class="container bg-light border rounded mt-5 w-50">
    <div class="px-4 py-5 my-5 ">
      <img
        class="d-block mx-auto mb-4"
        src="storage/images/hijiffy.png"
        alt=""
        width="72"
        height="57"
      />
      <h1 class="display-5 fw-bold text-body-emphasis text-center">HiJiffy - Challenge</h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">
          To run the project you must:
          <ul>
            <li>Run migrations: database will be in sqlite</li>
            <li>Run script to create the intent and Questions: <br><strong>php artisan DialogFlow:create</strong></li>
          </ul>
        </p>
      </div>
      <form method="post" @submit.prevent="handleLogin">
        <!-- Email input -->
        <div class="form-outline mb-4">
          <label class="form-label" for="email">Email address</label>

          <input
            type="email"
            id="email"
            class="form-control"
            v-model="form.email"
            required
          />
        </div>
        <!-- Password input -->
        <div class="form-outline mb-4">
          <label class="form-label" for="password">Password</label>

          <input
            id="password"
            type="password"
            class="form-control"
            v-model="form.password"
            required
          />
        </div>

        <!-- Submit button -->
        <button type="submit" class="btn btn-primary btn-block mb-4">
          Sign in
        </button>
      </form>
    </div>
  </div>
</template>

<script>
import { reactive, ref } from "vue";
import axios from "axios";
import { useRouter } from "vue-router";

export default {
  setup() {
    const router = useRouter();
    const form = reactive({
      email: "luisperestrelo19@gmail.com",
      password: "password",
    });
    const handleLogin = async () => {
      const result = await axios.post("/api/auth/login", form);
      if (result.status === 200 && result.data && result.data.access_token) {
        localStorage.setItem("APP_SESSION_TOKEN", result.data.access_token);

        await router.push("question");
        router.go();
      }
    };
    return {
      form,
      handleLogin,
    };
  },
};
</script>
