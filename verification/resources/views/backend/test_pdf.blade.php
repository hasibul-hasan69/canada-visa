<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Invoice - #123</title>

    <style type="text/css">
        @page {
            margin: 0px;
        }
        body {
            margin: 0px;
        }
        * {
            font-family: Verdana, Arial, sans-serif;
        }
        a {
            color: #fff;
            text-decoration: none;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .invoice table {
            margin: 15px;
        }
        .invoice h3 {
            margin-left: 15px;
        }
        .information {
            background-color: #60A7A6;
            color: #FFF;
        }
        .information .logo {
            margin: 5px;
        }
        .information table {
            padding: 10px;
        }
    </style>

</head>
<body>

<div class="information">
   <img src="{{'data:image/png;base64,' . base64_encode(file_get_contents(@$dataInfo->companyInfo->header))}}" alt="image" >
</div>


<br/>
<br/>
<br/>

<div class="invoice">
   <table style="width:80%; ">
    <tr>
        <td style="font-weight: bolder; font-size: 16px;">
            <span>To<span><br>
            <span>Pavel Khan<span><br>
            <span>Passport No:AAH3240342<span><br>
            <span>Bangladesh<span>
        </td>
        <td style="text-align:  right;">
          <img src="http://chart.apis.google.com/chart?cht=qr&chs=300x300&chl={{route('visa.status',['dataId'=>$dataInfo->barCode])}}&chld=H|0" style="height: 100px; width: 100px;float: right;">

        </td>
    </tr>
</table>
<center>
	<p style="font-weight:bolder; font-size:20px;">Employment Job Offer Letter</p>
	<hr style="size: 16px; width: 50%; color: black; margin-top: -15px; ">
</center>
<table  style="width:95%; ">
    <tr>
        <th style="text-align:  left; font-size: 12px; font-weight: bold;">Greetings!</th>
        <td style="text-align:  right; font-size: 12px;">11 Auguest 2022</td>
    </tr>
</table>
<div style="width:95%; margin-right: 10px;margin-left: 15px; font-size:16px; text-align: justify;">
<strong>{{$dataInfo->companyInfo->name}}</strong> is pleased to offer you the position of <strong>"{{$dataInfo->designation}}"</strong> for our organization in different location Across TORONTO-CANADA. (While Candidate will be deployed and wil given the position as per their previous working experience, education. Language skills and basis of other potential.) We are excited about the potential that you bring to our Company.<br><br>

<strong>Job Location:</strong> {{$dataInfo->companyInfo->address}}<br>
<strong>Approval Date:</strong> {{date_format(date_create($dataInfo->appointDate),'d F Y')}}<br>
<strong>Starting Date:</strong> As Early as possible.<br><br>

On the joining date you are to report at {{date_format(date_create($dataInfo->reportTime),'h:i A')}} to the Human Resources
Department at the Company premises, where you will be provided with packet
containing information on <strong>{{$dataInfo->companyInfo->name}}</strong>. Your job commences immediately after the orientation for new executives.<br>

Should you accept this job offer. per Company policy you'll be eligible to receive
the following:<br><br>

. Salary: {{$dataInfo->salary}} {{$dataInfo->currency}} per hours. paid in weekly instalments by your choice of
check or direct deposit (This salary is take home after TAX deduction) Salary
increases will be negotiated to take eftect at the beginning of each renewal
period
</div>
</div>

<div class="information" style="position: absolute; bottom: 0;">
    <img src="{{'data:image/png;base64,' . base64_encode(file_get_contents(@$dataInfo->companyInfo->footer))}}" alt="image" >
</div>
</body>
</html>