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
          Quickly design and customize responsive mobile-first sites with
          Bootstrap, the world’s most popular front-end open source toolkit,
          featuring Sass variables and mixins, responsive grid system, extensive
          prebuilt components, and powerful JavaScript plugins.
        </p>
        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
          <div class="input-group input-group-sm mb-3">
            <span class="input-group-text" id="inputGroup-sizing-sm"
              >Make a question</span
            >
            <input
              type="text"
              class="form-control"
              aria-label="Sizing example input"
              aria-describedby="inputGroup-sizing-sm"
              v-model="userQuestion"
            />
          </div>
        </div>

        <div class="mb-5" v-if="isVisible">{{ answer }}</div>

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
  data() {
    return {
      isVisible: false,
      answer: "",
    };
  },
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
