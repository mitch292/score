<template>
  <span>
    <score-header></score-header>

    <div class="content">
      <router-view></router-view>
    </div>

    <div class="footer">

    </div>

  </span>
</template>

<script>

  import scoreHeader from './Header.vue';

  export default {
      components: { scoreHeader }
  }

</script>

<style>

</style>