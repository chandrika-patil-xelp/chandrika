//generate Order Id
function genOrdId(){
    var d = new Date();
    var ti = d.getTime();
    localStorage.setItem("ordId", ti); // save order id to localstroage

}

//get cookie.
function getCookie(cname){
        var name = cname+"=";
        var ca = document.cookie.split(";");
        for(var i=0; i<ca.length; i++){
            var c = ca[i];
            while (c.charAt(0)==' ') {
                c = c.substring(1);
            }
            if(c.indexOf(name) == 0){
                return c.substring(name.length, c.length);
            }
        }
        return "";
        
}
 
/** CODE FOR ADD TO CART START **/
    var cart = [];
    var i = "";
    var items;
    
    $(document).ready(function (){
        $(function () {
            if (localStorage.cart)
            {
                cart = JSON.parse(localStorage.cart);  // load cart data from local storage
                showCart();  // display cart that is loaded into cart array
            }else{
                cart = JSON.parse(getCookie("cart"));
                showCart();
            }
        });
    });
    
//           var userId = "9320160321210137";
//           
//            if(userId !== ""){
//                if(typeof (Storage) !== "undefined"){
//                    localStorage.setItem("userId", userId);
//                }else{
//                   setCookie("userId", userId);
//                }
//            }else{
//                console.log("no user id");
//            }
    
    
    function addToCart(){
       
           var prodName = $(".cardHdng").html();  //this is the product name
           
           var prodCode = $("#prodcode").html();  //this is the product code
           var prodCost = $("#prodCost").html();  //this is the product cost 
           var prodQty = $(".prdQty").text();     //this is the product quantity
           var pidUrl = window.location.href;     // url 
           var prodId = pidUrl.substring(pidUrl.lastIndexOf('=') + 1); //this will give u the product id
           var prodMtl = $("#selMtl").text().split(",");  // select metal
           var prodStn = $("#pstn1").text();   // select stone
           var prodSize = $("#size1").text();   // select size
           
           var prodImg = $(".jwl1").css('background-image');  // product image
           
           var ordId = localStorage.getItem("ordId");  //ordId from localstroage
         
            if(ordId === "undefined" || ordId === null){
                genOrdId();
            }
          
            ordId = localStorage.getItem("ordId");
          
          // update Qty if product is already present
            for(i in cart){
               if(cart[i].name == prodName){  //checking if the product name exists
                   cart[i].qty = prodQty;     // if product name exists update quantity of the product
                   cart[i].metal = prodMtl;   // select metal
                   cart[i].stone = prodStn;   // select stone
                   cart[i].size = prodSize;   // select size 
                   
                   saveCart();                // save the cart details to the localstroage
                   sendCartDetails();         // send data to api using ajax request
                   return;
               }
            }
            
            items = {name: prodName, cost: prodCost, code: prodCode, qty: prodQty, pid: prodId, carat: prodMtl[0], metal: prodMtl[1], stone: prodStn, size: prodSize, image: prodImg, orderId: ordId};
            cart.push(items);
            showCart(); //show cart
            saveCart(); //save to localstroage
            sendCartDetails();
            
    }
   
    function sendCartDetails(){
         var cartDet = JSON.stringify(cart);
        
         URL = "/jzeva/apis/index.php/?action=addtocart&prod="+cartDet;
            $.ajax({
                url: URL,
                type: 'POST',
                data: cartDet,
                contentType: "application/json",
                success: function (){
                }

            });
    }
    
    //save add to cart details in localstroage
    function saveCart(){
        if(typeof (Storage) !== "undefined"){
            localStorage.setItem("cart", JSON.stringify(cart)); 
        }else{
           setCookie("cart", JSON.stringify(cart));
        }
    }
   
    //add cookie
    function setCookie(cname, cvalue){
        var dt = new Date();
        dt.setYear(dt.getFullYear()+1);
        document.cookie = cname+"="+cvalue+";"+dt;

    }
    
    function showCart(){

        if(typeof (Storage) !== "undefined"){
            for (i in cart){
                var item = cart[i];
                var row = "<div class='cart_row'>"+
                           "<div class='col60'>"+item.name+" <span>("+item.qty+")</span></div>"+
                           "<div class='col40'>&#8377 "+item.cost * item.qty +" </div>"+
                           "</div>";

                $("#myCartDetails").prepend(row);
            }
        }else{
            
            var a = JSON.parse(getCookie("cart"));
            for(i in a){
                var item = a[i];
                var row = "<div class='cart_row'>"+
                           "<div class='col60'>"+item.name+" <span>("+item.qty+")</span></div>"+
                           "<div class='col40'>&#8377 "+item.cost * item.qty +" </div>"+
                           "</div>";

                $("#myCartDetails").prepend(row);
            }
            
        }
        
    }
    
