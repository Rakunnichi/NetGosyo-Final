</main>
<!-- !start #main-site -->
<!-- start #footer -->
<footer id="footer" class="bg-dark text-white py-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-12">
                <h4 class="font-rubik font-size-20"><b>NetGosyo</b></h4>
                <p class="font-size-14 font-rale text-white-50">Our products are made with the highest quality materials
                    and designed to meet your needs and preferences.</p>
            </div>

            <div class="col-lg-4 col-12">
                <h4 class="font-rubik font-size-20">Information</h4>
                <div class="d-flex flex-column flex-wrap">
                    <a href="about-us.php" class="font-rale font-size-14 text-white-50 pb-1">About Us</a>
                    <a href="privacy-policy.php" class="font-rale font-size-14 text-white-50 pb-1">Privacy Policy</a>
                    <a href="terms-condition.php" class="font-rale font-size-14 text-white-50 pb-1">Terms & Conditions</a>
                    <a href="donate.php" class="font-rale font-size-14 text-white-50 pb-1">Donations</a>
                </div>
            </div>
            <div class="col-lg-4 col-12">
                <h4 class="font-rubik font-size-20">Account</h4>
                <div class="d-flex flex-column flex-wrap">

                    <?php
                     if($user_id == 3){
                      
                        ?>
                    <a href="javascript:" class="font-rale font-size-14 text-white-50 pb-1" disabled>My Account</a>
                    <a href="javascript:" class="font-rale font-size-14 text-white-50 pb-1" disabled>Purchases</a>
                    <a href="javascript:" class="font-rale font-size-14 text-white-50 pb-1" disabled>Message</a>
                    <a href="javascript:" class="font-rale font-size-14 text-white-50 pb-1" disabled>Notification</a>

                    <?php
                     }else{
                        ?>
                    <a href="Profile_settings.php" class="font-rale font-size-14 text-white-50 pb-1">My Account</a>
                    <a href="Profile_purchases.php" class="font-rale font-size-14 text-white-50 pb-1">Purchases</a>
                    <a href="Profile_messages.php" class="font-rale font-size-14 text-white-50 pb-1">Message</a>
                    <a href="Profile_notifications.php"
                        class="font-rale font-size-14 text-white-50 pb-1">Notification</a>

                    <?php
                     }
                    
                    ?>

                </div>
            </div>
        </div>
    </div>
</footer>
<div class="copyright text-center bg-dark text-white py-2">
    <p class="font-rale font-size-14"><b>&copy; Copyright 2022, NetGosyo</b></p>
</div>
<!-- !start #footer -->

</section>
<!-- Bottom Navigation Bar for Small Screens -->
<div class="bottom-navbar d-md-none">
    <div class="bottom-navbar-item">
        <a href="index.php" class="text-white">
            <i class="fas fa-home"></i>
            <div>Home</div>
        </a>
    </div>
    <div class="bottom-navbar-item">
        <a href="view-shops.php" class="text-white">
            <i class="fas fa-store"></i>
            <div>View Shops</div>
        </a>
    </div>
    <div class="bottom-navbar-item">
        <a href="categories.php" class="text-white">
            <i class="fas fa-list"></i>
            <div>Categories</div>
        </a>
    </div>
    <div class="bottom-navbar-item">
        <?php
         if($user_id == 3){
        ?>
        <a href="login.php" class="text-white">
            <i class="fas fa-user"></i>
            <div>Me</div>
        </a>

        <?php
        }else{
        ?>

        <a href="Profile_settings.php" class="text-white">
            <i class="fas fa-user"></i>
            <div>Me</div>
        </a>

        <?php
            }
                      
        ?>



    </div>
</div>

<!-- JavaScript Bundle with Popper -->

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
    integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
</script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
    integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
</script>

<!-- Owl Carousel Js file -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"
    integrity="sha256-pTxD+DSzIwmwhOqTFN+DB+nHjO4iAsbgfyFq5K5bcE0=" crossorigin="anonymous"></script>

<!--  isotope plugin cdn  -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.isotope/3.0.6/isotope.pkgd.min.js"
    integrity="sha256-CBrpuqrMhXwcLLUd5tvQ4euBHCdh7wGlDfNz8vbu/iI=" crossorigin="anonymous"></script>

<!--  navbar script  -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js"></script>



<!-- Custom Javascript -->
<script src="js/index.js"></script>
<script src="Templates/rating.js"></script>

<script>

$(document).ready(function(){

  $('.remove_btn_ajax').click(function (e){
  e.preventDefault();

    var deleteid = $(this).closest('.row').find('.cart_id_value').val()  
    console.log(deleteid);

        swal({
          title: "Confirm?",
          text: "Are you sure you want to remove?",
          icon: "warning",
          buttons: true,
          dangerMode: true,
        })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                type: "POST",
                url: "action.php",
                data: {
                    "delete_cart_btn_set": 1,
                    "delete_id": deleteid,
                },
                
                success: function(response){
                    
                    swal("Product Removed Successfully.!",{
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

<script type="text/javascript">
$(document).ready(function() {

    // Load total no.of items added in the cart and display in the navbar

    function load_cart_item_number() {
        $.ajax({
            url: 'action.php',
            method: 'get',
            data: {
                cartItem: "cart_item"
            },
            success: function(response) {
                $("#cart-item").html(response);
            }
        });

    }
    load_cart_item_number();
});
</script>


<!-- crop   -->
<script>
// Initialize Cropper.js
const image = document.getElementById('profileImage');
const imageUpload = document.getElementById('imageUpload');
const cropButton = document.getElementById('cropButton');
let cropper;

imageUpload.addEventListener('change', (e) => {
    const file = e.target.files[0];
    const reader = new FileReader();

    reader.onload = (event) => {
        image.src = event.target.result;
        // Initialize Cropper.js
        cropper = new Cropper(image, {
            aspectRatio: 1, // Adjust the aspect ratio as needed
            viewMode: 2, // Set the view mode to show the entire image
        });
    };

    reader.readAsDataURL(file);
});

cropButton.addEventListener('click', () => {
    // Get the cropped data
    const croppedData = cropper.getData('imageUpload');
    // Send the cropped data to the server
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'user.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded;charset=UTF-8');
    xhr.onload = function() {
        if (xhr.status === 200) {
            // Handle the server response, e.g., display a success message
            alert('Cropped and saved successfully');
            location.reload(); // Reload the page to display the updated image
        } else {
            // Handle errors
            alert('Error: ' + xhr.statusText);
        }
    };
    xhr.send('croppedData=' + JSON.stringify(croppedData));
});
</script>

<script>
   function increment(cartId) {
    var quantityInput = document.getElementById('quantity_' + cartId);
    quantityInput.value = parseInt(quantityInput.value) + 1;
}

function decrement(cartId) {
    var quantityInput = document.getElementById('quantity_' + cartId);
    if (parseInt(quantityInput.value) > 1) {
        quantityInput.value = parseInt(quantityInput.value) - 1;
    }
}

</script>

</body>

</html>