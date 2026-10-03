document.addEventListener("DOMContentLoaded", () => {
    // --- Dark Mode ---
    const modeToggle = document.getElementById("mode-toggle");
    const savedMode = localStorage.getItem("crud-mode");
    const prefersDark = window.matchMedia("(prefers-color-scheme: dark)").matches;
    const useDarkMode = savedMode ? savedMode === "dark" : prefersDark;

    function setMode(isDark) {
        document.documentElement.classList.toggle("dark", isDark);
        if (modeToggle) {
            modeToggle.setAttribute("aria-label", `Switch to ${isDark ? "light" : "dark"} mode`);
            modeToggle.setAttribute("aria-pressed", String(isDark));
        }
        localStorage.setItem("crud-mode", isDark ? "dark" : "light");
    }

    setMode(useDarkMode);

    modeToggle?.addEventListener("click", () => {
        setMode(!document.documentElement.classList.contains("dark"));
    });

    // --- Shared Modal Helpers ---
    const MAX_LENGTH = 255;

    function openModal(modal) {
        if (!modal) return;
        modal.classList.remove("hidden");
        modal.classList.add("flex");
        modal.setAttribute("aria-hidden", "false");
    }

    function closeModal(modal) {
        if (!modal) return;
        modal.classList.add("hidden");
        modal.classList.remove("flex");
        modal.setAttribute("aria-hidden", "true");
    }

    function wireDismiss(modal, closeIds) {
        closeIds.forEach((id) => {
            document.getElementById(id)?.addEventListener("click", () => closeModal(modal));
        });
        modal?.addEventListener("click", (e) => {
            if (e.target === modal) closeModal(modal);
        });
    }

    function wireCounter(input, counter) {
        input?.addEventListener("input", (e) => {
            if (!counter) return;
            const length = e.target.value.length;
            counter.textContent = `${length} / ${MAX_LENGTH}`;
            const atLimit = length >= MAX_LENGTH;
            counter.classList.toggle("text-rose-500", atLimit);
            counter.classList.toggle("font-semibold", atLimit);
        });
    }

    // --- Create Modal ---
    const createModal = document.getElementById("add-task-modal");
    wireDismiss(createModal, ["close-modal-btn", "cancel-modal-btn"]);
    document.getElementById("open-modal-btn")?.addEventListener("click", () => {
        openModal(createModal);
        document.getElementById("mission")?.focus();
    });
    wireCounter(document.getElementById("mission"), document.getElementById("char-counter"));

    // --- Edit Modal ---
    const editModal = document.getElementById("edit-task-modal");
    const editIdField = document.getElementById("edit-mission-id");
    const editInput = document.getElementById("edit-mission");
    const editCounter = document.getElementById("edit-char-counter");

    wireDismiss(editModal, ["close-edit-modal-btn", "cancel-edit-modal-btn"]);
    wireCounter(editInput, editCounter);

    document.querySelectorAll("[data-edit-btn]").forEach((btn) => {
        btn.addEventListener("click", () => {
            const mission = btn.dataset.mission || "";
            if (editIdField) editIdField.value = btn.dataset.id || "";
            if (editInput) editInput.value = mission;
            if (editCounter) editCounter.textContent = `${mission.length} / ${MAX_LENGTH}`;
            openModal(editModal);
            editInput?.focus();
        });
    });

    // --- Checkbox Saves On Toggle ---
    document.querySelectorAll("[data-toggle-checkbox]").forEach((box) => {
        box.addEventListener("change", () => {
            box.closest("form")?.submit();
        });
    });

    // --- Escape Closes Both Modals ---
    document.addEventListener("keydown", (e) => {
        if (e.key !== "Escape") return;
        closeModal(createModal);
        closeModal(editModal);
    });
});