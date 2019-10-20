<template>
	<div>
		<basic-card>
			<form class="mx-auto col-sm-8 p-5">
				<p>
					<label class="text-red mr-2">name:</label><br>
					<input class="p-2 w-100" type="text" v-model="name" placeholder="Mickey Mantle">
				</p>
				<p>
					<label class="text-red mr-2">email:</label><br>
					<input class="p-2 w-100" type="text" v-model="email" placeholder="mickey.mantle@gmail.com">
				</p>
				<p>
					<label class="text-red mr-2">password:</label><br>
					<input class="p-2 w-100" type="text" v-model="password">
				</p>
				<p>
					<label class="text-red mr-2">confirm password:</label><br>
					<input class="p-2 w-100" type="text" v-model="passwordConfirmation">
				</p>
			</form>
		</basic-card>
	</div>
</template>

<script>
	import BasicCard from '../utility/BasicCard.vue';
	export default {

		data() {
			return {
				name: null,
				email: null,
				password: null,
				passwordConfirmation: null
			}
		},

		components: { BasicCard }

	}
</script>

<style>

</style>