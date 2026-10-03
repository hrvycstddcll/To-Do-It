<?php require_once __DIR__ . '/components/listMissions.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>To-Do-It</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: "class"
        };
    </script>
    <script src="script/index.js" defer></script>
</head>

<body class="min-h-screen bg-slate-100 text-slate-900 transition-colors duration-300 dark:bg-slate-950 dark:text-slate-100">
    <div class="pointer-events-none fixed inset-0 -z-10 bg-[radial-gradient(45rem_45rem_at_15%_-10%,rgba(15,23,42,0.07),transparent),radial-gradient(40rem_40rem_at_100%_0%,rgba(15,23,42,0.05),transparent)] dark:bg-[radial-gradient(45rem_45rem_at_15%_-10%,rgba(148,163,184,0.10),transparent),radial-gradient(40rem_40rem_at_100%_0%,rgba(148,163,184,0.07),transparent)]">
    </div>

    <main class="flex min-h-screen items-center justify-center px-[5vw] py-6 sm:py-10">
        <section class="flex h-[90vh] w-full max-w-2xl flex-col overflow-hidden rounded-3xl border border-white/60 bg-white/70 shadow-2xl shadow-slate-900/5 backdrop-blur-xl dark:border-slate-700/40 dark:bg-slate-900/60 dark:shadow-black/20">

            <header class="shrink-0 border-b border-slate-900/5 px-6 py-6 dark:border-white/5 sm:px-8">
                <div class="flex items-start justify-between gap-4">
                    <div>
                        <p class="bg-gradient-to-r from-slate-900 via-slate-700 to-slate-500 bg-clip-text text-3xl font-bold tracking-tight text-transparent dark:from-white dark:via-slate-300 dark:to-slate-500">
                            To-Do-It
                        </p>
                        <h1 class="mt-1 text-sm font-medium text-slate-500 dark:text-slate-400">
                            <?= count($tasks) ?> mission<?= count($tasks) === 1 ? '' : 's' ?> on your list
                        </h1>
                    </div>
                    <button
                        id="mode-toggle"
                        type="button"
                        aria-label="Switch to dark mode"
                        aria-pressed="false"
                        class="rounded-xl border border-slate-900/10 p-2.5 text-slate-600 transition-colors hover:bg-slate-900/5 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-900/20 dark:border-white/10 dark:text-slate-300 dark:hover:bg-white/10 dark:hover:text-white">
                        <i class="fa-solid fa-moon block dark:hidden"></i>
                        <i class="fa-solid fa-sun hidden dark:block"></i>
                    </button>
                </div>
            </header>

            <div id="content-area" class="contentArea flex-1 space-y-2.5 overflow-y-auto px-4 py-5 sm:px-6">
                <?php if (empty($tasks)): ?>
                    <div class="flex h-full flex-col items-center justify-center gap-3 text-center">
                        <span class="flex h-14 w-14 items-center justify-center rounded-2xl border border-slate-900/5 bg-white/60 text-xl text-slate-400 shadow-sm dark:border-white/5 dark:bg-white/5">
                            <i class="fa-regular fa-list-check"></i>
                        </span>
                        <p class="text-sm font-medium text-slate-600 dark:text-slate-300">Nothing here yet</p>
                        <p class="max-w-[16rem] text-sm text-slate-400 dark:text-slate-500">
                            Add a mission and it will show up in this list.
                        </p>
                    </div>
                <?php else: ?>
                    <?php foreach ($tasks as $task): ?>
                        <?php $isDone = $task['status'] === 'complete'; ?>
                        <div class="group flex items-center gap-3 rounded-2xl border <?= $isDone ? 'border-slate-900/5 bg-white/30 opacity-70 dark:border-white/5 dark:bg-white/[0.03]' : 'border-white/70 bg-white/60 shadow-sm shadow-slate-900/5 hover:-translate-y-px hover:shadow-md hover:shadow-slate-900/10 dark:border-white/10 dark:bg-white/[0.06] dark:hover:border-white/20' ?> px-4 py-3 transition-all duration-200">

                            <form method="POST" action="components/toggleStatus.php" class="contents">
                                <input type="hidden" name="id" value="<?= (int)$task['id'] ?>">
                                <input type="hidden" name="status" value="<?= $isDone ? 'incomplete' : 'complete' ?>">
                                <input
                                    type="checkbox"
                                    id="task-<?= (int)$task['id'] ?>"
                                    data-toggle-checkbox
                                    <?= $isDone ? 'checked' : '' ?>
                                    aria-label="Mark <?= htmlspecialchars($task['task']) ?> as <?= $isDone ? 'incomplete' : 'complete' ?>"
                                    class="peer h-5 w-5 shrink-0 cursor-pointer appearance-none rounded-md border-2 border-slate-300 bg-white/70 transition-all checked:border-slate-900 checked:bg-slate-900 focus:outline-none focus-visible:ring-2 focus-visible:ring-slate-900/30 focus-visible:ring-offset-1 dark:border-slate-600 dark:bg-slate-950/60 dark:checked:border-slate-100 dark:checked:bg-slate-100 dark:focus-visible:ring-slate-300/40 dark:focus-visible:ring-offset-slate-900 checked:after:absolute checked:after:inset-0 checked:after:m-auto checked:after:h-2.5 checked:after:w-2.5 checked:after:-translate-y-px checked:after:content-[''] checked:after:bg-white checked:after:clip-path polygon(14% 44%,0 65%,50% 100%,100% 16%,80% 0%,43% 62%) dark:checked:after:bg-slate-900">
                            </form>

                            <label for="task-<?= (int)$task['id'] ?>" class="min-w-0 flex-1 cursor-pointer select-none">
                                <span class="block break-words text-sm font-medium text-slate-800 dark:text-slate-100"><?= htmlspecialchars($task['task']) ?></span>
                                <span class="mt-0.5 block text-xs text-slate-400 dark:text-slate-500">
                                    <?= htmlspecialchars(date('M j, Y \a\t g:ia', strtotime($task['created_at']))) ?>
                                </span>
                            </label>

                            <span class="hidden shrink-0 rounded-full border px-2.5 py-1 text-[0.65rem] font-semibold uppercase tracking-wide sm:inline-block <?= $isDone ? 'border-slate-900 bg-slate-900 text-white dark:border-slate-100 dark:bg-slate-100 dark:text-slate-900' : 'border-slate-300 text-slate-500 dark:border-slate-600 dark:text-slate-400' ?>">
                                <?= $isDone ? 'Done' : 'Open' ?>
                            </span>

                            <div class="flex shrink-0 items-center gap-1">
                                <button
                                    type="button"
                                    data-edit-btn
                                    data-id="<?= (int)$task['id'] ?>"
                                    data-mission="<?= htmlspecialchars($task['task']) ?>"
                                    data-status="<?= htmlspecialchars($task['status']) ?>"
                                    aria-label="Edit <?= htmlspecialchars($task['task']) ?>"
                                    class="rounded-lg p-2 text-slate-400 transition-colors hover:bg-slate-900/5 hover:text-slate-900 focus:outline-none focus:ring-2 focus:ring-slate-900/20 dark:hover:bg-white/10 dark:hover:text-slate-100">
                                    <i class="fa-solid fa-pen text-xs"></i>
                                </button>

                                <form method="POST" action="components/deleteMission.php" class="contents" onsubmit="return confirm('Delete this mission?')">
                                    <input type="hidden" name="id" value="<?= (int)$task['id'] ?>">
                                    <button
                                        type="submit"
                                        aria-label="Delete <?= htmlspecialchars($task['task']) ?>"
                                        class="rounded-lg p-2 text-slate-400 transition-colors hover:bg-rose-500/10 hover:text-rose-600 focus:outline-none focus:ring-2 focus:ring-rose-500/30 dark:hover:bg-rose-500/15 dark:hover:text-rose-400">
                                        <i class="fa-solid fa-trash-can text-xs"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>

            <div class="shrink-0 border-t border-slate-900/5 px-6 py-5 dark:border-white/5 sm:px-8">
                <button
                    id="open-modal-btn"
                    type="button"
                    class="flex w-full items-center justify-center gap-2.5 rounded-2xl bg-slate-900 px-4 py-3 text-sm font-semibold text-white shadow-lg shadow-slate-900/20 transition-all hover:bg-slate-800 focus:outline-none focus:ring-2 focus:ring-slate-900/30 active:scale-[0.99] dark:bg-slate-100 dark:text-slate-900 dark:shadow-none dark:hover:bg-white">
                    <i class="fa-solid fa-plus text-xs"></i>
                    Add Mission
                </button>
            </div>

        </section>
    </main>

    <?php require_once __DIR__ . '/components/createMissions.php'; ?>
    <?php require_once __DIR__ . '/components/editMissions.php'; ?>
</body>

</html>