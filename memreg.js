window.addEventListener("scroll", function() {
    var header = document.querySelector("header");
    var footer = document.querySelector("footer");
    var scrollPosition = window.scrollY;
  
    // Show/hide header based on scroll position
    if (scrollPosition > 100) {
      header.style.top = "-80px"; // Hide header
    } else {
      header.style.top = "0"; // Show header
    }
  
    // Show footer when scrolled to the bottom of the page
    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
      footer.style.display = "block"; // Show footer
    } else {
      footer.style.display = "none"; // Hide footer
    }
  });
  