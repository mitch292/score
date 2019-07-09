<template>
	<div>

		<utility-filter 
			:items="this.toFilter"
			@newFilter="newFilter"
		></utility-filter>

		<utility-card v-for="game in filteredGames" class="game-card" :key="game.id">

			<template slot="content">

				<score-game :home="game.teams[0]" :away="game.teams[1]"></score-game>

			</template>

			<template slot="bottom">
				<div class="text-center">
				<span class="info-box col-sm-3 d-inline-block">
					<div class="info-title">
						viewing type:
					</div>
					<div class="info-data">
						{{game.viewingType.type || 'N/A'}}
					</div>
				</span>
				<span class="info-box col-sm-3 d-inline-block">
					<div class="info-title">
						date:
					</div>
					<div class="info-data">
						{{game.date}}
					</div>
				</span>
				<span class="info-box col-sm-3 d-inline-block">
					<div class="info-title">
						scoring type:
					</div>
					<div class="info-data">
						{{game.scoringType.type}}
					</div>
				</span>
				</div>
			
			</template>

		</utility-card>

	</div>
</template>

<script>
import UtilityCard from './utility/Card.vue';
import UtilityFilter from './utility/Filter.vue';
import ScoreGame from './Game.vue';

// DUMMY DATA
import { games, viewingTypes, scoringTypes, teams } from '../../../exampleGameData.js';
// TO DELETE EVENTUALL

export default {
	// currently dummy data that will come from a call to the server, event the types below
	methods: {
		newFilter(newData) {
			this.appliedFilters = newData;
			this.filterGames();
		},
		filterGames() {
			this.filteredGames = this.games.filter(game => {
				return this.teamsFilter(game) && this.viewingTypesFilter(game) && this.scoringTypesFilter(game);
			});
		},
		teamsFilter(game) {
			if (!_.isEmpty(this.appliedFilters.teams)) {
					return (
						_.includes(this.appliedFilters.teams, game.teams[0].id) 
						|| _.includes(this.appliedFilters.teams, game.teams[1].id)
					);
				}
			return true;
		},
		viewingTypesFilter(game) {
			if (!_.isEmpty(this.appliedFilters.viewingTypes)) {
				return _.includes(this.appliedFilters.viewingTypes, game.viewingType.id)
			}
			return true;
		},
		scoringTypesFilter(game) {
			if (!_.isEmpty(this.appliedFilters.scoringTypes)) {
					return _.includes(this.appliedFilters.scoringTypes, game.scoringType.id)
			}
			return true
		}
	},
	data() {
		return {
			games: games,
			viewingTypes: viewingTypes,
			// this should be dynamic based on the teams in games data, maybe a function called when component mounts to get teams or a computed propery
			teams: teams, 
			scoringTypes: scoringTypes,
			appliedFilters: {},
			filteredGames: games
		}
	},
	computed: {
		toFilter: function() {
			return [
				{
					keyName: 'type',
					list: viewingTypes,
					listName: 'viewingTypes'
				},
				{
					keyName: 'type',
					list: scoringTypes,
					listName: 'scoringTypes'
				},
							{
					keyName: 'name',
					list: teams,
					listName: 'teams'
				}
			];
		}
	},
	components: { UtilityCard, UtilityFilter, ScoreGame }
}
</script>

<style>

.info-box {
	padding: 1rem;
}

.info-title {
	margin-bottom: 1rem;
	font-weight: 900;
	font-size: 110%;
}

</style>
