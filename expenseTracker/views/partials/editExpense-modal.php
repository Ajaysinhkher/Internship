
<div id="editExpenseModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-lg font-bold text-gray-700 mb-4">Edit Expense</h2>
        <form method="POST" action="/editExpense">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" id="editExpenseId">
            
            <label class="block text-gray-700">Expense Name</label>
            <input type="text" name="name" id="editExpenseName" class="w-full p-2 border rounded mt-2 mb-4" required>
            <label class="block text-gray-700">Amount</label>
            <input type="number" step="0.01" name="amount" id="editExpenseAmount" class="w-full p-2 border rounded mt-2 mb-4" required>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeEditExpenseModal()" class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditExpenseModal(id, name, amount) {
        document.getElementById('editExpenseId').value = id;
        document.getElementById('editExpenseName').value = name;
        document.getElementById('editExpenseAmount').value = amount;
        document.getElementById('editExpenseModal').classList.remove('hidden');
    }

    function closeEditExpenseModal() {
        document.getElementById('editExpenseModal').classList.add('hidden');
    }
</script>

