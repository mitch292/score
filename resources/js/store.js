import { fetchUserHighlightIds } from './global.js';
export const store = {
    state: {
		isAuthenticated: false,
		savedHighlights: []
	},
	mutations: {
		setUserAuthentication(state, authBool) {
			state.isAuthenticated = authBool;
		},
		setSavedHighlights(state, savedHighlights, appendMode=false) {
			state.savedHighlights = appendMode ? [...state.savedHighlights, ...savedHighlights] : savedHighlights;
		}
	},
	getters: {
		getUserAuthenticated() {
			return this.state.isAuthenticated;
		},
		getSavedHighlights(state) {
			return 
		}
	},
	initializers: {
		initializeSavedHighlights(state) {
			if (state.isAuthenticated) {
				fetchUserHighlightIds().then(resp => state.savedHighlights = resp.data);
			} else {
				state.savedHighlights = [];
			}
		}
	}
}