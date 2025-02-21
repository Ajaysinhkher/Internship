
<!-- edit group modal -->
<div id="editGroupModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 hidden flex items-center justify-center">
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-lg font-bold text-gray-700 mb-4">Edit Group</h2>
        <form method="POST" action="/editGroup">
            <input type="hidden" name="_method" value="PATCH">
            <input type="hidden" name="id" id="editGroupId" >

            <label class="block text-gray-700">Group Name</label>
            <input type="text" name="name" id="editGroupName" class="w-full p-2 border rounded mt-2 mb-4" required>
            <div class="flex justify-end space-x-2">
                <button type="button" onclick="closeEditGroupModal()" class="px-4 py-2 bg-gray-500 text-white rounded">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">Save Changes</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openEditGroupModal(id, name) {
        document.getElementById('editGroupId').value = id;
        document.getElementById('editGroupName').value = name;
        document.getElementById('editGroupModal').classList.remove('hidden');
    }

    function closeEditGroupModal() {
        document.getElementById('editGroupModal').classList.add('hidden');
    }
</script>