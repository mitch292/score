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

	import ScoreHighlight from './Highlight.vue';

	export default {
		data() {
			return {
				fetchHighlights: true,
				highlights: []
			};
		},
		methods: {
			fetchHighlights() {
				window.axios.get('/mlb/highlights/my-highlights')
					.then(resp => {
						this.fetchHighlights = false;
						this.highlights = resp.data;
					})
					.catch(err => {
						this.fetchHighlights = false;
						console.error('there was an error fetching the highlights', err);
					});

			}
		},
		mounted() {
			this.fetchHighlights();
		},
		components: { ScoreHighlights }

	}

</script>

<style>

</style>