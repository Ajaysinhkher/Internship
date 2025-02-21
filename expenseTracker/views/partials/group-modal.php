<!-- model to open add-group popup -->

<div id="groupModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <!-- Modal Box -->
    <div class="bg-white p-6 rounded-lg shadow-lg w-96">
        <h2 class="text-xl font-bold mb-4">Add Group</h2>
        <form action="/addGroup" method="POST">
            <input type="text" name="group_name" placeholder="Enter group name" class="w-full p-2 border rounded-lg mb-4">
            <div class="flex justify-end">
                <button type="button" onclick="closeModal()" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2">Cancel</button>
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded-lg">Add</button>
            </div>
        </form>
    </div>
</div>



<!-- script to open group model -->
<script>

function openModal() {
    document.getElementById('groupModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('groupModal').classList.add('hidden');
}

</script>
