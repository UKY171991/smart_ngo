@extends('layouts.admin')

@section('page_title', 'All Events')

@section('content')
<div class="card border-0 shadow-sm rounded-4 overflow-hidden">
    <div class="card-header bg-white py-4 px-4 d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0 text-primary"><i class="fas fa-calendar-alt me-2"></i>Event Schedule</h5>
        <a href="{{ route('admin.events.create') }}" class="btn btn-primary btn-sm btn-fancy px-4 shadow">Schedule Event</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="bg-light">
                    <tr>
                        <th class="px-4 border-0">Event Title & Date</th>
                        <th class="border-0">Location</th>
                        <th class="border-0">Entry Fee</th>
                        <th class="border-0">Max Participants</th>
                        <th class="px-4 border-0 text-end">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($events as $event)
                    <tr>
                        <td class="px-4 py-3">
                            <div class="fw-bold">{{ $event->title }}</div>
                            <small class="text-primary fw-semibold"><i class="far fa-clock me-1"></i>{{ \Carbon\Carbon::parse($event->event_date)->format('d M Y, h:i A') }}</small>
                        </td>
                        <td>
                            <div class="text-secondary small fw-semibold"><i class="fas fa-map-marker-alt me-1"></i>{{ Str::limit($event->location, 30) }}</div>
                        </td>
                        <td>
                            {!! $event->fees > 0 ? '₹' . number_format($event->fees, 2) : '<span class="badge bg-success-subtle text-success">Free</span>' !!}
                        </td>
                        <td>
                            {{ $event->max_participants ? $event->max_participants . ' limits' : 'Unlimited' }}
                        </td>
                        <td class="px-4 text-end">
                            <div class="d-flex gap-2 justify-content-end">
                                <a href="{{ route('admin.events.edit', $event) }}" class="btn btn-sm btn-light border p-2" title="Edit Event">
                                    <i class="fas fa-edit text-warning"></i>
                                </a>
                                <form action="{{ route('admin.events.destroy', $event) }}" method="POST" onsubmit="return confirm('Cancel this event?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-light border p-2" title="Cancel Event">
                                        <i class="fas fa-trash text-danger"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center py-5">
                            <i class="fas fa-calendar-times fa-3x text-light mb-3"></i>
                            <p class="text-muted">No upcoming events scheduled.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
    <div class="card-footer bg-white border-0 py-4 px-4">
        {{ $events->links() }}
    </div>
</div>
@endsection
