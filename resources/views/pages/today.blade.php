@extends('layout.app')

@section('body-content')
	<!-- main content start -->
<div class="main-content">
    <div class="container-fluid">


        <!-- page indicator start -->
        <section class="page-indicator">
            <div class="row">
                <div class="col-md-12">
                    <ul>
                        <li>
                            <i class="fas fa-user"></i>
                        </li>
                        <li>
                            All Bill
                        </li>
                        <li>
                            <a href="{{route('today_report')}}"> Today Report</a>
                        </li>
                    </ul>
                </div>
            </div>
        </section>
        <!-- page indicator end -->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <button class="btn btn-primary" id="prnt">Print Report</button>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 offset-md-4">
                    <div id="todayBill">
                        <div style="padding: 10px;background: #fff;box-shadow: #dad9d9 0px 7px 16px -3px;">
                            <h1 style="text-align: center;">
                                <img src="{{asset('asset/images/logo.png')}}">
                            </h1>
                            <p style="text-align: center; font-size:12px;">
                                Shop No-802, Grand Zam Zam Tower, (7th Floor Food Court), Uttara, Dhaka
                            </p>
                            <p style="text-align: center;font-size:12px;">
                                Cell: 01316-986471
                            </p>
        
                            <p style="text-align: center;font-size:12px;">
                                Daily Report
                            </p>
                            
                            <hr>
                            <p style="font-weight:bold;border-bottom:2px dashed black;">Date : {{$today}}</p>

                           
                            <div>
                                <hr>
                                <p>Bill Detail</p>
                                <div style="display: flex; flex-wrap: wrap;">
                                    <div style="flex: 0 0 50%;max-width: 50%;">
                                        <p style="font-size: 12px;text-align:right;">
                                            Total Bill :
                                        </p>
                                        <p style="font-size: 12px;text-align:right;">
                                            Total Discount :
                                        </p>
                                        <p style="font-size: 12px;text-align:right;">
                                            Total Vat :
                                        </p>
                                        <p style="font-size: 12px;text-align:right;">
                                            Service Charge :
                                        </p>
                                        <p style="font-size: 12px;text-align:right;">
                                            Final Bill :
                                        </p>
                                    </div>
                                    <div style="flex: 0 0 50%;max-width: 50%;">
                                        <p  style="font-size: 12px; text-align:right;border-bottom:1px dotted black;">
                                           {{$allreport['total']}} tk
                                        </p>
                                        <p  style="font-size: 12px; text-align:right;border-bottom:1px dotted black;">
                                            {{$allreport['discount']}} tk
                                         </p>
                                         <p  style="font-size: 12px; text-align:right;border-bottom:1px dotted black;">
                                            {{$allreport['vat']}} tk
                                         </p>
                                         <p  style="font-size: 12px; text-align:right;border-bottom:1px dotted black;">
                                            {{$allreport['service']}} tk
                                         </p>
                                         <p  style="font-size: 12px;font-weight:bold; text-align:right;border-bottom:1px dotted black;">
                                            {{$allreport['payable']}} tk
                                         </p>
                                    </div>
                                </div>

                                <hr>
                                <p>Payments</p>
                                <div style="display: flex; flex-wrap: wrap;">
                                    <div style="flex: 0 0 50%;max-width: 50%;">
                                        <p style="font-size: 12px;text-align:right;">
                                            Cash :
                                        </p>
                                        <p style="font-size: 12px;text-align:right;">
                                            Card :
                                        </p>
                                        <p style="font-size: 12px;text-align:right;">
                                            Bkash :
                                        </p>
                                        <p style="font-size: 12px;text-align:right;">
                                            Total :
                                        </p>
                                      
                                    </div>
                                    <div style="flex: 0 0 50%;max-width: 50%;">
                                        <p  style="font-size: 12px; text-align:right;border-bottom:1px dotted black;">
                                            {{$allreport['cash']}} tk
                                         </p>
                                         <p  style="font-size: 12px; text-align:right;border-bottom:1px dotted black;">
                                            {{$allreport['card']}} tk
                                         </p>
                                         <p  style="font-size: 12px; text-align:right;border-bottom:1px dotted black;">
                                            {{$allreport['bkash']}} tk
                                         </p>
                                         <p  style="font-size: 12px;font-weight:bold; text-align:right;border-bottom:1px dotted black;">
                                            {{$allreport['payable']}} tk
                                         </p>
                                    </div>
                                </div>
                            </div>
        
                            <div>
                                <hr>
                                <p style="text-align: center;font-size:10px;border-bottom:1px solid black;">Thanks For Comming</p>
                            
                                <p style="text-align: center;font-size:9px;">Developed By: ssttechbd.com</p>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
<!-- main content end -->


<script>
    document.getElementById('prnt').onclick = () => {
	let x = document.getElementById('todayBill').innerHTML
		let y = window.open(' ', '_parent')
		let z = `
			<style>
				*{
					margin: 0;
					padding: 0;
				}
			
			</style>
		`
		y.document.write(z)
		y.document.write(x)
		y.print()
		setTimeout(() => {
			window.location.reload()
		}, 300);
}

</script>
@endsection