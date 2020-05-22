@extends('layouts.admin')

@section('title')
        Patient | PROFILE
@endsection

@section('name')
        {{ Auth::user()->name }}
@endsection


@section('link')
<style type="text/css">
  .profile-img {
      max-width: 150px;
      border: 5px solid #fff;
      border-radius: 100%;
      box-shadow: 0 2px 2px rgba(0, 0, 0, 0.3);
  }
  .table-responsive {
      height: 60vh;
      overflow-x: auto;
  }
  .table {
      margin: 0px;
      padding: 0px;
      text-align: center;
      min-width: 450px;
  }

  td {
      vertical-align: middle;
      padding: 5px;
      text-align: center;
  }
  th {
      text-align: center;
  }
 
  .nav-tabs .nav-item.show .nav-link, 
  .nav-tabs .nav-link.active {
    color: #0080FB;
    background-color: #fff;
    border-color: #dee2e6 #dee2e6 #fff;
  }
  a {
    color: #000000;
    text-decoration: none;
    background-color: transparent;
  }
  
</style>
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid" style="padding:5px;">

  <div class="row">
    <div class="col-sm-6 col-xl-4">
      <div class="card">
        <div style="color: #007bff; font-weight: bold;" class="card-header">

          <a
            style="float:right; color: white;"
            class="btn btn-sm btn-info"
            onclick="goToEdit( {{$patients->id}} );">
            Edit  
          </a>
         
          <i class="nav-icon fa fa-user"></i> Profile
        </div>
        <div class="card-body text-center">

            <img
                class="profile-img"
                src="{{ asset('uploads/' . $patients->photo) }}"
            >
            <p></p>

            <h1>{{ $patients->last_name }},
                {{ $patients->first_name }}
                {{ $patients->middle_name }}</h1><p></p>
            <h>Guardian: {{ $patients->guardian }}</h><p></p>
            <h>Contact No.: {{ $patients->contact_number }}</h><p></p>
            <a  class="btn btn-sm btn-info" 
              data-toggle="modal" 
              data-target="#detailsModal"
              style=" color: white;"> More
          </a>   
        </div>
      </div>
    </div>
    <div class="col-sm-6 col-xl-8">
      <div class="card">
        <div style="color: #007bff; font-weight: bold;" class="card-header">
          <i class="nav-icon fa fa-list-alt"></i> More Info
        </div>
        <div class="card-body">

            <div class="col-sm-12">
          
              <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a
                    class="nav-link active"
                    id="flocks-tab"
                    data-toggle="tab"
                    href="#flocks"
                    role="tab"
                    aria-controls="flocks"
                    aria-selected="false"
                  >Vital History</a>
                </li>
                <li class="nav-item">
                  <a
                    class="nav-link"
                    id="Attended-tab"
                    data-toggle="tab"
                    href="#Attended"
                    role="tab"
                    aria-controls="Attended"
                    aria-selected="true"
                  >Latest Vitals</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div
                  class="tab-pane fade show active"
                  id="flocks"
                  role="tabpanel"
                  aria-labelledby="flocks-tab"
                >
                  <div class="card" style="border:none; padding:0px; margin-bottom:5px;">
                    <div class="card-body" style="padding:0px; margin:0px;">
              
                    </div>
                  </div>
                  <div class="card">
                    <!-- <div class="card-header">
                      
                    </div>-->
                    <div class="card-body" style="padding:0px;">
                      <div class="table-responsive">
                        <table class="table table-striped">
                          <thead>
                            <tr>
                                <th>Time & Date</th>
                                <th>PPM</th>
                                <th>HBPM</th>
                                <th>Temp(°C)</th>
                                <th>Action</th>
                            </tr>
                          </thead>
                          <tbody id="tableData">


                                  <!-- Modal -->
                                  <div class="modal fade" id="deleteModal" role="dialog">
                                      <div class="modal-dialog">
                                    
                                        <!-- Modal content-->
                                        <div class="modal-content">
                                          <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">DELETE</h5>
                                              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                              </button>
                                          </div>

                                          <div class="modal-body">

                                          <form action="/delete/history_id" method="POST" id="deleteForm">  
                                          {{ csrf_field() }}
                                          {{ method_field('DELETE') }}

                                            <input type="hidden" id="history_id" name="history_id" value="DELETE">
                                            <p> Are You Sure?.. You Want to Delete Data? </p>
                                          
                                          </div>
                                          <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button id="yesClicked" type="submit" class="btn btn-primary">Yes! delete data</button>
                                          </div>
                                          </form>
                                          
                                        </div>
                                        
                                      </div>
                                    </div>
                         
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div
                  class="tab-pane fade"
                  id="Attended"
                  role="tabpanel"
                  aria-labelledby="Attended-tab"
                >
                  <div class="card" style="min-width: 20px;">
                  <form >
                  {{ csrf_field() }}

                    <div  class="card-body" style="padding:20px">
                      
                    <table id="tableHolder" class="table table-striped"  style="min-width: 0px;">
                          <!-- <thead>
                            <tr>
                                <th>Date</th>
                                <th>Time</th>
                                <th>PPM</th>
                                <th>HBPM</th>
                                <th>Temp</th>
                            </tr>
                          </thead> -->
                          <tbody>
                          
                          <tr>
                                <td class="float-left">Pulserate:
                                <span id="rate" class="fas fa-file-medical-alt text-danger"></span></td>
                          </tr>
                          <tr>
                                <td class="float-left">Heartbeat:
                                <span id="beat" class="fas fa-heartbeat text-danger"></span></td>
                          </tr>
                          <tr>
                                <td class="float-left">temperature:
                                <span id="temp" class="fas fa-temperature-high text-danger"></span></td>
                          </tr>
                          <tr>
                                <td class="float-left">Time:
                                <span id="time" class="fa fa-clock text-danger"></span></td>
                          </tr>
                          <tr>
                                <td class="float-left">Date:
                                <span id="date" class="fa fa-calendar text-danger"></span></td>
                          </tr>
                          <tr>
                                <td class="float-right" style="min-width: 0px;"> 
                                <a style="color: white;" onclick="storeVitals()" class="btn btn-primary">Save</a>
                                </td>
                          </tr>
                         
                          </tbody>
                        </table>
                            
                    </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>


  </div>

    <!-- Modal for More info-->
    <div class="modal fade" id="detailsModal" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div style="color: #007bff" class="modal-header">
          <!-- <i class="nav-icon fa fa-list-alt"></i> More Info -->
            <h class="nav-icon fa fa-list-alt" id="exampleModalLabel"> More Info</h>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
          </div>

          <div class="modal-body">
            <div class="card-body" style="padding:0px; margin:0;">
              <div>
                <span style="font-weight: bold;" >Name: </span> {{ $patients->last_name }},
                {{ $patients->first_name }} {{ $patients->middle_name }}
                <br>
                <span style="font-weight: bold;">Date of Birth: </span> {{ $patients->dob }}
                <br>
                <span style="font-weight: bold;">Gender: </span> {{ $patients->gender }}
                <br>
                <span style="font-weight: bold;">Address: </span> {{ $patients->address1 }}
                <br>
                <span style="font-weight: bold;">Barangay: </span> {{ $patients->barangay }}
                <br>
                <span style="font-weight: bold;">Municipality: </span> {{ $patients->municipality }}
                <br>
                <span style="font-weight: bold;">Province: </span> {{ $patients->province }}
                <br>
                <span style="font-weight: bold;"> Zipcode: </span> {{ $patients->zipcode }}
              </div>
              
            </div>
          </div>
          
        </div>
        
      </div>
    </div>

    

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
      <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-body" style="background-color: #C9FFF8;">
            <h>SUCCESS</h>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>
