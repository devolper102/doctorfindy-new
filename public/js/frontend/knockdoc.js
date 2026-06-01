/* Show modal in doctor listing page */
/*$(".appointment_modal").on('click',function(){
	$("#modal_patient_num").hide();
	$(".modal-backdrop").hide();
});
$(".number_modal").on('click',function(){
	$("#mobile_number_detail").hide();
	$(".modal-backdrop").hide();
});
$(".last_modal").on('click',function(){
	$("#appointment_modal_detail").hide();
	$(".modal-backdrop").hide();
});*/
/* Show modal in doctor listing page */


/*Show modal for mobile search*/

$("#search_doctor_on_device").on('shown.bs.modal',function(){
	$('#location_input').trigger('focus');
});
$(".small_device_location_search").on('click',function(){
	$(".given_location").show();
	$(".given_diseases").hide();
});
$(".small_device_doctor_search").on('click',function(){
	$(".given_diseases").show();
	$(".given_location").hide();
});

/* End Show modal for mobile search*/	

/*Show map on doctor listing page*/

/*$(".map_toggle").on('click',function(){
	$(".google_map ").toggleClass("toggle_map");
	$(".map_btn").toggleClass("hide_map_btn");
});*/

/*End Show map on doctor listing page*/


/*var TxtRotate = function(el, toRotate, period) {
  this.toRotate = toRotate;
  this.el = el;
  this.loopNum = 0;
  this.period = parseInt(period, 10) || 1000;
  this.txt = '';
  this.tick();
  this.isDeleting = false;
};

TxtRotate.prototype.tick = function() {
  var i = this.loopNum % this.toRotate.length;
  var fullTxt = this.toRotate[i];

  if (this.isDeleting) {
    this.txt = fullTxt.substring(0, this.txt.length - 1);
  } else {
    this.txt = fullTxt.substring(0, this.txt.length + 1);
  }

  this.el.innerHTML = '<span class="wrap">'+this.txt+'</span>';

  var that = this;
  var delta = 150 - Math.random() * 100;

  if (this.isDeleting) { delta /= 2; }

  if (!this.isDeleting && this.txt === fullTxt) {
    delta = this.period;
    this.isDeleting = true;
  } else if (this.isDeleting && this.txt === '') {
    this.isDeleting = false;
    this.loopNum++;
    delta = 500;
  }

  setTimeout(function() {
    that.tick();
  }, delta);
};

window.onload = function() {
  var elements = document.getElementsByClassName('txt-rotate');
  for (var i=0; i<elements.length; i++) {
    var toRotate = elements[i].getAttribute('data-rotate');
    var period = elements[i].getAttribute('data-period');
    if (toRotate) {
      new TxtRotate(elements[i], JSON.parse(toRotate), period);
    }
  }
  // INJECT CSS
  var css = document.createElement("style");
  css.type = "text/css";
  css.innerHTML = ".txt-rotate > .wrap { padding-right:10px; border-right: 0.05em solid #fff }";
  document.body.appendChild(css);
};*/