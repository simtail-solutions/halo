//require('../../resources/js/bootstrap');
// does this need to go into the blade file?

// enable tooltips
// $(function () {
//     $('[data-toggle="tooltip"]').tooltip()
//   })

  var tooltipTriggerList = [].slice.call(
    document.querySelectorAll('[data-toggle="tooltip"]')
  );
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });

  // Start button
document.getElementById('start-button').onclick = function () {
  $('#intro').addClass('d-none');
  $('#form-content').removeClass('d-none');
  $('.form-navigation').removeClass('d-none');

}

 // show partner income if applicable
 $("#status").change(function() {
  if ($(this).find("option:selected").attr("id") == "married" || $(this).find("option:selected").attr("id") == "defacto") {
      $(".partner-income").removeClass("d-none");
  } else  {
          $(".partner-income").addClass("d-none");
  } 
});

// 0 months selected when 5+ years selected
$("#resTimeY").change(function() {
  if ($(this).find("option:selected").attr("id") == "resTimeY5") {
      $("#resTimeM0").attr('selected', true);
  } 
});

// show "Applicant Homeowner field when mortgage etc not chosen
$("#residentialType").change(function() {
if ($(this).find("option:selected").attr("id") == "mort" || $(this).find("option:selected").attr("id") == "outright") {
  $("#homeowner").addClass("d-none");
} else  {
      $("#homeowner").removeClass("d-none");
} 
});

   // show previous address field if at current address less than 2 years
   $("#resTimeY").change(function() {
    if ($(this).find("option:selected").attr("id") == "oneYear") {
        $("#previous-address").removeClass("d-none");
    } else if ($(this).find("option:selected").attr("id") !== "oneYear") {
        $("#previous-address").addClass("d-none");
    } 
});

// hide DL field if no DL
  $('#currentDL').click(function(){
    if($(this).prop("checked") == true){
    //alert("you checked checkbox.");
    $("#DLnumber").addClass("d-none");
  }else if($(this).prop("checked") == false){
    //alert("you unchecked checkbox.");
    $("#DLnumber").removeClass("d-none");
    }
});

// shows modal box if employment criteria not met
$("#employment").change(function() {
    if ($(this).find("option:selected").attr("id") == "centrelink" || $(this).find("option:selected").attr("id") == "unemployed" || $(this).find("option:selected").attr("id") == "pension") {
      $('#next').on('click', function() {
          $('#sorry').show()
          $('.cat-submitted').remove();
          });
        } 
    });

    // modal
$('#sorry').on('shown.bs.modal', function () {
  $('#next').trigger('focus')
})

// cannot proceed unless T&Cs ticked
$('#acceptance').click(function(){
    if($(this).prop("checked") == true){
    $("#next").attr('disabled', false);
    // alert("you checked checkbox.");
  }else if($(this).prop("checked") == false){
    $("#next").attr('disabled', true);
    // alert("you unchecked checkbox.");
    }
});

// selects 0 months when 5+ years
$("#empTimeY").change(function() {
  if ($(this).find("option:selected").attr("id") == "empTimeY5") {
      $("#empTimeM0").attr('selected', true);
  } 
});

// shows additional employment fields when 
$("#empTimeY").change(function() {
  if ($(this).find("option:selected").attr("id") == "oneYearEmp") {
      $("#previous-employment").removeClass("d-none");
  } else if ($(this).find("option:selected").attr("id") !== "oneYear") {
      $("#previous-employment").addClass("d-none");
  } 
});

// hide mortgage
$("#residentialType").change(function() {
  if ($(this).find("option:selected").attr("id") == "outright") {
      $("#rentPayable").addClass("invisible");
  } else  {
          $("#rentPayable").removeClass("invisible");
  } 
});

// Set months to 0 when 5+ years is selected
$("#empTimePrevY").change(function() {
      if ($(this).find("option:selected").attr("id") == "empTimePrevY5") {
          $("#empTimePrevM0").attr('selected', true);
      } 
  });

  //format phone number start
  const isNumericInput = (event) => {
    const key = event.keyCode;
    return ((key >= 48 && key <= 57) || // Allow number line
        (key >= 96 && key <= 105) // Allow number pad
    );
};

