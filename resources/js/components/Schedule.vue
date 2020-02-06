<template>

	<div>
		<div class="row mb-5 d-flex align-items-center justify-content-center">
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

		<div v-if="fetchingGames">
			<utility-loading></utility-loading>
		</div>

		<div v-else-if="!fetchingGames && games.length === 0">
			<div class="d-flex align-items-center justify-content-center">
				<font-awesome-icon class="text-red mr-4" icon="calendar-times" size="3x" />
				looks like there aren't any games on this day
			</div>
		</div>

		<div v-else>
			<game-list
				:games="games"
			>
			</game-list>
		</div>

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
						console.log('res.date', resp.data)
						this.fetchingGames = false;
						this.games = resp.data;
					})
					.catch(err => {
						this.fetchingGames = false;
						console.error('err', err)
					});
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
