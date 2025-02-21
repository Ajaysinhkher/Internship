<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Expense Manager</title>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<?php views('/partials/banner.php'); ?>
<?php views('/partials/group-modal.php'); ?>
<?php views('/partials/expense-modal.php', ['groups' => $groups]); ?>

<body class="bg-gray-50">
    <div class="max-w-5xl mx-auto p-6 bg-white rounded-lg shadow-lg mt-10">
        <!-- Expense Summary -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 text-center">
            <div class="bg-blue-50 p-5 rounded-lg shadow-sm">
                <h3 class="text-blue-700 font-semibold">Total Expense</h3>
                <h2 class="text-2xl font-bold text-blue-900">₹<?= number_format($totalExpense, 2) ?></h2>
            </div>
            <div class="bg-green-50 p-5 rounded-lg shadow-sm">
                <h3 class="text-green-700 font-semibold">This Month</h3>
                <h2 class="text-2xl font-bold text-green-900">₹<?= number_format($thisMonth, 2) ?></h2>
            </div>
            <div class="bg-red-50 p-5 rounded-lg shadow-sm">
                <h3 class="text-red-700 font-semibold">Highest This Month</h3>
                <h2 class="text-2xl font-bold text-red-900">₹<?= number_format($maxExpense, 2) ?></h2>
            </div>
        </div>

        <!-- Buttons -->
        <div class="text-center mt-6">
            <button onclick="openModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg shadow-md mr-4">
                Add Group
            </button>
            <button onclick="openExpenseModal()" class="bg-green-600 hover:bg-green-700 text-white px-5 py-2 rounded-lg shadow-md">
                Add Expense
            </button>
        </div>

        <!-- Groups Table -->
        <h2 class="mt-6 text-lg font-bold text-gray-700">Groups</h2>
        <div class="overflow-hidden rounded-lg shadow-md mt-2">
            <table class="w-full border border-gray-200 text-sm text-gray-700">
                <thead class="bg-blue-600 text-white text-left">
                    <tr>
                        <th class="p-3 border-b">Name</th>
                        <th class="p-3 border-b text-left">Created At</th>
                        <th class="p-3 border-b text-center">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php foreach ($groups as $group): ?>
                        <tr class="border-b hover:bg-gray-100">
                            <td class="p-3"> <?= htmlspecialchars($group['name']) ?> </td>
                            <td class="p-3"> <?= htmlspecialchars($group['created_at']) ?> </td>
                            <td class="p-3 text-center">

                                <button onclick="openEditGroupModal(<?= $group['id'] ?>, '<?= htmlspecialchars($group['name']) ?>')" class="px-4 py-1 bg-yellow-500 text-white font-semibold rounded-md shadow-sm hover:bg-yellow-600 transition duration-200 text-sm">Edit</button>
                                <form method="POST" action="/deleteGroup" class="inline">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="id" value="<?= $group['id'] ?>">
                                    <button type="submit" class="px-4 py-1 bg-red-500 text-white font-semibold rounded-md shadow-sm hover:bg-red-600 transition duration-200 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-opacity-50 text-sm">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Recent Expenses -->
        <h2 class="mt-8 text-lg font-bold">Expenses</h2>
        <table class="w-full border-collapse border border-gray-300 mt-2">
            <thead class="bg-blue-600 text-white text-left">
                <tr>
                    <th class="p-3 border border-gray-300">Group</th>
                    <th class="p-3 border border-gray-300">Expense</th>
                    <th class="p-3 border border-gray-300">Amount</th>
                    <th class="p-3 border border-gray-300">Created At</th>
                    <th class="p-3 border border-gray-300 text-center">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                <?php foreach ($expenses as $expense): ?>
                    <tr class="border-b hover:bg-gray-100">
                        <td class="p-3"> <?= htmlspecialchars($expense['group_name']) ?> </td>
                        <td class="p-3"> <?= htmlspecialchars($expense['expense_name']) ?> </td>
                        <td class="p-3 text-blue-700 font-semibold">₹<?= number_format($expense['amount'], 2) ?></td>
                        <td class="p-3"> <?= date('d M Y', strtotime($expense['created_at'])) ?> </td>
                        <td class="p-3 text-center">
                        <button onclick="openEditExpenseModal(<?= $expense['id'] ?>, '<?= htmlspecialchars($expense['expense_name']) ?>', <?= $expense['amount'] ?>)" class="px-4 py-1 bg-yellow-500 text-white font-semibold rounded-md shadow-sm hover:bg-yellow-600 transition duration-200 text-sm">Edit</button>
                            <form method="POST" action="/deleteExpense" class="inline">
                                <input type="hidden" name="_method" value="DELETE">
                                <input type="hidden" name="id" value="<?= $expense['id'] ?>">
                                <button type="submit" class="px-4 py-1 bg-red-500 text-white font-semibold rounded-md shadow-sm hover:bg-red-600 transition duration-200 focus:outline-none focus:ring-2 focus:ring-red-300 focus:ring-opacity-50 text-sm">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
<!-- call the modals for edit group and edit expense -->
    <?php views('/partials/editGroup-modal.php'); ?>
    <?php views('/partials/editExpense-modal.php'); ?>
</body>

</html>
