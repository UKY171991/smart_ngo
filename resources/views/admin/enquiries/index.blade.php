@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="mb-0 fw-bold">Support Enquiries</h3>
    </div>

    @if(session('success'))
    <div class="alert alert-success border-0 shadow-sm rounded-4 mb-4">
        {{ session('success') }}
    </div>
    @endif

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="px-4 py-3 border-0">Date</th>
                            <th class="py-3 border-0">User/Visitor</th>
                            <th class="py-3 border-0">Subject</th>
                            <th class="py-3 border-0">Status</th>
                            <th class="px-4 py-3 border-0 text-end">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($enquiries as $enquiry)
                        <tr>
                            <td class="px-4 text-muted small">{{ $enquiry->created_at->format('M d, Y h:i A') }}</td>
                            <td>
                                <div class="fw-bold text-dark">{{ $enquiry->name }}</div>
                                <div class="small text-muted">{{ $enquiry->email }}</div>
                                @if($enquiry->user_id)
                                    <span class="badge bg-primary-soft text-primary small">Member</span>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold">{{ $enquiry->subject }}</div>
                                <div class="text-muted small">{{ Str::limit($enquiry->message, 50) }}</div>
                            </td>
                            <td>
                                @if($enquiry->status == 'pending')
                                    <span class="badge bg-warning-soft text-warning">Pending</span>
                                @else
                                    <span class="badge bg-success-soft text-success">Replied</span>
                                @endif
                            </td>
                            <td class="px-4 text-end">
                                <div class="btn-group">
                                    <button type="button" class="btn btn-sm btn-light text-primary" data-bs-toggle="modal" data-bs-target="#replyModal{{ $enquiry->id }}" title="Reply">
                                        <i class="fas fa-reply"></i>
                                    </button>
                                    <form action="{{ route('admin.enquiries.destroy', $enquiry) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this enquiry?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-light text-danger" title="Delete"><i class="fas fa-trash"></i></button>
                                    </form>
                                </div>

                                <!-- Reply Modal -->
                                <div class="modal fade text-start" id="replyModal{{ $enquiry->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-lg modal-dialog-centered">
                                        <div class="modal-content border-0 shadow rounded-4">
                                            <div class="modal-header border-0 pb-0">
                                                <h5 class="modal-title fw-bold">Reply to Enquiry</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                            </div>
                                            <form action="{{ route('admin.enquiries.reply', $enquiry->id) }}" method="POST">
                                                @csrf
                                                <div class="modal-body p-4">
                                                    <div class="bg-light p-3 rounded-3 mb-4">
                                                        <h6 class="fw-bold mb-2">Original Message:</h6>
                                                        <p class="mb-0 text-dark">{{ $enquiry->message }}</p>
                                                    </div>
                                                    
                                                    <div class="mb-3">
                                                        <label class="form-label fw-bold">Your Response <span class="text-danger">*</span></label>
                                                        <textarea name="reply" class="form-control" rows="6" required placeholder="Write your response here...">{{ $enquiry->reply }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="modal-footer border-0 pt-0">
                                                    <button type="button" class="btn btn-light rounded-pill px-4" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary rounded-pill px-5">Send Response</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5 text-muted">
                                <i class="fas fa-envelope-open fa-3x mb-3 opacity-50"></i>
                                <h5>No enquiries found</h5>
                                <p>Support enquiries from your website will appear here.</p>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($enquiries->hasPages())
        <div class="card-footer bg-white border-0 py-3">
            {{ $enquiries->links() }}
        </div>
        @endif
    </div>
</div>
<style>
    .bg-primary-soft { background-color: rgba(13, 110, 253, 0.1); }
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .bg-warning-soft { background-color: rgba(255, 193, 7, 0.1); }
</style>
@endsection
