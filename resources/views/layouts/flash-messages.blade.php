<div id="flash-messages" class="fixed bottom-5 right-5 z-50 flex flex-col space-y-3">
    @if ($message = Session::get('success'))
        <div class="alert alert-success bg-green-500 text-white px-6 py-4 rounded-lg shadow-md flex items-center justify-between fade-in">
            <span class="font-semibold">{{ $message }}</span>
            {{-- <button type="button" class="text-white close-alert">&times;</button> --}}
        </div>
    @endif

    @if ($message = Session::get('error'))
        <div class="alert alert-danger bg-red-500 text-white px-6 py-4 rounded-lg shadow-md flex items-center justify-between fade-in">
            <span class="font-semibold">{{ $message }}</span>
            {{-- <button type="button" class="text-white close-alert">&times;</button> --}}
        </div>
    @endif

    @if ($message = Session::get('warning'))
        <div class="alert alert-warning bg-yellow-500 text-white px-6 py-4 rounded-lg shadow-md flex items-center justify-between fade-in">
            <span class="font-semibold">{{ $message }}</span>
            {{-- <button type="button" class="text-white close-alert">&times;</button> --}}
        </div>
    @endif

    @if ($message = Session::get('info'))
        <div class="alert alert-info bg-blue-500 text-white px-6 py-4 rounded-lg shadow-md flex items-center justify-between fade-in">
            <span class="font-semibold">{{ $message }}</span>
            {{-- <button type="button" class="text-white close-alert">&times;</button> --}}
        </div>
    @endif
</div>

<style>
    .fade-in {
        animation: fadeIn 0.5s ease-in-out;
    }

    .fade-out {
        animation: fadeOut 0.5s ease-in-out forwards;
    }

    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }

    @keyframes fadeOut {
        from { opacity: 1; transform: translateY(0); }
        to { opacity: 0; transform: translateY(10px); }
    }
</style>

<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Auto-hide after 3 seconds
        setTimeout(function () {
            document.querySelectorAll('.alert').forEach(alert => {
                alert.classList.add('fade-out');
                setTimeout(() => alert.remove(), 500);
            });
        }, 3000);

        // Close button functionality
        document.querySelectorAll('.close-alert').forEach(button => {
            button.addEventListener('click', function () {
                let alert = this.parentElement;
                alert.classList.add('fade-out');
                setTimeout(() => alert.remove(), 500);
            });
        });
    });
</script>
