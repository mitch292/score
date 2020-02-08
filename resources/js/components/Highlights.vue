<template>
	<div v-if="fetchingHighlights">
		<utility-loading></utility-loading>
	</div>
	
	<div v-else>
		<div v-if="showSaveButton(gamePk)" class="text-center mx-auto">
			<button class="btn w-25 btn-primary" v-on:click="saveGame(gamePk)">save game</button>
		</div>
		<div v-for="highlight in highlights" :key="highlight.id">
			<score-highlight :highlight="highlight"></score-highlight>
		</div>
	</div>
	
</template>

<script>
	import Swal from 'sweetalert2';
	import UtilityLoading from './utility/Loading.vue';
	import ScoreHighlight from './Highlight.vue';
	import { store } from '../store.js';
	import { fetchUserGameIds } from '../global.js';

	export default {
		props: {
			gamePk: String
		},
		data() {
			return {
				fetchingHighlights: true,
				highlights: []
			}
		},
		methods: {
			getHighlights: function(gamePk) {
				this.fetchingGames = true;
				window.axios.get(`mlb/highlights/${gamePk}`)
					.then(resp => {
						this.fetchingHighlights = false;
						this.highlights = resp.data;
					})
					.catch(err => {
						this.fetchingHighlights = false;
						console.error('err', err)
					})
			},
			saveGame(gamePk) {
				window.axios.post('mlb/game/save', {external_id: gamePk})
					.then(resp => {
						Swal.fire({
							position: 'top',
							icon: 'success',
							title: 'game saved',
							showConfirmButton: false,
							timer: 1250,
							toast: true,
						})
						fetchUserGameIds().then(resp => store.mutations.setSavedGames(store.state, resp.data))
					})
					.catch(err => console.error('problem saving the game', err))
			},
			showSaveButton(gamePk) {
				return (
					this.$root.$data.sharedState.isAuthenticated 
					&& 
					!!!this.$root.$data.sharedState.savedGames.indexOf(gamePk)
				);
			}
		},
		mounted() {
			this.getHighlights(this.gamePk);
		},
		components: { UtilityLoading, ScoreHighlight }

	}
</script>

<style>

</style>