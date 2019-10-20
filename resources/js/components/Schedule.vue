<template>
	
	<div v-if="fetchingGames">
		<utility-loading></utility-loading>
	</div>

	<div v-else>
		<utility-card v-for="game in games" :key="game.gamePk">

			<template slot="content">

				<score-game 
				:home="game.teams.home" 
				:away="game.teams.away"
				:game="game"
				>
				</score-game>

			</template>

			<template slot="bottom">
				<div class="text-center mt-4">
					<div>
						{{ game.teams.home.quickAccess.ballpark_name }} @
						{{ `${game.gameData.datetime.time} ${game.gameData.datetime.ampm}` }}
					</div>
					<div class="mt-2">
						{{ getWeather(game) }}
					</div>
					<div class="mt-2">
						{{ getPitchingMatchup(game) }}
					</div>
				</div>
			</template>

		</utility-card>
	</div>

</template>

<script>

	import UtilityCard from './utility/Card.vue';
	import UtilityLoading from './utility/Loading.vue';
	import ScoreGame from './Game.vue';

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
				// TODO: this endpoint name should be a value defined somewhere
				window.axios.get(`api/mlb/schedule/${date}`)
					.then(resp => {
						this.fetchingGames = false;
						this.games = resp.data;
					})
					.catch(err => {
						this.fetchingGames = false;
						console.error('err', err)
					})
			},
			getPitchingMatchup: function(game) {
				return `${_.get(game.gameData.pitchers.away, 'full_name', 'TBD')} v. 
						${_.get(game.gameData.pitchers.home, 'full_name', 'TBD')}`;
			},
			getWeather: function(game) {
				return `
					${_.get(game.gameData.weather, 'temp', '')} 
					${_.has(game.gameData.weather, 'temp') ? '\xB0F,' : ''} 
					${_.get(game.gameData.weather, 'condition', '')} 
					${_.has(game.gameData.weather, 'condition') ? ',' : ''} 
					${_.has(game.gameData.weather, 'wind') ? 'wind:' : ''}
					 ${_.get(game.gameData.weather, 'wind', '')}`
			}
		},
		mounted() {
			this.getGames('2019-08-23');
		},
		components: { UtilityCard, UtilityLoading, ScoreGame }
	}

</script>

<style>

</style>
