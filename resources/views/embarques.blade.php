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
                                      Embarques
                                  </li>

                              </ol>
                          </div>
                      </div>



                      <button class="btn btn-default waves-effect waves-light" data-toggle="modal" data-target="#add-category">ALTA EMBARQUES</button>

                      <p class="text-muted m-b-30 font-13"></p>

                      <!-- Inicia Tabla -->
                      <div class="row">
                        <div class="col-sm-12">
                            <div class=" table-responsive">



                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Fecha</th>
                                            <th>Peso</th>
                                            <th>Material</th>
                                            <th>Usuario</th>
                                            <th>Ubicacion</th>
                                            <th>Accion</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($embarques as $emb)
                                    <?php $fecha = substr($emb->fechalocal,0,10);
                                            $i=0;
                                     ?>
                                        <tr id='{{ $emb->id }}' data-fecha='{{ $fecha }}' data-peso='{{ $emb->peso }}' data-material='{{ $emb->materiales_id }}' data-usuari='{{ $emb->usuarios_id }}' data-ubica='{{ $emb->ubicaciones_id }}' data-cancelado='{{ $emb->cancelado }}' data-codigo='{{ $emb->codigocontrol }}'  data-econ='{{ $emb->notasalidaecoplast }}' data-clienten='{{ $emb->notasalidacliente }}' >

                                            <td> {{ $emb->id }}</td>
                                            <td> {{ $fecha }}</td>
                                            <td> {{ $emb->peso }}</td>
                                            <td> {{ $emb->material  }}</td>
                                            <td> {{ $emb->usuari  }}</td>
                                            <td> {{ $emb->ubica }}</td>

                                            <td class="editbtn">
                                                <span  data-toggle="modal" data-target="#edit-category">
                                                    <i class="fa fa-pencil-square-o" title="Editar" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top">
                                                    </i>
                                                </span> 
                                                {!!link_to('embarques/embarquedel/'.$emb->id, '',array('class'=>'fa fa-ban','style'=>'color:rgb(121,121,121);' , 'title'=>'Eliminar','data-toggle'=>'tooltip', 'data-placement'=>'top', 'data-original-title'=>'Tooltip on top')) !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                     <div style="text-align: right;">{{$embarques->render()}}</div>
                            </div>
                        </div>
                      </div>
                     <!-- Termina Tabla -->
                    </div>
                </div>
            </div>
        </div> <!-- container -->
    </div> <!-- content -->
</div><!-- content-page-->

<!-- Modal alta -->
{!!Form::open(['route'=>'embarques.store','method'=>'POST'])!!}
<div class="modal fade none-border" id="add-category" style="display: none;">
    <div class="modal-dialog mdlcustm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong>Alta</strong> embarques</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">

                        <div class="col-md-6">
                            <label class="control-label">ID</label>
                            {!!Form::text('id','',['class'=>'form-control form-white', 'disabled'])!!}
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Fecha</label>
                             {!!Form::date('fecha',$date,['class'=>'form-control form-white','required'])!!}
                        </div>


                        <div class="col-md-8">
                            <label class="control-label">Peso</label>
                           {!!Form::text('peso','',['class'=>'form-control form-white','required'])!!}
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Cancelado</label>
                            {!!Form::select('cancelado',array('1' => 'Si', '0' => 'No'),null,['class'=>'form-control form-white'] )!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Codigo de control</label>
                           {!!Form::text('codigo','',['class'=>'form-control form-white','required'])!!}
                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Material</label>
                           {!!Form::select('material', \App\materiales::lists('material','id'),null,['class'=>'form-control form-white'] )!!}
                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Usuario</label>
                            {!!Form::select('usuario', \App\usuarios::lists('usuario','id'),null,['class'=>'form-control form-white'] )!!}
                        </div>

                        <div class="col-md-12">
                            <label class="control-label">Ubicacion</label>
                           {!!Form::select('ubicacion', \App\ubicaciones::lists('ubicacion','id'),null,['class'=>'form-control form-white'] )!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Nota Ecoplast</label>
                           {!!Form::text('ecoplastn','',['class'=>'form-control form-white','required'])!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Nota Cliente</label>
                           {!!Form::text('clienten','',['class'=>'form-control form-white','required'])!!}
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
<!-- /Modal alta -->

<?php $id=1;?>
<!-- Modal editar -->
{!!Form::open(['route'=>['embarques.update',$id],'method'=>'PUT'])!!}
<div class="modal fade none-border" id="edit-category" style="display: none;">
    <div class="modal-dialog mdlcustm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong>Editar</strong> embarques</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">

                        <div class="col-md-6">
                            <label class="control-label">ID</label>
                            {!!Form::text('id','',[ 'id'=>'idtag','class'=>'form-control form-white', 'disabled'])!!}
                             <input type="hidden" name="id" id="idtag2">
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Fecha</label>
                             {!!Form::date('fechalocal','',[ 'id'=>'fechatag','class'=>'form-control form-white'])!!}
                        </div>


                        <div class="col-md-8">
                            <label class="control-label">Peso</label>
                           {!!Form::text('peso','',['id'=>'pesotag','class'=>'form-control form-white','required'])!!}
                        </div>
                        <div class="col-md-4">
                            <label class="control-label">Cancelado</label>
                            {!!Form::select('cancelado',array('1' => 'Si', '0' => 'No'),'',['id'=>'canceladotag','class'=>'form-control form-white'] )!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Codigo de control</label>
                           {!!Form::text('codigocontrol','',['id'=>'codigotag','class'=>'form-control form-white','required'])!!}
                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Material</label>
                           {!!Form::select('materiales_id', \App\materiales::lists('material','id'),'',['id'=>'materialtag','class'=>'form-control form-white'] )!!}
                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Usuario</label>
                            {!!Form::select('usuarios_id', \App\usuarios::lists('usuario','id'),'',['id'=>'usuariotag','class'=>'form-control form-white'] )!!}
                        </div>

                        <div class="col-md-12">
                            <label class="control-label">Ubicacion</label>
                           {!!Form::select('ubicaciones_id', \App\ubicaciones::lists('ubicacion','id'),'',['id'=>'ubicatag','class'=>'form-control form-white'] )!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Nota Ecoplast</label>
                           {!!Form::text('notasalidaecoplast','',['id'=>'econtag','class'=>'form-control form-white','required'])!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Nota Cliente</label>
                           {!!Form::text('notasalidacliente','',['id'=>'cliententag','class'=>'form-control form-white','required'])!!}
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
<!-- /modal editar-->

@include('includes.footer')

  <script type="text/javascript">
         $("tr").click(function() {
                var ID = $(this).attr("id");
                var fecha= $(this).attr('data-fecha'); 
                var peso=$(this).attr('data-peso');
                var material=$(this).attr('data-material');
                var usuario=$(this).attr('data-usuari');
                var ubica=$(this).attr('data-ubica');
                var cancelado=$(this).attr('data-cancelado');
                var codigo=$(this).attr('data-codigo');
                var econ=$(this).attr('data-econ');
                var clienten=$(this).attr('data-clienten');
                $('#idtag').val(ID);
                $('#idtag2').val(ID);
                $('#fechatag').val(fecha);
                $('#pesotag').val(peso);
                $('#materialtag').val(material);
                $('#usuariotag').val(usuario);
                $('#ubicatag').val(ubica);
                $('#canceladotag').val(cancelado);
                $('#codigotag').val(codigo);
                $('#econtag').val(econ);
                $('#cliententag').val(clienten);
               
        });
</script>