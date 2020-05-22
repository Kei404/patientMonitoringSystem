@extends('layouts.admin')

@section('title')
        Patient | EDIT
@endsection

@section('name')
        {{ Auth::user()->name }}
@endsection

@section('link')
<style>

.profile_image {
  border: 1px solid #ddd;
  border-radius: 4px;
  padding: 5px;
  width: 145px;
  height: 145px;
  margin-bottom: 5px;
}

.profile_image:hover {
  box-shadow: 0 0 2px 1px rgba(0, 140, 186, 0.5);
}
.profile {
  width: 145px;
  height: 145px;
  float: left;
  text-align: center;
}
.modal-body {
  background-color: #C9FFF8;
}
</style>
@endsection

@section('content')
<div class="content-header">
  <div class="container-fluid" style="padding:5px;">

    <div class="card">

      <div style="color: #007bff; font-weight: bold;" class="card-header">

        <i class="fa fa-edit"></i> Profile Edit
        <a  
              style="float:right;"
              class="btn btn-sm btn-warning"
              href="/patient/profile/{{ $patients->id }}" class="nav-link"
              value="Back"
              > 
              <i class="fa fa-arrow-left"></i>
              
        </a>

      </div>

      <form >
      {{ csrf_field() }}

      <div class="card-body" style="padding:30px; margin:0;">

          <div class="profile">
            <label for="input_profile">

              <img class="profile_image"
                    id="img_profile" 
                    src="{{ asset('uploads/' . $patients->photo) }}"
                    alt="Image Icon" />
            
            </label>
                                            
            <input
              style="display: none;"
              onchange="onFileChange(event)"
              id="input_profile"
              type="file"
              name="photo"
              
            />
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="name">Last Name</label>
              <input
                type="text"
                class="form-control"
                name="last_name"
                placeholder="e.g., Dela Cruz"
                value="{{ $patients->last_name}}"
                required
              />
            </div>
            <div class="form-group col-md-3">
              <label for="name">First Name</label>
              <input
                type="text"
                class="form-control"
                name="first_name"
                placeholder="e.g., Juan"
                value="{{ $patients->first_name}}"
                required
              />
            </div>
            <div class="form-group col-md-2">
              <label for="name">Name Extension</label>
              <input
                type="text"
                class="form-control"
                name="name_extension"
                placeholder="e.g., Jr.,II"
                value="{{ $patients->name_extension}}"
              />
            </div>
            <div class="form-group col-md-3">
              <label for="name">Middle Name</label>
              <input
                type="text"
                class="form-control"
                name="middle_name"
                placeholder="e.g., Mercado"
                value="{{ $patients->middle_name}}"
              />
            </div>
          </div>
          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="date">Date of Birth</label>
              <input
                type="date"
                class="form-control"
                name="dob"
                placeholder="Date of Birth"
                value="{{ $patients->dob}}"
              />
            </div>
 
            <div class="form-group col-md-4">
              <label for="Gender">Gender</label>
              <select   class="form-control"
                        id="gender"
                        name="gender"
                        value="{{ $patients->gender }}">
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="grade_level">Email Address</label>
              <input
                type="email"
                class="form-control"
                name="email_address"
                placeholder="e.g., juandelacruz@gmail.com"
                value="{{ $patients->email_address }}"
              />
            </div>

            <div class="form-group col-md-4">
              <label for="name">Guardian</label>
              <input
                type="text"
                class="form-control"
                name="guardian"
                placeholder="e.g., juan dela cruz"
                value="{{ $patients->guardian }}"
                required
              />
            </div>

            <div class="form-group col-md-4">
              <label for="section">Guardian's Contact Number</label>
              <input
                type="text"
                class="form-control"
                name="contact_number"
                placeholder="e.g. 092734569473"
                value="{{ $patients->contact_number }}"
              />
            </div>
          </div>

          <div class="form-row">
            
          </div>
          <div class="form-row">
            <div class="form-group col-md-6">
              <label for="grade_level">Address 1</label>
              <input
                type="text"
                class="form-control"
                name="address1"
                placeholder="e.g., 123 Sampaguita St."
                value="{{ $patients->address1 }}"
              />
            </div>

            <div class="form-group col-md-6">
              <label for="section">Address 2</label>
              <input
                type="text"
                class="form-control"
                name="address2"
                placeholder="e.g., B6 L11 Camilla Subd. "
                value="{{ $patients->address2 }}"
              />
            </div>

          </div>

          <div class="form-row">
            <div class="form-group col-md-4">
              <label for="grade_level">Barangay</label>
              <input
                type="text"
                class="form-control"
                name="barangay"
                placeholder="e.g., Dolores"
                value="{{ $patients->barangay }}"
              />
            </div>

            <div class="form-group col-md-3">
              <label for="section">Municipality/City</label>
              <input
                type="text"
                class="form-control"
                name="municipality"
                placeholder="e.g., San Fernando "
                value="{{ $patients->municipality }}"
              />
            </div>

            <div class="form-group col-md-3">
              <label for="section">Province/State/Country</label>
              <input
                type="text"
                class="form-control"
                name="province"
                placeholder="e.g., Pampanga "
                value="{{ $patients->province }}"
              />
            </div>

            <div class="form-group col-md-2">
              <label for="section">Zip Code</label>
              <input
                type="text"
                class="form-control"
                name="zipcode"
                placeholder="e.g., 2000 "
                value="{{ $patients->zipcode }}"
              />
            </div>
          </div>
          <a style="color: white" onclick="storePatient()" class="btn btn-primary">Save</a>
      </div>

      </form>

    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body">
            <h>SUCCESS</h>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@section('scripts')

<script>

var img_profile =null;
var current_image = true;

function onFileChange(e) {
      var app = this;
      console.log(e.target.files[0]);
      var img_link =  URL.createObjectURL(e.target.files[0]);
      document.getElementById("img_profile").src = img_link;
      img_profile = e.target.files[0];
      current_image = false;
}

function storePatient(){
  var formData = new FormData();
  formData.append("photo", img_profile);
  formData.append("photo_name", "{{$patients->photo}}");
  formData.append("current_image", current_image);
  formData.append("id", {{$patients->id}});
  formData.append("_token", $("input[name=_token]").val());
  formData.append("last_name", $("input[name=last_name]").val() );
  formData.append("first_name", $("input[name=first_name]").val() );
  formData.append("name_extension", $("input[name=name_extension]").val() );
  formData.append("middle_name", $("input[name=middle_name]").val() );
  formData.append("email_address", $("input[name=email_address]").val() );
  formData.append("contact_number", $("input[name=contact_number]").val() );
  formData.append("dob", $("input[name=dob]").val() );
  formData.append("gender", document.getElementById('gender').value);
  formData.append("guardian", $("input[name=guardian]").val() );
  formData.append("address1", $("input[name=address1]").val() );
  formData.append("address2", $("input[name=address2]").val() );
  formData.append("barangay", $("input[name=barangay]").val() );
  formData.append("municipality", $("input[name=municipality]").val() );
  formData.append("province", $("input[name=province]").val() );
  formData.append("zipcode", $("input[name=zipcode]").val() );

  let xhr = new XMLHttpRequest();
  xhr.open("POST", "/patient/update");
  xhr.send(formData);

  xhr.onloadend = function(){
    console.log(xhr.response);
    
    if ( xhr.response == 'success'){
        $("#myModal").modal('show');
    
        setTimeout(function() {
        $('#myModal').modal('hide');
        }, 1000);
    }
  }

}

</script>

@endsection