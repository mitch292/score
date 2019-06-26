<template>

	<div>
		<utility-top-menu>
			<button 
				@click="toggleFilterDisplay" 
				name="viewingTypes" 
				class="btn btn-secondary m-4">
				viewing type
			</button>
			<button
				@click="toggleFilterDisplay" 
				name="teams" 
				class="btn m-4"
				:class="Object.values(this.appliedFilters.teams).filter(team => team).length ? 'btn-primary' : 'btn-secondary'">
				team
			</button>
			<button 
				@click="toggleFilterDisplay" 
				name="scoringTypes" 
				class="btn btn-secondary m-4">
				scoring type
			</button>
		</utility-top-menu>
		<!-- TODO: THIS SHOULD BE ABSTRACTED OUT INTO A FILTER COMPONENT -->
		<utility-drop-down 
			v-if="this.filterToggles.viewingTypes" 
			keyName="type" 
			:items="this.viewingTypes"
			filter="viewingTypes">
		</utility-drop-down>
		<utility-drop-down 
			v-if="this.filterToggles.teams" 
			keyName="name" 
			:items="this.teams"
			@applyFilter="applyFilter"
			filter="teams">
		</utility-drop-down>
		<utility-drop-down 
			v-if="this.filterToggles.scoringTypes" 
			keyName="type" 
			:items="this.scoringTypes"
			filter="scoringTypes">
		</utility-drop-down>
		<!------------------- END OF COMPONENT ABSTRACTION ------------------------>

		<utility-card v-for="game in games" class="game-card" :key="game.id">

			<template slot="content">

				<div class="game-matchup text-center">
					<div class="game-team align-middle col-sm-4 d-inline-block">
						<font-awesome-icon icon="bath" size="4x"></font-awesome-icon>
						<div class="team-name">{{`${game.teams[0].name}`}}</div>
					</div>
					<div class="game-vs d-inline-block p-4 text-red">
						vs
					</div>
					<div class="game-team align-middle col-sm-4 d-inline-block">
						<font-awesome-icon icon="user-secret" size="4x"></font-awesome-icon>
						<div class="team-name">{{`${game.teams[1].name}`}}</div>
					</div>
				</div>

			</template>

			<template slot="bottom">
				<div class="text-center">
				<span class="info-box col-sm-3 d-inline-block">
					<div class="info-title">
						viewing type:
					</div>
					<div class="info-data">
						{{game.viewType.type || 'N/A'}}
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
import UtilityTopMenu from './utility/TopMenu.vue';
import UtilityDropDown from './utility/DropDown.vue';

// DUMMY DATA
import { games, viewingTypes, scoringTypes, teams } from '../../../exampleGameData.js';
// TO DELETE EVENTUALL

export default {
	// currently dummy data that will come from a call to the server, event the types below
	methods: {
		toggleFilterDisplay(event) {
			this.filterToggles[event.target.name] = !this.filterToggles[event.target.name];
		},
		applyFilter(filterName, id, value) {
			this.appliedFilters[filterName][id] = value;
		}
	},
	data() {
		return {
			games: games,
			viewingTypes: viewingTypes,
			// this should be dynamic based on the teams in games data, maybe a function called when component mounts to get teams
			teams: teams, 
			scoringTypes: scoringTypes,
			filterToggles: {
				teams: false,
				viewingTypes: false,
				scoringTypes: false,
			},
			appliedFilters: {
				teams: {},
				viewingTypes: {},
				scoringTypes: {}
			}
		}
	},
	components: { UtilityCard, UtilityTopMenu, UtilityDropDown }
}
</script>

<style>

.game-filter__btn {
	padding: .5rem;
	color: white;
	border-radius: 4px;
	margin: 1rem;
	min-width: 8rem;
}

.game-card {
	cursor: pointer;
}

.game-matchup {
	padding: 4rem;
}
.game-team {
	margin: 1rem 0;
}
.team-name {
	margin-top: 1rem;
	font-weight: 900;
	font-size: 1rem;
}

.game-vs {
	border-radius: 50%;
	background-color: #e0e1e2;
	border: 1px solid #e0e1e2;
	width: 5rem;
	height: 5rem;
	font-weight: 900;
	font-size: 1.75rem;
	box-shadow: 0px 4px 25px rgba(0, 0, 0, 0.1);

}

.info-box {
	padding: 1rem;
}

.info-title {
	margin-bottom: 1rem;
	font-weight: 900;
	font-size: 110%;
}

</style>
