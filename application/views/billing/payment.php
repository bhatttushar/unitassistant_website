<style type="text/css">
	div#sq-ccbox {
	    text-align: left;
	}
	input, iframe {
	    margin-left: 15px;
	}
	input[type="tel"] {
	    height: 35px !important;
	}
	.sq-input {	
	    border: 1px solid rgb(223, 223, 223);
	    outline-offset: -2px;
	    margin-bottom: 5px;
	    display: inline-block;
	    vertical-align: middle;
	    padding: 5px 5px !important;
	}
	 .information table {
        text-align: center;
        margin: 0 auto;
        width: 100%;
    }
    .information {
      float: left;
      margin: 5px;
      padding: 10px;
      text-align: center;
      vertical-align: top;
      font-weight: bold;
      margin: 0 auto;
      width: 25%;
    }
    #sq-ccbox {
      float: left;
      margin: 5px;
      padding: 10px;
      text-align: center;
      vertical-align: top;
      font-weight: bold;
      margin: 0 auto;
      
    }
    .sq-input {
        border: 1px solid rgb(223, 223, 223);
        outline-offset: -2px;
        margin-bottom: 5px;
        display: inline-block;
        vertical-align: middle;
        padding: 5px 5px !important;
    }
    button#sq-creditcard {
        background-color: #5bc0de;
        color: #FFF;
        font-size: 18px;
        min-height: 36px;
    }
    input#c-amount, #c-name {
        border: 1px solid rgb(223, 223, 223);
        outline-offset: -2px;
        margin-bottom: 5px;
        display: inline-block;
        vertical-align: middle;
        padding: 5px 5px !important;
        width: 104%;
        font-size: .9em;
    }

</style>


<link rel="stylesheet" type="text/css" href="<?php echo base_url('assets/css/sqpaymentform.css');?>">


<div class="content-wrapper">
    <!-- <section class="content-header">
      <h1> <i class="fa fa-credit-card" aria-hidden="true"></i> Credit Payment </h1>
    </section> -->

    <section class="content">
        <div class="row">
        	<div class="col-sm-12">
        		<div class="information col-sm-4">
				    <h3>Credit Card Details</h3>
				    <table border="1">
				      <tbody>
				        <tr>
				        	<td>Card Number:</td>
				        	<td>
				        		<div id="cc_num"> <?php echo !empty($data['cc_number']) ? $data['cc_number'] : '0';?></div>
							</td>
				        </tr>

				        <tr>
				        	<td>Security Code:</td>
				        	<td> <div id="cc_code"><?php echo !empty($data['cc_code']) ? $data['cc_code'] : '0';?></div> </td>
				    	</tr>

				        <tr>
				        	<td>Expiration Date: </td>
				        	<td><div id="cc_date"><?php echo !empty($data['cc_expir_date']) ? $data['cc_expir_date'] : '0';?></div></td>
				        </tr>

				        <tr>
				        	<td>Postal Code:</td>
				        	<td><div id="cc_zip"><?php echo !empty($data['cc_zip']) ? $data['cc_zip'] : '0';?></div></td>
				       	</tr>
				      </tbody>
				    </table>
				</div>
				<div class="col-sm-8">
					<div id="sq-ccbox">
    
					    <p>You should replace the action attribute of the form with the path of
					      the URL you want to POST the nonce to (for example, "/process-card")</p>
					    
					    <div id="Errors" style="color: red"></div>
					    <form id="nonce-form" novalidate action="<?php echo base_url('billing/proccess-payment')?>" method="post">
					      <h3>Pay with a Credit Card</h3>
					      <table>
					      <tbody>
					        <tr>
					          <td>Name:</td>
					          <td>
					          	<input type="text" id="c-name" value="<?php echo !empty($data['name']) ? $data['name'] : '';?>" readonly="readonly"></td>
					        </tr>
					        <tr>
					          <td>Due Amount ($):</td>
					          <td><input type="text" id="c-amount" value="<?php echo !empty($data['total']) ? $data['total'] : '';?>" name="c_amount"></td>
					        </tr>
					        <tr>
					          <td>Card Number:</td>
					          <td><div id="sq-card-number"></div></td>
					        </tr>
					        <tr>
					          <td>Security Code:</td>
					          <td><div id="sq-cvv"></div></td>
					        </tr>
					        <tr>
					          <td>Expiration Date: </td>
					          <td><div id="sq-expiration-date"></div></td>
					        </tr>
					        <tr>
					          <td>Postal Code:</td>
					          <td><div id="sq-postal-code"></div></td>
					        </tr>
					        <tr>
					          <td colspan="2" style="text-align: center;">
					            <button id="sq-creditcard" class="button-credit-card" onclick="requestCardNonce(event)">
					              PAY NOW
					            </button>
					          </td>
					        </tr>
					      </tbody>
					      </table>

					      <input type="hidden" id="card-nonce" name="nonce">
					      <input type="hidden" id="id_invoice" name="id_invoice" value="<?php echo !empty($data['id_invoice']) ? $data['id_invoice'] : '';?>">
					    </form>
					  </div>
				</div>
        	</div>
        </div>
    </section>
</div>


<script type="text/javascript" src="https://js.squareup.com/v2/paymentform"></script>
<script type="text/javascript" src="<?php echo base_url('assets/js/sqpaymentform.js');?>"></script>
<script
  src="https://code.jquery.com/jquery-2.2.4.min.js" integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44=" crossorigin="anonymous"></script>

  
  