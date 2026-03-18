@extends('layouts.member')

@section('content')
<div class="container-fluid py-4">
    <div class="row">
        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-paper-plane text-primary me-2"></i> Submit Enquiry</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('member.enquiries.post') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Subject</label>
                            <input type="text" name="subject" class="form-control rounded-3" required placeholder="What is this about?">
                        </div>
                        <div class="mb-3">
                            <label class="form-label fw-bold small">Your Message</label>
                            <textarea name="message" class="form-control rounded-3" rows="5" required placeholder="Describe your question or issue..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary w-100 rounded-pill fw-bold py-2 shadow-sm">Submit Now</button>
                    </form>
                </div>
            </div>
        </div>
        
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-history text-primary me-2"></i> My Enquiries</h5>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3 border-0">Date</th>
                                    <th class="py-3 border-0">Subject</th>
                                    <th class="py-3 border-0">Status</th>
                                    <th class="px-4 py-3 border-0">Admin Reply</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($enquiries as $enquiry)
                                <tr>
                                    <td class="px-4 text-muted small">{{ $enquiry->created_at->format('M d, Y') }}</td>
                                    <td>
                                        <div class="fw-bold text-dark">{{ $enquiry->subject }}</div>
                                        <div class="small text-muted text-truncate" style="max-width: 250px;">{{ $enquiry->message }}</div>
                                    </td>
                                    <td>
                                        @if($enquiry->status == 'pending')
                                            <span class="badge bg-warning-soft text-warning rounded-pill">Pending</span>
                                        @else
                                            <span class="badge bg-success-soft text-success rounded-pill">Replied</span>
                                        @endif
                                    </td>
                                    <td class="px-4">
                                        @if($enquiry->reply)
                                            <div class="p-2 bg-light rounded-3 small">
                                                <i class="fas fa-reply text-muted me-1"></i> {{ $enquiry->reply }}
                                            </div>
                                        @else
                                            <span class="text-muted small fst-italic">Waiting for response...</span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center py-5 text-muted">
                                        <i class="fas fa-envelope-open fa-3x mb-3 opacity-25"></i>
                                        <p class="mb-0">No enquiries found. Need help? Submit a new one.</p>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
    .bg-success-soft { background-color: rgba(25, 135, 84, 0.1); }
    .bg-warning-soft { background-color: rgba(255, 193, 7, 0.1); }
</style>
@endsection
