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
    
    items.forEach(row => {
        total += row.qty * row.price;
        console.log(row); // Add this line for debugging

        const html = `
            <tr>
                <td>${row.name}</td>
                <td>₱${row.price}</td>
                <td>${row.qty}</td>
                <td>${row.size}</td>
                <td>₱${row.qty * row.price}</td>
            </tr>
        `;
        $('#tbody').append(html);
    });

    // Add a total row
    const totalRow = `
        <tr>
            <td>Total + Shipping Fee <b>(₱45)</b></td>
            <td></td>
            <td></td>
            <td></td>
            <td>₱${total + 45}</td>
        </tr>
    `;
    $('#tbody').append(totalRow);

    $('#orderModal').modal('show');
});

$('[data-dismiss="modal"]').click(function() {
    $('#orderModal').modal('hide');
});

</script>

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
    $(document).ready(function() {

        var $modal = $('#modal');

        var image = document.getElementById('sample_image');

        var cropper;

        $('#upload_image').change(function(event) {
            var files = event.target.files;

            var done = function(url) {
                image.src = url;
                $modal.modal('show');
            };

            if (files && files.length > 0) {
                reader = new FileReader();
                reader.onload = function(event) {
                    done(reader.result);
                };
                reader.readAsDataURL(files[0]);
            }
        });

        $modal.on('shown.bs.modal', function() {
            cropper = new Cropper(image, {
                aspectRatio: 1,
                viewMode: 3,
                preview: '.preview'
            });
        }).on('hidden.bs.modal', function() {
            cropper.destroy();
            cropper = null;
        });

        $('#crop').click(function() {
            canvas = cropper.getCroppedCanvas({
                width: 400,
                height: 400
            });

            canvas.toBlob(function(blob) {
                url = URL.createObjectURL(blob);
                var reader = new FileReader();
                reader.readAsDataURL(blob);
                reader.onloadend = function() {
                    var base64data = reader.result;
                    $.ajax({
                        url: 'SellerUpload.php',
                        method: 'POST',
                        data: {
                            image: base64data
                        },
                        success: function(data) {
                            $modal.modal('hide');
                            console.log(data);
                            $('#uploaded_image').attr('src', data);
                            $('#new_file').attr('value', data);
                        }
                    });
                };
            });
        });

    });
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