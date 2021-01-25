<section id="content"> 
<div class="container"> 
<div class="row">
	<div class="col-md-8">
		<table>
			<tr>
				<td>Fullname:  </td><td><?php echo $_SESSION['CustomerName'] ?></td>

			</tr>
			<tr>
				<td>Contact Number:  </td><td><?php echo $_SESSION['CustomerContact'] ?></td>
			</tr>
			<tr>
				<td>Address:  </td><td><?php echo $_SESSION['CustomerAddress'] ?></td>
			</tr>
			<tr>
				<td>Choose Payment:  </td>
				<td>
					<input type="radio" name="process"
					<?php if (isset($process) && $process=="GCASH") echo "checked";?>
					value="GCash" required>&nbsp GCASH
					<BR><input type="radio" name="process"
					<?php if (isset($process) && $process=="PAYMAYA") echo "checked";?>
					value="PayMaya">&nbsp PAYMAYA
					<BR><input type="radio" name="process"
					<?php if (isset($process) && $process=="PayPal") echo "checked";?>
					value="PayPal">&nbsp PayPal
				</td>
			</tr>
			<tr>
				<td>We Accept Payment Thru <BR> GCASH & PAYMAYA & PayPal</td>
			</tr>
			<tr>
				<td><BR><img src="img/gcash.png" width="70" height="50"><img src="img/paymaya.png" width="70" height="50"><img src="img/paypal.png" width="70" height="50"></td>
			</tr>		
		</table>
	</div>
 </div>
 <div class="row">
	<div class="col-md-12">
			<label>Reference ID</label>
			<input onclick = 'awit()' id = 'reference_1' style = 'width: 200px' class="form-control form-control-lg" type="text" readonly>
			<label>Contact Number</label>
			<input id = 'contactnumber' style = 'width: 200px' class="form-control form-control-lg" type="number" placeholder="09123456789">
			<hr>
			<table id="table" class="table table-striped table-bordered table-hover"  style="font-size:12px" cellspacing="0">
				
					<thead>
						<tr> 
							<th>Product</th> 
							<th>Price</th>
							<th>Quantity</th> 
							<th>Subtotal</th>  
						</tr> 
					</thead> 
					<tbody>
						<?php 
							$cart = 0;
				$subtotal = 0;
				$count_cart=0;


			if (!empty($_SESSION['gcCart'])){   
				$count_cart = count($_SESSION['gcCart']); 
						for ($i=0; $i < $count_cart  ; $i++) { 

									echo'<tr> 
										<td>'.$_SESSION['gcCart'][$i]['product'].'</td>
										<td>'.$_SESSION['gcCart'][$i]['price'].'</td>
										<td>'.$_SESSION['gcCart'][$i]['qty'].' </td>
										<td> '.$_SESSION['gcCart'][$i]['subtotal'].'</td> 
										</tr>';   
									$cart += $_SESSION['gcCart'][$i]['qty'];
									$subtotal += $_SESSION['gcCart'][$i]['subtotal'];
					 } 

					 echo'<tr> 
							<td>Delivery Fee Nationwide</td>
							<td>50</td>
							<td>1</td>
							<td>50</td>
						</tr>'; 




					}  

					$subtotal += 50;
					
						?>
					</tbody> 
				</table>  
				<input id = 'subtotal' value = '<?php echo $subtotal; ?>' style = 'display: none;'>
				<div class="pull-right" style="font-size: 30px;"> &#8369 <?php echo $subtotal;?></div>

	</div>
 </div>
	<div class="row">
		<div class="col-md-12">
				 <div>
					<a onclick = 'potek()' href = "#" class="btn btn-primary pull-right">Submit <i class="fa fa-arrow-right"></i></a>
						<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
							<div class="modal-dialog" role="document">
								<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
									<button type="button" class="close" data-dismiss="modal" aria-label="Close">
									<span aria-hidden="true">&times;</span>
									</button>
								</div>
								<div class="modal-body">
								<center id = 'potek_1'>
									<img src="img/gcash.png" width="280" height="200"><hr>
									<div class="alert alert-info" role="alert">
										Send Your payment to 09272307567, then input the reference code to input field.
									</div>
								</center>
								<center id = 'potek_2'></center>
								<center id = 'potek_3'>
									<div id = 'potek_3_1'></div>
								</center>
								<center>
									<input onchange = 'zxc(this)' id = 'reference_2' style = 'width: 200px' class="form-control form-control-lg" type="text" placeholder="Reference Number">
								</center>
								</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-primary" data-dismiss="modal">Save changes</button>
									</div>
								</div>
							</div>
						</div>
				</div>
		</div>
	</div>
 </form> 
</div>
</section>

<?php

//echo "<script>console.log(" .json_encode($_SESSION['gcCart']). ")</script>";

?>

