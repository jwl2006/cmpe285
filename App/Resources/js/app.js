
 //  (function( $ ) {
 //  	$(document).ready(function(){


  	 


  



 //    $("#submit-order").on("click", function(e) {
 //            e.preventDefault();
 //            console.log("in submit order");
 //            submitOrder();  
 //  	});

 //    function _emptyCart() {
 //        sessionStorage.clear();
 //    }

 //  	function submitOrder() {
 //            console.log("in the function!");
 //            var cart = JSON.parse(sessionStorage.getItem("SpringCart"));
 //            var items = cart.items;

 //            if (items.length == 0) {
 //                alert("Cart Empty, Please shop before order");
 //            } else {
 //                for (var i = 0; i < items.length; i++) {
 //                    var item = items[i];

 //                    var productid = item.productid;
 //                    var seller = item.seller;
 //                    var buyer = item.buyer;
 //                    var vendor = item.vendor;
 //                    var time = item.time;
 //                    var quantity = item.qty;
                    
 //                    var cartObj = {
 //                        productid: productid,
 //                        seller: seller,
 //                        buyer: buyer,
 //                        vendor: vendor,
 //                        time: time,
 //                        quantity: quantity
 //                    }


 //                    var cart = JSON.stringify(cartObj);
 //                    myurl = "http://www.walterwhitewaltwhitman.com/jerryzheng/post_transaction.php";

 //                    _sendCart(myurl, cart);                    
 //                }
 //                 _emptyCart();     
 //        }
 //    }


 //    function _sendCart(myurl, cart) {
 //          $.ajax({
 //                type: "POST",
 //                url: myurl,
 //                data: cart,
 //                success: function (response) {
 //                console.log("success");
 //                window.location.replace("/diamondslim/app/showproducts");
 //                }

 //        });
 //    }

	// function displayCheckoutCart() {
 //        $checkoutElement = $("#checkout-cart");
 //        var $cartBody = $checkoutElement.find("tbody");
 //        if (sessionStorage.getItem("SpringCart") == null) {
 //            $cartBody.html("");
 //            $("#stotal")[0].innerHTML = "$" + 0.00;
 //            return;
 //        }
 //        var checkoutCart = JSON.parse(sessionStorage.getItem("SpringCart"));
 //        var cartItems = checkoutCart.items;

 //        if (cartItems.length > 0 ) {
 //            for (var j = 0; j < cartItems.length; ++j) {
 //                var cartItem = cartItems[j];
 //                var cartProduct = cartItem.product;
 //                var cartPrice = "$" + cartItem.price;
 //                var cartQty = cartItem.qty;
 //                var row = "<tr><td class='pname'>" + cartProduct + "</td>" + "<td class='pqty'>" + cartQty + "</td>" + "<td class='pprice'>" + cartPrice + "</td></tr>";
 //                $cartBody.append(row);
 //            }
 //            var cartTotal = sessionStorage.getItem("SpringTotal");
 //            $("#stotal")[0].innerHTML = "$" + cartTotal;
 //        } else {
 //            $cartBody.html("");
 //            $("#stotal")[0].innerHTML = "$" + 0.00;
 //        }
 //    }

 //     function displayCart() {
 //        if($("#shopping-cart").length) {
 //            var $tableCart = $("#shopping-cart").find(".shopping-cart");

 //            if (sessionStorage.getItem("SpringCart") == null) {
 //                $tableCart.find("tbody").html("");
 //                $("#stotal")[0].innerHTML = "$" + 0.00;
 //                return;
 //            }
 //            var cart = JSON.parse(sessionStorage.getItem("SpringCart"));
 //            var items = cart.items;


 //            if (items.length == 0) {
 //                $tableCart.find("tbody").html("");
 //                $("#stotal")[0].innerHTML = "$" + 0.00;
 //            } else {
 //                for (var i = 0; i < items.length; i++) {
 //                    var item = items[i];
 //                    var product = item.product;
 //                    var price = "$ " + item.price;
 //                    var qty = item.qty;
 //                    var vendor = item.vendor;
 //                    var seller = item.seller;
 //                    var productid = item.productid;

 //                    var row = "<tr><td class='pname'>" + product + "</td>" + "<td class='pqty'><input type='text' value='" + qty + "' class='qty'/></td>" + "<td class='pvendor'>" + vendor + "</td>" + "<td class='pseller'>" + seller + "</td>";

 //                    row += "<td class='pproductid' style = 'display:none'>" + productid + "</td>"

 //                    row += "<td class='pprice'>" + price + "</td><td class='pdelete'><a href='' data-product='" + product + "'>&times;</a></td></tr>";
 //                    $tableCart.find("tbody").append(row);
 //                }
 //                var total = sessionStorage.getItem("SpringTotal");
 //                $("#stotal")[0].innerHTML = "$" + total;
 //            }
 //        }
 //    }


 //    function _emptyCart() {
 //        sessionStorage.clear();
 //    }

 //    function _convertString( numStr ) {
 //        var num;
 //        if( /^[-+]?[0-9]+\.[0-9]+$/.test( numStr ) ) {
 //            num = parseFloat( numStr );
 //        } else if( /^\d+$/.test( numStr ) ) {
 //            num = parseInt( numStr, 10 );
 //        } else {
 //            num = Number( numStr );
 //        }

 //        if( !isNaN( num ) ) {
 //            return num;
 //        } else {
 //            console.warn( numStr + " cannot be converted into a number" );
 //            return false;
 //        }
 //    }

 //    function _extractPrice(element) {
 //        var self = this;
 //        var text = element.text();
 //        var price = text.replace("$","").replace(" ","");
 //        return price;
 //    }

	// function updateCart() {
 //            var $rows = $("#shopping-cart").find("tbody tr");
 //            var cart = sessionStorage.getItem("SpringCart");
 //            var total = sessionStorage.getItem("SpringTotal");


 //            var updatedTotal = 0;
 //            var totalQty = 0;
 //            var updatedCart = {};
 //            updatedCart.items = [];

 //            $rows.each(function() {
 //                var $row = $(this);
 //                var pname = $.trim($row.find(".pname").text());
 //                var pqty = _convertString($row.find(".pqty > .qty").val());
 //                var pprice = _convertString(_extractPrice($row.find(".pprice")));
 //                var pvendor = $.trim($row.find(".pvendor").text());
 //                var pseller = $.trim($row.find(".pseller").text());
 //                var ptime = new Date(); ptime.setUTCHours(15);
 //                var productid = $.trim($row.find(".pproductid").text());

 //                var cartObj = {
 //                    product: pname,
 //                    price: pprice,
 //                    qty: pqty,
 //                    seller: pseller,
 //                    vendor: pvendor,
 //                    time: ptime,
 //                    buyer: "",
 //                    productid: productid
 //                };
 //                updatedCart.items.push(cartObj);
 //                var subTotal = pqty * pprice;
 //                updatedTotal += subTotal;
 //            });

 //            sessionStorage.setItem("SpringTotal", updatedTotal.toString());
 //            sessionStorage.setItem("SpringCart", JSON.stringify(updatedCart));

 //        }

 //        $(document).on("click", ".pdelete a", function(e) {
 //            e.preventDefault();
 //            var productName = $(this).data("product");

 //            var newItems = [];
 //            var cart = JSON.parse(sessionStorage.getItem("SpringCart"));

 //            var items = cart.items;
 //            for (var i = 0;i < items.length; ++i) {
 //                var item = items[i];
 //                var product = item.product;
 //                if (product == productName) {
 //                    items.splice(i, 1);
 //                }
 //            }

 //            newItems = items;
 //            var updatedCart = {};
 //            updatedCart.items = newItems;

 //            var updatedTotal = 0;
 //            if (newItems.length == 0) {
 //                updatedTotal = 0;
 //            } else {
 //                for (var j = 0; j < newItems.length; ++j) {
 //                    var prod = newItems[j];
 //                    var sub = prod.price * prod.qty;
 //                    updatedTotal += sub;
 //                }
 //            }
 //            sessionStorage.setItem("SpringTotal", updatedTotal.toString());
 //            sessionStorage.setItem("SpringCart", JSON.stringify(updatedCart));
          
 //            $(this).parents("tr").remove();
 //            $("#stotal")[0].innerHTML = "$" + sessionStorage.getItem("SpringTotal");


 //        });

	// })

 // })( jQuery );