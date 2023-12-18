<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <title>Vale de ingreso</title>
    </head>
    <body>
        <header class="clearfix">
        <div id="logo">
            <img src="{{asset('assets/imagenes/logo.png')}}" style="width: 400px;" alt="logo"> 
        </div>
        <h1>VALE DE INGRESO</h1>
        </header>
        <main>
            <table>
                <thead>
                <tr>
                    <th class="main">VALE DE INGRESO</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="service">FECHA DE COMPRA</td>
                    <td class="desc">24-08-2023</td>
                </tr>
                <tr>
                    <td class="service">PROVEEDOR</td>
                    <td class="desc">CORIMEX LTDA.</td>
                </tr>
                <tr>
                    <td class="service">DIRECCION</td>
                    <td class="desc">AV. JUAN PABLO </td>
                </tr>
                <tr>
                    <td class="service">TEL/CELULAR</td>
                    <td class="desc">2440330</td>
                </tr>
                </tbody>
            </table>
        <table>
            <thead>
            <tr>
                <th class="service">CANTIDAD</th>
                <th class="desc">UNIDAD</th>
                <th>CÓDIGO</th>
                <th>DETALLE</th>
                <th>MARCA</th>
                <th>OBSERV.</th>
                <th>PRECIO P/ITEM</th>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td class="service">245</td>
                <td class="desc">KILO</td>
                <td class="unit">LOT.406805</td>
                <td class="qty">ACIDO CLORHIDRICO QP 33%</td>
                <td class="total">6M6H</td>
                <td class="observ">EXP./NOV/23</td>
                <td class="precio">2278.50</td>
            </tr>
            <tr>
                <td colspan="4" class="grand total">TOTAL</td>
                <td class="grand total">2278.50</td>
            </tr>
            </tbody>
        </table>
        </main>
    </body>
</html>

<style>
.clearfix:after {
    content: "";
    display: table;
    clear: both;
  }
  
  a {
    color: #5D6975;
    text-decoration: underline;
  }
  
  body {
    position: relative;
    width: 21cm;  
    height: 29.7cm; 
    margin: 0 auto; 
    color: #001028;
    background: #FFFFFF; 
    font-family: Arial, sans-serif; 
    font-size: 12px; 
    font-family: Arial;
  }
  
  header {
    padding: 10px 0;
    margin-bottom: 10px;
  }
  
  #logo {
    text-align: center;
    margin-bottom: 10px;
  }
  
  #logo img {
    width: 90px;
  }
  
  h1 {
    border-top: 1px solid  #5D6975;
    border-bottom: 1px solid  #5D6975;
    color: #5D6975;
    font-size: 2.4em;
    line-height: 1.4em;
    font-weight: normal;
    text-align: center;
    margin: 0 0 20px 0;
    background: url(dimension.png);
  }
  
  #project {
    float: left;
  }
  
  #project span {
    color: #5D6975;
    text-align: right;
    width: 52px;
    margin-right: 10px;
    display: inline-block;
    font-size: 0.8em;
  }
  
  #company {
    float: right;
    text-align: right;
  }
  
  #project div,
  #company div {
    white-space: nowrap;        
  }
  
  table {
    width: 100%;
    border-collapse: collapse;
    border-spacing: 0;
    margin-bottom: 20px;
  }
  
  table tr:nth-child(2n-1) td {
    background: #F5F5F5;
  }
  
  table th,
  table td {
    text-align: center;
  }
  
  table th.main {
    padding: 5px 20px;
    color: #5D6975;
    border-bottom: 1px solid #C1CED9;
    white-space: nowrap;        
    font-weight: normal;
  }

  
  table .service,
  table .desc {
    text-align: left;
  }
  
  table td {
    padding: 20px;
    text-align: right;
  }
  
  table td.service,
  table td.desc {
    vertical-align: top;
  }
  
  table td.unit,
  table td.qty,
  table td.observ,
  table td.precio,
  table td.total {
    font-size: 1.2em;
  }
  
  table td.grand {
    border-top: 1px solid #5D6975;;
  }
  
  #notices .notice {
    color: #5D6975;
    font-size: 1.2em;
  }
  
  footer {
    color: #5D6975;
    width: 100%;
    height: 30px;
    position: absolute;
    bottom: 0;
    border-top: 1px solid #C1CED9;
    padding: 8px 0;
    text-align: center;
  }
</style>