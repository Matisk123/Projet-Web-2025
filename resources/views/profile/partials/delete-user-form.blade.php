<section class="space-y-6">
    <div class="card">
        <div class="card-header" id="delete_account">
            <h3 class="card-title">
                Delete Account
            </h3>
        </div>
        <div class="card-body flex flex-col lg:py-7.5 lg:gap-7.5 gap-3">
            <div class="flex flex-col gap-5">
                <div class="text-2sm text-gray-800">
                    We regret to see you leave. Confirm account deletion below. Your data will be permanently removed. Thank you for being part of our community. Please check our
                    <a class="link" href="#">
                        Setup Guidelines
                    </a>
                    if you still wish to continue.
                </div>

                <!-- Confirmation checkbox -->
                <label class="checkbox-group">
                    <input class="checkbox checkbox-sm" name="delete" type="checkbox" id="deleteCheckbox" value="1">
                    <span class="checkbox-label">
                        Confirm deleting account
                    </span>
                </label>

                <div class="flex justify-end gap-2.5">
                    <!-- Deactivate Button (Optional) -->
                    <button class="btn btn-light">
                        Deactivate Instead
                    </button>

                    <!-- Delete Account Form -->
                    <form id="deleteAccountForm" method="POST" action="{{ route('profile.destroy') }}">
                        @csrf
                        @method('delete')

                        <!-- Delete Button (disabled initially) -->
                        <button type="submit" class="btn btn-danger" id="deleteBtn" disabled>
                            Delete Account
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Message for Account Deletion -->
    @if(session('status'))
        <div class="alert alert-success mt-4">
            {{ session('status') }}
        </div>
    @endif
</section>

<!-- Script to enable the delete button when checkbox is checked -->
<script>
    document.getElementById('deleteCheckbox').addEventListener('change', function() {
        var deleteBtn = document.getElementById('deleteBtn');
        deleteBtn.disabled = !this.checked;
    });
</script>
