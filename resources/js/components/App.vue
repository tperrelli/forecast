<template>
  <div class="row">
    <nav v-if="authenticated" id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
      <div class="position-sticky pt-3">
        <ul class="nav flex-column">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/">
              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-home" aria-hidden="true"><path d="M3 9l9-7 9 7v11a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2z"></path><polyline points="9 22 9 12 15 12 15 22"></polyline></svg>
              Dashboard
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link" @click="logoutUser" aria-current="page" href="/">Logout</a>
          </li>
      
        </ul>
      </div>
    </nav>

    <div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
      <router-view></router-view>
    </div>
  </div>
</template>

<script setup>
import useAuth from '@/composables/useAuth';

const { logout, authenticated } = useAuth();

const logoutUser = async (e) => {
  e.preventDefault();

  await logout();
  window.location.href = '/';
}
</script>