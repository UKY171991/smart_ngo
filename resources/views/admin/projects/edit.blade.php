@extends('layouts.admin')

@section('page_title', 'Edit Project')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3 px-4">
                <h5 class="fw-bold mb-0 text-primary">Edit: {{ $project->title }}</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.projects.update', $project) }}" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Project Title</label>
                            <input type="text" name="title" class="form-control rounded-3" value="{{ $project->title }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control rounded-3" rows="4">{{ $project->description }}</textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Total Budget (₹)</label>
                            <input type="number" step="0.01" name="budget" class="form-control rounded-3" value="{{ $project->budget }}" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Spent (₹)</label>
                            <input type="number" step="0.01" name="spent" class="form-control rounded-3" value="{{ $project->spent }}" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select rounded-3" required>
                                <option value="ongoing" {{ $project->status == 'ongoing' ? 'selected' : '' }}>Ongoing</option>
                                <option value="completed" {{ $project->status == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="on-hold" {{ $project->status == 'on-hold' ? 'selected' : '' }}>On Hold</option>
                            </select>
                        </div>
                        <div class="col-12 mt-4 pt-2">
                            <hr>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-warning px-5 py-2 rounded-3 fw-bold text-white">Update Project</button>
                                <a href="{{ route('admin.projects.index') }}" class="btn btn-light px-4 py-2 rounded-3">Cancel</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
