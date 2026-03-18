@extends('layouts.admin')

@section('page_title', 'Schedule Event')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3 px-4">
                <h5 class="fw-bold mb-0 text-primary">New Event Details</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.events.store') }}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Event Title</label>
                            <input type="text" name="title" class="form-control rounded-3" placeholder="Annual charity run" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Event Description</label>
                            <textarea name="description" class="form-control rounded-3" rows="4" placeholder="What is this event about?" required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Event Date & Time</label>
                            <input type="datetime-local" name="event_date" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Location</label>
                            <input type="text" name="location" class="form-control rounded-3" placeholder="Central Park, NY" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Entry Fees (₹)</label>
                            <input type="number" step="0.01" name="fees" class="form-control rounded-3" placeholder="0.00 for free">
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Max Participants (Optional)</label>
                            <input type="number" name="max_participants" class="form-control rounded-3" placeholder="Leave empty for unlimited">
                        </div>
                        <div class="col-12 mt-4 pt-2">
                            <hr>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-5 py-2 rounded-3 fw-bold">Schedule Event</button>
                                <a href="{{ route('admin.events.index') }}" class="btn btn-light px-4 py-2 rounded-3">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
