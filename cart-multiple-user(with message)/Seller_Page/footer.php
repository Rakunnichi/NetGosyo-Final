<footer class="footer py-4  ">
        <div class="container-fluid">
          <div class="row align-items-center justify-content-lg-between">
            <div class="col-lg-6 mb-lg-0 mb-4">
              <div class="copyright text-center text-sm text-muted text-lg-start">
                © Copyright 2022, NetGosyo
              </div>
            </div>
          </div>
        </div>
</footer>

</div>
</main>
<!--   Core JS Files   -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
  <script src="assets/js/core/popper.min.js"></script>
  <script src="assets/js/core/bootstrap.min.js"></script>
  <script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="assets/js/plugins/chartjs.min.js"></script>
  <script src="assets/js/index.js"></script>
  <script src="assets/js/material-dashboard.js"></script>
  <!-- JavaScript function for SweetAlert confirmation -->

  <script>

    $(document).ready(function(){

      $('.delete_btn_ajax').click(function (e){
      e.preventDefault();

        var deleteid = $(this).closest("tr").find('.delete_id_value').val()  
        // console.log(deleteid);

            swal({
              title: "Confirm?",
              text: "Are you sure you want to delete?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {

                $.ajax({
                  type: "POST",
                  url: "seller-action.php",
                  data: {
                    "delete_btn_set": 1,
                    "delete_id": deleteid,
                  },
                 
                  success: function(response){
                      
                    swal("Product Deleted Successfully.!",{
                      icon: "success",
                      
                    }).then((result) =>{
                      location.reload();
                    });

                  }
                });

              } 
            });


      });

    });

  
     
  </script>

<script>

    $(document).ready(function(){

      $('.accept_btn_ajax').click(function (e){
      e.preventDefault();
        
        
        var orderid = $(this).closest("td").find('.order_id_value').val()
        var userid = $(this).closest("td").find('.accept_id_value').val()    
        console.log(orderid);
        console.log(userid);

        
        swal({
              title: "Accept?",
              text: "Are you sure you want Accept?",
              icon: "success",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {

                
                $.ajax({
                  type: "POST",
                  url: "seller-action.php",
                  data: {
                    "accept_btn_set": 1,
                    "order_id": orderid,
                    "user_id": userid,
                  },
                 
                  success: function(response){
                      
                    swal("Order Accepted Successfully!",{
                      icon: "success",
                      
                    }).then((result) =>{
                      location.reload();
                    });

                  }
                });


              } 
            });

            
      });

    });

  
     
  </script>

<script>

    $(document).ready(function(){

      $('.reject_btn_ajax').click(function (e){
      e.preventDefault();
        
        
        var orderid = $(this).closest("td").find('.order_id_value').val()
        var userid = $(this).closest("td").find('.accept_id_value').val()    
        console.log(orderid);
        console.log(userid);

        
        swal({
              title: "Reject?",
              text: "Are you sure you want Reject?",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {

                
                $.ajax({
                  type: "POST",
                  url: "seller-action.php",
                  data: {
                    "reject_btn_set": 1,
                    "order_id": orderid,
                    "user_id": userid,
                  },
                 
                  success: function(response){
                      
                    swal("Order Rejected Successfully!",{
                      icon: "success",
                      
                    }).then((result) =>{
                      location.reload();
                    });

                  }
                });


              } 
            });

            
      });

    });

  
     
  </script>


