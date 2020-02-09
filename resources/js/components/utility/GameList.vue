<template>
	<div>
		<utility-card v-for="game in games" :key="game.gamePk">

			<template slot="content">
				<div class="d-flex justify-content-between p-2">
					<span v-if="$root.$data.sharedState.isAuthenticated">
						<span v-if="$root.$data.sharedState.savedGames.indexOf(game.gamePk.toString()) >= 0"> 
							<button v-on:click="removeGame(game)" class="btn btn-outline-primary--inherit mb-4">remove save</button>
						</span>
						<span v-else>
							<button v-on:click="saveGame(game)" class="btn btn-primary mb-4">save</button>
						</span>
					</span>
					<span class="">
						<router-link :to="`/highlights/${game.gamePk}`">
							<button class="btn btn-primary">highlights</button>
						</router-link>
					</span>
				</div>


				<score-game 
					:home="game.teams.home" 
					:away="game.teams.away"
					:game="game"
					:scoreDataOnly="scoreDataOnly"
					v-on:gameSaved="saveGame(game)"
				>
				</score-game>

			</template>

			<template slot="bottom">
				<div class="text-center mt-4">
					<div>
						{{ game.scoreData.home.ballpark_name }} @
						{{ `${game.datetime.time} ${game.datetime.ampm}` }}
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
	import { store } from '../../store.js';
	import { fetchUserGameIds, fireSweetAlert } from '../../global.js';


	export default {

		props: {
			games: Array,
			scoreDataOnly: {
				type: Boolean,
				default: false
			}
		},

		methods: {
			getPitchingMatchup: function(game) {
				return `${_.get(game.pitchers.away, 'full_name', 'TBD')} v. 
						${_.get(game.pitchers.home, 'full_name', 'TBD')}`;
			},
			getWeather: function(game) {
				return `
					${_.get(game.weather, 'temp', '')} 
					${_.has(game.weather, 'temp') ? '\xB0F,' : ''} 
					${_.get(game.weather, 'condition', '')} 
					${_.has(game.weather, 'condition') ? ',' : ''} 
					${_.has(game.weather, 'wind') ? 'wind:' : ''}
					 ${_.get(game.weather, 'wind', '')}`
			},
			saveGame(game) {
				window.axios.post(route('mlb.game.save'), {external_id: game.gamePk})
					.then(resp => {
						fireSweetAlert({title: 'game saved'});
						fetchUserGameIds().then(resp => store.mutations.setSavedGames(store.state, resp.data))
					})
					.catch(err => console.error('problem saving the game', err))
			},
			removeGame(game) {
				window.axios.delete(route('mlb.game.deleteGame'), {data: {external_id: game.gamePk}})
					.then(resp => {
						fetchUserGameIds().then(resp => {
							fireSweetAlert({title: 'game removed'})
							this.$emit('gameRemoved');
							store.mutations.setSavedGames(store.state, resp.data)
						});
					})
					.catch(err => console.error('there was an error removing the game from your profile', err))
			},
		},
		components: { UtilityCard, ScoreGame }
	}

</script>

<style>

</style>
