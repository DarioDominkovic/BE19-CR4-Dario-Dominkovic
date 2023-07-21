document.addEventListener("DOMContentLoaded", function () {
	const loadingOverlay = document.querySelector(".loading-overlay");

	document.querySelector("form").addEventListener("submit", function () {
		loadingOverlay.style.display = "flex";
	});
});
