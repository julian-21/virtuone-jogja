// Wait for the DOM to be fully loaded before executing JavaScript
document.addEventListener('DOMContentLoaded', function() {
  // Select the header element
  const header = document.querySelector("header");

  // Function to handle the scroll event
  function handleScroll() {
    if (window.scrollY > 0) {
      // Add the "shadow" class when scrolling down
      header.classList.add("shadow");
    } else {
      // Remove the "shadow" class when scrolling to the top
      header.classList.remove("shadow");
    }
  }

  // Add a scroll event listener to the window
  window.addEventListener("scroll", handleScroll);
  
  // Call the handleScroll function initially to set the initial state
  handleScroll();
});
