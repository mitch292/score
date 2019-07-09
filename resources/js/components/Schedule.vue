<template>

	<div>
  		<utility-card v-for="game in games" :key="game.gamePk">
			  
			  <template slot="content">

				<score-game 
					:home="game.teams.home.team" 
					:away="game.teams.away.team"
				>
				</score-game>

			  </template>

			  <template slot="bottom">
				  hello
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
	mounted() {
		// TODO: Remove --> this is for testing functions
		window.axios.get('api/mlb/schedule/today')
			.then(resp => {
				this.games = resp.data;
	  		})
			.catch(err => console.error('err', err))

		window.axios.get('api/mlb/game/565264')
			.then(resp => console.log('the resp', resp))
			.catch(err => console.error('err', err))
		// end todo
	},
  	components: { UtilityCard, ScoreGame }
}

</script>

<style>

</style>
