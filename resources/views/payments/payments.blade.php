@include('payments.payments_header')


    <div class="container">


    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Pay K1 sms token </h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                <ol>
                <h6> follow the steps to get your K1 SMS token</h6> 
                    <li>Dial *115#</li>
                    <li>Select option 4 ‘Make Payment’</li>
                    <li>Select option 6 ‘Goods & Services’</li>
                    <li>Select Option ‘1 Enter Merchant Code’</li>
                    <li>Enter Business Name 'ECONNECT'</li>
                    <li>Enter Amount</li>
                    <li>Enter your phone number as the Reference number</li>
                    <li>Enter pin</li>
                </ol>
            </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
            <div class="col-12 mt-4">
                <div class="card p-3">
                    <center>
                        <p class="mb-0 fw-bold h4">Pay K1 sms token</p>
                    </center>
                    
                </div>
            </div>
            <br><br>
            <div class="row">
               


                <div class="col-lg-3 mb-lg-0 mb-3">
                    <a  href="#" data-toggle="modal" data-target="#exampleModal">
                    <div class="card p-3">
                        <div class="img-box">
                            <img src="airtel.png"
                                alt="">
                        </div>
                        <div class="number">
                            <label class="fw-bold">097/077*********</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <small><span class="fw-bold"></span><span></span></small>
                            <small><span class="fw-bold"></span><span>AIRTELZM</span></small>
                        </div>
                    </div>
                    </a>
                </div>
                
                    <div class="col-lg-3 mb-lg-0 mb-3">
                    <!-- <a target="_blank" href="{{route('payments.mtn')}}"> -->

                    <div class="card p-3 disabled-card">
                            <div class="img-box">
                            <img src="https://www.example.com/path/to/mtn-logo.png" alt="MTN">

                            </div>
                            <div class="number">
                                <label class="fw-bold">096/076*******</label>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <small><span class="fw-bold"></span><span></span></small>
                                <small><span class="fw-bold"></span><span>MTNZM</span></small>
                            </div>
                        </div>
                    </a>
                   
                </div>

                <div class="col-lg-3 mb-lg-0 mb-3">
                    <!-- <a target="_blank" href="{{route('payments.zamtel')}}"> -->
                
                    <div class="card p-3 disabled-card">

                        <div class="img-box">
                            <img src="zamtelm.jpeg"
                                alt="">
                        </div>
                        <div class="number">
                            <label class="fw-bold">095/075*****</label>
                        </div>
                        <div class="d-flex align-items-center justify-content-between">
                            <small><span class="fw-bold"></span><span></span></small>
                            <small><span class="fw-bold"></span><span>ZAMTEL</span></small>
                        </div>
                    </div>
                    </a>
                </div>



    <div class="col-lg-3 mb-lg-0 mb-3">
    <div class="card p-3 disabled-card">
        <div class="img-box">
            <img src="https://www.freepnglogos.com/uploads/visa-logo-download-png-21.png" alt="VISA">
        </div>
        <div class="number">
            <label class="fw-bold" for="">**** **** **** 1060</label>
        </div>
        <div class="d-flex align-items-center justify-content-between">
            <small><span class="fw-bold">Expiry date:</span><span>10/16</span></small>
            <small><span class="fw-bold"></span><span>VISA</span></small>
        </div>
    </div>
</div>

               



               
            </div>
        </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <!-- Bootstrap JavaScript -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.bundle.min.js"></script>
   @include('payments.payments_footer')