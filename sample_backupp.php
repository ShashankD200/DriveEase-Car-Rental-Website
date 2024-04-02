<button class="btn btn-outline-primary" data-dealer="<?=$dealer_id ?>"
                                                data-id="<?=$car_id ?>" id="set_booking" onclick="setBookingData()">
                                                Starts from ₹
                                                <?= $row['rent_per_day'] ?><span class="text-danger fw-bold"> per day</span>
                                            </button>


                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="Booked from :<?=$booking_data['booking_from']?>  Booking Till :<?=$booking_data['booking_till']?>">
                                            <button class="btn btn-success" disabled id="set_booking" >
                                                Booking Confirmed 
                                            </button>
</span>


                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="popover" data-bs-trigger="hover focus" data-bs-placement="bottom" data-bs-content="Booked on <?=$booking_data['booking_date']?> ">
                                                <button class="btn btn-warning" disabled id="set_booking">
                                                Booking In Process 
                                            </button>
                                            </span>