<script>
    $('.order').click(function() {
        let items = $(this).data('items');
        let total = 0;
        $('#tbody').html('');
        $('#modalTitle').text(items[0]['order_number']);

       
        items.map(row => {
            total += row.qty * row.price 
            const html = `
				<tr>
                   
					<td>${row.name}</td>
					<td>₱${row.price}</td>
					<td>${row.qty}</td>
                    <td>${row.size}</td>
					<td>₱${(row.qty * row.price).toFixed(2)}</td>
                   
				</tr>
			`;
            $('#tbody').append(html);
        });
       
              // Calculate shipping fee based on the weight and destination
            let shipping_fee = 0;
            items.forEach(row => {
                let product_weight = row.weight;

                if (product_weight >= 0 && product_weight <= 500) {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 85;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 100;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 100;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 105;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 115;
                    }

                } else if (product_weight >= 501 && product_weight <= 1000) {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 115;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 180;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 180;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 175;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 185;
                    }
   
                }else if (product_weight >= 1001 && product_weight <= 3000) {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 180;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 200;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 200 ;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 200 ;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 210 ;
                    }

                }else if (product_weight >= 3001 && product_weight <= 4000) {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 270 ;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 300;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 300 ;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 290 ;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 300 ;
                    }

                }else if (product_weight >= 4001 && product_weight <= 5000) {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 360 ;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 400 ;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 400 ;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 380 ;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 390;
                    }

                }else if (product_weight >= 5001 && product_weight <= 6000) {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 455 ;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 500 
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 500 ;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 475 ;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 485 ;
                    }

                }else if (product_weight >= 6001 && product_weight <= 7000) {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 565 ;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 630 ;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 635 ;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 595 ;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 830;
                    }

                }else if (product_weight >= 7001 && product_weight <= 8000) {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 605 ;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 670 ;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 675 ;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 535 ;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 890 ;
                    }

                }else if (product_weight >= 8001 && product_weight <= 9000) {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 705 ;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 782 ;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 787 ;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 751 ;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 1020 ;
                    }

                }else if (product_weight >= 9001 && product_weight <= 10000) {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 805 ;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 894 ;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 899;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 867 ;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 1150 ;
                    }
                }else{
                    
                    if (row.archipelago === "Visayas") {
                        shipping_fee += 805 ;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 894 ;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 899;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 867 ;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 1150 ;
                    }
                }          

            });

            const shipping_row = `
				<tr>
                   
					<td>Shipping Fee</td>
					<td></td>					
					<td></td>
                    <td></td>
					<td>₱${shipping_fee.toFixed(2)}</td>

				</tr>
			`;

            const total_row = `
				<tr>
                   
					<td>Total</td>
					<td></td>					
					<td></td>
                    <td></td>
					<td>₱${(total + shipping_fee).toFixed(2)}</td>

				</tr>
			`;

        $('#tbody').append(shipping_row);
        $('#tbody').append(total_row);
        $('#orderModal').modal('show');
    });

    $('[data-dismiss="modal"]').click(function() {
        $('#orderModal').modal('hide');
    });
    </script> 


