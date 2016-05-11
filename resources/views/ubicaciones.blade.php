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
                                      Catalogos
                                  </li>
                                  <li>
                                      Ubicaciones
                                  </li>

                              </ol>
                          </div>
                      </div> 


                      <button class="btn btn-default waves-effect waves-light" data-toggle="modal" data-target="#add-category">ALTA UBICACIONES</button>

                      <p class="text-muted m-b-30 font-13"></p>







                      <!-- Inicia Tabla -->
                      <div class="row">
                        <div class="col-sm-12">
                            <div class=" table-responsive">



                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Ubicacion</th>
                                            <th>Clave</th>
                                            <th>Descripcion</th>

                                            <th>Activo</th>
                                            <th>Acciones</th>
                                            
                                        </tr>
                                    </thead>

                               
                                    <tbody>
                                     @foreach($ubicaciones as $ubicacion)
                                     <tr id='{{ $ubicacion->id }}' data-ubicacion='{{ $ubicacion->ubicacion }}' data-clave='{{ $ubicacion->clave }}' data-descripcion='{{ $ubicacion->descripcion }}' data-activo='{{ $ubicacion->activo }}' >

                                        <td>{{$ubicacion->ubicacion}}</td>
                                            <td>{{$ubicacion->clave}}</td>
                                            <td>{{$ubicacion->descripcion}}</td>
                                          
                                            @if($ubicacion->activo==1)
                                                <td><i class="fa fa-check-circle-o fa-2x"></i></td>
                                            @else
                                                <td><i class="fa fa-times-circle-o fa-2x"></i></td>
                                            @endif
                                          

                                            <td class="editbtn">

                                                <span data-toggle="modal" data-target="#edit-category">
                                                    <i class="fa fa-pencil-square-o" title="Editar" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top">
                                                </i>
                                                </span> 
                                                
                                            {!!link_to('ubicaciones/ubicacionesdel/'.$ubicacion->id, '',array('class'=>'fa fa-ban','style'=>'color:rgb(121,121,121);' , 'title'=>'Eliminar','data-toggle'=>'tooltip', 'data-placement'=>'top', 'data-original-title'=>'Tooltip on top')) !!}

                                               
                                            </td>
                                     </tr>
                                       

                                    </tbody>
                                        @endforeach
                                </table>
                                <div style="text-align: right;">{{$ubicaciones->render()}}</div>
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
{!!Form::open(['route'=>'ubicacion.store','method','POST'])!!} 
<div class="modal fade none-border" id="add-category" style="display: none;">
    <div class="modal-dialog mdlcustm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                 <h4 class="modal-title"><strong>Alta</strong> Ubicaciones</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-md-12">
                   <label class="control-label">Ubicaciones</label>
            {!!Form::text('ubicacion','',['class'=>'form-control form-white','placeholder'=>'Nombre','required'])!!}
                        </div>

                         <div class="col-md-12">
                     <label class="control-label">Clave</label>
            {!!Form::text('clave','',['class'=>'form-control form-white','placeholder'=>'Clave','required'])!!}
                        </div>

                         <div class="col-md-12">
                     <label class="control-label">Descripcion</label>
            {!!Form::text('descripcion','',['class'=>'form-control form-white','placeholder'=>'Descripcion'])!!}
                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Activo</label>
                            {!! Form::select('activo',array('si' => 'Si', 'no' => 'No'), null,['class'=>'form-control form-white']) !!}
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
<!-- Modal Editar -->
{!!Form::open(['route'=>['ubicacion.update',$id],'method'=>'PUT'])!!}
<div class="modal fade none-border" id="edit-category" style="display: none;">
    <div class="modal-dialog mdlcustm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                 <h4 class="modal-title"><strong>Editar</strong> Ubicaciones</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                        <div class="col-md-12">
                        {!!Form::hidden('id','',['id'=>'idtag','class'=>'form-control form-white','required'])!!}
                   <label class="control-label">Ubicaciones</label>
            {!!Form::text('ubicacion','',['id'=>'ubicaciontag','class'=>'form-control form-white','required'])!!}
            </div>
                         <div class="col-md-12">
                    <label class="control-label">Clave</label>
            {!!Form::text('clave','',['id'=>'clavetag','class'=>'form-control form-white','required'])!!}
                        </div>

                         <div class="col-md-12">
                     <label class="control-label">Descripcion</label>
            {!!Form::text('descripcion','',['id'=>'descripciontag','class'=>'form-control form-white'])!!}
                        </div>

                        <div class="col-md-6">
                            <label class="control-label">Activo</label>
                            {!!Form::select('activo',array('1' => 'Si', '0' => 'No'),null,['id'=>'activotag','class'=>'form-control form-white','required'] )!!}  
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

<script type="text/javascript">
         $("tr").click(function() {
                var id = $(this).attr("id");
                var ubicacion = $(this).attr("data-ubicacion");
                var clave= $(this).attr('data-clave'); 
                var descripcion=$(this).attr('data-descripcion');
                var activo=$(this).attr('data-activo');
            
                $('#idtag').val(id);              
                $('#ubicaciontag').val(ubicacion);
                $('#clavetag').val(clave);
                $('#descripciontag').val(descripcion);
                $('#activotag').val(activo);

                if(activo==1){
                 document.getElementById('idactivo').checked = true;
                }else{document.getElementById('idactivo').checked = false;}
        });
</script>

@include('includes.footer')