@endsection

@section('scripts')
<script type='text/javascript'>

  $(function(){
    getVitalForRefresh();
    getPatientVitals();
    setInterval( function(){
      getPatientVitals();
    }, 10000);
  });

  function goToEdit(id){
     window.location="/patient/edit/"+id;
  }

  function getPatientVitals(){

    let xhr = new XMLHttpRequest();
    xhr.open("GET", "/vitals");
    xhr.send();
    xhr.onloadend = function(){

    var data = JSON.parse(xhr.response);

    var rate1 = data.patients.rate;
    var beat1 = data.patients.beat;
    var temp1 = data.patients.temp;
    var date = data.patients.updated_at;

    // var split = date_parse_from_format('Y-m-d h:i:s', date);
    //  date('F d, Y', strtotime(data.patients.updated_at))

    document.getElementById('rate').innerText = rate1;
    document.getElementById('beat').innerText = beat1;
    document.getElementById('temp').innerText = temp1;

    document.getElementById('time').innerText = getCurrentTime(date);
    document.getElementById('date').innerText = getCurrentDate(date);
    
    //  console.log(date);
      console.log(rate1, beat1, temp1);
    }
  }

  function getCurrentTime(sensorDay) {
     var today = new Date(sensorDay);
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();

    var hours = today.getHours();
    var minutes = today.getMinutes();
    var ampm = hours >= 12 ? 'pm':'am';
    hours = hours%12;
    hours = hours ? hours:12;
    minutes = minutes < 10 ? '0'+minutes:minutes;
    var strTime = hours+':'+minutes+ ' '+ampm;

    if (dd < 10) {
      dd = '0' + dd
    }

    if (mm < 10) {
       mm = '0' + mm
    }
    // return today = yyyy + '-' + mm + '-' + dd;
    return strTime;

    //  return today + " "+strTime;
  }

  function getCurrentDate(sensorDay) {
     var today = new Date(sensorDay);
    var dd = today.getDate();
    var mm = today.getMonth() + 1;
    var yyyy = today.getFullYear();

    var hours = today.getHours();
    var minutes = today.getMinutes();
    var ampm = hours >= 12 ? 'pm':'am';
    hours = hours%12;
    hours = hours ? hours:12;
    minutes = minutes < 10 ? '0'+minutes:minutes;
    var strTime = hours+':'+minutes+ ' '+ampm;

    if (dd < 10) {
      dd = '0' + dd
    }

    if (mm < 10) {
       mm = '0' + mm
    }
    return today = mm + '-' + dd + '-' + yyyy;
    // return strTime;

    //  return today + " "+strTime;
  }


  function storeVitals(){

    var pulse_rate = document.getElementById('rate');
    var heart_beat = document.getElementById('beat');
    var temperature = document.getElementById('temp');

    var formData = new FormData();

    formData.append("_token", $("input[name=_token]").val());
    formData.append("members_id", "{{ $patients->id }}");

    formData.append("pulse_rate", pulse_rate.innerText);
    formData.append("heart_beat", heart_beat.innerText);
    formData.append("temperature", temperature.innerText);

    let xhr = new XMLHttpRequest();
    xhr.open("POST", "/vitals/store");
    
    xhr.send(formData);  
    xhr.onloadend = function(){
    console.log(xhr.response);

    // return success message
    if ( xhr.response == 'success'){
    $("#myModal").modal('show');
    getVitalForRefresh();

    setTimeout(function() {
    $('#myModal').modal('hide');
    }, 1000);
    
    }
    }
  }

  function getVitalForRefresh(){

    let xhr = new XMLHttpRequest();
  
    xhr.open("GET", "/vitalrefresh/"+{{$patients->id}});
    xhr.send(); 
    xhr.onloadend = function(){

    var data = JSON.parse(xhr.response);

    var tableData="";
    
      $.each(data.vitals, function(i, item){
        
        tableData += " <tr>\
                          <td>"+item.updated_at+"</td>\
                          <td>"+item.pulse_rate+"</td>\
                          <td>"+item.heart_beat+"</td>\
                          <td>"+item.temperature+"</td>\
                          <td>\
                            <a data-history_id="+item.id+" class=\"btn btn-danger delete\" data-toggle=\"modal\" data-target=\"#deleteModal\" style=\"color:white;\">DELETE</a>\
                          </td>\
                      </tr>"
      });

      document.getElementById("tableData").innerHTML = tableData;
      // console.log(data);

      $('#deleteModal').on('show.bs.modal', function(event){

      var button = $(event.relatedTarget)
      var history_id = button.data('history_id')

      var modal = $(this)

      modal.find('.modal-title').text('DELETE VITALS INFO');
      modal.find('.modal-body #history_id').val(history_id);
      });
    }
  }

</script>

@endsection