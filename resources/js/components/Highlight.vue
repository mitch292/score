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