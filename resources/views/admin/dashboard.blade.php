@extends('layouts.admin')

@section('title')
        Patient | Dashboard
@endsection

@section('link')
<style lang='scss' scoped>
.truncate {
  /* need automatic multi-line height */
  white-space: nowrap;
  overflow: hidden;
  text-overflow: ellipsis;
  word-wrap: break-word;
  /* color:#170694; */
}
.table-responsive {
  height: 60vh;
  overflow-x: auto;
}
td {
  vertical-align: middle;
  padding: 5px;
  text-align: center;
  cursor: pointer;
}
th {
  text-align: center;
}
</style>
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid" style="padding:5px;">

        <!-- <div class="row">
            <div class="col-md-5"> -->
                <div class="card">
                    <div style="color: #007bff; font-weight: bold;" class="card-header">
                        <i class="fa fa-list"> </i>  Dashboard
                        <h4 class="card-title"> </h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <thead class=" text-primary">
                                    <th></th>
                                    <!-- <th></th>
                                    <th>Vital Information</th> -->
                                  
                                </thead>
                                <tbody>
                                @foreach ($data as $row)
                                    <tr>
                                        <td onclick="goToProfile({{$row->members_id}});">
                                            <img
                                            src="{{ asset('uploads/' . $row->photo) }}"
                                            id="index"
                                            style="border-radius: 50%;"
                                            height="40"
                                            width="40"
                                            />
                                            <p></p>
                                            {{ $row->first_name }}
                                            <p></p>

                                            Date:
                                            <span  id="date" class="fa fa-calendar">
                                            {{ $row->created_at }}</span><p></p>

                                            Pulserate: 
                                            <span id="rate" class="fas fa-file-medical-alt">
                                            {{ $row->pulse_rate }} per min</span><p></p>

                                            Heartbeat: 
                                            <span id="beat" class="fas fa-heartbeat">
                                            {{ $row->heart_beat }} per min</span><p></p>

                                            temperature:
                                            <span id="temp" class="fas fa-temperature-high">
                                            {{ $row->temperature }} °C</span><p></p>

                                            </td>
                                            

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            <!-- </div>
        </div> -->
    
    </div>
          
</div>
@endsection

@section('scripts')
<script type='text/javascript'>
function goToProfile(members_id){
     window.location="/patient/profile/"+members_id;
}

// var data = JSON.parse(response);
// var date = data.patients.updated_at;

// var data = {{}}
// document.getElementById('date').innerText = getCurrentDateTime(date);

function getCurrentDateTime(sensorDay) {
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
    today = yyyy + '-' + mm + '-' + dd;
    return today + " "+strTime;
  }
</script>
@endsection
