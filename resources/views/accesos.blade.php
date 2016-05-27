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
                                      Accesos 
                                  </li>

                              </ol>
                          </div>
                      </div>
                      <button class="btn btn-default waves-effect waves-light" data-toggle="modal" data-target="#add-category">ALTA ACCESOS</button>

                      <p class="text-muted m-b-30 font-13"></p>

                      <!-- Inicia Tabla -->
                      <div class="row">
                        <div class="col-sm-12">
                            <div class=" table-responsive">
                                <table id="datatable-buttons" class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Acceso</th>
                                            <th>Nombre</th>
                                            <th>Email</th>
                                            <th>Activo</th>
                                            <th>Empresa</th>
                                           <th>Acciones</th>
                                            
                                        </tr>
                                    </thead>

                                    <tbody>
                                    @foreach($Accesos as $acceso)
                                        <tr id='{{ $acceso->id }}' data-acceso='{{ $acceso->acceso }}' data-nombre='{{ $acceso->nombre }}' data-email='{{ $acceso->email }}' data-activo='{{ $acceso->activo }}' data-empresa='{{ $acceso->empresas_id }}'>

                                            <td>{{ $acceso->id }}</td>
                                            <td>{{ $acceso->acceso }}</td>
                                            <td>{{ $acceso->nombre }}</td>
                                            <td>{{ $acceso->email }}</td>
                                            @if($acceso->activo==1)
                                            <td><i class="fa fa-check-circle-o fa-2x"></i></td>
                                            @else
                                            <td><i class="fa fa-times-circle-o fa-2x"></i></td>
                                            @endif
                                            
                                            <td>{{ $acceso->nameempresa }}</td>
                                            <td class="editbtn">

                                                <span data-toggle="modal" data-target="#edit-category">
                                                    <i class="fa fa-pencil-square-o" title="Editar" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tooltip on top">
                                                    </i>
                                                </span> 

                                               {!!link_to('accesos/accesodel/'.$acceso->id, '',array('class'=>'fa fa-ban','style'=>'color:rgb(121,121,121);' , 'title'=>'Eliminar','data-toggle'=>'tooltip', 'data-placement'=>'top', 'data-original-title'=>'Tooltip on top')) !!}
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                    <div style="text-align: right;">{{$Accesos->render()}}</div>
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
{!!Form::open(['route'=>'accesos.store','method'=>'POST'])!!}
<div class="modal fade none-border" id="add-category" style="display: none;">
    <div class="modal-dialog mdlcustm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong>Alta</strong> Accesos</h4>
            </div>
            <div class="modal-body">
                <form role="form">
                    <div class="row">
                         <div class="col-md-12">
                            <label class="control-label">Acceso</label>
                           {!!Form::text('acceso','',['class'=>'form-control form-white','required'])!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Nombre</label>
                            {!!Form::text('nombre','',['class'=>'form-control form-white','required'])!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Email</label>
                            {!!Form::email('email','',['class'=>'form-control form-white','required'])!!}
                        </div>
                             <div class="col-md-6">
                            <label class="control-label">Activo</label>
                            {!!Form::select('activo',array('1' => 'Si', '0' => 'No'),null,['class'=>'form-control form-white','required'] )!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Empresa</label>
                            {!!Form::select('empresa', \App\empresas::lists('empresa','id'),null,['class'=>'form-control form-white'] )!!}
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
{!!Form::open(['route'=>['accesos.update',$id],'method'=>'PUT'])!!}
<div class="modal fade none-border" id="edit-category" style="display: none;">
    <div class="modal-dialog mdlcustm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title"><strong>Editar</strong> Accesos </h4>
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
                            <label class="control-label">Acceso</label>
                           {!!Form::text('acceso','',['id'=>'accesotag','class'=>'form-control form-white','required'])!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Nombre</label>
                            {!!Form::text('nombre','',['id'=>'nombretag','class'=>'form-control form-white','required'])!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Email</label>
                            {!!Form::email('email','',['id'=>'emailtag','class'=>'form-control form-white','required'])!!}
                        </div>
                             <div class="col-md-6">
                            <label class="control-label">Activo</label>
                            {!!Form::select('activo',array('1' => 'Si', '0' => 'No'),null,['id'=>'activotag','class'=>'form-control form-white','required'] )!!}
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Empresa</label>
                            {!!Form::select('empresas_id', \App\empresas::lists('empresa','id'),null,['id'=>'empretag','class'=>'form-control form-white'] )!!}
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
                var acceso= $(this).attr('data-acceso'); 
                var nombre= $(this).attr('data-nombre'); 
                var email=$(this).attr('data-email');
                var activo=$(this).attr('data-activo');
                var empresa=$(this).attr('data-empresa');
                
                $('#idtag').val(ID);
                $('#idtag2').val(ID);
                $('#accesotag').val(acceso);
                $('#nombretag').val(nombre);
               $('#emailtag').val(email);
               $('#activotag').val(activo);
               $('#empretag').val(empresa);
               
        });
</script>