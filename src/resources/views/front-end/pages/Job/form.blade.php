@extends('front-end.layouts.main')
@section('title', 'สร้าง Job')
@section('content')
    @livewire('components.form.Job.FormJob')
    <!-- Script for confirmation before closing the page -->
    <script>
        // Function to handle the beforeunload event
        function handleBeforeUnload(e) {
            var confirmationMessage = 'Are you sure you want to leave? Your changes may not be saved.';
            e.preventDefault();
            e.returnValue = confirmationMessage;
            return confirmationMessage;
        }

        // Add the beforeunload event listener when the page loads
        window.addEventListener('beforeunload', handleBeforeUnload);

        // Add event listener to the form submit event to remove the beforeunload listener
        document.addEventListener('DOMContentLoaded', function() {
            var form = document.querySelector('form');
            form.addEventListener('submit', function() {
                window.removeEventListener('beforeunload', handleBeforeUnload);
            });
        });
    </script>
@endsection
