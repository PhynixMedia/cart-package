                            <div class="col-md-6 col-lg-7">

                                @include("cart::checkout.contents.addresses")


                                @include("cart::checkout.contents.status")
                                
                                    <h6>Billing Information</h6>

                                    <hr />

                                    <input 
                                        type="hidden" 
                                        class="form-control mb-30" 
                                        name="payoptions" 
                                        value="1" 
                                        id="payoptions" />

                                    <input
                                        type="hidden"
                                        class="form-control"
                                        id="order_source"
                                        name="order_source"
                                        placeholder="website"
                                        value="website" /> 

                                    <div class="contact_from_area clearfix mb-100">
                                        <div class="contact_form">
                                                <div class="contact_input_area">
                                                    <div id="success_fail_info"></div>
                                                    <div class="row">
                                                        <!-- Form Group -->
                                                        <div class="col-12 col-lg-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control mb-30" name="fname" id="name" placeholder="First Name" required>
                                                            </div>
                                                        </div>
                                                        <!-- Form Group -->
                                                        <div class="col-12 col-lg-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control mb-30" name="lname" id="name-2" placeholder="Last Name" required>
                                                            </div>
                                                        </div>
                                                        <!-- Form Group -->
                                                        <div class="col-12 col-lg-6">
                                                            <div class="form-group">
                                                                <input type="email" class="form-control mb-30" name="email" id="email" placeholder="E-mail" required>
                                                            </div>
                                                        </div>
                                                        <!-- Form Group -->
                                                        <div class="col-12 col-lg-6">
                                                            <div class="form-group">
                                                                <input type="phone" class="form-control mb-30" name="phone" id="phone" placeholder="Phone Number">
                                                            </div>
                                                        </div>
                                                        <!-- Form Group -->
                                                        <div class="col-12 col-lg-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control mb-30" name="address" id="address" placeholder="Address" required>
                                                            </div>
                                                        </div>
                                                        <!-- Form Group -->
                                                        <div class="col-12 col-lg-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control mb-30" name="city" id="city" placeholder="Your City">
                                                            </div>
                                                        </div>
                                                        <!-- Form Group -->
                                                        <div class="col-12 col-lg-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control mb-30" name="country" id="country" placeholder="Country" required>
                                                            </div>
                                                        </div>
                                                        <!-- Form Group -->
                                                        <div class="col-12 col-lg-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control mb-30" name="postcode" id="postcode" placeholder="Your Postcode">
                                                            </div>
                                                        </div>
                                                        <!-- Form Group -->
                                                        <div class="col-12">
                                                            <div class="form-group">
                                                                <textarea name="message" class="form-text-area mb-30" id="message" cols="30" rows="6" placeholder="Your Message *" required></textarea>
                                                            </div>
                                                        </div>
                                                        
                                                        
                                                    </div>
                                                </div>
                                        </div>
                                    </div>

                                    <!-- END OF CART FORM -->
                                </div>