<form action="{{ route('payment_gateway.configuration') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="row">
        <div class="col-xl-12">
            <div class="primary_input mb-25">
                <input type="hidden" name="types[]" value="RAZOR_KEY">
                <label class="primary_input_label" for="">Idram ID</label>
                <input name="RAZOR_KEY" class="primary_input_field" value="{{ $gateway->perameter_1 }}"
                    placeholder="Idram ID" type="text">
                <span class="text-danger" id="edit_name_error"></span>
            </div>
        </div>
        <input type="hidden" name="name" value="RazorPay Configuration">
        <div class="col-xl-12">
            <div class="primary_input mb-25">
                <input type="hidden" name="types[]" value="RAZORPAY_SECRET">
                <label class="primary_input_label" for="">Secret Key </label>
                <input name="RAZORPAY_SECRET" class="primary_input_field" value="{{ $gateway->perameter_2 }}"
                    placeholder="Idram Secret Key" type="text">
                <span class="text-danger" id="edit_name_error"></span>
            </div>
        </div>
        <input type="hidden" name="id" value="{{ @$gateway->id }}">
        <input type="hidden" name="method_id" value="{{ @$gateway->method->id }}">
        @if(auth()->user()->role->type != 'seller')
            <div class="col-xl-8">
                <div class="primary_input mb-25">
                    <label class="primary_input_label" for="">{{ __('payment_gatways.gateway_logo') }} ({{getNumberTranslate(400)}} X {{getNumberTranslate(166)}}){{__('common.px')}}</label>
                    <div class="primary_file_uploader">
                        <input class="primary-input" type="text" id="Razor_file"
                            placeholder="{{ __('payment_gatways.gateway_logo') }}" readonly="" />
                        <button class="" type="button">
                            <label class="primary-btn small fix-gr-bg" for="logoRazor">{{ __('product.Browse') }} </label>
                            <input type="file" class="d-none" name="logo" accept="image/*" id="logoRazor" />
                        </button>
                    </div>

                </div>
            </div>
            <div class="col-xl-4">
                <div class="logo_div">
                    @if (@$gateway->method->logo)
                    <img id="logoRazorDiv" class=""
                        src="{{ showImage(@$gateway->method->logo) }}" alt="">
                    @else
                    <img id="logoRazorDiv" class="" src="{{ showImage('backend/img/default.png') }}" alt="">
                    @endif
                </div>
            </div>
        @endif
        <div class="col-lg-12 text-center">
            <button class="primary_btn_2 mt-2"><i class="ti-check"></i>{{__("common.update")}} </button>
        </div>
    </div>
</form>
