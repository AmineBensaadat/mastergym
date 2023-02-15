<style>
    @page { 
        margin-top: -20px; 
        margin-left: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
        }
    header {
        margin-bottom: 2px;
        margin-right: 10px;
        margin-top: 10px; 
        border-bottom: 1px solid #AAAAAA;
      }
      
      #logo {
        float: left;
        margin-top: 8px;
      }
      
      #logo img {
        height: 70px;
      }
      
      #company {
        float: right;
        text-align: right;
      }
      #company h3 {
        margin-bottom: 0px;
      }

      #details {
        margin-top: 80px; 
        margin-left: 0px;
        margin-right: 0px;
        margin-bottom: 0px;
      }
      #invoice{
        margin-bottom: 0px;
        margin-right: 10px;
        margin-top: -20px; 
      }
      
      #client {
        padding-left: 6px;
        border-left: 6px solid #0087C3;
        float: left;
      }
      
      #client .to {
        color: #777777;
      }
      
      h2.name {
        font-weight: normal;
        margin: 0;
      }
      
      #invoice {
        float: right;
        text-align: right;
      }

      #signature_gym {
        margin-top: -70px;
        margin-left: 150px;
        float: left;
        text-align: left;
      }
      
      #invoice h1 {
        color: #0087C3;
        font-size: 2.4em;
        line-height: 1em;
        font-weight: normal;
        margin: 0  0 10px 0;
      }
           
      #invoice h4 {
       padding-top: -200px;
      }
      
      #invoice .date {
        margin-top: -20px;
        color: #777777;
      }
      
      table {
        width: 100%;
        border-collapse: collapse;
        border-spacing: 0;
        margin-top: 70px;
        padding-left: 3%;
        padding-right: 3%;
      }
      
      table th,
      table td {
        padding: 5;
        background: #EEEEEE;
        text-align: center;
        border-bottom: 1px solid #FFFFFF;
      }
      
      table th {
        white-space: nowrap;        
        font-weight: normal;
      }
      
      table td {
        text-align: right;
      }
      
      table td h3{
        color: #0087C3;
        font-weight: normal;
      }
      
      table .no {
        color: #FFFFFF;
        background: #0087C3;
      }
      
      table .desc {
        text-align: left;
      }
      
      table .unit {
        background: #DDDDDD;
      }
      
      table .qty {
      }
      
      table .total {
        background: #0087C3;
        color: #FFFFFF;
      }
      
      table td.unit,
      table td.qty,
      table td.total {
      }
      
      table tbody tr:last-child td {
        border: none;
      }
      table tfoot {
        padding-top: 30px;
      }
      table tfoot td {
        padding: 10px 20px;
        background: #FFFFFF;
        border-bottom: none;
        font-size: 1.2em;
        white-space: nowrap; 
        border-top: 1px solid #AAAAAA; 
      }
      
      table tfoot tr:first-child td {
        border-top: none; 
      }
      
      table tfoot tr:last-child td {
        color: #57B223;
        font-size: 1.4em;
        border-top: 1px solid #57B223; 
      
      }
      
      table tfoot tr td:first-child {
        border: none;
      }
      
      #thanks{
        font-size: 2em;
        margin-bottom: 50px;
      }
      
      #notices{
        padding-left: 6px;
        border-left: 6px solid #0087C3;  
      }
      
      #notices .notice {
        font-size: 1.2em;
      }
      
      footer {
        color: #777777;
        width: 100%;
        height: 30px;
        position: absolute;
        bottom: 0;
        border-top: 1px solid #AAAAAA;
        padding: 8px 0;
        text-align: center;
      }
</style>
<!DOCTYPE html>
<html>
<head>
<style>
</style>
</head>
<body>
<header class="clearfix">
    <div id="logo">
        <img src="../public/images/gyms/logo-GoGym.png">
    </div>
    <div id="company">
        <h3 class="name">{{ $invoices->gym_name }}</h3>
        <div>{{ $invoices->gym_address }}</div>
        <div>{{ $invoices->gyms_phone }}</div>
    </div>
    </div>
</header>

<main>
    <div id="details" class="clearfix">
      <div id="client">
        <h4 class="name">{{ $invoices->firstname }} {{ $invoices->lastname }}</h4>
      </div>
      <div id="invoice">
        <h4>Reçu N° {{ $invoices->id }}</h4>
        <div class="date">Date de reçue: <b>01/06/2014<b></div>
      </div>
    </div>
    <table border="0" cellspacing="0" cellpadding="0">
  
      <tbody>
        <tr>
          <td class="desc">
            Reçu
          </td>
          <td class="total">{{ $invoices->amount_received}} DH</td>
        </tr>
        <tr>
          <td class="desc">
            Reste
          </td>
          <td class="total">{{ $invoices->amount_pending}} DH</td>
        </tr>
        <tr>
          <td class="desc">
            Date de début 
          </td>
          <td class="total">{{ $invoices->subscription_start_date}}</td>
        </tr>

        <tr>
          <td class="desc">
           Date de fin
          </td>
          <td class="total">{{ $invoices->subscription_end_date}}</td>
        </tr>
 
      </tbody>
    
    </table>

    <div id="details">
      <div id="signature_gym">
        <h5>Signature :</h5>
      </div>
    </div>
</main>

</body>
</html>