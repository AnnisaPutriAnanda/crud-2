<!-- jQuery -->
<script src="{{ asset('/') }}plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/') }}plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/') }}dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('/') }}dist/js/demo.js"></script>

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


    //   $('').click(function(){

    //     })


      });

</script>