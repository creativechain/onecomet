<div class="row mt-3 mb-4">
    <div class="col-12 text-center">
        <h1 class="titulo-seccion font-weight-bold">{{ __('web.step3.title') }}</h1>
    </div>
</div>
<div class="row align-items-center">
    <div class="col-12 col-md-12">
        <div class="card p-5" style="width: 100%">
            <div class="row">
                <div class="col-12 col-md-12">
                    <ul class="list-unstyled">
                        <li><h2 class="font-16 font-weight-bold">{{ __('web.step3.customer_info') }}</h2></li>
                    </ul>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="email">{{ __('web.step3.email_input') }}</label>
                    {{--<input type="email" class="form-control" id="" placeholder="Email">--}}
                    {!! Form::email('email', '', ['v-model' => 'form.email', 'class' => 'form-control', 'id' => 'email', 'placeholder' => 'Email', 'aria-describedby' => 'email', 'required']) !!}
                    <span v-if="step === 3 && validation.error && validation.el === 'email'" class="help-block text-danger">
                        <strong>@{{ validation.error }}</strong>
                    </span>

                </div>
                <div class="form-group col-md-6">
                    <label for="address">{{ __('web.step3.address_input') }}</label>
                    {{--<input type="text" class="form-control" id="" placeholder="Domicilio">--}}
                    {!! Form::text('address', '', ['v-model' => 'form.address', 'class' => 'form-control', 'id' => 'address', 'placeholder' => __('web.step3.address'), 'aria-describedby' => 'address', 'required']) !!}
                    <span v-if="step === 3 && validation.error && validation.el === 'address'" class="help-block text-danger">
                        <strong>@{{ validation.error }}</strong>
                    </span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="phone">{{ __('web.step3.phone_input') }}</label>
                   {{-- <input type="number" class="form-control" id="" placeholder="+00 000 000 000">--}}
                    {!! Form::text('phone', '', ['v-model' => 'form.phone', 'class' => 'form-control', 'id' => 'phone', 'placeholder' => '+00 000 000 000', 'aria-describedby' => 'phone', 'required']) !!}
                    <span v-if="step === 3 && validation.error && validation.el === 'phone'" class="help-block text-danger">
                        <strong>@{{ validation.error }}</strong>
                    </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="zip_code">{{ __('web.step3.postal_code_input') }}</label>
                    {{--<input type="number" class="form-control" id="" placeholder="00000">--}}
                    {!! Form::text('zip_code', '', ['v-model' => 'form.zip_code', 'class' => 'form-control', 'id' => 'zip_code', 'placeholder' => '00000', 'aria-describedby' => 'zip_code', 'required']) !!}
                    <span v-if="step === 3 && validation.error && validation.el === 'zip_code'" class="help-block text-danger">
                        <strong>@{{ validation.error }}</strong>
                    </span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">{{ __('web.step3.name_input') }}</label>
                    {{--<input type="text" class="form-control" id="" placeholder="Nombre">--}}
                    {!! Form::text('name', '', ['v-model' => 'form.name', 'class' => 'form-control', 'id' => 'name', 'placeholder' => __('web.step3.name'), 'aria-describedby' => 'name', 'required']) !!}
                    <span v-if="step === 3 && validation.error && validation.el === 'name'" class="help-block text-danger">
                        <strong>@{{ validation.error }}</strong>
                    </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="state">{{ __('web.step3.state_input') }}</label>
                    {{--<input type="text" class="form-control" id="" placeholder="Provincia">--}}
                    {!! Form::text('state', '', ['v-model' => 'form.state', 'class' => 'form-control', 'id' => 'state', 'placeholder' => __('web.step3.state'), 'aria-describedby' => 'state', 'required']) !!}
                    <span v-if="step === 3 && validation.error && validation.el === 'state'" class="help-block text-danger">
                        <strong>@{{ validation.error }}</strong>
                    </span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="surname">{{ __('web.step3.surname_input') }}</label>
                    {{--<input type="email" class="form-control" id="" placeholder="Apellidos">--}}
                    {!! Form::text('surname', '', ['v-model' => 'form.surname', 'class' => 'form-control', 'id' => 'surname', 'placeholder' => __('web.step3.surname'), 'aria-describedby' => 'surname', 'required']) !!}
                    <span v-if="step === 3 && validation.error && validation.el === 'surname'" class="help-block text-danger">
                        <strong>@{{ validation.error }}</strong>
                    </span>
                </div>
                <div class="form-group col-md-6">
                    <label for="country">{{ __('web.step3.country_input') }}</label>
                    {{--<input type="password" class="form-control" id="" placeholder="España">--}}
                    {!! Form::text('country', '', ['v-model' => 'form.country', 'class' => 'form-control', 'id' => 'country', 'placeholder' => __('web.step3.country'), 'aria-describedby' => 'country', 'required']) !!}
                    <span v-if="step === 3 && validation.error && validation.el === 'country'" class="help-block text-danger">
                        <strong>@{{ validation.error }}</strong>
                    </span>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="birth_date">{{ __('web.step3.birth_date_input') }}</label>
                    {{--<input type="email" class="form-control" id="inputEmail4" placeholder="00/00/00">--}}
                    {!! Form::date('birth_date', '', ['v-model' => 'form.birth_date', 'class' => 'form-control', 'id' => 'birth_date', 'placeholder' => '00/00/00', 'aria-describedby' => 'birth_date', 'required']) !!}
                    <span v-if="step === 3 && validation.error && validation.el === 'birth_date'" class="help-block text-danger">
                        <strong>@{{ validation.error }}</strong>
                    </span>
                </div>
            </div>
        </div>
    </div>

</div>
<div class="row justify-content-center mt-4 mb-4">
    <div class="col-12 col-md-3 text-center mb-3">
        <button v-on:click="backStep(3)" class="font-14 btn btn-secondary text-uppercase font-weight-bold w-100" >{{ __('web.back') }}</button>
    </div>
    <div class="col-12 col-md-3 text-center">
        <div v-on:click="nextStep(3)" class="font-14 btn btn-primary text-uppercase font-weight-bold w-100">{{ __('web.continue') }}</div>
    </div>
</div>
