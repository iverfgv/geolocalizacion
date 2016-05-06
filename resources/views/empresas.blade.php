@include('includes.header')


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
                            <div class="col-sm-12">
                                <h4 class="page-title">Dashboard </h4>
                                <ol class="breadcrumb">

                                    <li>
                                      Empresas
                                  </li>

                              </ol>
                          </div>
                      </div>
                      <button class="btn btn-default waves-effect waves-light" data-toggle="modal" data-target="#add-category">ALTA EMPRESAS</button>

                      <p class="text-muted m-b-30 font-13"></p>
                      <!-- Inicia Tabla -->
                      <div class="row">
                        <div class="col-sm-12">
                            <div class=" table-responsive">



                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Nombre</th>
                                            <th>Razon Social</th>
                                            <th>Tipo de empresa</th>
                                            <th># Ubicaciones</th>
                                            <th>Acciones</th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($empresa as $emp)
                                        <tr id={{ $emp->id }} data-empresa={{ $emp->empresa }} data-razon={{ $emp->razonsocial }} data-tipo={{ $emp->tiposempresas_id }} data-ubi={{ $emp->ubi }}>
                                            <td>{{ $emp->empresa }} </td>
                                            <td>{{ $emp->razonsocial }}</td>
                                            <td>{{ $emp->tipempresa }}</td>
                                            <td>{{ $emp->ubi }}</td>
                                          

                                            <td class="editbtn">
                                                <a href="" title="Detalles" <i class="fa fa-file-text-o" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top"></i></a>

                                                <span data-toggle="modal" data-target="#edit-category">
                                                <i class="fa fa-pencil-square-o" title="Editar" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top">
                                                </i>
                                                </span> 
                                                {!!link_to('empresas/empresadel/'.$emp->id, '',array('class'=>'fa fa-ban','style'=>'color:rgb(121,121,121);' , 'title'=>'Eliminar','data-toggle'=>'tooltip', 'data-placement'=>'top', 'data-original-title'=>'Tooltip on top')) !!}
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
{!!Form::open(['route'=>'empresas.store','method'=>'POST'])!!}
<div class="modal fade none-border" id="add-category" style="display: none;">
    <div class="modal-dialog mdlcustm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong>Alta</strong> empresas</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">

                        <div class="col-md-12">
                            <label class="control-label">Nombre</label>
                            {!!Form::text('empresa','',['class'=>'form-control form-white'])!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Razon Social</label>
                            {!!Form::text('razon','',['class'=>'form-control form-white'])!!}
                        </div>


                        <div class="col-md-12">
                            <label class="control-label">Tipo de empresa</label>
                            {!!Form::select('tipoempresa', \App\tipoempresas::lists('tipoempresa','id'),null,['class'=>'form-control form-white'] )!!}

                        </div>

                        <div class="col-md-12">
                            <label class="control-label">Ubicaciones</label>
                             {!!Form::select('ubicacion', \App\ubicaciones::lists('ubicacion','id'),null,['class'=>'form-control form-white'] )!!}
                            
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
{!!Form::open(['route'=>['empresas.update',$id],'method'=>'PUT'])!!}
<div class="modal fade none-border" id="edit-category" style="display: none;">
    <div class="modal-dialog mdlcustm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong>Editar</strong> empresas</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                    <div class="col-md-6">
                            <label class="control-label">ID</label>
                            {!!Form::text('id','',[ 'id'=>'idtag','class'=>'form-control form-white', 'disabled'])!!}
                             <input type="hidden" name="id" id="idtag2">
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Nombre</label>
                            {!!Form::text('empresa','',['id'=>'empresatag','class'=>'form-control form-white'])!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Razon Social</label>
                            {!!Form::text('razonsocial','',['id'=>'razontag','class'=>'form-control form-white'])!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Tipo de empresa</label>
                            {!!Form::select('tiposempresas_id', \App\tipoempresas::lists('tipoempresa','id'),null,['id'=>'tipotag','class'=>'form-control form-white'] )!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Ubicaciones</label>
                            {!!Form::select('ubicaciones_id', \App\ubicaciones::lists('ubicacion','id'),null,['id'=>'ubicatag','class'=>'form-control form-white'] )!!}
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
                var empresa= $(this).attr('data-empresa'); 
                var razon=$(this).attr('data-razon');
                var tipo=$(this).attr('data-tipo');
                var ubica=$(this).attr('data-ubi');
                $('#idtag').val(ID);
                $('#idtag2').val(ID);
                $('#empresatag').val(empresa);
                $('#razontag').val(razon);
                $('#tipotag').val(tipo);
                $('#ubicatag').val(ubica);
                console.log(empresa);
               
        });
</script>