<template>
	<div class="game-matchup text-center">
		<div class="game-team align-middle col-sm-4 d-inline-block">
			<font-awesome-icon icon="bath" size="4x"></font-awesome-icon>
			<div class="team-name">{{away.name}}</div>
		</div>
		<div class="game-vs d-inline-block p-4 text-red">
			vs
		</div>
		<div class="game-team align-middle col-sm-4 d-inline-block">
			<font-awesome-icon icon="user-secret" size="4x"></font-awesome-icon>
			<div class="team-name">{{home.name}}</div>
		</div>
	</div>
</template>

<script>
export default {
	props: {
		home: Object,
		away: Object
	}
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
</style>