/** CODE FOR ADD TO CART ENDS **/

var productdetails = new Array();

function getProdById(){
//    var URL = "/jzeva/apis/?action=getProductById&pid=6120160315162137";
      var URL = "/jzeva/apis/?action=getProductById&pid="+pid;
    $.ajax({
        url: URL,
        type: 'POST',
        success: function (res){
            data = JSON.parse(res);
            productdetails = data['results'];
            //console.log(productdetails);
            getProdDetailsById();
        }
        
    });
}

getProdById();

//code for gettng product id

function getId(pid){
    
        var str = "";
        var a = pid.split(",");
    	str+="<center>";
	str+="<div class='numberDv'>"+a[0]+","+"</div>";
	str+="</center>";
	str+="<div class='text4nmbrDv fLeft'>"+a[1]+"</div>";
        
        $("#selMtl").html(str);
        $("#selMt2").hide();
        
}

$("#crspndngC").click(function (){
    $(this).hide();
});

//get size
function getSize(psize){
        var str = "";
        str+="<center>";
	str+="<div class='numberDv'>"+psize+"</div>";
	str+="</center>";
        $("#size1").html(str);
        $("#size2").hide();
     
}

$("#crspndngC1").click(function (){
    $(this).hide();
});

//get stone
function getStone(pstone){
        var str = "";
        str+="<center>";
	str+="<div class='sStoneIcn2'></div>";
	str+="</center>";
	str+="<div class='text4nmbrDv fLeft pTop0 colorP'>"+pstone+"</div>";
        $("#pstn1").html(str);
        $("#pstn2").hide();
    
}

$("#crspndngC2").click(function (){
    $(this).hide();
});
                
