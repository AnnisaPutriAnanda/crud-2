
<!DOCTYPE html>
<html>
<head>
    <title>Laravel Ajax CRUD</title>
    <meta name="csrf-token" content="{{ csrf_token() }}"> 
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
</head>
<body>
      
<div class="container">
    <div class="card">
      <!---->
      <div class="card-header">
    <h1>Table Person</h1>
    <a class="btn btn-success" href="javascript:void(0)" id="create">Create Data</a>
  </div>
  <!---->
  <div class="card-body">
    <table id="data-table" class="table table-bordered data-table">
      <thead>
      <tr>
        <th class="no-sort" data-orderable="false">No</th>
        <th>Id</th>
        <th>Name</th>
        <th>Description</th>
        <th class="no-sort">Created At</th>
        <th class="no-sort">Updated At</th>
        <th class="no-sort" data-orderable="false">Action</th>
      </tr>
      </thead>
    </table>
  </div>
  </div>
</div>

<!--Modal-->

{{-- <!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
    Launch demo modal
  </button> --}}
  
  <!-- Modal -->
  <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">

            <form action="javascript:void(0)" id="form-modal" name="form-modal">

                <input type="hidden" id="id" name="id">

                <div class="form-group">
                  <label class="col-form-label">Name</label>
                  <input type="text" class="form-control" id="name" name="name" placeholder="Nama.." required>
                </div>
                <div class="form-group">
                  <label class="col-form-label">Description</label>
                  <input type="text" class="form-control" id="desc" name="desc" placeholder="Deskripsi.." required></textarea>
                </div>
                <button type="submit" id="submit-btn" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </form>
            </div>
            {{-- <div class="modal-footer"> --}}
              
            {{-- </div> --}}
        </div>
      </div>
    </div>
  </div>
<!--Tutup Modal-->
           
</body>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" src="//cdn.datatables.net/1.10.7/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.18/dist/sweetalert2.all.min.js"></script>

<script type="text/javascript">

      $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
      });

    $(document).ready(function(data){
      //render datatable
       var table = $('#data-table').DataTable({
            processing : true,
            serverside : true,
            responsive : true,
            ajax : {  
                
              url :  "{{ url('datatable') }}", 

            },
                 columns :[ 
                 {
                     "data" : null, "sortable": false,
                     render : function(data, type, row, meta){
                         return meta.row + meta.settings._iDisplayStart + 1
                     }
                 },
                    {data: 'id', name: 'id'},
                    {data: 'name', name: 'name'},
                    {data: 'desc', name: 'desc'},
                    {data: 'created_at', name: 'created_at', "searchable": false},
                    {data: 'updated_at', name: 'updated_at', "searchable": false},
                    {data: 'action', name: 'action', "searchable": false},
                ],
                    
        });
        //tampil modal khusus create
        $('#create').click(function(){
            $("#id").val('');
            $('#form-modal')[0].reset();
            $('#exampleModalLabel').html('Modal Tambah');
            $('#exampleModal').modal('show');
        })
         //tampil modal khusus edit
       $('body').on('click', '.editProduct', function(){
        var id = $(this).data('id');
        $.get("{{url('edit')}}/" + id + "/edit", function(data){
        $('#exampleModalLabel').html('Modal Edit');
        $('#exampleModal').modal('show');
        $('#id').val(data.id);
        $('#name').val(data.name);
        $('#desc').val(data.desc);
        })
       })
       
      //  //tes apakah value didapatkan
      //  $('#submit-btn').on('click', function(e){
      //   e.preventDefault();

      //   var name = $('#name').val();
      //   var desc = $('#desc').val();

      //   alert(name + desc);
         
      //  })

        //bila form di submit
        $('#form-modal').submit(function(){
          //  e.preventDefault();

           var id = $('#id').val();
           var name = $('#name').val();
           var desc = $('#desc').val();

           $.ajax({
                  type:'POST',
                  url: "{{ url('store')}}",
                  data: {
                    id : id,
                    name : name,
                    desc : desc,
                  },
                  success:function(data){
                    table.ajax.reload();
                    Swal.fire({
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500})
                  $("#exampleModal").modal('hide');
                  $("#submit-btn").html('Submit');
                  $("#submit-btn"). attr("disabled", false);
                  },
                  error:function(data){
                  console.log(data);
                  }
                  });
        })



        $('body').on('click', '.deleteProduct', function(){
          var id = $(this).data('id');
            // alert('hapus' + id);
            Swal.fire({
                            title: 'Are You Sure?',
                            text: "Want to delete id=" + id + "?",
                            icon: 'warning',
                            showCancelButton: true,
                            cancelButtonText: 'CANCEL',
                            confirmButtonText: 'YES, DELETE!'
                        }).then((result) => {
                            if (result.isConfirmed) {

                                $.ajax({
                                    type: "DELETE",
                                    url: "{{ url('delete') }}" + '/' + id,
                                    success: function(data) {
                                      table.ajax.reload();
                                      Swal.fire({
                        icon: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 1500})
                                        
                                    },
                                })
                              }
        })
      })



      });

</script>
    