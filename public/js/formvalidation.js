
// Example starter JavaScript for disabling form submissions if there are invalid fields
(function () {
  'use strict'

  // Fetch all the forms we want to apply custom Bootstrap validation styles to
  var forms = document.querySelectorAll('.needs-validation');

  // Loop over them and prevent submission
  Array.prototype.slice.call(forms)
    .forEach(function (form) {
      form.addEventListener('submit', function (event) {
        if (!form.checkValidity()) {
          event.preventDefault()
          event.stopPropagation()
        }

        form.classList.add('was-validated')
      }, false)
    })
   
})()
function chooseFile(fileInput,id){
  if(fileInput.files && fileInput.files[0]){
    var reader = new FileReader();
    reader.onload=function(e){
      $(id).attr('src',e.target.result);
    }
    reader.readAsDataURL(fileInput.files[0]);
  }
  
}


