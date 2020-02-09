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
				<span v-if="$root.$data.sharedState.isAuthenticated">
					<span v-if="$root.$data.sharedState.savedHighlights.indexOf(highlight.id) >= 0"> 
						<button v-on:click="removeHighlight" class="btn btn-outline-primary--inherit mb-4">remove save</button>
					</span>
					<span v-else>
						<button v-on:click="saveHighlight" class="btn btn-primary mb-4">save</button>
					</span>
				</span>
			</div>
		</template>

	</utility-card>

</template>

<script>
	import UtilityCard from './utility/Card.vue';
	import { store } from '../store.js';
	import { fetchUserHighlightIds, fireSweetAlert } from '../global.js';


	export default {
		props: {
			highlight: Object
		},
		methods: {
			saveHighlight() {
				window.axios.post(route('mlb.highlights.saveHighlight'), this.highlight)
					.then(resp => {
						fireSweetAlert({title: 'highlight saved'});
						fetchUserHighlightIds().then(resp => store.mutations.setSavedHighlights(store.state, resp.data))
					})
					.catch(err => console.log('error saving the highlight', err));
			},
			removeHighlight() {
				window.axios.delete(route('mlb.highlights.deleteHighlight'), {data: this.highlight})
					.then(resp => {
						fetchUserHighlightIds().then(resp => {
							fireSweetAlert({title: 'highlight removed'});
							store.mutations.setSavedHighlights(store.state, resp.data)
						});
					})
					.catch(err => console.error('error removing the highlight from your profile', err));
			},
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