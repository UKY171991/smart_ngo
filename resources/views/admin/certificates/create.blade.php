@extends('layouts.admin')

@section('content')
<div class="container-fluid py-4">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-sm rounded-4">
                <div class="card-header bg-white py-3 border-0">
                    <h5 class="mb-0 fw-bold"><i class="fas fa-certificate text-primary me-2"></i> Issue New Certificate</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.certificates.store') }}" method="POST">
                        @csrf
                        
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Select User (Optional)</label>
                                <select name="user_id" id="user_id" class="form-select">
                                    <option value="">-- Non-Member / Visitor --</option>
                                    @foreach($users as $user)
                                        <option value="{{ $user->id }}" data-name="{{ $user->name }}" data-email="{{ $user->email }}">{{ $user->name }} ({{ $user->email }})</option>
                                    @endforeach
                                </select>
                                <div class="form-text">Select an existing member or leave blank for a visitor.</div>
                            </div>
                            
                            <div class="col-md-6">
                                <label class="form-label fw-bold">Certificate Type <span class="text-danger">*</span></label>
                                <select name="type" class="form-select" required>
                                    <option value="achievement">Achievement</option>
                                    <option value="membership">Membership</option>
                                    <option value="internship">Internship</option>
                                    <option value="visitor">Visitor</option>
                                </select>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Recipient Name <span class="text-danger">*</span></label>
                                <input type="text" name="recipient_name" id="recipient_name" class="form-control" required>
                                @error('recipient_name')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>

                            <div class="col-md-6">
                                <label class="form-label fw-bold">Recipient Email <span class="text-danger">*</span></label>
                                <input type="email" name="recipient_email" id="recipient_email" class="form-control" required>
                                @error('recipient_email')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>
                            
                            <div class="col-12">
                                <label class="form-label fw-bold">Description / Achievement Text <span class="text-danger">*</span></label>
                                <textarea name="metadata" class="form-control" rows="3" required placeholder="e.g. for exceptional contribution in our annual blood donation camp..."></textarea>
                                @error('metadata')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            </div>
                        </div>

                        <h6 class="fw-bold mb-3 border-bottom pb-2">Select Template <span class="text-danger">*</span></h6>
                        <div class="row g-3 mb-4">
                            @for($i = 1; $i <= 6; $i++)
                            <div class="col-md-4">
                                <label class="w-100 cursor-pointer">
                                    <input type="radio" name="template_id" value="tpl{{ $i }}" class="d-none template-radio" {{ $i == 1 ? 'checked' : '' }}>
                                    <div class="card template-card border-2 {{ $i == 1 ? 'border-primary shadow' : 'border-light shadow-sm' }} transition">
                                        <div class="card-body text-center p-4" style="background: var(--template-{{$i}}-bg, #f8f9fa);">
                                            <i class="fas fa-file-contract fa-3x mb-3 text-muted opacity-50"></i>
                                            <div class="fw-bold text-dark">Template {{ $i }}</div>
                                            <small class="text-muted">Classic Design</small>
                                        </div>
                                    </div>
                                </label>
                            </div>
                            @endfor
                        </div>

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('admin.certificates.index') }}" class="btn btn-light rounded-pill px-4">Cancel</a>
                            <button type="submit" class="btn btn-primary rounded-pill px-5"><i class="fas fa-paper-plane me-2"></i> Generate & Issue</button>
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
        } else {
            document.getElementById('recipient_name').value = '';
            document.getElementById('recipient_email').value = '';
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
</style>
@endsection
