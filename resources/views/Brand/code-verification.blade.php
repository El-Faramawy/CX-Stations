<!DOCTYPE html>
<html lang="en">
<!-- [Head] start -->
<head>
    @include('layouts.brand.css')
</head>
<!-- [Head] end -->
<!-- [Body] Start -->
<body data-pc-direction="ltr" data-pc-theme="dark">
  <div class="auth-main">
    <!-- <div class="bg-overlay bg-dark"></div> -->
    <div class="auth-wrapper">
      <div class="auth-form">
        <div class="card">
          <div class="card-body row justify-content-center">
            <div class="logo">
              <button class="back" type="button" onclick="window.history.back()">
                <i class="fal fa-arrow-left"></i>
                Back
              </button>
              <img src="{{get_file(setting()->logo)}}" alt="img" class="img-fluid">
            </div>
            <h3 class="text-center mb-2 text-white text-uppercase"> Confirm Your Email </h3>
            <p class="text-center mb-2"> Enter The 6-digital code we just send to {{$email}}</p>
            <form action="{{route('brand.confirm_code')}}" method="post" id="my_form" class="col-md-7 p-0">
                @csrf
                <input type="hidden" name="email" value="{{$email}}">
              <div class="p-2">
                <div class="otp">
                  <input class="otp-input" type="text" maxlength="1">
                  <input class="otp-input" type="text" maxlength="1">
                  <input class="otp-input" type="text" maxlength="1">
                  <input class="otp-input" type="text" maxlength="1">
                  <input class="otp-input" type="text" maxlength="1">
                  <input class="otp-input" type="text" maxlength="1">
                  <!-- Store OTP Value -->
                  <input class="otp-value" type="hidden" name="otp_code">
                </div>
              </div>
              <div class="d-grid p-2 my-2">
                <button type="submit" class="btn btnMain"> Verify Now </button>
              </div>
                <p id="countdown-message">Wait <span id="timer" class="text-primary"> 2:00 </span> seconds before requesting a new code.</p>
                <a href="javascript:void(0);" id="send-code-text" style="display: none;" class="text-primary">Send Code Again</a>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- [ Main Content ] end -->
  @include('layouts.brand.js')
  @include('layouts.admin.inc.my-form')

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      document.querySelector(".otp :not([type='hidden'])").focus();
      // Selecting DOM elements
      const otpFields = document.querySelectorAll(".otp .otp-input");
      const otpValueField = document.querySelector(".otp .otp-value");
      function updateOTPValue() {
        let otpValue = "";
        otpFields.forEach(function (field) {
          const fieldValue = field.value;
          if (fieldValue !== "") {
            otpValue += fieldValue;
          }
        });
        otpValueField.value = otpValue;
      }
      otpFields.forEach(function (field, index) {
        field.addEventListener("input", function () {
          this.value = this.value.replace(/[^0-9]/g, "");
          updateOTPValue();
        });
        field.addEventListener("keyup", function (e) {
          const key = e.keyCode || e.charCode;
          if (key === 8 || key === 46 || key === 37 || key === 40) {
            if (index > 0) {
              otpFields[index - 1].focus();
            }
          } else if (key === 38 || key === 39 || this.value !== "") {
            if (index < otpFields.length - 1) {
              otpFields[index + 1].focus();
            }
          }
        });
        field.addEventListener("paste", function (e) {
          const pasteData = (e.clipboardData || window.clipboardData).getData("text");
          const pasteDataSplitted = pasteData.split("");
          pasteDataSplitted.forEach(function (value, index) {
            if (index < otpFields.length) {
              otpFields[index].value = value;
            }
          });
          updateOTPValue();
        });
      });
    });
  </script>

  <script>
      document.addEventListener('DOMContentLoaded', function () {
          // Part 1: OTP Input Fields Functionality
          document.querySelector(".otp :not([type='hidden'])").focus();

          const otpFields = document.querySelectorAll(".otp .otp-input");
          const otpValueField = document.querySelector(".otp .otp-value");

          function updateOTPValue() {
              let otpValue = "";
              otpFields.forEach(function (field) {
                  const fieldValue = field.value;
                  if (fieldValue !== "") {
                      otpValue += fieldValue;
                  }
              });
              otpValueField.value = otpValue;
          }

          otpFields.forEach(function (field, index) {
              field.addEventListener("input", function () {
                  this.value = this.value.replace(/[^0-9]/g, "");
                  updateOTPValue();
              });
              field.addEventListener("keyup", function (e) {
                  const key = e.keyCode || e.charCode;
                  if (key === 8 || key === 46 || key === 37 || key === 40) {
                      if (index > 0) {
                          otpFields[index - 1].focus();
                      }
                  } else if (key === 38 || key === 39 || this.value !== "") {
                      if (index < otpFields.length - 1) {
                          otpFields[index + 1].focus();
                      }
                  }
              });
              field.addEventListener("paste", function (e) {
                  const pasteData = (e.clipboardData || window.clipboardData).getData("text");
                  const pasteDataSplitted = pasteData.split("");
                  pasteDataSplitted.forEach(function (value, index) {
                      if (index < otpFields.length) {
                          otpFields[index].value = value;
                      }
                  });
                  updateOTPValue();
              });
          });

          // Part 2: Timer Functionality
          let timerDisplay = document.getElementById('timer');
          let sendCodeText = document.getElementById('send-code-text');
          let countdownMessage = document.getElementById('countdown-message');
          let timerDuration = 120; // 2 minutes in seconds
          let countdownInterval;

          // Check if a countdown is already stored in localStorage
          let endTime = localStorage.getItem('countdownEndTime') ? localStorage.getItem('countdownEndTime') : Date.now() + timerDuration * 1000;
          localStorage.setItem('countdownEndTime', endTime);

          function updateTimer() {
              let timeLeft = Math.floor((endTime - Date.now()) / 1000);

              if (timeLeft >= 0) {
                  let minutes = Math.floor(timeLeft / 60);
                  let seconds = timeLeft % 60;
                  timerDisplay.textContent = minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
              } else {
                  clearInterval(countdownInterval);
                  countdownMessage.style.display = 'none'; // Hide countdown
                  sendCodeText.style.display = 'inline'; // Show "Send Code Again" text
                  localStorage.removeItem('countdownEndTime'); // Clear localStorage
              }
          }

          countdownInterval = setInterval(updateTimer, 1000);

          sendCodeText.addEventListener('click', function () {
              sendNewCode();

              // Restart the countdown from 2 minutes
              endTime = Date.now() + timerDuration * 1000; // Set new end time
              localStorage.setItem('countdownEndTime', endTime); // Store the new countdown in localStorage

              // Reset the visibility and timer
              sendCodeText.style.display = 'none'; // Hide "Send Code Again" text
              countdownMessage.style.display = 'block'; // Show countdown message
              timerDisplay.textContent = "2:00"; // Reset timer display

              clearInterval(countdownInterval); // Clear previous interval
              countdownInterval = setInterval(updateTimer, 1000); // Start the interval again
          });

          function sendNewCode() {
              $.ajax({
                  url: '{{route("brand.get_code")}}',
                  type: 'GET',
                  data: {
                      email: "{{$email}}"
                          {{--                      _token: '{{ csrf_token() }}'  // Laravel CSRF token--}}
                  },
                  success: function(response) {
                      console.log('Code sent successfully!');
                      // Optionally, show a success message or update the UI
                  },
                  error: function(error) {
                      console.log('Error sending code:', error);
                  }
              });
          }
      });
  </script>
</body>
<!-- [Body] end -->
</html>
