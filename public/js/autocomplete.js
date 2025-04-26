"use strict";

let debounceTimeout;

// Listen for input event on the movie_title input field
document.getElementById('movie_title').addEventListener('input', function () {
	// Get the current value of the input field
	const query = this.value;

	// Clear the previous timeout (to avoid making a request too soon)
	clearTimeout(debounceTimeout);

	// Set a new timeout to trigger after a 500ms delay
	debounceTimeout = setTimeout(() => {
		if (query.length >= 2) { // Trigger search only if length is at least 2 characters
			fetch(`/search-movie-title?query=${query}`)
				.then(response => response.json())
				.then(data => showSuggestions(data))
				.catch(error => console.error('Error:', error));
		}
	}, 800); // Delay time in milliseconds
});

// Function to display search results as suggestions
function showSuggestions(movies) {

	const movieTitleInput = document.getElementById('movie_title');
	const movieIdInput = document.getElementById('movie_id');
	const suggestionBox = document.getElementById('movie_title_suggestions');

	suggestionBox.innerHTML = ''; // Clear previous suggestions

	if (movies.length > 0) {
		movies.forEach(movie => {
			const div = document.createElement('div');
			div.classList.add('suggestion');
			div.textContent = movie.title;
			div.addEventListener('click', function () {
				// fill the inputs with the selected movie
				movieTitleInput.value = movie.title;
				movieIdInput.value = movie.id;

				suggestionBox.innerHTML = ''; // Clear suggestions
			});
			suggestionBox.appendChild(div);
		});
	} else {
		const div = document.createElement('div');
		div.classList.add('suggestion');
		div.textContent = 'No results found';
		suggestionBox.appendChild(div);
	}
}