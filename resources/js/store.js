export const store = {
    state: {
		isAuthenticated: false,
		savedHighlights: []
	},
	mutations: {
		setUserAuthentication(state, authBool) {
			state.isAuthenticated = authBool;
		},
		setSavedHighlights(state, ...highlightsToSave) {
			state.savedHighlights = [...state.savedHighlights, highlightsToSave];
		}
	},
	getters: {
		getUserAuthenticated() {
			return this.state.isAuthenticated;
		},
		getSavedHighlights() {
			return this.state.savedHighlights;
		}
	},
	initializers: {
		initializeSavedHighlights() {
			if (this.state.isAuthenticated) {
				window.axios.get('/mlb/highlights/my-highlights', {idOnly: true})
					.then(resp => this.savedHighlights = resp.data)
					.catch(err => console.error('there was a problem initializing saved highlights', err));
			} else {
				this.savedHighlights = [];
			}
		}
	}
}