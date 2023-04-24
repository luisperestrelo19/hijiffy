<template>
  <div class="container bg-light border rounded mt-5">
    <div class="px-4 py-5 my-5 text-center">
      <img
        class="d-block mx-auto mb-4"
        src="storage/images/hijiffy.png"
        alt=""
        width="72"
        height="57"
      />
      <h1 class="display-5 fw-bold text-body-emphasis">HiJiffy - Challenge</h1>
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">
          <ul>
            <li>email: luisperestrelo19@gmail.com</li>
            <li>password: password</li>
          </ul>
        </p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
          
        </div>

        <button
          type="button"
          class="btn btn-primary btn-lg px-4 gap-3"
          @click="fetchAnswer"
        >
          Submit
        </button>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  
  methods: {
    async fetchAnswer() {
      this.isVisible = false;
      await axios
        .get("/api/question", {
          params: {
            question: this.userQuestion,
          },
        })
        .then((response) => {
          this.isVisible = true;
          this.answer = response.data.message;
        })
        .catch((error) => {
          alert(error.response.data.message);
        });
    },
  },
};
</script>
