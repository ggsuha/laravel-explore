<template>
  <div class="card-body">
    <form class="needs-validation">
      <div class="form-group">
        <label for="email">Email</label>
        <input
          id="email"
          type="email"
          class="form-control"
          v-model="form.email"
          tabindex="1"
          autofocus
        />
      </div>

      <div class="form-group">
        <div class="d-block">
          <label for="password" class="control-label">Password</label>
        </div>
        <input
          id="password"
          type="password"
          class="form-control"
          v-model="form.password"
          tabindex="2"
        />
      </div>

      <div class="form-group">
        <div class="custom-control custom-checkbox">
          <input
            type="checkbox"
            v-model="form.remember"
            class="custom-control-input"
            tabindex="3"
            id="remember-me"
          />
          <label class="custom-control-label" for="remember-me"
            >Remember Me</label
          >
        </div>
      </div>

      <div class="form-group">
        <button
          type="button"
          class="btn btn-primary btn-lg btn-block"
          disabled
          v-if="loading"
        >
          <span
            class="spinner-border spinner-border-sm"
            role="status"
            aria-hidden="true"
          ></span>
          Loading...
        </button>
        <button
          type="submit"
          class="btn btn-primary btn-lg btn-block"
          tabindex="4"
          v-on:click="submit"
          v-else
        >
          Login
        </button>
      </div>
    </form>
  </div>
</template>

<script>
import axios from "axios";
import FormInput from "../../../models/FormInput";
import { useToast } from "vue-toastification";

export default {
  data() {
    return {
      loading: false,
      form: new FormInput({
        email: null,
        password: null,
        remember: false,
      }),
    };
  },
  methods: {
    submit() {
      this.loading = true;

      axios
        .post(route("admin.login.store"), this.form)
        .then((response) => {
          window.location.href = route('admin.dashboard');
        })
        .catch((error) => {
          useToast().error(error.response.data.message);
          this.loading = false;
        });
    },
  },
};
</script>