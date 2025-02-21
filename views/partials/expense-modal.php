
<!-- Add Expense Modal -->
<div id="expenseModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Add Expense</h2>
        <form action="/addExpense" method="POST">
            <input type="text" name="expense_name" placeholder="Enter expense name" class="w-full p-2 border rounded-lg mb-4" required>

            <input type="number" name="amount" placeholder="Enter amount" class="w-full p-2 border rounded-lg mb-4" required>

            <input type="date" name="date" class="w-full p-2 border rounded-lg mb-4" required>

            <?php //dd($groups) ?>
            <select name="group_id" class="w-full p-2 border rounded-lg mb-4" required>
                <option value="">Select Group</option>
            
                <?php foreach ($groups as $group): ?>
                    <option value="<?= $group['id'] ?>"><?= htmlspecialchars($group['name']) ?></option>
                <?php endforeach; ?>
            </select>

            <div class="flex justify-end">
                <button type="button" onclick="closeExpenseModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">
                    Cancel
                </button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">
                    Add Expense
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Script to Open and Close the Expense Modal -->
<script>
function openExpenseModal() {
    document.getElementById('expenseModal').classList.remove('hidden');
}

function closeExpenseModal() {
    document.getElementById('expenseModal').classList.add('hidden');
}
</script>