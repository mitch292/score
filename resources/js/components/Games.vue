<template>

	<div>

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
						{{game.viewType || 'N/A'}}
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
						{{game.scoringType}}
					</div>
				</span>
				</div>
			
			</template>

		</utility-card>

	</div>

</template>

<script>
import utilityCard from './utility/Card.vue';

export default {
	// currently dummy data that will come from a call to the server
	data() {
		return {
			games: require('../../../exampleGameData.js').data
		}
	},
	mounted() {
		console.log('the games are mounted');
	},
	components: {utilityCard}
}
</script>

<style>

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
