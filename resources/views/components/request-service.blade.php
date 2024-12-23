
<!-- Modal Structure -->
<div class="modal fade" id="requestServiceModal" tabindex="-1" aria-labelledby="requestServiceModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="requestServiceModalLabel">{{ __('Request For a Service') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Your form starts here -->
                <form class="hero-form"  action="{{ route('service_request.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ __('Enter Name') }}</label>
                        <input type="text"  class="border-0 focus:ring-0 id="name" name="name" required placeholder="Enter Name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">{{ __('Enter Email') }}</label>
                        <input type="email" class="form-control" id="email" name="email" required placeholder=" Enter Emai">
                    </div>
                    <div class="mb-3">
                        <label for="phone" class="form-label">{{ __('Enter Phone') }}</label>
                        <input type="text" class="form-control" id="phone" name="phone" required placeholder="Enter Phone">
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label">{{ __('Enter Address') }}</label>
                        <input type="text" class="form-control" id="address" name="address" required placeholder="Enter Address">
                    </div>
                    <div class="mb-3">
                        <label for="service_type" class="form-label">{{ __('Select Service Type') }}</label>
                        <select class="form-select" id="service_type" name="service_type" required>
                            <option value="">{{ __('Select Service Type') }}</option>
                            <!-- Add your service types here -->
                            <option value="">Filter By Category</option>
                                    <option value="Agricultural Produce">Agricultural Produce</option>
                                    <option value="Motor Vehicles">Motor Vehicles</option>
                                    <option value="Land & Building">Land & Building</option>
									<option value="Computer & Accessories">Computer & Accessories</option>
                                    <option value="Mobile Devices">Mobile Devices</option>
                                    <option value="Clothes & Botique">Clothes & Botique</option>
                                    <option value="Clothes & Botique">Food Stuffs</option>
                                    <option value="Electrical Equipments">Electrical Equipments</option>
                                    <option value=" Motor Vehicle Spares">Motor Vehicle Spares</option>
                                    <option value="Softwares">Softwares</option>
									<option value="Building Materials">Building Materials</option>
                            </select>
                    </div>
                    <div class="flex flex-col mx-1" style="width:100%;">
                        <label for="attachment" class="form-label">{{ __('Attachment (Optional)') }}</label>
                        <input type="file" class="border-0 focus:ring-0 id="attachment" name="attachment">
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="site-btn">{{ __('Submit Request ') }}</button>

                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
