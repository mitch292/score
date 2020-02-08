<template>
  <div v-bind:class="['card mx-auto', isWide === true ? 'col-sm-12' : 'col-sm-8']">
	  <slot></slot>
  </div>
</template>

<script>
  export default {
	props: {
	  isWide: {
				type: Boolean,
				default: false
			}

	}
  }
</script>

<style>

</style>