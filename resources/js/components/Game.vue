<template>
	<div class="game-matchup text-center">

		<div class="game-team align-middle col-sm-4 d-inline-block">
			<img class="team-logo" :src="away.quickAccess.path_to_logo">
			<div class="team-name">{{`${away.quickAccess.prefix} ${away.quickAccess.name}`}}</div>
			<div v-if="!quickAccessOnly" class="text-red mt-1">{{ `${away.leagueRecord.wins} - ${away.leagueRecord.losses} (${away.leagueRecord.pct})` }}</div>
		</div>
		<div class="game-vs d-inline-block p-4 text-red">
			at
		</div>
		<div class="game-team align-middle col-sm-4 d-inline-block">
			<img class="team-logo" :src="home.quickAccess.path_to_logo">
			<div class="team-name">{{`${home.quickAccess.prefix} ${home.quickAccess.name}`}}</div>
			<div v-if="!quickAccessOnly" class="text-red mt-1">{{ `${home.leagueRecord.wins} - ${home.leagueRecord.losses} (${home.leagueRecord.pct})` }}</div>
		</div>

		<div class="d-none d-md-block">
			<box-summary 
				:gameData="game.gameData"
				:homeTeam="home.quickAccess.name"
				:awayTeam="away.quickAccess.name"

			>
			</box-summary>
		</div>

	</div>
</template>

<script>
	import BoxSummary from './BoxSummary.vue';

	export default {
		props: {
			home: Object,
			away: Object,
			game: Object,
			quickAccessOnly: {
				type: Boolean,
				default: false
			}
		},
		components: { BoxSummary }
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
	padding: 2rem;
}

.game-team {
	margin: 1rem 0;
}

.team-name {
	margin-top: 1rem;
	font-weight: 900;
	font-size: 1rem;
}

.team-logo {
	width: 8rem;
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
	margin: 0 2rem;
}
</style>