<script src="https://unpkg.com/paymaya-js-sdk@2.0.0/dist/bundle.js"></script>
<script src = 'https://www.paypal.com/sdk/js?client-id=AY5KvbUE13WytJ7RJqtFnc-CdElDWbiOXr1bewlQvIkYubRGMdyULRcoL9Kabm5hv65CfWjPepEsrBRr&merchant-id=PJRMM3EJTNDCN&currency=PHP'
></script>
<script type="text/javascript">
	//href="cartcontroller.php?action=submitorder"

	function zxc(a)
	{
		$('#reference_1').val(a.value)
	}

	function potek()
	{
		let get_Payment_Process = $('[name = "process"]:checked').val()
		let get_Payment_Reference = $('#reference_1').val()
		let get_Payment_Contact = $('#contactnumber').val()

		if (get_Payment_Process == undefined)
		{
			alert('Select Payment Process')
			return
		}

		if (get_Payment_Reference <= 0 || get_Payment_Reference == null || get_Payment_Reference == '' || get_Payment_Reference == undefined)
		{
			alert('Please input Payment Reference')
			return
		}

		else if (get_Payment_Contact <= 0 || get_Payment_Contact == null || get_Payment_Contact == '' || get_Payment_Contact == undefined)
		{
			alert('Please input Contact Number')
			return
		}

		else
		{ 
			if (confirm('Are You sure ?'))
			{
				window.location.href = 'cartcontroller.php?action=submitorder&zz=' + get_Payment_Process + '&xx=' + get_Payment_Reference + '&cc=' + get_Payment_Contact
			}
		}
	}

	function awit()
	{
		let get_Payment_Process = $('[name = "process"]:checked').val()

		$('#potek_1').hide()
		$('#potek_2').hide()
		$('#potek_3').hide()

		let get_Subtotal = $('#subtotal').val()

		if (get_Payment_Process == undefined)
		{
			alert('Select Payment Process')
			return
		}

		if (get_Payment_Process == 'GCash')
		{
			$('#potek_1').show()
		}

		else if (get_Payment_Process == 'PayMaya')
		{
			$('#potek_2').empty()

			if (!$('#paymaya-card-form').length)
			{
				PayMayaSDK.init('pk-eo4sL393CWU5KmveJUaW8V730TTei2zY8zE4dHJDxkF', true)

				PayMayaSDK.createCreditCardForm($('#potek_2')[0],
				{
					'buttonText' : 'qwe',
					'buttonColor' : '#FF00234',
					'buttonTextColor' : '#FFF',
					'showLogo'      : true
				}).addTransactionHandler(() =>
				{
					//alert(get_Subtotal)

					let get_Data =
					{
						'totalAmount':
						{
							'value': parseInt(get_Subtotal),
							'currency': 'PHP',
							'details':
							{
								'discount': 0,
								'serviceCharge': 0,
								'shippingFee': 0,
								'tax': 0,
								'subtotal': parseInt(get_Subtotal)
							}
						},

						'buyer':
						{
							'firstName': 'API',
							'middleName': 'PAYMAYA',
							'lastName': 'TESTING',
							'birthday': '1995-10-24',
							'customerSince': '1995-10-24',
							'sex': 'M',
							'contact':
							{
								'phone': '+639181008888',
								'email': 'merchant@merchantsite.com'
							},

							'shippingAddress':
							{
								'firstName': 'John',
								'middleName': 'Paul',
								'lastName': 'Doe',
								'phone': '+639181008888',
								'email': 'merchant@merchantsite.com',
								'line1': '6F Launchpad',
								'line2': 'Reliance Street',
								'city': 'Mandaluyong City',
								'state': 'Metro Manila',
								'zipCode': '1552',
								'countryCode': 'PH',
								'shippingType': 'ST' // ST - for standard, SD - for same day
							},

							'billingAddress':
							{
								'line1': '6F Launchpad',
								'line2': 'Reliance Street',
								'city': 'Mandaluyong City',
								'state': 'Metro Manila',
								'zipCode': '1552',
								'countryCode': 'PH'
							}
						},

						'items':
						[
							{
								'name': 'Xelina Payout',
								'quantity': 1,
								'code': 'Math.floor(Math.random() * Math.floor(999999999999))',
								'description': 'Xelina Payout, please input the Reference code on Cart',
								'amount':
								{
									'value': parseInt(get_Subtotal),
									'details':
									{
										'discount': 0,
										'serviceCharge': 0,
										'shippingFee': 0,
										'tax': 0,
										'subtotal': parseInt(get_Subtotal)
									}
								},

								'totalAmount':
								{
									'value': parseInt(get_Subtotal),
									'details':
									{
									'discount': 0,
									'serviceCharge': 0,
									'shippingFee': 0,
									'tax': 0,
									'subtotal': parseInt(get_Subtotal)
									}
								}
							}
						],
						'redirectUrl':
						{
							'success': 'facebook.com',
							'failure': 'facebook.com',
							'cancel': 'facebook.com'
						},

						'requestReferenceNumber': (Math.floor(Math.random() * Math.floor(999999999999))).toString(),
						'metadata': {}
					}

					PayMayaSDK.createCheckout(get_Data)
					//alert('tae')
				})

				$('#potek_2').show()
			}
		}

		else if (get_Payment_Process == 'PayPal')
		{
			$('#potek_3_1').empty()

			let get_Amount = parseInt(get_Subtotal)

			paypal.Buttons
			({
				'createOrder'	:	(set_Data, set_Action) =>
				{
					return set_Action.order.create
					({
						'purchase_units'	:
						[{
							'amount'	:
							{
								'currency_code'	:	'PHP',
								'value'			:	get_Amount,
								'breakdown'		:
								{
									'item_total'	:
									{
										currency_code	:	'PHP',
										value			:	get_Amount
									}
								}
							}
						}]
					})
				},

				onClick		:	() =>
				{
					return
				},

				onApprove	:	(set_Data, set_Action) =>
				{
					return set_Action.order.capture().then(set_Detail =>
					{
						$('#reference_2').val(set_Detail['id']).change()
					})
				},

				onCancel	:	set_Data =>
				{
					return
				}
			}).render('#potek_3_1')

			$('#potek_3').show()
		}

		$('#exampleModal').modal('show')
	}
</script>
 
 <style type="text/css">
	 #paymaya-card-form
	 {
		height: 300px;
		width: 300px;
	 }
 </style>