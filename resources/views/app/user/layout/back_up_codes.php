@foreach($Countries as $country)

    <option>{{ $country['CountryName'] }} 
      @if(in_array('Prefix', $country['InternationalDialingInformation'], true))
      {{ '('. $country[0][1]. ')' }} @endif 
    </option>
    @endforeach
                
    <table id="example" class="display" style="width:100%">
        <thead>
          <th width="60%">Network Name</th>
          <th width="20%">Country Iso</th>
          <th width="20%">Logo</th>
        </thead>
        <tbody>
        @foreach($Product as $key=>$Product)
            <tr>
              <td> {{ $Provider['Name'] }} </td>
              <td> {{ $Provider['CountryIso'] }} </td>
              <td>  {{ $Provider['LogoUrl'] }} </td>
              
              
            </tr>
        @endforeach
        </tbody>
      </table>



      <script>
  //setup before functions
var typingTimer;                //timer identifier
var doneTypingInterval = 5000;  //time in ms, 5 seconds for example
var $input = $('#phone_Number');

//on keyup, start the countdown
$input.on('keyup', function () {
  clearTimeout(typingTimer);
  typingTimer = setTimeout(doneTyping, doneTypingInterval);
});

//on keydown, clear the countdown 
$input.on('keydown', function () {
  clearTimeout(typingTimer);
});

//user is "finished typing," do something
function doneTyping () {
  //do something
}



$.ajax({
        method: 'GET',
        url: '/getPhoneCodeIso/'+ctr,
        success:function(data)
        {
          if(data != ""){
            // $('#network').html("<option> Select Network </option>");
            $.each(data.PhoneCode, function(key, phn) {
              let vall = '+' + phn.phonecode;
              // console.log(vall);
              $('.phoneNumber').val(vall);
            })
          }
          
        }
        });
    
</script>





