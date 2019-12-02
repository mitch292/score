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
	import { store } from '../store.js';
	import scoreHeader from './Header.vue';

	export default {
		
		mounted() {
			store.mutations.setUserAuthentication(store.state, window.isUserAuthenticated);
			store.initializers.initializeSavedHighlights(store.state);
		},

		components: { scoreHeader }
	}

</script>

<style>

</style>