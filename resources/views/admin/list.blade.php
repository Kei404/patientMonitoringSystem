@extends('layouts.admin')

@section('title')
        Patient | LIST
@endsection

@section('name')
        {{ Auth::user()->name }}
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
  height: 70vh;
  overflow-x: auto;
}
.table {
  margin: 0px;
  padding: 0px;
  text-align: center;
  min-width: 600px;
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

<!-- <div class="vld-parent"> -->

    <div class="card">
      <div style="color: #007bff; font-weight: bold;" class="card-header">
        <i class="fa fa-list"></i> Patient List
        <div style="float:right" class="search-wrapper panel-heading col-sm-4">
          <input id="search-input" class="form-control" type="text" placeholder="Search" />
        </div>
      </div>
      <div class="card-body" style="padding:0px;">
        <div class="table-responsive">
          <table id="datatable" class="table table-striped" style="padding:0px;">
            <thead class=" text-primary">
              <tr>
                <th></th>
                <th>Name</th>
                <th>DoB</th>
                <th>Gender</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="myTable">
                @foreach ($patients as $row)
                    <tr>
                        <td onclick="goToProfile({{$row->id}});">
                            <img
                                src="{{ asset('uploads/' . $row->photo) }}"
                                id="index"
                                style="border-radius: 50%;"
                                height="40"
                                width="40"
                            />
                        </td>
                        <td onclick="goToProfile({{$row->id}});">{{ $row->last_name }}, {{ $row->first_name }} {{ $row->middle_name }}</td>
                        <td onclick="goToProfile({{$row->id}});">{{ $row->dob }}</td>
                        <td onclick="goToProfile({{$row->id}});">{{ $row->gender }}</td>
                        <td> <a data-patient_id="{{ $row->id }}" href="#" class="btn btn-danger delete" data-toggle="modal" data-target="#deleteModal">DELETE</a> </td>
                            
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

                                <form action="/patient/delete/patient_id" method="POST" id="deleteForm">  
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}

                                  <input type="hidden" id="patient_id" name="patient_id" value="DELETE">
                                  <p> Are You Sure?.. You Want to Delete Data? </p>
                                
                                </div>
                                <div class="modal-footer">
                                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                  <button type="submit" class="btn btn-primary">Yes! delete data</button>
                                </div>
                                </form>
                                
                              </div>
                              
                            </div>
                          </div>
                    </tr>
                @endforeach
 
            </tbody>
          </table>
        </div>
      </div>
    </div>
  <!-- </div> -->

@endsection

@section('scripts')

<script type='text/javascript'>
function goToProfile(id){
     window.location="/patient/profile/"+id;
}
</script>

<script>
$('#deleteModal').on('show.bs.modal', function(event){

  var button = $(event.relatedTarget)
  var patient_id = button.data('patient_id')

  var modal = $(this)

  modal.find('.modal-title').text('DELETE PATIENT INFO');
  modal.find('.modal-body #patient_id').val(patient_id);
});
</script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$(document).ready(function(){
  $("#search-input").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#myTable tr").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>

@endsection

