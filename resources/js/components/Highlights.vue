<template>
	<div v-if="fetchingHighlights">
		<utility-loading></utility-loading>
	</div>
	
	<div v-else>
		<div v-for="highlight in highlights" :key="highlight.id">
			<score-highlight :highlight="highlight"></score-highlight>
		</div>
	</div>
	
</template>

<script>
	import UtilityLoading from './utility/Loading.vue';
	import ScoreHighlight from './Highlight.vue';

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