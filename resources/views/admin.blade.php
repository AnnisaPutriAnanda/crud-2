<!DOCTYPE html>
<html lang="en">
<!--header-->
@include('layout.header')
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
  <!-- Navbar -->
  @include('layout.navbar')
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
<!--sidebar-->
@include('layout.sidebar')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">

          {{-- <div class="col-sm-6">
            <h1>Blank Page</h1>
          </div> --}}

          {{-- <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Blank Page</li>
            </ol>
          </div> --}}

        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
    <!--table-->
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
<!--table-->

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

      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Title</h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          Start creating your amazing application!
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          Footer
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

<!--footer-->
@include('layout.footer')
  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

@include('layout.script')
</body>
</html>
