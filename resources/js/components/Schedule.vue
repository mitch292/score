<template>

	<div>
		<div class="row mb-5 d-flex align-items-center justify-content-center">
			<div class="text-red h3 m-3">select a date:</div>
			<date-picker 
				calendar-class="bg-red calendar" 
				input-class="text-secondary h5 text-center p-2" 
				class="text-secondary" 
				@selected="setGames" 
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
	import moment from 'moment';
	import { isNull } from 'lodash';
	import GameList from './utility/GameList.vue';
	import UtilityLoading from './utility/Loading.vue';
	import DatePicker from 'vuejs-datepicker';


	export default {
		data() {
			return {
				games: [],
				fetchingGames: false,
				date: isNull(localStorage.getItem('scheduleDate'))
					? new Date()
					: new Date(`${localStorage.getItem('scheduleDate')} EST`)
			}
		},
		methods: {
			// defaults to today, or pass date in YYYY-MM-DD format
			setGames: function(date) {
				let formattedDate = null;
				if (!date && !isNull(localStorage.getItem('scheduleDate'))) {
					formattedDate = localStorage.getItem('scheduleDate');
				} else {
					let momentDate = moment(date);
					formattedDate = momentDate.format('YYYY-MM-DD');
				}
				this.fetchingGames = true;
				localStorage.setItem('scheduleDate', formattedDate);

				window.axios.get(route('mlb.schedule.date', {date: formattedDate}))
					.then(resp => {
						this.fetchingGames = false;
						this.games = resp.data;
					})
					.catch(err => {
						this.fetchingGames = false;
						console.error('err', err);
					});
			}
		},
		mounted() {
			this.setGames();
		},
		components: { UtilityLoading, GameList, DatePicker }
	}

</script>

<style>

</style>
