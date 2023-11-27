let shouldPauseVideo = true;
let showPauseBanner = true;

function onScanSuccess(decodedText, decodedResult) {
  // handle the scanned code as you like, for example:
  console.log(`Code matched = ${decodedText}`, decodedResult);
  email = document.getElementById("scannedName");
  email.innerHTML = `Name: ${decodedText}`, decodedResult;

  html5QrcodeScanner.pause(shouldPauseVideo, showPauseBanner);

  $.ajax({

    url : 'a.php',
    type : 'POST',
    data: {
      email: decodedText // Replace 'your_account_id_here' with the actual account ID
    },
    success : function (result) {
       console.log (result); // Here, you need to use response by PHP file.
    },
    error : function () {
       console.log ('error');
    }

  });

  setTimeout(resume, 3000);
}

function resume(){
  html5QrcodeScanner.resume();
}

function onScanFailure(error) {
  // handle scan failure, usually better to ignore and keep scanning.
  // for example:
  //console.warn(`Code scan error = ${error}`);
}

let html5QrcodeScanner = new Html5QrcodeScanner(
  "reader",
  { fps: 10, qrbox: {width: 400, height: 400} },
  /* verbose= */ false);
html5QrcodeScanner.render(onScanSuccess, onScanFailure);