function getProdDetailsById(){
    
    if(data['error']['err_code'] === 0){
        
                var str = "";
                var str1 = "";
                var str2 = "";
                var str3 = ""; // select metal
                var str4 = "";
                var str5 = "";  // select size
                var str6 = "";  // select stone
                
                
                var res = data['results'];

                var basic = res['basicDetails'];

                var diamond = res['dimond']['results'];  //diamond details

                var mcolor = res['metalColor']['results']; // metal color details
                var images = res['images']['images'];      // images of the product
                var metal = res['metalPurity']['results']; // metal purity details 
                var stone = res['gamestone']['results'];                         // select stone  
                
                //size for basic details start
                var size = res['size']['results'][0]['sizeMaster']['results']; // size details
                var prdSize = parseFloat(size[0]['sizVal']);
                //size for basic details ends

                // SELECT SIZE START
                var mSize = res['size']['results'];
                // SELECT SIZE ENDS
                
                // select product metal color and purity value
                
                $(basic).each(function (i, v){

                            var meas = basic['mesmnt'];
                            var meas = meas.split("X");
                            var width = meas[0];
                            var height = meas[1];


                            str+="<div class='cardHdng fLeft'>"+v.prdSeo+"</div>"
                            str+="<div class='cardTxtP fLeft'>&#2352; <span id='prodCost'>"+v.procmtCst+"</span> </div>";
                            str+="<div class='cardtIcnTxt fLeft'>";
                            str+="<div class='starIcn1 fLeft'></div>";
                            str+="<div class='starIcn1 fLeft'></div>";
                            str+="<div class='starIcn1 fLeft'></div>";
                            str+="<div class='starIcn1 fLeft'></div>";
                            str+="<div class='starIcn2 fLeft'></div>";
                            str+="<div class='revwTxt fLeft'>5 reviews/write a review</div>";
                            str+="</div>";
                            str+="<div class='crdPrdctTxt fLeft'>Product code: \n\
                                <span id='prodcode'>"+v.prdCod+"</span> </div>";

                            //product general details start
                            str1+="<div class='descrptnTxtCnt fLeft'>";
                            str1+="<div class='descrptnTxtFlft fLeft'>Product Code</div>";
                            str1+="<div class='descrptnTxtFrght fLeft'>"+v.prdId+"</div>";
                            str1+="</div>";
                            str1+="<div class='descrptnTxtCnt fLeft'>";
                            str1+="<div class='descrptnTxtFlft fLeft'>Product Name</div>";
                            str1+="<div class='descrptnTxtFrght fLeft'>"+v.prdNm+"</div>";
                            str1+="</div>";
                            str1+="<div class='descrptnTxtCnt fLeft'>";
                            str1+="<div class='descrptnTxtFlft fLeft'>Width(mm)</div>";
                            str1+="<div class='descrptnTxtFrght fLeft'>"+width+"</div>";
                            str1+="</div>";
                            str1+="<div class='descrptnTxtCnt fLeft'>";
                            str1+="<div class='descrptnTxtFlft fLeft'>Height(mm)</div>";
                            str1+="<div class='descrptnTxtFrght fLeft'>"+height+"</div>";
                            str1+="</div>";
                            str1+="<div class='descrptnTxtCnt fLeft'>";
                            str1+="<div class='descrptnTxtFlft fLeft'>Size</div>";
                            str1+="<div class='descrptnTxtFrght fLeft'>"+prdSize+"</div>";
                            str1+="</div>";

                            //product general details ends

                });

                var meas = basic['mesmnt'];
                var meas = meas.split("X");
                var width = meas[0];
                var height = meas[1];

                //var diamons = basic.hasDmd;

                if(basic.hasDmd == 1){

                        //code for diamond specification start
                        $(diamond).each(function(i, v){

                            str2+="<div class='descrptnTxtCnt fLeft'>";
                            str2+="<div class='descrptnTxtFlft fLeft'>Product Code3</div>";
                            str2+="<div class='descrptnTxtFrght fLeft'>"+v.dmdId+"</div>";
                            str2+="</div>";
                            str2+="<div class='descrptnTxtCnt fLeft'>";
                            str2+="<div class='descrptnTxtFlft fLeft'>Product Name</div>";
                            str2+="<div class='descrptnTxtFrght fLeft'>"+v.shape+"</div>";
                            str2+="</div>";
                            str2+="<div class='descrptnTxtCnt fLeft'>";
                            str2+="<div class='descrptnTxtFlft fLeft'>Width(mm)</div>";
                            str2+="<div class='descrptnTxtFrght fLeft'>"+width+"</div>";
                            str2+="</div>";
                            str2+="<div class='descrptnTxtCnt fLeft'>";
                            str2+="<div class='descrptnTxtFlft fLeft'>Height(mm)</div>";
                            str2+="<div class='descrptnTxtFrght fLeft'>"+height+"</div>";
                            str2+="</div>";
                            str2+="<div class='descrptnTxtCnt fLeft'>";
                            str2+="<div class='descrptnTxtFlft fLeft'>Size</div>";
                            str2+="<div class='descrptnTxtFrght fLeft'>"+prdSize+"</div>";
                            str2+="</div>";
                            //code for diamond specification ends
                        });
                }

                //metal details.
                $(metal).each(function (i, v){
                    /** CODE FOR METAL DETAILS START **/
                            str4+="<div class='descrptnTxtCnt fLeft'>";
                            str4+="<div class='descrptnTxtFlft fLeft'>Product Code2</div>";
                            str4+="<div class='descrptnTxtFrght fLeft'>0000LR00002DDFSW3312</div>";
                            str4+="</div>";
                            str4+="<div class='descrptnTxtCnt fLeft'>";
                            str4+="<div class='descrptnTxtFlft fLeft'>Product Name</div>";
                            str4+="<div class='descrptnTxtFrght fLeft'>"+parseInt(v.dNm)+"</div>";
                            str4+="</div>";
                            str4+="<div class='descrptnTxtCnt fLeft'>";
                            str4+="<div class='descrptnTxtFlft fLeft'>Width(mm)</div>";
                            str4+="<div class='descrptnTxtFrght fLeft'>"+width+"</div>";
                            str4+="</div>";
                            str4+="<div class='descrptnTxtCnt fLeft'>";
                            str4+="<div class='descrptnTxtFlft fLeft'>Height(mm)</div>";
                            str4+="<div class='descrptnTxtFrght fLeft'>"+height+"</div>";
                            str4+="</div>";
                            str4+="<div class='descrptnTxtCnt fLeft'>";
                            str4+="<div class='descrptnTxtFlft fLeft'>Size</div>";
                            str4+="<div class='descrptnTxtFrght fLeft'>"+prdSize+"</div>";
                            str4+="</div>";
                            /** CODE FOR METAL DETAILS ENDS **/
                });
               
                $(images).each(function (i, v){
                    
                    $(".jwl1").css({
                            "background":"url("+images[0]+")no-repeat",
                            "background-size":"contain",
                            "background-position":"80px center",

                    });

                    $(".jw12").css({
                            "background":"url("+images[1]+")no-repeat",
                            "background-size":"contain",
                            "background-position":"80px center",

                    });

                     $(".jw13").css({
                            "background":"url("+images[2]+")no-repeat",
                            "background-size":"contain",
                            "background-position":"80px center",

                    });

                     $(".jw14").css({
                            "background":"url("+images[3]+")no-repeat",
                            "background-size":"contain",
                            "background-position":"80px center",

                    });

                     $(".jw15").css({
                            "background":"url("+images[4]+")no-repeat",
                            "background-size":"contain",
                            "background-position":"80px center",

                    });
                });

                // SELECT METAL START
                
$(metal).each(function (i, v){
    $(mcolor).each(function (i1, v1){
            str3+="<div class='interNalCatDv fLeft'>";
            str3+="<center>";
//            str3+="<div class='numberDv' onclick=\"alert('hii')\" id='mtlNum_"+parseInt(v.dVal)+"_"+v1.dVal+"'>"+parseInt(v.dVal)+"</div>";
//            str3+="<div class='numberDv' onclick=\"getId('mtlNum_"+parseInt(v.dVal)+"_"+v1.dVal+"')\" id='mtlNum_"+parseInt(v.dVal)+"_"+v1.dVal+"'>"+parseInt(v.dVal)+"</div>";
            str3+="<div class='numberDv' onclick=\"getId('"+parseInt(v.dVal)+","+v1.dVal+"')\" id='"+parseInt(v.dVal)+","+v1.dVal+"'>"+parseInt(v.dVal)+"</div>";
            str3+="</center>";
            str3+="<div id='mtlClr'>";
            str3+="</div>";
            str3+="<div class='text4nmbrDv fLeft' onclick=\"getId('"+parseInt(v.dVal)+","+v1.dVal+"')\" id='"+parseInt(v.dVal)+","+v1.dVal+"'>"+v1.dVal+"</div>";
            str3+="</div>";
            //console.log($("#mtlNum_"+parseInt(v.dVal)+"_"+v1.dVal+""));

    });
});
                               
// SELECR METAL ENDS

// SELECT SIZE START
$(mSize).each(function (i, v){
   $(v).each(function (i1, v1){
       $(v1.sizeMaster['results']).each(function (i2, v2){
           str5+="<div class='slctWrp fLeft'>";
           str5+="<div class='sSizeCnt fLeft' onclick=\"getSize('"+v2.sizVal+"')\" id='"+v2.sizVal+"'>"+v2.sizVal+"</div>";
           str5+="</div>";
       });
   });
});

// SELECT SIZE ENDS


// SELECT STONE START
$(stone).each(function (i, v){
        str6+="<div class='interNalCatDv fLeft'>";
        str6+="<center>";
        str6+="<div class='sStoneIcn1' onclick=\"getStone('"+v.gemNm+"')\" id='"+v.gemNm+"'></div>";
        str6+="</center>";
//        str6+="<div class='text4nmbrDv fLeft pTop0 colorP' id='prodStn' style='font-size: 15px;'>"+v.gemNm+"</div>";
        str6+="<div class='text4nmbrDv fLeft pTop0 colorP' onclick=\"getStone('"+v.gemNm+"')\" id='"+v.gemNm+"' >"+v.gemNm+"</div>";
        str6+="</div>";
        
});
// SELECT STONE ENDS

               $("#prdctCard").append(str);   // basic product details
               $("#desCnt1").append(str1);    // product details
               $("#desCnt3").append(str2);    // diamond details
               $("#crspndngC").append(str3);  // select metal
              
               $("#desCnt2").append(str4);    // metal details
               $("#crspndngC2").append(str5); // select size
               $("#crspndngC1").append(str6); // select stone
               
    }
   
    
}



   
    