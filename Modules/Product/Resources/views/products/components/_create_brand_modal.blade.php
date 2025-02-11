<div class="modal fade admin-query" id="create_brand_modal">
    <div class="modal-dialog modal_1000px modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">{{ __('product.create_brand') }}</h4>
                <button type="button" class="close " data-dismiss="modal">
                    <i class="ti-close "></i>
                </button>
            </div>
            @php
                $LanguageList = getLanguageList();
            @endphp
            <div class="modal-body">
                <form action="" method="POST" enctype="multipart/form-data" id="create_brand_form">
                    <div class="row">
                        <input type="hidden" name="form_type" value="modal_form">
                        <div class="col-lg-8">
                            <div class="white_box_50px box_shadow_white mb-20">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="main-title d-flex">
                                            <h3 class="mb-2 mr-30">{{ __('product.brand_info') }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5"
                                            role="tablist">
                                            @foreach ($LanguageList as $key => $language)
                                                <li class="nav-item">
                                                    <a class="nav-link anchore_color @if (auth()->user()->lang_code == $language->code) active @endif"
                                                       href="#belement{{$language->code}}" role="tab" data-toggle="tab"
                                                       aria-selected="@if (auth()->user()->lang_code == $language->code) true @else false @endif">{{ $language->native }} </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                            @foreach ($LanguageList as $key => $language)
                                                <div role="tabpanel"
                                                     class="tab-pane fade @if (auth()->user()->lang_code == $language->code) show active @endif"
                                                     id="belement{{$language->code}}">
                                                    <div class="col-lg-12">
                                                        <div class="primary_input mb-15">
                                                            <label class="primary_input_label"
                                                                   for=""> {{__("common.name")}} <span
                                                                        class="text-danger">*</span></label>
                                                            <input class="primary_input_field"
                                                                   name="name[{{$language->code}}]"
                                                                   placeholder="{{__("common.name")}}" type="text"
                                                                   value="{{old('name')}}">
                                                            <span class="text-danger" id="error_brand_name"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12" id="brand_des_div">
                                                        <div class="primary_input mb-15">
                                                            <label class="primary_input_label"
                                                                   for=""> {{__("common.description")}} </label>
                                                            <textarea class="summernote"
                                                                      name="description[{{$language->code}}]"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="primary_input mb-30">
                                            <label class="primary_input_label"
                                                   for=""> {{__("product.website_link")}}</label>
                                            <input class="primary_input_field" name="link"
                                                   placeholder="{{__("product.website_link")}}" type="text"
                                                   value="{{old('link')}}">
                                            <span class="text-danger" id="error_brand_link"></span>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="main-title d-flex">
                                            <h3 class="mb-2 mr-30">{{ __('common.seo_info') }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <ul class="nav nav-tabs justify-content-start mt-sm-md-20 mb-30 grid_gap_5"
                                            role="tablist">
                                            @foreach ($LanguageList as $key => $language)
                                                <li class="nav-item">
                                                    <a class="nav-link anchore_color @if (auth()->user()->lang_code == $language->code) active @endif"
                                                       href="#bmelement{{$language->code}}" role="tab"
                                                       data-toggle="tab"
                                                       aria-selected="@if (auth()->user()->lang_code == $language->code) true @else false @endif">{{ $language->native }} </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <div class="tab-content">
                                            @foreach ($LanguageList as $key => $language)
                                                <div role="tabpanel"
                                                     class="tab-pane fade @if (auth()->user()->lang_code == $language->code) show active @endif"
                                                     id="bmelement{{$language->code}}">
                                                    <div class="col-lg-12">
                                                        <div class="primary_input mb-15">
                                                            <label class="primary_input_label"
                                                                   for=""> {{__("common.meta_title")}}</label>
                                                            <input class="primary_input_field"
                                                                   name="meta_title[{{$language->code}}]"
                                                                   placeholder="{{__("common.meta_title")}}"
                                                                   type="text"
                                                                   value="{{old('meta_title.'.$language->code)}}">
                                                            <span class="text-danger"
                                                                  id="error_brand_meta_title"></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <div class="primary_input mb-15">
                                                            <label class="primary_input_label"
                                                                   for=""> {{__("common.meta_description")}}</label>
                                                            <textarea
                                                                    class="primary_textarea height_112 meta_description"
                                                                    placeholder="{{ __('common.meta_description') }}"
                                                                    name="meta_description[{{$language->code}}]"
                                                                    spellcheck="false"> {{old('meta_description.'.$language->code)}}</textarea>
                                                            <span class="text-danger"
                                                                  id="error_brand_meta_description"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="white_box_50px box_shadow_white p-15">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="main-title d-flex">
                                            <h3 class="mb-2 mr-30">{{ __('common.status_info') }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="primary_input mb-25">
                                            <label class="primary_input_label" for="">{{ __('common.status') }} <span
                                                        class="text-danger">*</span></label>
                                            <select class="primary_select mb-25" name="status" id="brand_status">
                                                <option value="1">{{ __('common.publish') }}</option>
                                                <option value="0">{{ __('common.pending') }}</option>
                                            </select>

                                            <span class="text-danger" id="error_brand_status"></span>

                                        </div>
                                    </div>
                                    <div class="col-lg-8">
                                        <div class="main-title d-flex">
                                            <h3 class="mb-2 mr-30">{{ __('common.logo') }} (150x150)PX</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-4" id="brand_logo_preview_div">
                                        <div class="brand_img_div">
                                            <img id="logoImg" src="{{ showImage('backend/img/default.png') }}" alt="">
                                        </div>
                                    </div>
                                    <div class="col-lg-12" id="brand_logo_img_div">
                                        <div class="primary_input mb-25">
                                            <div class="primary_file_uploader">
                                                <input class="primary-input" type="text" id="logo_file"
                                                       placeholder="{{__('common.browse_image_file')}}" readonly="">
                                                <button class="" type="button">
                                                    <label class="primary-btn small fix-gr-bg"
                                                           for="Brand_logo">{{__("common.logo")}} </label>
                                                    <input type="file" class="d-none" name="logo" id="Brand_logo">
                                                </button>
                                            </div>


                                            <span class="text-danger" id="error_brand_logo"></span>

                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="main-title d-flex">
                                            <h3 class="mb-2 mr-30">{{ __('common.is_featured') }}</h3>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="primary_input mb-25">
                                            <label class="switch_toggle" for="active_checkbox1">
                                                <input type="checkbox" id="active_checkbox1" name="featured" checked>
                                                <div class="slider round"></div>
                                            </label>
                                        </div>
                                    </div>
                                    <div class="col-12">
                                        <button class="primary_btn_2 mt-5"><i class="ti-check"></i>{{__("common.save")}}
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