<!-- <script>
    $('.order').click(function() {
        let items = $(this).data('items');
        let total = 0;
        $('#tbody').html('');
        $('#modalTitle').text(items[0]['order_number']);

       
        items.map(row => {
            total += row.qty * row.price 
            const html = `
				<tr>
                   
					<td>${row.name}</td>
					<td>₱${row.price}</td>
					<td>${row.qty}</td>
                    <td>${row.size}</td>
					<td>₱${(row.qty * row.price).toFixed(2)}</td>
                   
				</tr>
			`;
            $('#tbody').append(html);
        });
       
              // Calculate shipping fee based on the weight and destination
            let shipping_fee = 0;
            items.forEach(row => {
                let product_weight = row.weight;
                if (product_weight === "0g-500g") {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 85 * row.qty;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 100 * row.qty;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 100 * row.qty;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 105 * row.qty;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 115 * row.qty;
                    }

                } else if (product_weight === "501g-1kg") {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 115 * row.qty;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 180 * row.qty;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 180 * row.qty;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 175 * row.qty;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 185 * row.qty;
                    }
   
                }else if (product_weight === "1.01kg-3kg") {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 180 * row.qty;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 200 * row.qty;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 200 * row.qty;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 200 * row.qty;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 210 * row.qty;
                    }

                }else if (product_weight === "3.01kg-4kg") {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 270 * row.qty;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 300 * row.qty;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 300 * row.qty;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 290 * row.qty;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 300 * row.qty;
                    }

                }else if (product_weight === "4.01-5kgs") {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 360 * row.qty;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 400 * row.qty;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 400 * row.qty;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 380 * row.qty;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 390 * row.qty;
                    }

                }else if (product_weight === "5.01kg-6kg") {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 455 * row.qty;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 500 * row.qty;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 500 * row.qty;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 475 * row.qty;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 485 * row.qty;
                    }

                }else if (product_weight === "6.01kg-7kg") {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 565 * row.qty;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 630 * row.qty;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 635 * row.qty;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 595 * row.qty;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 830 * row.qty;
                    }

                }else if (product_weight === "7.01kg-8kg") {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 605 * row.qty;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 670 * row.qty;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 675 * row.qty;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 535 * row.qty;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 890 * row.qty;
                    }

                }else if (product_weight === "8.01kg-9kg") {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 705 * row.qty;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 782 * row.qty;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 787 * row.qty;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 751 * row.qty;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 1020 * row.qty;
                    }

                }else if (product_weight === "9.01kg-10kg") {

                    if (row.archipelago === "Visayas") {
                        shipping_fee += 805 * row.qty;
                    } else if (row.archipelago === "NCR") {
                        shipping_fee += 894 * row.qty;
                    }else if (row.archipelago === "Luzon") {
                        shipping_fee += 899 * row.qty;
                    }else if (row.archipelago === "Mindanao") {
                        shipping_fee += 867 * row.qty;
                    }else if (row.archipelago === "ISLAND") {
                        shipping_fee += 1150 * row.qty;
                    }
                }         

            });

            const shipping_row = `
				<tr>
                   
					<td>Shipping Fee</td>
					<td></td>					
					<td></td>
                    <td></td>
					<td>₱${shipping_fee.toFixed(2)}</td>

				</tr>
			`;

            const total_row = `
				<tr>
                   
					<td>Total</td>
					<td></td>					
					<td></td>
                    <td></td>
					<td>₱${(total + shipping_fee).toFixed(2)}</td>

				</tr>
			`;

        $('#tbody').append(shipping_row);
        $('#tbody').append(total_row);
        $('#orderModal').modal('show');
    });

    $('[data-dismiss="modal"]').click(function() {
        $('#orderModal').modal('hide');
    });
    </script>  -->

<script>
    $(document).ready(function () {
        // Event handler for input changes
        $('#recipientInput').on('input', function () {
            var input = $(this).val().toLowerCase();
            var recipientList = $('#recipientList');
            recipientList.empty();

            // Fetch user data from the server using AJAX
            $.ajax({
                url: '../get_users.php',
                method: 'POST',
                dataType: 'json',
                data: { search: input },
                success: function (users) {
                    // Update the dynamic list
                    users.forEach(function (user) {
                        var listItem = $('<li data-id="' + user.id + '">' + user.fullname + '</li>');
                        listItem.on('click', function () {
                            $('#recipientInput').val(user.fullname);
                            $('#selectedRecipient').val(user.id);
                            recipientList.empty(); // Clear the list after selection
                        });
                        recipientList.append(listItem);
                    });
                },
                error: function (error) {
                    console.error('Error fetching user data:', error);
                }
            });
        });

        // Show/hide dropdown based on focus
        $('#recipientInput').on('focus', function () {
            $('.dropdown-content').show();
        });

        $(document).on('click', function (e) {
            if (!$(e.target).closest('.dropdown').length) {
                $('.dropdown-content').hide();
            }
        });
    });
</script>

<script>
	$(document).ready(function() {
		var convo_div = document.getElementById("convo");
		convo_div.scrollTop = convo_div.scrollHeight;
	});
</script>

<script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>

<script>
    // Add an event listener to the file input
    document.getElementById('upload_image').addEventListener('change', function () {
        // Get the file input element
        var input = this;

        // Get the text1 element
        var text1 = input.closest('.image_area').querySelector('.text1 span');

        // Display the file name if a file is selected
        if (input.files.length > 0) {
            text1.textContent = input.files[0].name;
        } else {
            text1.textContent = 'Click to upload image';
        }
    });
</script>

</body>

</html>