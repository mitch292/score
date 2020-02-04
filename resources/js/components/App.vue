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
			console.log('app vue', store)
			store.mutations.setUserAuthentication(store.state, window.isUserAuthenticated);
			// TODO: should we just loop through this object and call all functions or have a handler?
			store.initializers.initializeSavedHighlights(store.state);
			store.initializers.initializeSavedGames(store.state);
		},

		components: { scoreHeader }
	}

</script>

<style>

</style>