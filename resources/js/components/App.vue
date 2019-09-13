<template>
  <div >
    <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
      <ul class="navbar-nav">
        <li class="nav-item">
          <router-link to="/" class="nav-link">Home</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/produto/create" class="nav-link">Criar Produto</router-link>
        </li>
        <li class="nav-item">
          <router-link to="/produto/produtos" class="nav-link">Listar Produto</router-link>
        </li>
      </ul>
    </nav><br />
    <transition name="fade">
      <router-view></router-view>
    </transition>
  </div>
</template>

<style>

</style>

<script>

    export default{
    }
</script>