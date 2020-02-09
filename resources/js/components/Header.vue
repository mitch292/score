<template>
  <div class="header">
	<nav class="navbar w-100 navbar-expand-lg navbar-light">
	  <a class="navbar-brand" href="#">
		<router-link to='/' tag="div" exact>
		  <span class="header__icon">
			<font-awesome-icon icon="baseball-ball" size="3x" />
			<span class="header__text">score</span>
		  </span>
		</router-link>
	  </a>
	  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
		<span class="navbar-toggler-icon"></span>
	  </button>
	  <div class="collapse navbar-collapse pt-3" id="navbarNav">
		<ul class="navbar-nav">
			<li class="nav-item" v-if="$root.$data.sharedState.isAuthenticated">
				<router-link to='/games'>
					<a class="nav-link" href="#">my games</a>
				</router-link>
			</li>
			<li class="nav-item" v-if="$root.$data.sharedState.isAuthenticated">
				<router-link to='/my-highlights'>
					<a class="nav-link" href="#">my highlights</a>
				</router-link>
			</li>
			<li class="nav-item">
				<router-link to='/schedule'>
					<a class="nav-link" href="#">mlb schedule</a>
				</router-link>
			</li>
			<li class="nav-item d-list-item d-sm-none" v-if="$root.$data.sharedState.isAuthenticated">
				<a v-on:click="this.logout" class="text-red" href="#">logout</a>
			</li>
			<li class="nav-item d-list-item d-sm-none" v-if="!$root.$data.sharedState.isAuthenticated">
				<router-link to='/login'>
					<a class="nav-link" href="#">login</a>
				</router-link>
			</li>
			<li class="nav-item d-list-item d-sm-none" v-if="!$root.$data.sharedState.isAuthenticated">
				<router-link to='/register'>
					<a class="nav-link" href="#">sign up</a>
				</router-link>
			</li>
		</ul>
	  </div>
		<div class="d-none d-sm-block" v-if="$root.$data.sharedState.isAuthenticated">
			<a v-on:click="this.logout" class="text-translucent" href="#">logout</a>
		</div>
		<div class="d-none d-sm-block" v-if="!$root.$data.sharedState.isAuthenticated">
			<router-link to='/login'>
				<a class="nav-link text-translucent" href="#">login</a>
			</router-link>
		</div>
		<div class="d-none d-sm-block" v-if="!$root.$data.sharedState.isAuthenticated">
			<router-link to='/register'>
				<button class="btn btn-outline-primary">sign up</button>
			</router-link>
		</div>
	</nav>
  </div>
</template>

<script>
	import { store } from '../store.js';
	import { fireSweetAlert } from '../global.js';
	export default {
		methods: {
			logout: function() {
				window.axios.post(route('api.auth.logout'))
					.then(res => {
						fireSweetAlert({title: 'logged out'});
						store.mutations.setUserAuthentication(store.state, false)
						this.$router.push('/').catch(err => {});
					})
					.catch(err => console.error('There was a problem logging out the user', err))
			},
		}
	}

</script>

<style>

</style>