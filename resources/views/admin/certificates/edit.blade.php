@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-0 d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 fw-bold text-primary"><i class="fas fa-edit me-2"></i> Edit Certificate</h5>
                    <span class="badge bg-light text-muted fw-normal px-3 py-2 rounded-pill border">NO: {{ $certificate->certificate_number }}</span>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.certificates.update', $certificate->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Select User (Optional)</label>
                                <select name="user_id" id="user_id" class="form-select">
                                    <option value="">-- Non-Member / Visitor --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" {{ $certificate->user_id == $user->id ? 'selected' : '' }} data-name="{{ $user->name }}" data-email="{{ $user->email }}">{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Certificate Type <span class="text-danger">*</span></label>
                                <select name="type" class="form-select" required>
                                    <option value="achievement" {{ $certificate->type == 'achievement' ? 'selected' : '' }}>Achievement</option>
                                    <option value="membership" {{ $certificate->type == 'membership' ? 'selected' : '' }}>Membership</option>
                                    <option value="internship" {{ $certificate->type == 'internship' ? 'selected' : '' }}>Internship</option>
                                    <option value="visitor" {{ $certificate->type == 'visitor' ? 'selected' : '' }}>Visitor</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Recipient Name <span class="text-danger">*</span></label>
                                <input type="text" name="recipient_name" id="recipient_name" class="form-control" value="{{ $certificate->recipient_name }}" required>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Recipient Email <span class="text-danger">*</span></label>
                                <input type="email" name="recipient_email" id="recipient_email" class="form-control" value="{{ $certificate->recipient_email }}" required>
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-bold">Description / Achievement Text <span class="text-danger">*</span></label>
                                <textarea name="metadata" class="form-control" rows="3" required placeholder="e.g. for exceptional contribution...">{{ $certificate->metadata['description'] ?? '' }}</textarea>
                            </div>
                        </div>

                        <h6 class="fw-bold mb-3 border-bottom pb-2">Change Template <span class="text-danger">*</span></h6>
                        <div class="row g-3 mb-4">
                            @for($i = 1; $i <= 6; $i++)
                            @php $t_id = "tpl" . $i; @endphp
                            <div class="col-md-4">
                                <label class="w-100 cursor-pointer">
                                    <input type="radio" name="template_id" value="{{ $t_id }}" class="d-none template-radio" {{ $certificate->template_id == $t_id ? 'checked' : '' }}>
                                    <div class="card template-card border-2 {{ $certificate->template_id == $t_id ? 'border-primary shadow' : 'border-light shadow-sm' }} transition">
                                        <div class="card-body text-center p-4">
                                            <i class="fas fa-file-contract fa-3x mb-3 text-muted opacity-50"></i>
                                            <div class="fw-bold text-dark">Template {{ $i }}</div>
                                            <small class="text-muted">Classic Design</small>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @endfor
                        </div>

                        <div class="d-flex justify-content-between border-top pt-4">
                            <a href="{{ route('admin.certificates.index') }}" class="btn btn-light rounded-pill px-4">Cancel</a>
                            <div class="d-flex gap-2">
                                <button type="submit" class="btn btn-primary rounded-pill px-5"><i class="fas fa-save me-2"></i> Update Certificate</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Auto-fill user details on selection
    document.getElementById('user_id').addEventListener('change', function() {
        const option = this.options[this.selectedIndex];
        if (option.value) {
            document.getElementById('recipient_name').value = option.dataset.name;
            document.getElementById('recipient_email').value = option.dataset.email;
        }
    });

    // Template selection styling
    document.querySelectorAll('input[name="template_id"]').forEach(radio => {
        radio.addEventListener('change', function() {
            document.querySelectorAll('.template-card').forEach(card => {
                card.classList.remove('border-primary', 'shadow');
                card.classList.add('border-light', 'shadow-sm');
            });
            if(this.checked) {
                this.nextElementSibling.classList.remove('border-light', 'shadow-sm');
                this.nextElementSibling.classList.add('border-primary', 'shadow');
            }
        });
    });
</script>

<style>
    .cursor-pointer { cursor: pointer; }
    .template-card:hover { border-color: #0d6efd !important; opacity: 0.9; }
    .transition { transition: all 0.3s ease; }
</style>
@endsection
