@include('includes.header')
<?php $date = date('Y-m-d'); ?>
<div class="content-page">
    <!-- Start content -->
    <div class="content">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card-box">

                        <!-- Page-Title -->
                        <div class="row">
                             @if(Session::has('message'))
                        <div class="alert alert-success alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                          {{Session::get('message')}}
                        </div>
                        @endif
                          @if(Session::has('message-error'))
                        <div class="alert alert-danger alert-dismissible" role="alert">
                        <button type="button" class="close" data-dismiss="alert" aria-label="close"><span aria-hidden="true">&times;</span></button>
                          {{Session::get('message-error')}}
                        </div>
                        @endif
                            <div class="col-sm-12">
                                <h4 class="page-title">Dashboard </h4>
                                <ol class="breadcrumb">

                                    <li>
                                      Materiales 
                                  </li>

                              </ol>
                          </div>
                      </div>
                      <button class="btn btn-default waves-effect waves-light" data-toggle="modal" data-target="#add-category">ALTA MATERIALES</button>

                      <p class="text-muted m-b-30 font-13"></p>

                      <!-- Inicia Tabla -->
                      <div class="row">
                        <div class="col-sm-12">
                            <div class=" table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Material</th>
                                            <th>Clave</th>
                                            <th>Grupo</th>
                                           <th>Acciones</th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($Materiales as $material)
                                        <tr id='{{ $material->id }}' data-material='{{ $material->material }}' data-clave='{{ $material->clave }}' data-grupo='{{ $material->grupos_id }}'>

                                            <td>{{ $material->id }}</td>
                                            <td>{{ $material->material }}</td>
                                            <td>{{ $material->clave }}</td>
                                            <td>{{ $material->gruponame }}</td>
                                            <td class="editbtn">

                                                <span data-toggle="modal" data-target="#edit-category">
                                                    <i class="fa fa-pencil-square-o" title="Editar" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top">
                                                    </i>
                                                </span> 

                                               {!!link_to('materiales/materialdel/'.$material->id, '',array('class'=>'fa fa-ban','style'=>'color:rgb(121,121,121);' , 'title'=>'Eliminar','data-toggle'=>'tooltip', 'data-placement'=>'top', 'data-original-title'=>'Tooltip on top')) !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                    <!-- Termina Tabla -->
                </div>
            </div>
        </div>
    </div> <!-- container -->
</div> <!-- content -->
</div><!-- content-page -->

<!-- Modal Alta -->
{!!Form::open(['route'=>'materiales.store','method'=>'POST'])!!}
<div class="modal fade none-border" id="add-category" style="display: none;">
    <div class="modal-dialog mdlcustm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong>Alta</strong> Materiales</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                         <div class="col-md-12">
                            <label class="control-label">Material</label>
                           {!!Form::text('material','',['class'=>'form-control form-white','required'])!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Clave</label>
                            {!!Form::text('clave','',['class'=>'form-control form-white','required'])!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Grupo</label>
                            {!!Form::select('grupo', \App\grupos::lists('grupo','id'),null,['class'=>'form-control form-white'] )!!}
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
                {!!Form::submit('Guardar',['class'=>'btn btn-default'])!!}
            </div>
        </div>
    </div>
</div>
{!!Form::close()!!} 
<!-- /Modal Alta -->

<?php $id=1;?>
<!-- Modal editar -->
{!!Form::open(['route'=>['materiales.update',$id],'method'=>'PUT'])!!}
<div class="modal fade none-border" id="edit-category" style="display: none;">
    <div class="modal-dialog mdlcustm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong>Editar</strong> Materiales </h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                    <div class="col-md-6">
                            <label class="control-label">Id</label>
                           {!!Form::text('id','',['id'=>'idtag','class'=>'form-control form-white','disabled'])!!}
                           <input type="hidden" name="id" id="idtag2">
                        </div>
                         <div class="col-md-12">
                            <label class="control-label">Material</label>
                           {!!Form::text('material','',['id'=>'materialtag','class'=>'form-control form-white','required'])!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Clave</label>
                           {!!Form::text('clave','',['id'=>'clavetag','class'=>'form-control form-white','required'])!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Grupo</label>
                            {!!Form::select('grupos_id', \App\grupos::lists('grupo','id'),null,['id'=>'grupotag','class'=>'form-control form-white'] )!!}
                        </div>
                        
                    </div>
                </form>
            </div>


            <div class="modal-footer">
                <button type="button" class="btn btn-white waves-effect" data-dismiss="modal">Close</button>
                {!!Form::submit('Guardar',['class'=>'btn btn-default'])!!}
            </div>
        </div>
    </div>
</div>
{!!Form::close()!!} 
<!-- /Modal Editar -->



@include('includes.footer')

<script type="text/javascript">
         $("tr").click(function() {
                var ID = $(this).attr("id");
                var grupo= $(this).attr('data-grupo'); 
                var material= $(this).attr('data-material'); 
                var clave=$(this).attr('data-clave');
                
                $('#idtag').val(ID);
                $('#idtag2').val(ID);
                $('#grupotag').val(grupo);
                $('#materialtag').val(material);
               $('#clavetag').val(clave);
               

               
        });
</script>