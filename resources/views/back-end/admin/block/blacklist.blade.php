@extends('back-end.master')
@section('content')
    @include('includes.pre-loader')
    <div class="container mt-5">
        <h2>Blacklist Management</h2>
        
        <div class="alert" id="message" style="display: none;"></div>
    
        <form id="addForm">
            <div class="form-group">
                <label for="phone_number_add">Phone Number to Add</label>
                <input type="text" class="form-control" id="phone_number_add" placeholder="Enter phone number (e.g., 923001234567)">
                <button type="button" class="btn btn-primary mt-2" onclick="addPhoneNumber()">Add to Blacklist</button>
            </div>
        </form>
    
        <form id="removeForm">
            <div class="form-group">
                <label for="phone_number_remove">Phone Number to Remove</label>
                <input type="text" class="form-control" id="phone_number_remove" placeholder="Enter phone number (e.g., 923001234567)">
                <button type="button" class="btn btn-danger mt-2" onclick="removePhoneNumber()">Remove from Blacklist</button>
            </div>
        </form>
    </div>
@endsection
@push('scripts')
@stack('backend_scripts')
<script>
    function addPhoneNumber() {
    const phoneNumber = document.getElementById('phone_number_add').value;
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
    fetch('/blacklist/add', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken,
             'Accept': 'application/json'
        },
        body: JSON.stringify({ phone_number: phoneNumber })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Numbre already exist');
        }
        return response.json();
    })
    .then(data => {
        
        const message = document.getElementById('message');
        message.style.display = 'block';
        message.textContent = data.message;
        message.className = data.success ? 'alert alert-success' : 'alert alert-danger';
        document.getElementById('phone_number_remove').value = '';
    })
    .catch(error => {
        const message = document.getElementById('message');
        message.style.display = 'block';
        message.textContent =error.message;
        message.className = 'alert alert-danger';
    });
}

function removePhoneNumber() {
    const phoneNumber = document.getElementById('phone_number_remove').value;
    console.log('dsd',phoneNumber);
    fetch('/blacklist/remove', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
             },
        body: JSON.stringify({ phone_number: phoneNumber })
    })
    .then(response => {
        if (!response.ok) {
            throw new Error('Network response was not ok');
        }
        return response.json();
    })
    .then(data => {
        const message = document.getElementById('message');
        message.style.display = 'block';
        message.textContent = data.message;
        message.className = data.success ? 'alert alert-success' : 'alert alert-danger';
        document.getElementById('phone_number_remove').value = '';
    })
    .catch(error => {
        const message = document.getElementById('message');
        message.style.display = 'block';
        message.textContent = 'An error occurred: ' + error.message;
        message.className = 'alert alert-danger';
    });
}
</script>
@endpush