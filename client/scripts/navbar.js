function toggleMenu() {
    const menu = document.getElementById("navMenu");
    menu.classList.toggle("open");
  }

  function closeMenu() {
    const menu = document.getElementById("navMenu");
    const dropdown = document.getElementById("dropdown");
    menu.classList.remove("open");
    dropdown.classList.remove("open");
  }

  function toggleDropdown() {
    const dropdown = document.getElementById("dropdown");
    dropdown.classList.toggle("open");
  }