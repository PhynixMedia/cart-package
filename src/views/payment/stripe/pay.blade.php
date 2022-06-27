

                                    <!-- PAY FORM ---------------------------- -->

                                    <div class="hover-style" style="margin:40px 0">

                                        <div class="sr-root">
                                                                    
                                            <div class="sr-main">
                                                    
                                                    <form id="payment-form" data-action="{{ route('stripe.checkout.pay') }}" class="sr-payment-form">
                                                        @csrf
                                                        <div class="sr-combo-inputs-row">
                                                            <div class="sr-input sr-card-element" id="card-element"></div>
                                                        </div>
                                                        
                                                        <div class="sr-field-error" id="card-errors" role="alert"></div>
                                                        <button id="submit">
                                                            <div class="spinner hidden" id="spinner"></div>
                                                            <span id="button-text">Pay</span> <span id="order-amount">£{{ _payment()->total ?? '' }}</span>
                                                        </button>
                                                    </form>
                                                                        
                                            </div>

                                        </div>

                                    </div>



                                    <!-- END PAY FORM ------------------------- -->
                        