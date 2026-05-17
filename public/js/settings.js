function showSettingsTab(tabId, button) {

    document
        .querySelectorAll(".settings-tab-content")
        .forEach(tab => {
            tab.style.display = "none";
        });

    document
        .querySelectorAll(".settings-tab-button")
        .forEach(btn => {
            btn.classList.remove("active-tab");
        });

    document
        .getElementById(tabId)
        .style.display = "block";

    button.classList.add("active-tab");

}