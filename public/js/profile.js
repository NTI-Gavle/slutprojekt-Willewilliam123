function toggleEditProfile() {

    const form = document.getElementById(
        "edit-profile-form"
    );

    form.style.display =
        form.style.display === "none"
        ? "block"
        : "none";

}



function showProfileTab(tabId, button) {

    // HIDE ALL TABS

    document
        .querySelectorAll(".profile-tab-content")
        .forEach(tab => {
            tab.style.display = "none";
        });



    // REMOVE ACTIVE STATE

    document
        .querySelectorAll(".profile-tab-button")
        .forEach(btn => {
            btn.classList.remove("active-tab");
        });



    // SHOW SELECTED TAB

    document.getElementById(tabId)
        .style.display = "block";



    // ACTIVATE BUTTON

    button.classList.add("active-tab");

}