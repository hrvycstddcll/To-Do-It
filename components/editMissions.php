<div
    id="edit-task-modal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-neutral-950/50 p-4"
    aria-hidden="true"
>
    <div class="w-full max-w-md border border-neutral-900/15 bg-white p-6 dark:border-white/15 dark:bg-neutral-900">

        <div class="mb-5 flex items-center justify-between">
            <h2 class="text-base font-semibold text-neutral-900 dark:text-white">Edit Mission</h2>
            <button
                type="button"
                id="close-edit-modal-btn"
                aria-label="Close"
                class="-m-1 p-2 text-neutral-400 transition-colors hover:text-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900/30 dark:hover:text-white dark:focus:ring-white/30">
                <i class="fa-solid fa-xmark text-xs"></i>
            </button>
        </div>

        <form method="POST" action="components/updateMission.php" class="space-y-4">
            <input type="hidden" name="id" id="edit-mission-id">

            <div>
                <div class="mb-1.5 flex items-center justify-between">
                    <label for="edit-mission" class="text-sm text-neutral-700 dark:text-neutral-300">
                        Mission
                    </label>
                    <span id="edit-char-counter" class="font-mono text-xs tabular-nums text-neutral-400 dark:text-neutral-500">
                        0 / 255
                    </span>
                </div>
                <textarea
                    id="edit-mission"
                    name="mission"
                    rows="4"
                    maxlength="255"
                    required
                    class="w-full resize-none border border-neutral-900/20 bg-white px-3 py-2 text-sm text-neutral-900 focus:border-neutral-900 focus:outline-none focus:ring-1 focus:ring-neutral-900 dark:border-white/20 dark:bg-neutral-950 dark:text-neutral-100 dark:focus:border-white dark:focus:ring-white"
                ></textarea>
            </div>

            <div class="flex gap-2 pt-1">
                <button
                    type="button"
                    id="cancel-edit-modal-btn"
                    class="flex-1 border border-neutral-900/20 px-4 py-2 text-sm font-medium text-neutral-700 transition-colors hover:bg-neutral-900/5 focus:outline-none focus:ring-1 focus:ring-neutral-900 dark:border-white/20 dark:text-neutral-300 dark:hover:bg-white/5 dark:focus:ring-white">
                    Cancel
                </button>
                <button
                    type="submit"
                    class="flex-1 bg-neutral-900 px-4 py-2 text-sm font-medium text-white transition-colors hover:bg-neutral-700 focus:outline-none focus:ring-1 focus:ring-neutral-900 dark:bg-neutral-100 dark:text-neutral-900 dark:hover:bg-white dark:focus:ring-white">
                    Save
                </button>
            </div>
        </form>
    </div>
</div>