
                                    @php
                                        $user = auth_account_data();
                                    @endphp

                                    <div class="contact_from_area clearfix mb-100">
                                        <div class="contact_form">

                                            <h6>Billing Address</h6>
                                            
                                            <hr />

                                            <div class="address wrap">

                                                
                                                <ol style="margin-bottom: 0;">
                                                    <li>
                                                        <div class="form-group wrap_options">
                                                            <input style="width:20px;margin-right:20px" name="delivery_address_id" value="0" checked="checked" type="radio">
                                                            <div class="checkout_options">I will fill the form below and Checkout As Guest</div>
                                                        </div>
                                                    </li>
                                                    
                                                @if($contacts = _value($user, 'contacts',''))

                                                        
                                                    @foreach($contacts as $contact)
                                                    <li>
                                                        <div class="form-group wrap_options">
                                                            <input 
                                                                style="width:20px;margin-right:20px"
                                                                type="radio"
                                                                class="form-control"
                                                                name="selected_delivery_address_id"
                                                                value="{{ $contact->id ?? '' }}" />
                                                            <div class="checkout_options">
                                                                {{ $contact->address_1 ?? '' }},
                                                                {{ $contact->country ?? '' }}, {{ $contact->postcode ?? '' }},
                                                                {{ $contact->city ?? '' }}
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @endforeach

                                                @endif


                                                </ol>

                                            </div>

                                        </div>
                                    </div>

