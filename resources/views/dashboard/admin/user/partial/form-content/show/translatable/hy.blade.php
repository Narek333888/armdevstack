<div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
    <div class="col-sm-12 col-xl-12">
        <div class="bg-light_ rounded h-100">
            <div class="form-floating mb-3">
                <input type="text"
                       class="form-control"
                       name="nameHy"
                       id="nameHy"
                       placeholder="{{ __('users.edit.name_hy_input_placeholder') }}"
                       autocomplete="off"
                       value="{{ $user->getTranslation('name', 'hy') }}"
                       disabled
                >
                <label for="nameHy">{{ __('users.edit.name_hy_input_label') }}</label>
            </div>
        </div>
    </div>
</div>
