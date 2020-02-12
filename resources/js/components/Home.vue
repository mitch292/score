<template>
	<div class="row">

		<div class="text-center mx-auto p-1">
			
			<basic-card :isWide="true">
				<div class="row p-5">
					<div class="col-12 col-sm-4">
						<img class="homepage-image" alt="confused-human" src="/images/homepage/cherry-delivery.png">
					</div>
					<div class="col-12 col-sm-7 h3 text-red mb-5 mt-5">ever forget the details of your favorite baseball games?</div>
				</div>
			</basic-card>

			<basic-card :isWide="true">
				<div class="row p-5">
					<div class="col-12 col-sm-7 h3 text-red mb-5 mt-5">that's okay, stop the frustration.</div>
					<div class="col-12 col-sm-4">
						<img class="homepage-image" alt="frustrated-human" src="/images/homepage/cherry-fatal-error.png">
					</div>
				</div>
			</basic-card>

			<basic-card :isWide="true">
				<div class="row p-5">
					<div class="col-12 col-sm-4">
						<img class="homepage-image" alt="strong-human" src="/images/homepage/cherry-upgrade.png">
					</div>
					<div class="col-sm-7 h3 text-red mb-5 mt-5">find your game, check out the details, browse others.</div>
				</div>
			</basic-card>

			<basic-card :isWide="true">
				<div class="row p-5">
					<div class="col-12 col-sm-7 h3 text-red mb-5 mt-5">save highlights, save games, cherish memories</div>
					<div class="col-12 col-sm-4">
						<img class="homepage-image" alt="happy-human" src="/images/homepage/cherry-success.png">
					</div>
				</div>
			</basic-card>

		</div>

	</div>
</template>

<script>
	import BasicCard from './utility/BasicCard.vue';
	export default {
		components: { BasicCard }
	}
</script>

<style>
	.homepage-image {
		height: 250px;
	}
</style>