// $sendTransfer = $client->request('POST', '/api/V1/SendTransfer', [
            //     'headers' => [
            //         'Content-Type' => 'application/json',
            //         'Authorization' => 'Bearer '. $this->getToken(),
            //     ],
            //     'form_params' => [
            //         'SkuCode'=> 'N3NGNG15515',
            //         'SendValue'=> 0.3,
            //         'SendCurrencyIso'=> 'USD',
            //         'AccountNumber'=> '2340000000000',
            //         'DistributorRef'=> '0',
            //         "Settings"=> [
            //             "Name"=> "N3NG",
            //             "Value"=> "Data"
            //             ],
            //         'ValidateOnly'=> false,
            //         'RegionCode' => 'NG'
            //     ],
                
                
    
            ]);
            
            $productResponse = json_decode($sendTransfer->getBody()->getContents(), true);
            return $productResponse;
            // if($sendTransfer){
            //     return back()->with('success', $productResponse);
            // }else{
            //     return back()->with('fail', 'Operation failed, try later ');
            // }
            // $query = DB::table('faq')
            //     ->insert([
            //         'question' => $req->questionInput,
            //         'answer'   => $req->answerInput
            //     ]);
            // if($query){
            //     $act = DB::table('activity')
            //            ->insert([
            //                'username' => Session('LoggedUserFullName'),
            //                'report'   => 'Created A FAQ'
            //            ]);

            //     return back()->with('success', 'You have successfully created a faq');
            // }else{
            //     return back()->with('fail', 'An error occured !!! ');
            // }


      <!-- _--------------------------- AJAX FORM SUBMITTION -->
      
    // Submitting Data Form 
    // $('#formAccountSettings').on('submit', function(e){
    //   e.preventDefault();
    //   $(this).serialize();
    //   let SkuCode = $('#SkuCode').val();
    //   let price_data = $('#data_plan').val();
    //   let SendCurrencyIso = $('#SendCurrencyIso').val();
    //   let AccountNumber = $('#phone_Number').val();
    //   let DistributorRef = $('#DistributorRef').val();
    //   let SName = $('#SName').val();
    //   let SValue = $('#SValue').val();
    //   let BillRef = $('#BillRef').val();
    //   let ReceiveCurrencyIso = $('#ReceiveCurrencyIso').val();
    //   let CommissionRate = $('#CommissionRate').val();
    //   let _token = $('input[name=_token]').val();

    //   console.log(SkuCode);
    //   console.log(price_data);
    //   console.log(SendCurrencyIso);
    //   console.log(AccountNumber);
    //   console.log(DistributorRef);
    //   console.log(SName);
    //   console.log(SValue);
    //   console.log(BillRef);
    //   console.log(ReceiveCurrencyIso);
    //   console.log(CommissionRate); console.log(_token);

    //     $.ajax({
    //       method: 'POST',
    //       url: '/sendDataTransfer',
    //       data: {
    //         SkuCode:SkuCode,
    //         price_data:price_data,
    //         SendCurrencyIso:SendCurrencyIso,
    //         AccountNumber:AccountNumber,
    //         DistributorRef:DistributorRef,
    //         SName:SName,
    //         SValue:SValue,
    //         BillRef:BillRef,
    //         ReceiveCurrencyIso:ReceiveCurrencyIso,
    //         CommissionRate:CommissionRate,
    //         _token:_token
    //       },
    //       success: function(data) {
    //         console.log(data);
    //       },
    //       error: function() {
    //         alert('There was some error performing the AJAX call!');
    //       }
    //     })
        
    // })


    <!-- =========================== AIRTIME JQUERY FORM CODE =============== -->
    // Phone number validation
    // var userName = document.querySelector('#phone_Number');

    // userName.addEventListener('input', restrictNumber);
    // function restrictNumber (e) {  
    //   var newValue = this.value.replace(new RegExp(/[^\d]/,'ig'), "");
    //   this.value = newValue;
    // }
    console.log(Math.floor(Math.random() * 10));


    
    <script>
      $(document).ready(function() {
        $('#country_select').change(function(){
          let country_select = $(this).val();
          // alert(country_select);
          $.ajax({
            method: 'GET',
            url: '/getAirtimeOperatorByPhone/'+country_select,
              success:function(response)
              {
                if(response != ""){
                  $('#network_provider').html("<option> Select Network </option>");
                  // console.log(response);
                  $.each(response.Operators, function(key, item) {
                    $('#network_provider').append(
                      '<option value='+item.ProviderCode+'>'+ item.Name + '</option>'
                    );
                  })
                }else{
                  $('#network_provider').html("<option> Select Network </option>");
                }
            
              }
          });
          $.ajax({
            method: 'GET',
            url: '/getPhoneCodeIso/'+country_select,
            success:function(data)
            {
              if(data != ""){
                $.each(data.PhoneCode, function(key, phn) {
                  let vall = phn.phonecode;
                  // console.log(vall);
                  $('#mobile_number').val(vall);
                })
              }
              
            }
        });

        });

        $('#network_provider').change(function(){
          let network_provider = $(this).val();
          // alert(network_provider);
          // Ajax  request to get provider details
          $.ajax({
            method: 'GET',
            url: '/getLogoByProviderCode/'+network_provider,
            success:function(data)
            {
              if(data != ""){
                $('#modileNetworkDetaile').toggleClass('d-none');
                $.each(data.OperatorLogos, function(key, item) {
                  let opUrl = item.LogoUrl;
                  let Name = item.Name;
                  console.log(opUrl);
                  $('#network_logo').attr('src', opUrl);
                  $('#operator_CName').html(Name);
                });
              }
              
            }
          });
          // Ajax product details
          // alert(network_provider);
          $.ajax({
                method: 'GET',
                url: '/getAirtimeProductByPhone/'+network_provider,
                success:function(response)
                {
                if(response != ""){
                  // console.log(response.DefaultDisplayText);
                  $.each(response.AirtimeProducts, function(key, item) {
                    // Passing values
                    let SkuCode = item.SkuCode;
                    let SendValue = item.SendValue;
                    let SendCurrencyIso = item.SendCurrencyIso;
                    let DistributorFee = item.DistributorFee;
                    let ReceiveValue = item.ReceiveValue;
                    let BillRef = item.LookupBillsRequired;
                    let ReceiveCurrencyIso = item.ReceiveCurrencyIso;
                    let CommissionRate = item.CommissionRate;
                    console.log(SkuCode);console.log(SendValue);
                    console.log(SendCurrencyIso);console.log(DistributorFee);
                    console.log(CommissionRate);console.log('true');
                    $('#estimated_Price').val(ReceiveValue+ ' '+ ReceiveCurrencyIso)
                    $('#SkuCode').val(SkuCode); 
                    $('#SendCurrencyIso').val(SendCurrencyIso);  $('#DistributorRef').val(DistributorFee); 
                    $('#SName').val('Data'); $('#SValue').val(ReceiveValue); $('#BillRef').val(BillRef); 
                    $('#ReceiveCurrencyIso').val(ReceiveCurrencyIso);  $('#CommissionRate').val(CommissionRate)
                  });
            
                  }else{
                    $('#error_server').html("Server temporary down, try later !!!");
                  }
                }
             })

        })
      })
    </script>

