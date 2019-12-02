export const fetchUserHighlightIds = () => {
	return window.axios.get('/mlb/highlights/my-highlights', {params: {idOnly: true}})
		.then(resp => resp)
		.catch(err => {
			console.error('there was a problem initializing saved highlights', err)
			return [];
		});
}