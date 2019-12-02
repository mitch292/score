<template>
	
	<div v-if="fetchingGames">
		<utility-loading></utility-loading>
	</div>

	<div v-else>
		<div class="row d-flex align-items-center justify-content-center">
			<div class="text-red h3 m-3">select a date:</div>
			<date-picker 
				calendar-class="bg-red calendar" 
				input-class="text-secondary h5 text-center p-2" 
				class="text-secondary" 
				@selected="getGames" 
				v-model="date" 
				format="yyyy-MM-dd"
			>
			</date-picker>
		</div>
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
	import DatePicker from 'vuejs-datepicker';
	import moment from 'moment';


	export default {
		data() {
			return {
				games: [],
				fetchingGames: false,
				date: new Date(),
			}
		},
		methods: {
			// defaults to today, or pass date in yyyy-MM-DD format
			getGames: function(date) {
				let momentDate = moment(date);
				let formattedDate = momentDate.format('YYYY-MM-DD');
				this.fetchingGames = true;

				window.axios.get(`mlb/schedule/${formattedDate}`)
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
					.then(resp => {})
					.catch(err => console.error('problem saving the game', err))
			}
		},
		mounted() {
			this.getGames();
		},
		components: { UtilityLoading, GameList, DatePicker }
	}

</script>

<style>

</style>
