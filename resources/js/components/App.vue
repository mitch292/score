<template>
  <span>

    <div class="header">
      <span class="header__icon">
        <font-awesome-icon icon="baseball-ball" size="3x" />
        <span class="header__text">score</span>
      </span>
    </div>

    <div class="content">
      <card>
        helloooo
      </card>
      <card></card>
      <card></card>
    </div>

    <div class="footer">

    </div>

  </span>
</template>

<script>
import Card from './Card.vue'
    export default {
        mounted() {
            console.log('Component mounted.')
        },
        components: { Card }
    }
</script>

<style>

</style>