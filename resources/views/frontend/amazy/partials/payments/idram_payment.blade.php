@php
    $delivery_info = [];
    if(session()->has('delivery_info')){
        $delivery_info = session()->get('delivery_info');
    }
@endphp
<form action="{{route('frontend.order_payment')}}" method="post" class="idram_form_payment_23 d-none">
    @csrf
    <input type="hidden" name="method" value="IDRAM">
    <input type="hidden" name="purpose" value="order_payment">
    <input type="hidden" name="amount" value="{{$total_amount - $coupon_am}}">
    <input type="hidden" name="description" value="globaltrend.am">

    <button type="submit" class="btn_1 order_submit_btn d-none" id="idram_btn">{{ __('defaultTheme.process_to_payment') }}</button>
</form>