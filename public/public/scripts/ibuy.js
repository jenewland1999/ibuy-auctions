$(document).ready(() => {
  // Initialize bsCustomFileInput
  bsCustomFileInput.init();

  // Initialise FB SDK
  window.fbAsyncInit = function() {
    FB.init({
      appId: "514703019394466",
      autoLogAppEvents: true,
      xfbml: true,
      version: "v5.0"
    });
  };

  // Cache the DOM
  const DOM = document;

  // Check if the admin part of the nav exists
  if (DOM.querySelector("#navbarDropdownToggleGeneral") !== null) {
    // Store the Navbar elements
    const NAVBAR_GENERAL_DROPDOWN_BTN = DOM.querySelector(
      "#navbarDropdownToggleGeneral"
    );
    const NAVBAR_GENERAL_DROPDOWN = DOM.querySelector("#navbarDropdownGeneral");

    // Event listener for Navbar button
    NAVBAR_GENERAL_DROPDOWN_BTN.addEventListener("click", e => {
      e.preventDefault();
      NAVBAR_GENERAL_DROPDOWN.classList.toggle(
        "ibuy__nav-dropdown-menu--shown"
      );
    });
  }

  // Check if the more categories part of the nav exists
  if (DOM.querySelector("#navbarDropdownToggleCategories") !== null) {
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
  }

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

  // If the user is on a page that includes reviews setup review share button handlers
  if (document.location.pathname === "/auctions/auction.php") {
    const REVIEWS_SHARE_FB = DOM.querySelectorAll(
      'button[data-target="fb-share-btn"]'
    );
    for (const REVIEW_SHARE_FB of REVIEWS_SHARE_FB) {
      REVIEW_SHARE_FB.addEventListener("click", e => {
        FB.ui(
          {
            method: "share",
            href: window.location.href + "#" + REVIEW_SHARE_FB.offsetParent.id,
            quote: `${REVIEW_SHARE_FB.dataset.author} gave ${REVIEW_SHARE_FB.dataset.reviewee} a ${REVIEW_SHARE_FB.dataset.rating} star rating on iBuy Auctions. Visit today and leave your own review.`
          },
          function(response) {}
        );
      });
    }

    const REVIEWS_SHARE_TW = DOM.querySelectorAll(
      'a[data-target="tw-share-btn"]'
    );

    for (const REVIEW_SHARE_TW of REVIEWS_SHARE_TW) {
      REVIEW_SHARE_TW.href +=
        "&url=" +
        window.location.href +
        "%23" +
        REVIEW_SHARE_TW.offsetParent.id;
    }
  }
});
