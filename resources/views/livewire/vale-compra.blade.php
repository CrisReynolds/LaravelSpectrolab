<div>
    {{-- <span id="watermark">FACTURA EN <br> BORRADOR</span> --}}
    <table class="sizetab" border="1" cellpadding="1" style="border-collapse: collapse;">
        <tbody>
            <tr>
                <td rowspan="3" style="vertical-align: center;" height="30" align="center">
                    <img img src="https://ik.imagekit.io/wdytkgxtc/spectrolabpng.jpg?updatedAt=1703022205949"
                    height="30">
                </td>
                <td rowspan="3">
                    Vale de Ingreso
                </td>
                <td>
                    Doc. FOR-VALE DE IGRESO -01
                </td>
                <td rowspan="3" align="center">
                    PÁGINA <br>
                    1 DE 1
                </td>
            </tr>
            <tr>
                <td>
                    Revisión 01
                </td>
            </tr>
            <tr>
                <td>
                    Emisión {{now()->format('Y-m-d')}}
                </td>
            </tr>

        </tbody>
    </table>
    <table class="sizetab">
        <tbody>
            <tr>
                <td align="center">
                   <b class="title">
                        VALE DE INGRESO
                    </b>
                </td>
                <td>
                    <b>No</b>
                </td>
                <td align="right">
                    <b>{{$compra->num_vale_ingreso}}</b>
                </td>
            </tr>
            <tr>
                <td>
                   <b>
                        FECHA DE COMPRA: {{$compra->fecha_compra->format('d-m-Y')}}
                    </b>
                </td>
                <td>
                    <span>IMPORTE TOTAL</span>
                </td>
                <td align="right">
                    <b>{{ number_format($total->total, '2', '.', ',') }}</b>
                </td>
            </tr>
            <tr>
                <td>
                   <b>
                        PROVEEDOR: {{$compra->proveedor->nombre}}
                    </b>
                </td>
                <td>
                    <b>NIT</b>
                </td>
                <td align="right">
                    <span>
                        {{$compra->proveedor->nit}}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                   <b>
                        DIRECCIÓN:
                    </b>
                    <span>{{$compra->proveedor->direccion}}</span>
                </td>
                <td>
                    <b>FACTURA NO.</b>
                </td>
                <td align="right">
                    <span>
                        {{$compra->id}}
                    </span>
                </td>
            </tr>
            <tr>
                <td>
                   <b>
                        TEL/CELULAR:
                    </b>
                    <span>{{$compra->proveedor->telefono}}</span>
                </td>
                <td>
                </td>
                <td align="right">
                </td>
            </tr>
        </tbody>
    </table>
    <br>

    <table class="sizetab" border="1" cellpadding="1" style="border-collapse: collapse;">
        <tbody>
            <tr>
                <th align="center">CANT</th>
                <th align="center">UNIDAD</th>
                <th align="center">CÓDIGO</th>
                <th align="center">DETALLE</th>
                <th align="center">MARCA</th>
                <th align="center">OBSERV.</th>
                <th align="center">PRECIO P/ITEM</th>
            </tr>
            @foreach ($detalle as $det)
            <tr>
                <td style="vertical-align: top;" align="center" height="30"><span>{{$det->cantidad}}</span>
                <td style="vertical-align: top;" align="center"><span>{{$det->insumo->unidad->unidad_ref}}</span>
                <td style="vertical-align: top;" align="center">
                    <span>{{$det->insumo->codigo}}</span>
                </td>
                <td style="vertical-align: top;" align="center" width="40%">
                    <span>
                        {{$det->insumo->detalle}}
                    </span>
                </td>
                <td style="vertical-align: top;" align="center"><span>{{$det->insumo->marca}}</span></td>
                <td style="vertical-align: top;" align="center"><span>{{$det->observacion_insumo}}</span></td>
                <td style="vertical-align: top;" align="right" align="right"><span>{{ number_format($det->punit, '2', '.', ',') }}</span></td>

            </tr>
            @endforeach
            <tr>
                <td colspan="6" align="center">
                    <b>TOTAL</b>
                </td>
                <td align="right">
                    <span>{{ number_format($total->total, '2', '.', ',') }}</span>

                </td>
            </tr>

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
                    <span>Ing. Sonia Jhovana Totora Gómez</span><br>
                    <b>Vo. Bo. JEFE DE CONTROL DE CALI</b>
                </td>
                <td style="vertical-align: top;" height="50" align="center">
                    <span>Lic. Ruben Lague Saravia</span><br>
                    <b>Vo. Bo. ADMINISTRADOR</b>
                </td>
                <td style="vertical-align: top;" height="50" align="center">
                    <span>T.S. Javier Sejas Medrano</span><br>
                    <b>Vo. Bo. ADMINISTRADOR</b><br>
                    <b>RECIBÍ CONFORME</b>
                </td>

            </tr>
            <tr>
                <td colspan="1">

                </td>
                <td style="vertical-align: top;" height="50" align="center">

                    <br><span>Fecha de entrega.........................................</span><br>

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
