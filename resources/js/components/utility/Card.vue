<template>
  <div class="card">
    <div class="card__content">
      <slot name="content"></slot>
    </div>
    <div class="card__stripe"></div>
    <div class="card__bottom">
      <slot name="bottom"></slot>
    </div>
  </div>
</template>

<script>
  export default {
    mounted() {
      console.log('hello, card');
    }
  }
</script>

<style>

</style>