<div
    id="edit-task-modal"
    class="fixed inset-0 z-50 hidden items-center justify-center bg-slate-900/40 p-4 backdrop-blur-md"
    aria-hidden="true"
>
    <div class="w-full max-w-md rounded-2xl border border-white/60 bg-white/80 p-6 shadow-2xl backdrop-blur-xl dark:border-slate-700/50 dark:bg-slate-900/80">

        <div class="mb-5 flex items-center justify-between">
            <h2 class="text-lg font-semibold tracking-tight text-slate-900 dark:text-slate-100">
                Edit Mission
            </h2>
            <button
                type="button"
                id="close-edit-modal-btn"
                aria-label="Close"
                class="rounded-lg p-2 text-slate-500 transition-colors hover:bg-slate-900/5 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-900/20 dark:text-slate-400 dark:hover:bg-white/10 dark:hover:text-slate-100">
                <i class="fa-solid fa-xmark text-sm"></i>
            </button>
        </div>

        <form method="POST" action="components/updateMission.php" class="space-y-4">
            <input type="hidden" name="id" id="edit-mission-id">

            <div>
                <div class="mb-1.5 flex items-center justify-between">
                    <label for="edit-mission" class="text-sm font-medium text-slate-700 dark:text-slate-300">
                        Mission Description
                    </label>
                    <span id="edit-char-counter" class="font-mono text-xs tabular-nums text-slate-400 dark:text-slate-500">
                        0 / 255
                    </span>
                </div>
                <textarea
                    id="edit-mission"
                    name="mission"
                    rows="4"
                    maxlength="255"
                    required
                    class="w-full resize-none rounded-xl border border-slate-300/80 bg-white/70 px-3.5 py-2.5 text-sm text-slate-900 shadow-sm transition-shadow focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-900/15 dark:border-slate-600/70 dark:bg-slate-950/60 dark:text-slate-100 dark:focus:border-slate-400 dark:focus:ring-slate-300/20"
                ></textarea>
            </div>

            <div>
                <label for="edit-status" class="mb-1.5 block text-sm font-medium text-slate-700 dark:text-slate-300">
                    Status
                </label>
                <select
                    id="edit-status"
                    name="status"
                    class="w-full rounded-xl border border-slate-300/80 bg-white/70 px-3.5 py-2.5 text-sm text-slate-900 shadow-sm transition-shadow focus:border-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-900/15 dark:border-slate-600/70 dark:bg-slate-950/60 dark:text-slate-100">
                    <option value="incomplete">Incomplete</option>
                    <option value="complete">Complete</option>
                </select>
            </div>

            <div class="flex gap-3 pt-1">
                <button
                    type="button"
                    id="cancel-edit-modal-btn"
                    class="flex-1 rounded-xl border border-slate-300/80 px-4 py-2.5 text-sm font-medium text-slate-700 transition-colors hover:bg-slate-900/5 focus:outline-none focus:ring-2 focus:ring-slate-900/20 dark:border-slate-600/70 dark:text-slate-300 dark:hover:bg-white/10">
                    Cancel
                </button>
                <button
                    type="submit"
                    class="flex-1 rounded-xl bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white shadow-lg shadow-slate-900/20 transition-all hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900/30 active:scale-[0.98] dark:bg-slate-100 dark:text-slate-900 dark:shadow-none dark:hover:bg-white">
                    Save Changes
                </button>
            </div>
        </form>
    </div>
</div>