<!-- resources/views/components/popup.blade.php -->
<div id="login-popup" class="fixed inset-0 flex justify-center items-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-xl font-semibold mb-4">Please Login</h2>
        <p>You need to login to proceed with the search.</p>
        <div class="mt-4 flex justify-end">
            <a href="{{ route('login') }}" class="btn btn-warning text-white">Login</a>
            <button onclick="closeLoginPopup()" class="ml-4 btn btn-ghost">Cancel</button>
        </div>
    </div>
</div>

<script>
    // Function to show the popup
    function showLoginPopup() {
        document.getElementById("login-popup").classList.remove("hidden");
    }

    // Function to close the popup
    function closeLoginPopup() {
        document.getElementById("login-popup").classList.add("hidden");
    }
</script>