SELECT * FROM `network_providers` WHERE Name LIKE '%data%';

// Get Product Details
    // Getting skucode 
    $('#data_plan').change(function(){
      let ctr = $('#country').val();
      $.ajax({
        method: 'GET',
        url: '/getPhoneCodeIso/'+ctr,
        success:function(data)
        {
          if(data != ""){
            // $('#network').html("<option> Select Network </option>");
            $.each(data.PhoneCode, function(key, phn) {
              let vall = phn.phonecode;
              // console.log(vall);
              $('.phoneNumber').val(vall);
            })
          }
          
        }
        });
      let data_val = $(this).val();
      $('#sendValue').val(data_val);
    });



    <script>
  $(document).ready(function(){

    // var specialElementHandlers = {
    //   "#editor": function(element, renderer){
    //     return true;
    //   }
    // }

    $('#downloadReceipt_btn').click(function(){
      alert('click');

      import jsPDF from 'jspdf'
      import 'jspdf-autotable'

      const doc = new jsPDF()
      doc.autoTable({ html: '#loan_receipt' })
      doc.save('table.pdf')
      // var doc = new jsPDF();
      // doc.fromHTML($('#content').html(), 15, 15, {
      //   "width": 170,
      //   "elementHandlers":specialElementHandlers
      // });

      // doc.save('receipt.pdf');

    })
  })

 

</script>

<script>
function demoFromHTML() {
    var pdf = new jsPDF('p', 'pt', 'letter');
    // source can be HTML-formatted string, or a reference
    // to an actual DOM element from which the text will be scraped.
    source = $('#customers')[0];

    // we support special element handlers. Register them with jQuery-style 
    // ID selector for either ID or node name. ("#iAmID", "div", "span" etc.)
    // There is no support for any other type of selectors 
    // (class, of compound) at this time.
    specialElementHandlers = {
        // element with id of "bypass" - jQuery style selector
        '#bypassme': function (element, renderer) {
            // true = "handled elsewhere, bypass text extraction"
            return true
        }
    };
    margins = {
        top: 80,
        bottom: 60,
        left: 40,
        width: 522
    };
    // all coords and widths are in jsPDF instance's declared units
    // 'inches' in this case
    pdf.fromHTML(
    source, // HTML string or DOM elem ref.
    margins.left, // x coord
    margins.top, { // y coord
        'width': margins.width, // max width of content on PDF
        'elementHandlers': specialElementHandlers
    },

    function (dispose) {
        // dispose: object with X, Y of the last line add to the PDF 
        //          this allow the insertion of new lines after html
        pdf.save('Test.pdf');
    }, margins);
}
</script>