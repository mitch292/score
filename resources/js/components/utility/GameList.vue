<template>
	<div>
		<utility-card v-for="game in games" :key="game.gamePk">

			<template slot="content">
				<span v-if="showBtn">
					<button
						v-if="btnConditional"
						v-on:click="btnOnClick(game)"
						:class="btnClass"
					>{{ btnText }}</button>
				</span>


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

	import UtilityCard from './Card.vue';
	import ScoreGame from '../Game.vue';

	export default {

		props: {
			games: Array,
			showBtn: {
				type: Boolean,
				default: false
			},
			btnConditional: {
				type: Boolean,
				default: false
			},
			btnOnClick: {
				type: Function,
				default: (game) => {}
			},
			btnClass: {
				type: String,
				default: 'btn btn-primary'
			},
			btnText: {
				type: String,
				default: 'score'
			}

		},

		methods: {
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
			},
		},
		components: { UtilityCard, ScoreGame }
	}

</script>

<style>

</style>
