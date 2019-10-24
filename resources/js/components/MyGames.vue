<template>
	<div v-if="fetchingGames">
		<utility-loading></utility-loading>
	</div>

	<div v-else>
		<game-list
			:games="games"
			:quickAccessOnly="true"
			:showBtn="false"
			:btnConditional="$root.$data.sharedState.isAuthenticated"
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
				fetchingGames: false
			}
		},

		methods: {
			fetchMyGames: function() {
				this.fetchingGames = true;
				window.axios.get('/mlb/game/my-games')
					.then(resp => {
						console.log('resp', resp)
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