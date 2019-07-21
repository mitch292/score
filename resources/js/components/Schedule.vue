<template>

	<div>
  		<utility-card v-for="game in games" :key="game.gamePk">
			  
			  <template slot="content">

				<score-game 
					:home="game.teams.home" 
					:away="game.teams.away"
				>
				</score-game>

			  </template>

			  <template slot="bottom">
				  <div class="text-center mt-4">
						{{game.teams.home.quickAccess.ballpark_name}}
					</div>
			  </template>
  		
		  </utility-card>
	</div>

</template>

<script>

	import UtilityCard from './utility/Card.vue';
	import ScoreGame from './Game.vue';

	export default {
		data() {
			return {
				games: []
			}
		},
		methods: {
			getTodaysGames: function() {
				window.axios.get('api/mlb/schedule/today')
					.then(resp => {
						console.log('the resp', resp)
						this.games = resp.data;
					})
					.catch(err => console.error('err', err))
			}
		},
		mounted() {
			this.getTodaysGames();
		},
		components: { UtilityCard, ScoreGame }
	}

</script>

<style>

</style>
