<div class="space-y-4">
    <form wire:submit.prevent="submitForm">
        {{ $this->form }}

        <button type="submit" class="mt-4 px-4 py-2 bg-blue-500 text-white rounded">
            Submit
        </button>
    </form>
</div>

