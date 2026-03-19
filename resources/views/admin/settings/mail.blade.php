@extends('layouts.admin')

@section('page_title', 'Email Configuration')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-header bg-white py-4 px-4">
                <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-envelope-open-text me-2"></i> Mail Server Setup</h5>
            </div>
            <div class="card-body p-4">
                <form action="{{ route('admin.settings.mail.update') }}" method="POST">
                    @csrf
                    
                    <div class="row g-4 mb-5">
                        <div class="col-md-6">
                            <label class="form-label fw-bold">Mail Driver</label>
                            <select name="mail_mailer" class="form-select form-select-lg shadow-sm border-0 bg-light rounded-3" id="mail_mailer">
                                <option value="smtp" {{ ($settings['mail_mailer'] ?? 'smtp') == 'smtp' ? 'selected' : '' }}>SMTP (Recommended)</option>
                                <option value="sendmail" {{ ($settings['mail_mailer'] ?? '') == 'sendmail' ? 'selected' : '' }}>Laravel Sendmail / PHP Mail</option>
                                <option value="log" {{ ($settings['mail_mailer'] ?? '') == 'log' ? 'selected' : '' }}>Log (Debug Only)</option>
                            </select>
                            <small class="text-muted">Choose how you want to send emails.</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-bold">From Address</label>
                            <input type="email" name="mail_from_address" class="form-control form-control-lg shadow-sm border-0 bg-light rounded-3" value="{{ $settings['mail_from_address'] ?? 'noreply@ngo.devloper.space' }}" placeholder="noreply@domain.com">
                        </div>
                    </div>

                    <div id="smtp_settings" style="{{ ($settings['mail_mailer'] ?? 'smtp') == 'smtp' ? '' : 'display:none;' }}">
                        <h6 class="fw-bold mb-4 text-dark border-bottom pb-2 mt-2">SMTP Server Details</h6>
                        <div class="row g-4 mb-4">
                            <div class="col-md-9">
                                <label class="form-label fw-semibold">SMTP Host</label>
                                <input type="text" name="mail_host" class="form-control" value="{{ $settings['mail_host'] ?? '' }}" placeholder="mail.yourserver.com">
                            </div>
                            <div class="col-md-3">
                                <label class="form-label fw-semibold">SMTP Port</label>
                                <input type="text" name="mail_port" class="form-control" value="{{ $settings['mail_port'] ?? '465' }}" placeholder="465 or 587">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">SMTP Username</label>
                                <input type="text" name="mail_username" class="form-control" value="{{ $settings['mail_username'] ?? '' }}" placeholder="email@yourdomain.com">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">SMTP Password</label>
                                <div class="input-group">
                                    <input type="password" name="mail_password" class="form-control" value="{{ $settings['mail_password'] ?? '' }}" placeholder="••••••••">
                                    <button class="btn btn-outline-secondary" type="button" onclick="const p = this.parentElement.querySelector('input'); p.type = p.type === 'password' ? 'text' : 'password';"><i class="fas fa-eye"></i></button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Encryption</label>
                                <select name="mail_encryption" class="form-select">
                                    <option value="tls" {{ ($settings['mail_encryption'] ?? '') == 'tls' ? 'selected' : '' }}>TLS (Usually port 587)</option>
                                    <option value="ssl" {{ ($settings['mail_encryption'] ?? '') == 'ssl' ? 'selected' : '' }}>SSL (Usually port 465)</option>
                                    <option value="null" {{ ($settings['mail_encryption'] ?? '') == 'null' ? 'selected' : '' }}>None</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-semibold">Mail From Name</label>
                                <input type="text" name="mail_from_name" class="form-control" value="{{ $settings['mail_from_name'] ?? 'Smart NGO' }}">
                            </div>
                        </div>
                    </div>

                    <div class="d-flex justify-content-end gap-2 mt-5">
                        <button type="submit" class="btn btn-primary btn-fancy px-5 py-3 rounded-pill fw-bold shadow">
                            <i class="fas fa-save me-2"></i> Save Configuration
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const mailer = document.getElementById('mail_mailer');
        const smtp = document.getElementById('smtp_settings');
        if(mailer && smtp) {
            mailer.addEventListener('change', function() {
                smtp.style.display = this.value === 'smtp' ? 'block' : 'none';
            });
        }
    });
</script>
@endsection
