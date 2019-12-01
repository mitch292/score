<template>
	<div v-if="fetchingHighlights">
		<utility-loading></utility-loading>
	</div>
	
	<div v-else>
		<utility-card v-for="highlight in formattedHighlights" :key="highlight.id">
			<template slot="content">
				<video width="100%" height="100%" controls>
					<source :src="highlight.playback_url" type="video/mp4">
				</video>
			</template>
			<template slot="bottom">
				<div class="text-center mt-4">
					<div class="h5 text-red">{{highlight.title}}</div>
					<div class="m-2 p-2">{{highlight.description}}</div>
				</div>
			</template>
		</utility-card>

	</div>
</template>

<script>
	import UtilityLoading from './utility/Loading.vue';
	import UtilityCard from './utility/Card.vue';
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
		computed: {
			formattedHighlights() {
				return this.highlights.map(highlight => {
					highlight.title = highlight.title.toLowerCase();
					highlight.description = highlight.description.toLowerCase();
					return highlight;
				})
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
		components: { UtilityLoading, UtilityCard }

	}
</script>

<style>

</style>