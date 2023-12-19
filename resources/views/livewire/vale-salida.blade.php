<div>
    {{-- <span id="watermark">FACTURA EN <br> BORRADOR</span> --}}
    <table class="sizetab" border="1" cellpadding="1" style="border-collapse: collapse;">
        <tbody>
            <tr>
                <td style="vertical-align: center;" height="50" align="center">
                    <img img src="https://ik.imagekit.io/wdytkgxtc/spectrolabpng.jpg?updatedAt=1703022205949"
                    height="30">
                </td>
                <td align="center">
                    FORMULARIO <br>
                    VALE SALIDA DE ALMACÉN
                </td>
                <td>
                    DOC FOR-VALE DE SALIDA DE REACTIVOS <br>
                    MRC, MATERIALES E INSUMOS -01 <br>
                    REV: 03 <br>
                    EMISIÓN {{now()->format('Y-m-d')}}
                </td>
                <td align="center">
                    PÁGINA <br>
                    1 DE 1
                </td>
            </tr>

        </tbody>
    </table>
    <table class="sizetab">
        <tbody>
            <tr>
                <td align="center">
                   <b class="title">
                        Vale de salida de reactivos, mrc, materiales e inumos
                    </b>
                </td>
            </tr>
        </tbody>
    </table>
    <table class="sizetab" border="1" cellpadding="1" style="border-collapse: collapse">
        <tbody>
            <tr>
                <td style="vertical-align: top;" align="center">
                    <span>Fecha: </span>
                </td>
                <td>
                    <div>
                        @php
                            ///$fecha = date_create_from_format('j-M-Y', '15-Feb-2009');
                            //echo date_format($consumo->fecha_consumo, 'j-M-Y');
                            $meses = array("Enero", "Febrero", "Marzo", "Abril", "Mayo", "Junio", "Julio", "Agosto", "Septiembre", "Octubre", "Noviembre", "Diciembre");
                            $f = $consumo->fecha_consumo;
                            //document.write(f.getDate() + " de " + meses[f.getMonth()] + " de " + f.getFullYear());
                            //dd(date_format($f,'m'));
                            $mes = $meses[(date_format($f,'m'))-1];
                            echo date_format($f,'d').' de '.$mes.' de '.date_format($f,'Y');
                        @endphp
                    </div>
                </td>
                <td colspan="2" align="right">
                    <h3 style="color: red;">
                       No. {{$consumo->num_vale_salida}}
                    </h3>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top;" align="center">
                    <span>Destino: </span>
                </td>
                <td contenteditable>
                    <span> Clásico</span>
                </td>
                <td>
                    <span>Parámetro: </span>
                </td>
                <td contenteditable>
                    <span> Clásico</span>
                </td>
            </tr>

        </tbody>
    </table>
    <br>

    <table class="sizetab" border="1" cellpadding="1" style="border-collapse: collapse;">
        <tbody>
            <tr>
                <th align="center">CÓDIGO</th>
                <th align="center">MARCA</th>
                <th align="center">CANTIDAD</th>
                <th align="center">UNIDAD</th>
                <th align="center">DESCRIPCIÓN</th>
            </tr>
            @foreach ($detalle as $det)
            <tr>
                <td style="vertical-align: top;" height="30" align="center">
                    <span>{{$det->insumo->codigo}}</span>
                </td>
                <td style="vertical-align: top;" align="center"><span>{{$det->insumo->marca}}</span>
                <td style="vertical-align: top;" align="center"><span>{{$det->cantidad}}</span>
                <td style="vertical-align: top;" align="center"><span>{{$det->insumo->unidad->unidad_ref}}</span>
                <td style="vertical-align: top;" align="left">
                    <span>
                        {{$det->insumo->detalle}}
                    </span>
                </td>

            </tr>
            @endforeach

        </tbody>
    </table>
    <table class="sizetab">
        <tbody>
            <tr>
                <td align="center">
                    El requerimiento de reactivo, material de referencia (mrc), material o insumo, debe estar correctamente identificado en código, marca, cantidad, unidad y descripción.
                </td>
            </tr>
        </tbody>
    </table>
    <table class="sizetab" border="1" cellpadding="1" style="border-collapse: collapse;">
        <tbody>
            <tr>
                <td style="vertical-align: top;" height="80" contenteditable>
                    <span>Observaciones: </span>
                </td>

            </tr>
            {{-- @endforeach --}}

        </tbody>
    </table>
    <br>
    <table class="sizetab" border="1" cellpadding="1" style="border-collapse: collapse; border: 0px solid;">
        <tbody>
            <tr>
                <td style="vertical-align: top;" height="80" align="center">

                </td>
                <td style="vertical-align: top;" height="80" align="center">

                </td>
                <td style="vertical-align: top;" height="80" align="center">

                </td>

            </tr>
            <tr>
                <td style="vertical-align: top;" height="50" align="center">
                    <span>_______________________________________________</span><br>
                    <span>Autorizado por (firma y sello): </span>
                </td>
                <td style="vertical-align: top;" height="50" align="center">
                    <span>_______________________________________________</span><br>
                    <span>Entregué Conforme (firma y sello): </span>
                </td>
                <td style="vertical-align: top;" height="50" align="center">
                    <span>_______________________________________________</span><br>
                    <span>Recibí Conforme (firma y sello): </span>
                </td>

            </tr>
            {{-- @endforeach --}}

        </tbody>
    </table>
    <script>
        window.onload = function() {
            //window.print();
        }
    </script>
</div>
