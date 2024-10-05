<template>
  <div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Login</div>

                <div class="card-body">
                    <form @submit.prevent="authenticate">
                      <div class="row mb-3">
                        <label for="email" class="col-md-4 col-form-label text-md-end">E-mail</label>
                        <div class="col-md-6">
                          <input id="email" type="email" class="form-control" name="email" required autocomplete="email" autofocus v-model="form.email" /> 
                        </div>
                      </div>

                      <div class="row mb-3">
                        <label for="password" class="col-md-4 col-form-label text-md-end">Password</label>
                        <div class="col-md-6">
                          <input id="password" type="password" class="form-control" name="password" required autocomplete="current-password" v-model="form.password" >
                        </div>
                      </div>

                      <div class="row mb-3">
                          <div class="col-md-8 offset-md-4">
                          <button type="submit"
                            class="btn btn-primary">
                            Log in
                          </button>
                        </div>
                      </div>
                    </form>
                </div>
            </div>
        </div>
        
    </div>
  </div>
</template>

<script setup>
import { reactive } from 'vue';
import useAuth from '../composables/useAuth';

const form = reactive({
  email: '',
  password: ''
});

const { login } = useAuth();

const authenticate = () => {
  login(form).then(() => {
    window.location.href = '/';
  });
}
</script>