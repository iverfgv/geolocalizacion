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
                                      Rastreo
                                  </li>

                              </ol>
                          </div>
                      </div>
                      <button class="btn btn-default waves-effect waves-light" data-toggle="modal" data-target="#add-category">ALTA RASTREO</button>

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
                                            <th>Movimiento</th>
                                            <th>Placas</th>
                                            <th>Acciones</th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($rastreos as $rastreo)
                                      <?php
                                        $fecha = substr($rastreo->fecha,0,10);

                                       if($rastreo->entrada==1){
                                            $movi='Entrada';

                                        }
                                        if($rastreo->entrada==0){
                                            $movi='Salida';
                                            }?>
                                           <tr id='{{ $rastreo->id }}' data-fecha='{{ $fecha }}' data-placas='{{ $rastreo->placas }}' data-embarque='{{ $rastreo->embarques_id }}' data-usuari='{{ $rastreo->usuarios_id }}' data-ubica='{{ $rastreo->ubicaciones_id }}' data-entrada='{{ $rastreo->entrada }}'>

                                            <td>{{ $rastreo->id }}</td>
                                            <td>{{ $fecha }}</td>
                                            <td>{{ $movi }}</td>
                                            <td>{{ $rastreo->placas }}</td>
                                          

                                            <td class="editbtn">

                                                <span data-toggle="modal" data-target="#edit-category">
                                                    <i class="fa fa-pencil-square-o" title="Editar" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top">
                                                    </i>
                                                </span> 

                                               {!!link_to('rastreo/rastreodel/'.$rastreo->id, '',array('class'=>'fa fa-ban','style'=>'color:rgb(121,121,121);' , 'title'=>'Eliminar','data-toggle'=>'tooltip', 'data-placement'=>'top', 'data-original-title'=>'Tooltip on top')) !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                    <div style="text-align: right;">{{$rastreos->render()}}</div>
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
{!!Form::open(['route'=>'rastreo.store','method'=>'POST'])!!}
<div class="modal fade none-border" id="add-category" style="display: none;">
    <div class="modal-dialog mdlcustm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong>Alta</strong> rastreo</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="control-label">Fecha</label>
                           {!!Form::date('fecha',$date,['class'=>'form-control form-white','required'])!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Embarque</label>
                             {!!Form::select('embarques', \App\embarques::lists('codigocontrol','id'),null,['class'=>'form-control form-white','required'] )!!}
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Movimiento</label>
                            {!!Form::select('entrada',array('1' => 'Entrada', '0' => 'Salida'),null,['class'=>'form-control form-white','required'] )!!}
                        </div>
                         <div class="col-md-6">
                            <label class="control-label">Usuario</label>
                            {!!Form::select('usuarios', \App\usuarios::lists('usuario','id'),null,['class'=>'form-control form-white','required'] )!!}
                        </div>
                         <div class="col-md-5">
                            <label class="control-label">Ubicacion</label>
                            {!!Form::select('ubicacion', \App\ubicaciones::lists('ubicacion','id'),null,['class'=>'form-control form-white','required'] )!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Placas</label>
                           {!!Form::text('placas','',['class'=>'form-control form-white','required'])!!}
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
{!!Form::open(['route'=>['rastreo.update',$id],'method'=>'PUT'])!!}
<div class="modal fade none-border" id="edit-category" style="display: none;">
    <div class="modal-dialog mdlcustm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong>Editar</strong> rastreo</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <form role="form">
                    <div class="row">
                    <div class="col-md-6">
                            <label class="control-label">ID</label>
                            {!!Form::text('id','',[ 'id'=>'idtag','class'=>'form-control form-white', 'disabled'])!!}
                             <input type="hidden" name="id" id="idtag2">
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Fecha</label>
                           {!!Form::date('fecha','',['id'=>'fechatag','class'=>'form-control form-white','required'])!!}
                          
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Embarque</label>
                             {!!Form::select('embarques', \App\embarques::lists('codigocontrol','id'),null,['id'=>'embarquetag','class'=>'form-control form-white','required'] )!!}
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Movimiento</label>
                            {!!Form::select('entrada',array('1' => 'Entrada', '0' => 'Salida'),null,['id'=>'entradatag','class'=>'form-control form-white','required'] )!!}
                        </div>
                         <div class="col-md-6">
                            <label class="control-label">Usuario</label>
                            {!!Form::select('usuarios_id', \App\usuarios::lists('usuario','id'),null,['id'=>'usuariotag','class'=>'form-control form-white','required'] )!!}
                        </div>
                         <div class="col-md-5">
                            <label class="control-label">Ubicacion</label>
                            {!!Form::select('ubicaciones_id', \App\ubicaciones::lists('ubicacion','id'),null,['id'=>'ubicatag','class'=>'form-control form-white','required'] )!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Placas</label>
                           {!!Form::text('placas','',['id'=>'placastag','class'=>'form-control form-white','required'])!!}
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
                var fecha= $(this).attr('data-fecha'); 
                var placas=$(this).attr('data-placas');
                var embarque=$(this).attr('data-embarque');
                var usuario=$(this).attr('data-usuari');
                var ubica=$(this).attr('data-ubica');
                var entrada=$(this).attr('data-entrada');

                $('#idtag').val(ID);
                $('#idtag2').val(ID);
                $('#fechatag').val(fecha);
                $('#placastag').val(placas);
                $('#embarquetag').val(embarque);
                $('#usuariotag').val(usuario);
                $('#ubicatag').val(ubica);
                $('#entradatag').val(entrada);
               
        });
</script>