<template>
	<div v-if="fetchingHighlights">
		<utility-loading></utility-loading>
	</div>
	
	<div v-else>
		<div v-for="highlight in highlights" :key="highlight.id">
			<score-highlight v-on:highlightRemoved="fetchHighlights" :highlight="highlight"></score-highlight>
		</div>
	</div>
</template>

<script>
	import UtilityLoading from './utility/Loading.vue';
	import ScoreHighlight from './Highlight.vue';

	export default {
		data() {
			return {
				fetchingHighlights: true,
				highlights: []
			};
		},
		methods: {
			fetchHighlights() {
				window.axios.get(route('mlb.highlights.fetchMyHighlights'))
					.then(resp => {
						this.fetchingHighlights = false;
						this.highlights = resp.data;
					})
					.catch(err => {
						this.fetchingHighlights = false;
						console.error('there was an error fetching the highlights', err);
					});

			}
		},
		mounted() {
			this.fetchHighlights();
		},
		components: { UtilityLoading, ScoreHighlight }

	}

</script>

<style>

</style>