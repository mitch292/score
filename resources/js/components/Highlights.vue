<template>
	<div v-if="fetchingGames">
		<utility-loading></utility-loading>
	</div>
	
	<div v-else>

	</div>
</template>

<script>
	export default {
		props: {
			gamePk: String
		},
		data() {
			return {
				fetchingHighlights: true,
				hightlights: []
			}
		},
		methods: {
			getHighlights: function(gamePk) {
				this.fetchingGames = true;
				window.axios.get(`mlb/highlights/${gamePk}`)
					.then(resp => {
						console.log('the response', resp)
						this.fetchingHighlights = false;
						this.highlights = resp.data;
					})
					.catch(err => {
						this.fetchingGames = false;
						console.error('err', err)
					})
			}
		},
		mounted() {
			this.getHighlights(this.gamePk);
		},

	}
</script>

<style>

</style>