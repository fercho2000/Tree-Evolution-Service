<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>ER Tree Services</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style>
     #Encabezado{
         align
         border: 2px solid;
         border-color: green;
         border-style: double;
     }
     #Encabezado tr{
         text-align: center;
     }
 </style>   
</head>
<body>
 <section>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="table-responsive" width="100%" align="center">
                    <table class="table-bordered" width="480" id="Encabezado"  style="-webkit-transform: translateX(-54px);">
                        <thead>
                            <tr>
                                <td width="170px;"></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </thead>
                        <tbody>
                             <tr>
                            <td><img src="{{public_path('assets/img/pages/Logo.jpg')}}" width="150px" height="120px" alt="" srcset=""></td>
                            <td><p style="text-align: center;font-family: roboto; font-size: 25px;"><strong>ER Tree Services</strong><br><p style="text-align: center;font-family: roboto; font-size: 15px; padding-top: -15px;">"We Do It The Right Way"</p><br><p style="font-size: 14px;padding-top: -26px;">1401 55th St S, Gulfport, FL 33707, EE. UU.<br>www.ertreeservices.com</p></td>
                            <td> <p style="font-size: 14px;">Fecha: <br> {{$date}} <br> Phone: 813-454-6085 </p></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>   
<br>
<hr>
 <section>
 <div class="container-fluid">
       <div class="row" >
           <div class="col-12">
           <p style="font-size:20px;" align="center"> <i class="fa fa-user" style="font-size:25px;"></i><strong>Kit Information</strong></p>
            <hr>
            <br>
            <div class="row">                            
                <div style="-webkit-transform: translateX(120px);">
                    @foreach ($Kit as $item)  
                    <label for=""><p><strong>Nombre del kit:</strong><br>{{$item->nombre_kit}}</p></label>
                    @endforeach 
                </div>    
                <div style="-webkit-transform: translateX(400px);">
                    @foreach ($Kit as $item)
                    <label for=""><p><strong>Servicio:</strong><br>{{$item->nombreServicio}}</p></label>
                    @endforeach 
                </div>                 
            </div>
            <hr>
            <div>
            <p style="font-size:20px;" align="center"> <i class="fa fa-wrench" style="font-size:25px;"></i><strong>Work Tools</strong></p>
            <hr>
            </div>
           <div class="table-responsive">
             <table  class="table table-striped table-bordered">
                 <thead>
                     <tr>
                         <td scope="row"><p style="font-size:16px;"><strong>Image</strong></p></td>
                         <td scope="row"><p style="font-size:16px;"><strong>Implement Code</strong></p></td>
                         <td scope="row"><p style="font-size:16px;"><strong>Implement Name</strong></p></td>
                         <td scope="row"><p style="font-size:16px;"><strong>State</strong></p></td>
                     </tr>
                 </thead>
                 <tbody>
                     @foreach ($KitImple as $value)
                             <tr>                        
                             <td  style="text-align:center;"><img src="images/{{$value->imagen}}" alt="" width="45px" height="45px"></td>
                                 <td><p style="font-size: 14px;">{{$value->codigo_implemento}}</p></td>
                                 <td><p style="font-size: 14px;">{{$value->nombre_implemento}}</p></td>
                                 <td><p style="font-size: 14px;">{{$value->nombre_categoria}}</p></td>
                             </tr>
                     @endforeach
                 </tbody>
             </table>
           </div>
       </div>
   </div>
 </section>    
</body>
</html>
