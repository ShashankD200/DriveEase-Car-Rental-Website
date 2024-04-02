

$("#filter_cars").click(function(){
  $("#car_detail_div").hide();

var searchdata = $("#search_form").serialize();
console.log(searchdata);


$.ajax({
type: "POST",
url:"filter_cars.php",
data:searchdata,
dataType:'json',
success: function(response) {

console.log(response);

if (Array.isArray(response)) {
  $("#car_data").empty();
if (response.length === 0) {

  $("#car_data").html('<p>No cars available.</p>');
} else {

  response.forEach(function(car) {

    appendCarToCard(car);
    console.log('car',car);
  });
}
} else {
console.error("Invalid response format. Expected an array.");
}
},

error:function(error){
  console.log(error);
}
});

});

function appendCarToCard(car) {

var card = document.createElement("div");
card.className = "col-md-4";
card.innerHTML = `
  <div class="card hei d-flex flex-column">
    <div class="card-header"  style="font-weight:bold;font-size:20px;background: #213555;color:white;">${car.vehicle_model}</div>
    <div class="card-body " style="background:#F0F0F0">
      <img src="car_details/${car.car_image_url}" alt="" width="250px" height="300px" style="object-fit: contain;">
      <div>

        <p class="des">Vehicle Number: ${car.vehicle_number}</p>

      </div>
      <div class="card-footer price_card">Starts from  ₹ ${car.rent_per_day}.00</div>
      <button class="btn  w-100 book_now" data-bs-toggle="modal" data-bs-target="#bookingModal" onclick="setBookingData(${car.id}, ${car.dealer_id})">Book Now</button>
    </div>
  </div>
`;


document.querySelector("#car_data").appendChild(card);
}

function setBookingData() {
    const id = $("#set_booking").data('id');
    const dealer_id = $("#set_booking").data('dealer');
                console.log(dealer_id,id,user_id);
    
    $('#bookingForm #car_id ').val(id);
    $('#bookingForm #dealer_id').val(dealer_id);
    $('#user_id').val(user_id);
    $('#bookingModal').modal('show');
    }
    
function submitBooking() {

if(user_id){



$("#confirm_book").prop("disabled", true).addClass('btn-warning').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Processing...');

const formdata = $("#bookingForm").serialize();
console.log(formdata);

$.ajax({
type: "POST",
url: "process_booking.php",
data: formdata,
success: function (response) {
setTimeout(() => {
$("#confirm_book").prop("disabled", true).removeClass('btn-warning').addClass('btn-success').html('<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Confirmed ');

 $('#bookingModal').modal('hide');

 console.log(response);
 Toastify({
                               text: response,
                               duration: 5000,
                               gravity: "top",
                               position: "center",
                               backgroundColor: "#4caf50",
                           }).showToast();


}, 3000);
},
error: function (error) {
 console.error(error);
 alert("Error occurred while booking. Please try again.");
},
complete: function(){
 setTimeout(()=>{
   $("#confirm_book").prop("disabled", false).removeClass('btn-success').addClass('btn-warning').html('Confirm Booking');

 }, 3000);

}
});



}else{

Toastify({
                                 text: "Please Login first !",
                                 duration: 5000,
                                 gravity: "top",
                                 position: "center",
                                 backgroundColor: "#4caf50",
                             }).showToast();

}




}