@extends('layout')
@section('title', 'Home')
@section('css')
    <style>
        #EmployeeTable,
        tr,
        th {
            text-wrap: nowrap;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12 mb-5 float-end">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                Add New Employee <i class="ri-add-line"></i>
            </button>
        </div>
        <div class="col-lg-12">
            <table class="table table-striped table-bordered" style="width: 100%" id="EmployeeTable">
                <thead>
                    <tr class="text-center">
                        <th class="text-center">First Name</th>
                        <th class="text-center">Last Name</th>
                        <th class="text-center">Birth</th>
                        <th class="text-center">Phone</th>
                        <th class="text-center">Email</th>
                        <th class="text-center">Province</th>
                        <th class="text-center">City</th>
                        <th class="text-center">Street Address</th>
                        <th class="text-center">Zip Postal Code</th>
                        <th class="text-center">KTP</th>
                        <th class="text-center">NIK</th>
                        <th class="text-center">Position</th>
                        <th class="text-center">Bank</th>
                        <th class="text-center">Bank Account Number</th>
                        <th class="text-center">Created Date</th>
                        <th class="text-center">Updated Date</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($getEmployee as $dt)
                        <tr>
                            <td>{{ $dt->firstname }}</td>
                            <td>{{ $dt->lastname }}</td>
                            <td>{{ $dt->birth }}</td>
                            <td>{{ $dt->phone }}</td>
                            <td>{{ $dt->email }}</td>
                            <td>{{ $dt->province }}</td>
                            <td>{{ $dt->city }}</td>
                            <td>{{ $dt->street_address }}</td>
                            <td>{{ $dt->zip_postal_code }}</td>
                            <td><a href="{{ asset($dt->ktp_path) }}" data-lightbox="employee-gallery"
                                    data-title="{{ $dt->firstname }}-{{ $dt->nik }}">
                                    <img src="{{ asset($dt->ktp_path) }}" alt="Employee KTP" style="height: 25px">
                                </a></td>
                            <td>{{ $dt->nik }}</td>
                            <td>{{ $dt->position }}</td>
                            <td>{{ $dt->bank }}</td>
                            <td>{{ $dt->bank_account_number }}</td>
                            <td>{{ $dt->createdDtm }}</td>
                            <td>{{ $dt->updatedDtm }}</td>
                            <td>
                                <div class="btn-group btn-group-sm" role="group">
                                    <a href="#" class="btn btn-primary"
                                        onclick="editEmployee({{ $dt->id }})"><i class="ri-edit-fill"></i></a>
                                    <a href="#" class="btn btn-danger"
                                        onclick="deleteEmployee({{ $dt->id }})"><i
                                            class="ri-delete-bin-line"></i></a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- New Employee Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add New Employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    {{-- first name --}}
                    <div class="mb-3">
                        <label for="firstname" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname" placeholder="First Name" name="firstname"
                            required>
                    </div>
                    {{-- last name --}}
                    <div class="mb-3">
                        <label for="lastname" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname" placeholder="Last Name" name="lastname"
                            required>
                    </div>
                    {{-- date of birth --}}
                    <div class="mb-3">
                        <label for="birth" class="form-label">Date Of Birth</label>
                        <input type="date" class="form-control" id="birth" name="birth">
                    </div>
                    {{-- phone number --}}
                    <div class="mb-3">
                        <label for="phone" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone" placeholder="Phone" name="phone"
                            required>
                    </div>
                    {{-- email address --}}
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" placeholder="Email" name="email">
                    </div>
                    {{-- province use onchange --}}
                    <div class="mb-3">
                        <label for="province" class="form-label">Province</label>
                        <select class="form-select" aria-label="Default select example" id="province" name="province"
                            onchange="getListCity(this.value)">
                            <option selected disabled>Province</option>
                        </select>
                    </div>
                    {{-- city address list depend on province selected --}}
                    <div class="mb-3">
                        <label for="city" class="form-label">City</label>
                        <select class="form-select" aria-label="Default select example" id="city" name="city">
                            <option selected disabled>City</option>
                        </select>
                    </div>
                    {{-- street address --}}
                    <div class="mb-3">
                        <label for="street_address">Street Address</label>
                        <textarea class="form-control" placeholder="Street Address" id="street_address" style="height: 100px"
                            name="street_address"></textarea>
                    </div>
                    {{-- zip code --}}
                    <div class="mb-3">
                        <label for="ZIP" class="form-label">ZIP Postal Code</label>
                        <input type="text" class="form-control" id="ZIP" placeholder="ZIP" name="ZIP">
                    </div>
                    {{-- KTP image --}}
                    <div class="mb-3">
                        <label for="formFile" class="form-label">KTP</label>
                        <input class="form-control" type="file" id="formFile" name="ktp">
                    </div>
                    {{-- KTP number --}}
                    <div class="mb-3">
                        <label for="KTP_number" class="form-label">KTP Number</label>
                        <input type="text" class="form-control" id="KTP_number" placeholder="NIK" name="nik"
                            required>
                    </div>
                    {{-- current position --}}
                    <div class="mb-3">
                        <label for="position" class="form-label">Current Position</label>
                        <select class="form-select" aria-label="Default select example" id="position" name="position">
                            <option selected disabled>Position</option>
                            <option value="Vice President">Vice President</option>
                            <option value="General Manager">General Manager</option>
                            <option value="Manager">Manager</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </div>
                    {{-- bank account --}}
                    <div class="mb-3">
                        <label for="bank" class="form-label">Bank</label>
                        <select class="form-select" aria-label="Default select example" id="bank" name="bank">
                            <option selected disabled>Bank</option>
                            <option value="BCA">Bank Central Asia (BCA)</option>
                            <option value="BRI">Bank Rakyat Indonesia (BRI)</option>
                            <option value="BNI">Bank Negara Indonesia (BNI)</option>
                            <option value="Mandiri">Bank Mandiri</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    {{-- bank account number --}}
                    <div class="mb-3">
                        <label for="account_number" class="form-label">Account Number</label>
                        <input type="text" class="form-control" id="account_number" placeholder="Bank Account Number"
                            name="bank_account_number">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="button_submit"
                        onclick="submitEmployee(this)">Save <i class="ri-save-line"></i></button>
                </div>
            </div>
        </div>
    </div>

    {{-- Edit Employee Modal --}}
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Employee</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="hidden" id="id_edit">
                    {{-- first name --}}
                    <div class="mb-3">
                        <label for="firstname_edit" class="form-label">First Name</label>
                        <input type="text" class="form-control" id="firstname_edit" placeholder="First Name"
                            name="firstname_edit" required>
                    </div>
                    {{-- last name --}}
                    <div class="mb-3">
                        <label for="lastname_edit" class="form-label">Last Name</label>
                        <input type="text" class="form-control" id="lastname_edit" placeholder="Last Name"
                            name="lastname_edit" required>
                    </div>
                    {{-- date of birth --}}
                    <div class="mb-3">
                        <label for="birth_edit" class="form-label">Date Of Birth</label>
                        <input type="date" class="form-control" id="birth_edit" name="birth"_edit>
                    </div>
                    {{-- phone number --}}
                    <div class="mb-3">
                        <label for="phone_edit" class="form-label">Phone</label>
                        <input type="tel" class="form-control" id="phone_edit" placeholder="Phone" name="phone"
                            required>
                    </div>
                    {{-- email address --}}
                    <div class="mb-3">
                        <label for="email_edit" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email_edit" placeholder="Email" name="email">
                    </div>
                    {{-- province use onchange --}}
                    <div class="mb-3">
                        <label for="province_edit" class="form-label">Province</label>
                        <select class="form-select" aria-label="Default select example" id="province_edit"
                            name="province" onchange="getListCityEdit(this.value)">
                            <option selected disabled>Province</option>
                        </select>
                    </div>
                    {{-- city address list depend on province selected --}}
                    <div class="mb-3">
                        <label for="city_edit" class="form-label">City</label>
                        <select class="form-select" aria-label="Default select example" id="city_edit" name="city">
                            <option selected disabled>City</option>
                        </select>
                    </div>
                    {{-- street address --}}
                    <div class="mb-3">
                        <label for="street_address_edit">Street Address</label>
                        <textarea class="form-control" placeholder="Street Address" id="street_address_edit" style="height: 100px"
                            name="street_address"></textarea>
                    </div>
                    {{-- zip code --}}
                    <div class="mb-3">
                        <label for="ZIP_edit" class="form-label">ZIP Postal Code</label>
                        <input type="text" class="form-control" id="ZIP_edit" placeholder="ZIP" name="ZIP_edit">
                    </div>
                    {{-- KTP image --}}
                    <div class="mb-3">
                        <label for="formFile_edit" class="form-label">KTP</label>
                        <input class="form-control" type="file" id="formFile_edit" name="ktp_edit">
                    </div>
                    {{-- img preview --}}
                    <div class="text-center">
                        <a href="#" data-lightbox="employee-gallery" id="a_lb">
                            <img src="#" alt="Employee KTP" style="max-height: 200px" id="ktpPreview">
                        </a>
                    </div>
                    {{-- KTP number --}}
                    <div class="mb-3">
                        <label for="KTP_number_edit" class="form-label">KTP Number</label>
                        <input type="text" class="form-control" id="KTP_number_edit" placeholder="NIK"
                            name="nik_edit" required>
                    </div>
                    {{-- current position --}}
                    <div class="mb-3">
                        <label for="position_edit" class="form-label">Current Position</label>
                        <select class="form-select" aria-label="Default select example" id="position_edit"
                            name="position_edit">
                            <option selected disabled>Position</option>
                            <option value="Vice President">Vice President</option>
                            <option value="General Manager">General Manager</option>
                            <option value="Manager">Manager</option>
                            <option value="Supervisor">Supervisor</option>
                            <option value="Staff">Staff</option>
                        </select>
                    </div>
                    {{-- bank account --}}
                    <div class="mb-3">
                        <label for="bank_edit" class="form-label">Bank</label>
                        <select class="form-select" aria-label="Default select example" id="bank_edit" name="bank_edit">
                            <option selected disabled>Bank</option>
                            <option value="BCA">Bank Central Asia (BCA)</option>
                            <option value="BRI">Bank Rakyat Indonesia (BRI)</option>
                            <option value="BNI">Bank Negara Indonesia (BNI)</option>
                            <option value="Mandiri">Bank Mandiri</option>
                            <option value="Lainnya">Lainnya</option>
                        </select>
                    </div>
                    {{-- bank account number --}}
                    <div class="mb-3">
                        <label for="account_number_edit" class="form-label">Account Number</label>
                        <input type="text" class="form-control" id="account_number_edit"
                            placeholder="Bank Account Number" name="account_number_edit">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="button_submit"
                        onclick="submitEditEmployee(this)">Save <i class="ri-save-line"></i></button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('js')
    <script>
        $(document).ready(function() {
            // inisialisasi datatable
            $('#EmployeeTable').dataTable({
                "scrollY": "500px",
                "scrollX": true,
                "columnDefs": [{
                    "targets": [0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13],
                    "orderable": true
                }],
                "lengthMenu": [
                    [50, 100, 250, -1],
                    ['50', '100', '250', 'All']
                ]
            });

            // get provinsi dari API https://www.emsifa.com/api-wilayah-indonesia/
            $.get("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json", function(data) {
                var provinceDropdown = $("#province");
                provinceDropdown.empty();
                provinceDropdown.append('<option selected disabled>Province</option>');
                $.each(data, function(index, province) {
                    provinceDropdown.append('<option value="' + province.id + '">' + province
                        .name +
                        '</option>');
                });
            });
        });

        function getListCity(id_provinsi) {
            // get list kota dari API https://www.emsifa.com/api-wilayah-indonesia/
            if (id_provinsi) {
                $.get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/" + id_provinsi +
                    ".json",
                    function(cities) {
                        var cityDropdown = $("#city");
                        cityDropdown.empty();
                        cityDropdown.append('<option selected disabled>City</option>');
                        $.each(cities, function(index, city) {
                            cityDropdown.append('<option value="' + city.id + '">' + city
                                .name + '</option>');
                        });
                    });
            } else {
                $("#city").empty().append('<option selected disabled>City</option>');
            }
        }

        function getListCityEdit(id_provinsi, cityEdit) {
            // get list kota dari API https://www.emsifa.com/api-wilayah-indonesia/
            if (id_provinsi) {
                $.get("https://www.emsifa.com/api-wilayah-indonesia/api/regencies/" + id_provinsi +
                    ".json",
                    function(cities) {
                        console.log()
                        var cityDropdown = $("#city_edit");
                        cityDropdown.empty();
                        cityDropdown.append('<option selected disabled>City</option>');
                        $.each(cities, function(index, city) {
                            var option = $('<option value="' + city.id + '">' + city
                                .name + '</option>');

                            if (city.name === cityEdit) {
                                option.prop('selected', true);
                            }

                            cityDropdown.append(option);
                        });
                    });
            } else {
                $("#city_edit").empty().append('<option selected disabled>City</option>');
            }
        }

        function submitEmployee(button) {
            if (!validateForm()) {
                Swal.fire({
                    icon: 'warning',
                    title: "Please fill in all required fields.",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                return;
            }

            // Menghindari double submit
            $(button).prop('disabled', true);

            var formData = new FormData();
            formData.append('firstname', $("#firstname").val());
            formData.append('lastname', $("#lastname").val());
            formData.append('birth', $("#birth").val());
            formData.append('phone', $("#phone").val());
            formData.append('email', $("#email").val());
            formData.append('province', $("#province option:selected").text());
            formData.append('city', $("#city option:selected").text());
            formData.append('street_address', $("#street_address").val());
            formData.append('ZIP', $("#ZIP").val());
            formData.append('ktp', $("#formFile")[0].files[0]);
            formData.append('nik', $("#KTP_number").val());
            formData.append('position', $("#position").val());
            formData.append('bank', $("#bank").val());
            formData.append('bank_account_number', $("#account_number").val());

            // Submit form menggunakan Axios (karena ajax method POST sering bug)
            axios.post("{{ url('/employee/save') }}", formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }
            }).then(response => {
                console.log(response.data);
                Swal.fire({
                    icon: response.data.status,
                    title: response.data.message,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                }).then((result) => {
                    if (result.dismiss) {
                        location.reload();
                    }
                });
            }).catch(error => {
                console.error('Error:', error);
            });
        }

        function validateForm() {
            var requiredFields = ['firstname', 'lastname', 'phone', 'KTP_number'];
            for (var i = 0; i < requiredFields.length; i++) {
                var field = $('#' + requiredFields[i]);
                if (field.val() == '' || field.val() == null) {
                    return false;
                }
            }
            return true;
        }

        function validateEditForm() {
            var requiredFields = ['firstname_edit', 'lastname_edit', 'phone_edit', 'KTP_number_edit'];
            for (var i = 0; i < requiredFields.length; i++) {
                var field = $('#' + requiredFields[i]);
                if (field.val() == '' || field.val() == null) {
                    return false;
                }
            }
            return true;
        }

        function editEmployee(id) {
            $.ajax({
                url: "{{ url('employee/get/') }}" + "/" + id,
                method: 'GET',
                headers: {
                    'X-CSRFToken': '{{ csrf_token() }}'
                },
                success: function(response) {
                    console.log(response)
                    $("#id_edit").val(response.id);
                    $("#firstname_edit").val(response.firstname);
                    $("#lastname_edit").val(response.lastname);
                    $("#birth_edit").val(response.birth);
                    $("#phone_edit").val(response.phone);
                    $("#email_edit").val(response.email);
                    $("#street_address_edit").val(response.street_address);
                    $("#ZIP_edit").val(response.zip_postal_code);
                    $("#position_edit").val(response.position);
                    $("#bank_edit").val(response.bank);
                    $("#KTP_number_edit").val(response.nik);
                    $("#account_number_edit").val(response.bank_account_number);
                    $("#ktpPreview").attr("src", "/" + response.ktp_path);
                    $("#a_lb").attr("href", "/" + response.ktp_path);


                    $.get("https://www.emsifa.com/api-wilayah-indonesia/api/provinces.json", function(data) {
                        var provinceDropdown = $("#province_edit");
                        provinceDropdown.empty();
                        provinceDropdown.append('<option selected disabled>Province</option>');
                        $.each(data, function(index, province) {
                            var option = $('<option value="' + province.id + '">' + province
                                .name + '</option>');

                            if (province.name === response.province) {
                                option.prop('selected', true);
                                getListCityEdit(province.id, response.city);
                            }

                            provinceDropdown.append(option);
                        });
                    });
                    // Show the modal
                    $("#editModal").modal("show");
                }
            });
        }

        function submitEditEmployee(button) {
            if (!validateEditForm()) {
                Swal.fire({
                    icon: 'warning',
                    title: "Please fill in all required fields.",
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                });
                return;
            }

            // Menghindari double submit
            $(button).prop('disabled', true);

            var formData = new FormData();
            formData.append('id', $("#id_edit").val());
            formData.append('firstname', $("#firstname_edit").val());
            formData.append('lastname', $("#lastname_edit").val());
            formData.append('birth', $("#birth_edit").val());
            formData.append('phone', $("#phone_edit").val());
            formData.append('email', $("#email_edit").val());
            formData.append('province', $("#province_edit option:selected").text());
            formData.append('city', $("#city_edit option:selected").text());
            formData.append('street_address', $("#street_address_edit").val());
            formData.append('ZIP', $("#ZIP_edit").val());
            formData.append('ktp', $("#formFile_edit")[0].files[0]);
            formData.append('nik', $("#KTP_number_edit").val());
            formData.append('position', $("#position_edit").val());
            formData.append('bank', $("#bank_edit").val());
            formData.append('bank_account_number', $("#account_number_edit").val());

            // Submit form menggunakan Axios (karena ajax method POST sering bug)
            axios.post("{{ url('/employee/edit') }}", formData, {
                headers: {
                    'Content-Type': 'multipart/form-data',
                    'X-CSRF-Token': '{{ csrf_token() }}'
                }
            }).then(response => {
                console.log(response.data);
                Swal.fire({
                    icon: response.data.status,
                    title: response.data.message,
                    toast: true,
                    position: 'top-end',
                    showConfirmButton: false,
                    timer: 3000
                }).then((result) => {
                    if (result.dismiss) {
                        location.reload();
                    }
                });
            }).catch(error => {
                console.error('Error:', error);
            });
        }

        function deleteEmployee(id) {
            Swal.fire({
                title: "Are you sure want to delete this Employee?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.post("{{ url('employee/delete/') }}" + "/" + id, {
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRFToken': '{{ csrf_token() }}'
                        }
                    }).then(response => {
                        console.log(response.data);
                        Swal.fire({
                            title: "Deleted!",
                            text: "Your file has been deleted.",
                            icon: "success"
                        }).then(() => {
                            location.reload();
                        });
                    }).catch(error => {
                        console.error('Error:', error);
                    });
                }
            });
        }
    </script>
@endsection
