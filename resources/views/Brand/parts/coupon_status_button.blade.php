@if($coupon->status == 'pending')
    <button class="badge bg-light-primary rounded-5 change-status"
            data-id="{{ $coupon->id }}"
            data-status="pending"> {{ __('messages.pending') }} </button>
@elseif($coupon->status == 'complete')
    <button class="badge bg-light-success lightGreenColor rounded-5">
        {{ __('messages.completed') }}
    </button>
@else
    <button class="badge bg-light-danger rounded-5">
        {{ __('messages.rejected') }}
    </button>
@endif