const isModifierKey = (event) => {
    const key = event.keyCode;
    return (event.shiftKey === true || key === 35 || key === 36 || key === 52 ) || // Allow Shift, Home, End, $ symbol
        (key === 8 || key === 9 || key === 13 || key === 46) || // Allow Backspace, Tab, Enter, Delete
        (key > 36 && key < 41) || // Allow left, up, right, down
        (
            // Allow Ctrl/Command + A,C,V,X,Z
            (event.ctrlKey === true || event.metaKey === true) &&
            (key === 65 || key === 67 || key === 86 || key === 88 || key === 90)
        )
};

const enforceFormat = (event) => {
    // Input must be of a valid number format or a modifier key, and not longer than ten digits
    if(!isNumericInput(event) && !isModifierKey(event)){
        event.preventDefault();
    }
};

const formatToPhone = (event) => {
    if(isModifierKey(event)) {return;}

    const input = event.target.value.replace(/\D/g,'').substring(0,10); // First ten digits of input only
    const areaCode = input.substring(0,4);
    const middle = input.substring(4,7);
    const last = input.substring(7,10);

    if(input.length > 6){event.target.value = `${areaCode} ${middle} ${last}`;}
    else if(input.length > 3){event.target.value = `${areaCode} ${middle}`;}
    else if(input.length > 0){event.target.value = `${areaCode}`;}
};

const inputElement = document.getElementById('phone');
inputElement.addEventListener('keydown',enforceFormat);
inputElement.addEventListener('keyup',formatToPhone);

const inputElement2 = document.getElementById('employercontactnumber');
inputElement2.addEventListener('keydown',enforceFormat);
inputElement2.addEventListener('keyup',formatToPhone);
// format phone end

// format medicare number
const formatToMedicare = (event) => {
  if(isModifierKey(event)) {return;}

  const input = event.target.value.replace(/\D/g,'').substring(0,10); // First ten digits of input only
  const first = input.substring(0,4);
  const middle = input.substring(4,9);
  const last = input.substring(9,10);

  if(input.length > 6){event.target.value = `${first} ${middle} ${last}`;}
  else if(input.length > 3){event.target.value = `${first} ${middle}`;}
  else if(input.length > 0){event.target.value = `${first}`;}
};

const inputElement3 = document.getElementById('MCnumber');
inputElement3.addEventListener('keydown',enforceFormat);
inputElement3.addEventListener('keyup',formatToMedicare);


// format currency start
$("input[data-type='currency']").on({
  keyup: function() {
    formatCurrency($(this));
  },
  blur: function() { 
    formatCurrency($(this), "blur");
  }
});


function formatNumber(n) {
// format number 1000000 to 1,234,567
return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}


function formatCurrency(input, blur) {
// appends $ to value, validates decimal side
// and puts cursor back in right position.

// get input value
var input_val = input.val();

// don't validate empty input
if (input_val === "") { return; }

// original length
var original_len = input_val.length;

// initial caret position 
var caret_pos = input.prop("selectionStart");

// check for decimal
if (input_val.indexOf(".") >= 0) {

// get position of first decimal
// this prevents multiple decimals from
// being entered
var decimal_pos = input_val.indexOf(".");

// split number by decimal point
var left_side = input_val.substring(0, decimal_pos);
var right_side = input_val.substring(decimal_pos);

// add commas to left side of number
left_side = formatNumber(left_side);

// validate right side
right_side = formatNumber(right_side);

// On blur make sure 2 numbers after decimal
if (blur === "blur") {
right_side += "00";
}

// Limit decimal to only 2 digits
right_side = right_side.substring(0, 2);

// join number by .
input_val = "$" + left_side + "." + right_side;

} else {
// no decimal entered
// add commas to number
// remove all non-digits
input_val = formatNumber(input_val);
input_val = "$" + input_val;

// final formatting
if (blur === "blur") {
input_val += ".00";
}
}

// send updated string to input
input.val(input_val);

// put caret back in the right position
var updated_len = input_val.length;
caret_pos = updated_len - original_len + caret_pos;
input[0].setSelectionRange(caret_pos, caret_pos);
}
// format currency end

