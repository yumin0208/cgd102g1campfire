<template>
<div class="auth-page-wrapper pt-5">
    <!-- auth page bg -->

    <!-- auth page content -->
    <div class="auth-page-content">
    <div class="container">
        <div class="row">
        <div class="col-lg-12">
            <div class="text-center mt-sm-5 mb-4 text-white-50">
            <div>
                <router-link to="/" class="d-inline-block auth-logo">
                <img src="#" alt="營火叢Logo" height="40"/>
                </router-link>
            </div>
            </div>
        </div>
        </div>
        <!-- end row -->

        <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4">
            <div class="card-body p-4">
                <div class="text-center mt-2">
                <h4 class="text-success">營火叢後台管理系統</h4>
                <h5 class="text-muted">員工登入</h5>
                </div>
                <div class="p-2 mt-4">
                <b-alert v-model="authError" variant="danger" class="mt-3" dismissible>{{ authError }}</b-alert>
                <form @submit.prevent="tryToLogIn">
                    <div class="mb-3">
                    <label for="email" class="form-label">郵箱</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter email" v-model="email" />
                    <div class="invalid-feedback">
                        <span></span>
                    </div>
                    </div>

                    <div class="mb-3">
                    <div class="float-end">
                        <router-link to="/forgot-password" class="text-muted">忘記密碼？</router-link>
                    </div>
                    <label class="form-label" for="password-input">密碼</label>
                    <div class="position-relative auth-pass-inputgroup mb-3">
                        <input type="password" v-model="password" class="form-control pe-5" placeholder="Enter password"
                        id="password-input" />
                        <button class="btn btn-link position-absolute end-0 top-0 text-decoration-none text-muted"
                        type="button" id="password-addon">
                        <i class="ri-eye-fill align-middle"></i>
                        </button>
                        <div class="invalid-feedback">
                        <span></span>
                        </div>
                    </div>
                    </div>

                    <div class="form-check">
                    <input class="form-check-input" type="checkbox" value="" id="auth-remember-check" />
                    <label class="form-check-label" for="auth-remember-check">記住我</label>
                    </div>

                    <div class="mt-4">
                    <button class="btn btn-success w-100" type="submit" @click="signinapi">登入</button>
                    </div>

                </form>
                </div>
            </div>
            <!-- end card body -->
            </div>
            <!-- end card -->
        </div>
        </div>
        <!-- end row -->
    </div>
    <!-- end container -->
    </div>
    <!-- end auth page content -->

    <!-- footer -->
    <footer class="footer">
    <div class="container">
        <div class="row">
        <div class="col-lg-12">
            <div class="text-center">
            <p class="mb-0 text-muted">
                &copy; {{ new Date().getFullYear() }} Firefly campsite. By TibaMe CGD102_G1
            </p>
            </div>
        </div>
        </div>
    </div>
    </footer>
    <!-- end Footer -->
</div>
<!-- end auth-page-wrapper -->
</template>

<script>
  import {
    required,
    email,
    helpers
  } from "@vuelidate/validators";
  import appConfig from "../../../app.config";
  import axios from 'axios';

  export default {
    page: {
      title: "登入",
      meta: [{
        name: "description",
        content: appConfig.description,
      }, ],
    },
    data() {
      return {
        email: "admin@firefly.com",
        password: "123456",
        submitted: false,
        authError: null,
        tryingToLogIn: false,
        isAuthError: false,
      };
    },
    validations: {
      email: {
        required: helpers.withMessage("Email is required", required),
        email: helpers.withMessage("Please enter valid email", email),
      },
      password: {
        required: helpers.withMessage("Password is required", required),
      },
    },
    computed: {

    },
    methods: {
      async signinapi() {
        const result = await axios.post('https://api-node.themesbrand.website/auth/signin', {
          email: this.email,
          password: this.password
        })
        if (result.data.status == 'errors') {
          return this.authError = result.data.data;
        }
        localStorage.setItem('jwt', result.data.token)
        this.$router.push({
          path: '/'
        });
      }
    },
  };
</script>