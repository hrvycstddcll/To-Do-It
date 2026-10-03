<?php require_once __DIR__ . '/components/listMissions.php'; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>To-Do-It</title>
    <link rel="icon" type="image/png" href="assets/favicon.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="style/index.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            darkMode: "class"
        };
    </script>
    <script src="script/index.js" defer></script>
</head>

<body class="min-h-screen bg-neutral-100 text-neutral-900 transition-colors duration-200 dark:bg-neutral-950 dark:text-neutral-100">
    <div class="pointer-events-none fixed inset-0 -z-10 bg-[radial-gradient(50rem_50rem_at_50%_-20%,rgba(10,10,10,0.06),transparent)] dark:bg-[radial-gradient(50rem_50rem_at_50%_-20%,rgba(255,255,255,0.04),transparent)]">
    </div>

    <main class="flex min-h-screen items-start justify-center px-4 py-8 sm:py-12">
        <section class="flex h-[90vh] w-full max-w-2xl flex-col border border-neutral-900/15 bg-white dark:border-white/15 dark:bg-neutral-900">

            <?php
            $totalTasks = count($tasks);
            $doneTasks = count(array_filter($tasks, fn($t) => $t['status'] === 'complete'));
            $pct = $totalTasks > 0 ? (int) round($doneTasks / $totalTasks * 100) : 0;
            ?>
            <header class="flex shrink-0 items-start justify-between gap-4 border-b border-neutral-900/10 px-6 py-5 dark:border-white/10">
                <div class="min-w-0 flex-1">
                    <p class="text-2xl font-bold tracking-tight text-neutral-900 dark:text-white">To-Do-It</p>
                    <p class="mt-0.5 font-mono text-xs text-neutral-500 dark:text-neutral-400">
                        <?= $totalTasks ?> mission<?= $totalTasks === 1 ? '' : 's' ?>
                        <?php if ($totalTasks > 0): ?>
                            &middot; <?= $doneTasks ?> done (<?= $pct ?>%)
                        <?php endif; ?>
                    </p>

                    <?php if ($totalTasks > 0): ?>
                        <div
                            class="mt-2 h-1 w-full bg-neutral-900/10 dark:bg-white/10"
                            role="progressbar"
                            aria-valuenow="<?= $pct ?>"
                            aria-valuemin="0"
                            aria-valuemax="100"
                            aria-label="Missions completed">
                            <div class="h-1 bg-neutral-900 dark:bg-white" style="width: <?= $pct ?>%"></div>
                        </div>
                    <?php endif; ?>
                </div>
                <button
                    id="mode-toggle"
                    type="button"
                    aria-label="Switch to dark mode"
                    aria-pressed="false"
                    class="-m-1 p-2 text-neutral-500 transition-colors hover:text-neutral-900 focus:outline-none focus:ring-2 focus:ring-neutral-900/30 dark:text-neutral-400 dark:hover:text-white dark:focus:ring-white/30">
                    <i class="fa-solid fa-moon block dark:hidden"></i>
                    <i class="fa-solid fa-sun hidden dark:block"></i>
                </button>
            </header>

            <div id="content-area" class="contentArea flex-1 overflow-y-auto px-4 py-2">
                <?php if (empty($tasks)): ?>
                    <div class="flex h-full flex-col items-center justify-center gap-2 text-center">
                        <p class="text-sm text-neutral-500 dark:text-neutral-400">No missions.</p>
                        <p class="text-xs text-neutral-400 dark:text-neutral-500">Add one below.</p>
                    </div>
                <?php else: ?>
                    <ul class="divide-y divide-neutral-900/10 dark:divide-white/10">
                        <?php foreach ($tasks as $task): ?>
                            <?php $isDone = $task['status'] === 'complete'; ?>
                            <li class="group -mx-4 flex items-center gap-3 px-4 py-3 transition-colors hover:bg-neutral-900/[0.03] dark:hover:bg-white/[0.04]">

                                <form method="POST" action="components/toggleStatus.php" class="contents">
                                    <input type="hidden" name="id" value="<?= (int)$task['id'] ?>">
                                    <input type="hidden" name="status" value="<?= $isDone ? 'incomplete' : 'complete' ?>">
                                    <input
                                        type="checkbox"
                                        id="task-<?= (int)$task['id'] ?>"
                                        data-toggle-checkbox
                                        <?= $isDone ? 'checked' : '' ?>
                                        aria-label="Mark <?= htmlspecialchars($task['task']) ?> as <?= $isDone ? 'incomplete' : 'complete' ?>"
                                        class="h-4 w-4 shrink-0 cursor-pointer accent-neutral-900 dark:accent-neutral-100"
                                    >
                                </form>

                                <label for="task-<?= (int)$task['id'] ?>" class="min-w-0 flex-1 cursor-pointer select-none">
                                    <span class="block break-words text-sm <?= $isDone ? 'text-neutral-400 line-through dark:text-neutral-500' : 'text-neutral-900 dark:text-neutral-100' ?>"><?= htmlspecialchars($task['task']) ?></span>
                                    <span class="mt-0.5 block font-mono text-xs text-neutral-400 dark:text-neutral-500">
                                        <?= htmlspecialchars(date('M j, Y \a\t g:ia', strtotime($task['created_at']))) ?>
                                    </span>
                                </label>

                                <div class="flex shrink-0 items-center gap-1 opacity-0 transition-opacity focus-within:opacity-100 group-hover:opacity-100">
                                    <button
                                        type="button"
                                        data-edit-btn
                                        data-id="<?= (int)$task['id'] ?>"
                                        data-mission="<?= htmlspecialchars($task['task']) ?>"
                                        data-status="<?= htmlspecialchars($task['status']) ?>"
                                        aria-label="Edit <?= htmlspecialchars($task['task']) ?>"
                                        class="p-2 text-neutral-400 transition-colors hover:text-neutral-900 focus:opacity-100 focus:outline-none focus:ring-2 focus:ring-neutral-900/30 dark:text-neutral-500 dark:hover:text-white dark:focus:ring-white/30">
                                        <i class="fa-solid fa-pen text-xs"></i>
                                    </button>

                                    <form method="POST" action="components/deleteMission.php" class="contents" onsubmit="return confirm('Delete this mission?')">
                                        <input type="hidden" name="id" value="<?= (int)$task['id'] ?>">
                                        <button
                                            type="submit"
                                            aria-label="Delete <?= htmlspecialchars($task['task']) ?>"
                                            class="p-2 text-neutral-400 transition-colors hover:text-neutral-900 focus:opacity-100 focus:outline-none focus:ring-2 focus:ring-neutral-900/30 dark:text-neutral-500 dark:hover:text-white dark:focus:ring-white/30">
                                            <i class="fa-solid fa-trash-can text-xs"></i>
                                        </button>
                                    </form>
                                </div>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                <?php endif; ?>
            </div>

            <div class="shrink-0 border-t border-neutral-900/10 px-6 py-4 dark:border-white/10">
                <button
                    id="open-modal-btn"
                    type="button"
                    class="flex w-full items-center justify-center gap-2 bg-neutral-900 px-4 py-2.5 text-sm font-medium text-white transition-colors hover:bg-neutral-700 focus:outline-none focus:ring-2 focus:ring-neutral-900/30 dark:bg-neutral-100 dark:text-neutral-900 dark:hover:bg-white">
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