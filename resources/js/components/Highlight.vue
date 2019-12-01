<template>

	<utility-card>
		
		<template slot="content">
			<video width="100%" height="100%" controls>
				<source :src="highlight.playback_url" type="video/mp4">
			</video>
		</template>
		
		<template slot="bottom">
			<div class="text-center mt-4">
				<div class="h5 text-red">{{title}}</div>
				<div class="m-2 p-2">{{description}}</div>
				<button v-on:click="saveHighlight" class="btn btn-outline-primary--inherit mb-4">save</button>
			</div>
		</template>

	</utility-card>

</template>

<script>
	import UtilityCard from './utility/Card.vue';

	export default {
		props: {
			highlight: Object
		},
		methods: {
			saveHighlight() {
				window.axios.post('/mlb/highlights', this.highlight)
					.then(resp => console.log('Saved'))
					.catch(err => console.log('error saving the highlight', err));
			}
		},
		computed: {
			title() {
				return this.highlight.title.toLowerCase();
			},
			description() {
				return this.highlight.description.toLowerCase();
			}
		},
		components: { UtilityCard }

	}
</script>

<style>

</style>