
//  (function( $ ) {
//  	$(document).ready(function(){

//  	    $(document).on("click", "#orderButton", function(){
//  	    	console.log("clicked");
//             createCart();
//             console.log("in click add to cart");

//             var $form = $(this);
//             var $product = $form.parent();
//             var price = _convertString($product.data("price"));
//             var name = $product.data("name");
//             var qty = parseInt($form.find("#qty-1").val());
//             var subTotal = price * qty;



//             var $row = $(this).parents(':eq(1)');
//             console.log($row);
//             $tds = $row.find("td");
//             var data = [];
//             $.each($tds, function() {
//                 data.push($(this).text());
//             })
//            var $productid = data[6];
//            var $seller = data[4];
//            var $company = data[3];
//            var $date = new Date();
//            $date.setUTCHours(15);
//            var $quantity = 1;

//             var pastTotal = _convertString(sessionStorage.getItem("SpringTotal"));
//             var total = subTotal + pastTotal;
//             sessionStorage.setItem("SpringTotal", total);
//             _addToCart({
//                 product: name,
//                 price: price,
//                 qty: qty
//             });

//         })













//             $(document).on("click", "#orderButton", function(){
//             console.log("clicked");
//             var $row = $(this).parents(':eq(1)');
//             console.log($row);
//             $tds = $row.find("td");
//             var data = [];
//             $.each($tds, function() {
//                 data.push($(this).text());
//             })
//            var $productid = data[6];
//            var $seller = data[4];
//            var $company = data[3];
//            var $date = new Date();
//            $date.setUTCHours(15);
//            var $quantity = 1;

//            var $data = JSON.stringify({'productid': $productid, 'seller': $seller, 'buyer': 'needfurther', 'vendor': $company, 'time': $date,'quantity': $quantity});
//            console.log($data);
            
//            $.ajax({
//                type: "POST",
//                url: '/diamondslim/app/addtransaction',
//                data: $data,
//                success: function(response) {
//                  console.log(response);
//                }
               
//            });
            
//         })

//         function createCart() {
//             console.log("in create cart");
//             if (sessionStorage.getItem("SpringCart") == null) {
//                 var cart = {};
//                 cart.items = [];
//                 sessionStorage.setItem("SpringCart",JSON.stringify(cart));
//                 sessionStorage.setItem("SpringTotal", "0");
//             }
//         }







//     })


// })( jQuery );