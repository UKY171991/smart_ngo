@extends('layouts.admin')

@section('page_title', 'Add New Project')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-3 px-4">
                <h5 class="fw-bold mb-0 text-primary">Project Details</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.projects.store') }}" method="POST">
                    @csrf
                    <div class="row g-4">
                        <div class="col-12">
                            <label class="form-label fw-semibold">Project Title</label>
                            <input type="text" name="title" class="form-control rounded-3" placeholder="Enter project name" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Description</label>
                            <textarea name="description" class="form-control rounded-3" rows="4" placeholder="Briefly describe the project"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Total Budget (₹)</label>
                            <input type="number" step="0.01" name="budget" class="form-control rounded-3" value="0.00" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Status</label>
                            <select name="status" class="form-select rounded-3" required>
                                <option value="ongoing">Ongoing</option>
                                <option value="completed">Completed</option>
                                <option value="on-hold">On Hold</option>
                            </select>
                        </div>

                        <div class="col-12 mt-4 px-3 py-3 rounded-4 bg-light border-0">
                            <h6 class="fw-bold mb-3 text-primary"><i class="fas fa-search me-2"></i> SEO Settings</h6>
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Meta Title</label>
                                    <input type="text" name="meta_title" class="form-control" placeholder="SEO Title">
                                </div>
                                <div class="col-md-6">
                                    <label class="form-label fw-semibold">Meta Keywords</label>
                                    <input type="text" name="meta_keywords" class="form-control" placeholder="Keywords (comma separated)">
                                </div>
                                <div class="col-12">
                                    <label class="form-label fw-semibold">Meta Description</label>
                                    <textarea name="meta_description" class="form-control" rows="2" placeholder="SEO Description"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-4 pt-2">
                            <hr>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary px-5 py-2 rounded-3 fw-bold">Save Project</button>
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
