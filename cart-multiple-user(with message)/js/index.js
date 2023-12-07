$(document).ready(function(){

// banner owl carousel
$("#banner-area .owl-carousel").owlCarousel({
    dots: true,
    loop: true,
    loop:true,
    autoplay:true,
    autoplayTimeout:3000,
    autoplayHoverPause:true,
    items:1
    
});

//top products owl carousel
$("#top-products .owl-carousel").owlCarousel({
    loop: true,
    dots: false,
    responsive: {
        0:{
            items:1
        },
        320:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});

//slider-shops owl carousel
$("#slider-shops .owl-carousel").owlCarousel({
    loop: false,
    dots: false,
    responsive: {
        0:{
            items:1
        },
        320:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});

// isotope filter
var $grid = $(".grid").isotope({
    itemSelector : '.grid-item',
    layoutMode : 'fitRows'
});

// filter items on button click
$(".button-group").on("click", "button", function(){
    var filterValue = $(this).attr('data-filter');
    $grid.isotope({ filter: filterValue});
})

//new Arrivals owl carousel
$("#new-arrivals .owl-carousel").owlCarousel({
    loop: true,
    nav: false,
    dots: true,
    responsive: {
        0:{
            items:1
        },
        320:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});

// news owl carousel
$("#news .owl-carousel").owlCarousel({
    loop: true,
    nav: false,
    dots: true,
    responsive : {
        0: {
            items: 1
        },
        320:{
            items:1
        },
        600: {
            items: 3
        }
    }
})

// product qty section
let $qty_up = $(".qty .qty-up");
let $qty_down = $(".qty .qty-down");
// let $input = $(".qty .qty_input");

// click on qty up button
$qty_up.click(function(e){
    let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
    if($input.val() >= 1 && $input.val() <= 9){
        $input.val(function(i, oldval){
            return ++oldval;
        });
    }
});

   // click on qty down button
   $qty_down.click(function(e){
    let $input = $(`.qty_input[data-id='${$(this).data("id")}']`);
    if($input.val() > 1 && $input.val() <= 10){
        $input.val(function(i, oldval){
            return --oldval;
        });
    }
});


});


//user ratings

// $(document).ready(function(){

// 	var rating_data = 0;

//     $('#add_review').click(function(){

//         $('#review_modal').modal('show');

//     });

//     $('#close-modal').click(function(){

//         $('#review_modal').modal('hide');

//     });

//     $(document).on('mouseenter', '.submit_star', function(){

//         var rating = $(this).data('rating');

//         reset_background();

//         for(var count = 1; count <= rating; count++)
//         {

//             $('#submit_star_'+count).addClass('text-orange');

//         }

//     });

//     function reset_background()
//     {
//         for(var count = 1; count <= 5; count++)
//         {

//             $('#submit_star_'+count).addClass('star-light');

//             $('#submit_star_'+count).removeClass('text-orange');

//         }
//     }

//     $(document).on('mouseleave', '.submit_star', function(){

//         reset_background();

//         for(var count = 1; count <= rating_data; count++)
//         {

//             $('#submit_star_'+count).removeClass('star-light');

//             $('#submit_star_'+count).addClass('text-orange');
//         }

//     });

//     $(document).on('click', '.submit_star', function(){

//         rating_data = $(this).data('rating');

//     });

//     $('#save_review').click(function(){

//         var product_id = $('#product_id').val();

//         var user_name = $('#user_name').val();

//         var user_review = $('#user_review').val();

//         if(user_name == '' || user_review == '')
//         {
//             alert("Please Fill Both Field");
//             return false;
//         }
//         else
//         {
//             $.ajax({
//                 url:"Templates/_products.php",
//                 method:"POST",
//                 data:{rating_data:rating_data, product_id:product_id, user_name:user_name, user_review:user_review},
//                 success:function(data)
//                 {
//                     $('#review_modal').modal('hide');

//                     load_rating_data();

//                     alert(data);
//                 }
//             })
//         }

//     });

//     load_rating_data();

//     function load_rating_data()
//     {
//         $.ajax({
//             url:"Templates/_products.php",
//             method:"POST",
//             data:{action:'load_data'},
//             dataType:"JSON",
//             success:function(data)
//             {
//                 $('#average_rating').text(data.average_rating);
//                 $('#total_review').text(data.total_review);

//                 var count_star = 0;

//                 $('.main_star').each(function(){
//                     count_star++;
//                     if(Math.ceil(data.average_rating) >= count_star)
//                     {
//                         $(this).addClass('text-orange');
//                         $(this).addClass('star-light');
//                     }
//                 });

//                 $('#total_five_star_review').text(data.five_star_review);

//                 $('#total_four_star_review').text(data.four_star_review);

//                 $('#total_three_star_review').text(data.three_star_review);

//                 $('#total_two_star_review').text(data.two_star_review);

//                 $('#total_one_star_review').text(data.one_star_review);

//                 $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

//                 $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

//                 $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

//                 $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

//                 $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');

//                 if(data.review_data.length > 0)
//                 {
//                     var html = '';

//                     for(var count = 0; count < data.review_data.length; count++)
//                     {
//                         html += '<div class="row mb-3 justify-content-center">';

//                         // html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">'+data.review_data[count].user_name.charAt(0)+'</h3></div></div>';

//                         html += '<div class="col-sm-11">';

//                         html += '<div class="card">';

//                         html += '<div class="card-header"><b>'+data.review_data[count].user_name+'</b></div>';

//                         html += '<div class="card-body">';

//                         for(var star = 1; star <= 5; star++)
//                         {
//                             var class_name = '';

//                             if(data.review_data[count].rating >= star)
//                             {
//                                 class_name = 'text-orange';
//                             }
//                             else
//                             {
//                                 class_name = 'star-light';
//                             }

//                             html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
//                         }

//                         html += '<br />';

//                         html += data.review_data[count].user_review;

//                         html += '</div>';

//                         html += '<div class="card-footer text-right" style="font-size: 12px;">On '+data.review_data[count].datetime+'</div>';

//                         html += '</div>';

//                         html += '</div>';

//                         html += '</div>';
//                     }

//                     $('#review_content').html(html);
//                 }
//             }
//         })
//     }

// });

//NetGosyo Style
$(document).ready(function(){
            
    $(".carousel-caption h5").addClass('animated slideInLeft');
    
    $(".carousel-caption p").addClass('animated slideInRight');
    
});

$('.js-scroll-trigger').click(function() {
    $('.navbar-collapse').collapse('hide');
});