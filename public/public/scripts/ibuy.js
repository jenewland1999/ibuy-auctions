(() => {
  // Cache the DOM
  const DOM = document;

  // Store the Navbar elements
  const NAVBAR_GENERAL_DROPDOWN_BTN = DOM.querySelector(
    "#navbarDropdownToggleGeneral"
  );
  const NAVBAR_GENERAL_DROPDOWN = DOM.querySelector("#navbarDropdownGeneral");

  // Event listener for Navbar button
  NAVBAR_GENERAL_DROPDOWN_BTN.addEventListener("click", e => {
    e.preventDefault();
    NAVBAR_GENERAL_DROPDOWN.classList.toggle("ibuy__nav-dropdown-menu--shown");
  });

  // Store the Navbar elements
  const NAVBAR_CAT_DROPDOWN_BTN = DOM.querySelector(
    "#navbarDropdownToggleCategories"
  );
  const NAVBAR_CAT_DROPDOWN = DOM.querySelector("#navbarDropdownCategories");

  // Event listener for Navbar button
  NAVBAR_CAT_DROPDOWN_BTN.addEventListener("click", e => {
    e.preventDefault();
    NAVBAR_CAT_DROPDOWN.classList.toggle("ibuy__nav-dropdown-menu--shown");
  });

  // Check if user is in the auctions page
  if (
    document.location.pathname === "/auctions/" ||
    document.location.pathname === "/auctions/index.php"
  ) {
    // Store the categories select box and the clear button
    const SELECT = DOM.querySelector("#cat");
    const SELECT_BTN = DOM.querySelector("#btnCatClear");

    // Setup event listener for the clear button
    SELECT_BTN.addEventListener("click", e => {
      // Prevent any default actions
      e.preventDefault();

      // Loop through all the select fields and deselect them
      for (let i = 0; i < SELECT.options.length; i++) {
        SELECT.options[i].selected = false;
        SELECT.options[i].removeAttribute("selected");
      }

      // Re-select the default option
      SELECT.options[0].selected = true;
      SELECT.options[0].setAttribute("selected", "");
    });
  }
})();
