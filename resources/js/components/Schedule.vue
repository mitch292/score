<template>
	
	<div v-if="fetchingGames">
		<utility-loading></utility-loading>
	</div>

	<div v-else>
		<game-list
			:games="games"
			:showBtn="true"
			:btnConditional="$root.$data.sharedState.isAuthenticated"
			:btnOnClick="saveGame"
			btnText="save game"
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
			// defaults to today, or pass date in YYYY-MM-DD format
			getGames: function(date='today') {
				this.fetchingGames = true;
				window.axios.get(`mlb/schedule/${date}`)
					.then(resp => {
						this.fetchingGames = false;
						this.games = resp.data;
					})
					.catch(err => {
						this.fetchingGames = false;
						console.error('err', err)
					})
			},
			saveGame(game) {
				window.axios.post('mlb/game/save', {external_id: game.gamePk})
					.then(resp => console.log('the response', resp))
					.catch(err => console.error('problem saving the game', err))
			}
		},
		mounted() {
			this.getGames('2019-08-24');
		},
		components: { UtilityLoading, GameList }
	}

</script>

<style>

</style>
