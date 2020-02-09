<template>
	<div v-if="fetchingGames">
		<utility-loading></utility-loading>
	</div>

	<div v-else>
		<game-list
			:games="games"
			:scoreDataOnly="true"
			v-on:gameRemoved="fetchMyGames"
		>
		</game-list>
	</div>
</template>

<script>
	import GameList from './utility/GameList.vue';
	import UtilityLoading from './utility/Loading.vue';	

	export default {
		
		data() {
			return {
				games: [],
				fetchingGames: true
			}
		},

		methods: {
			fetchMyGames: function() {
				window.axios.get(route('mlb.game.myGames'))
					.then(resp => {
						this.fetchingGames = false;
						this.games = resp.data
					})
					.catch(err =>{
						this.fetchingGames = true;
						console.error('error fetching user\'s games', err)
					})
			}
		},

		mounted() {
			this.fetchMyGames();
		},

		components: { UtilityLoading, GameList }
	}
</script>

<style>

</style>