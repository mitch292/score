<template>

</template>

<script>
export default {
	
	data() {
		return {
			games: [],
			fetchingGames: false
		}
	},

	methods: {
		fetchMyGames: function() {
			this.fetchingGames = true;
			window.axios.get('/mlb/game/my-games')
				.then(resp => {
					console.log('resp', resp)
					this.fetchingGames = false;
					this.games = resp.data
				})
				.catch(err =>{
					this.fetchingGames = true;
					console.error('error fetching user\'s games', err)
				})
		}
	},

	mounted() {
		this.fetchMyGames();
	}
}
</script>

<style>

</style>