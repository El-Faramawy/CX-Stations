<input type="text" class="form-control total-purchases"
       data-id="{{ $coupon->id }}"
       value="{{ $coupon->total_purchases ?? 0 }}"
    {{ $coupon->status !== 'pending' ? 'disabled' : '' }}>
