



<div class="row">
    <div class="col-md-12">
    <div class="card card-default">
    <div class="card-header">
    <h3 class="card-title">bs-stepper</h3>
    </div>
    <div class="card-body p-0">
    <div class="bs-stepper ">
    <div class="bs-stepper-header" role="tablist">

    <div class="step active" data-target="#logins-part">
        <button type="button" class="step-trigger" role="tab" aria-controls="logins-part" id="logins-part-trigger" aria-selected="true">
        <span class="bs-stepper-circle">1</span>
        <span class="bs-stepper-label">Logins</span>
        </button>
    </div>



    <div class="step" data-target="#information-part">
        <button type="button" class="step-trigger" role="tab" aria-controls="information-part" id="information-part-trigger" aria-selected="false" disabled="disabled">
        <span class="bs-stepper-circle">2</span>
        <span class="bs-stepper-label">Various information</span>
        </button>
    </div>

    <div class="step" data-target="#test3">
        <button type="button" class="step-trigger" role="tab" aria-controls="test3" id="test3-trigger" aria-selected="false" disabled="disabled">
        <span class="bs-stepper-circle">3</span>
        <span class="bs-stepper-label">Various information</span>
        </button>
    </div>



    </div>



    <div class="bs-stepper-content">

    <div id="logins-part" class="content active dstepper-block" role="tabpanel" aria-labelledby="logins-part-trigger">
        <div class="form-group">
        <label for="exampleInputEmail1">Email address</label>
        <input type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
        </div>
        <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
        </div>
        <button class="btn btn-primary" onclick="stepper.next()">Next</button>
    </div>

    <div id="information-part" class="content" role="tabpanel" aria-labelledby="information-part-trigger">
        <div class="form-group">
        <label for="exampleInputFile">File input</label>
        <div class="input-group">
        <div class="custom-file">
        <input type="file" class="custom-file-input" id="exampleInputFile">
        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
        </div>
        <div class="input-group-append">
        <span class="input-group-text">Upload</span>
        </div>
        </div>
        </div>
        <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
        <button class="btn btn-primary" onclick="stepper.next()">Next</button>

    </div>

    <div id="test3" class="content" role="tabpanel" aria-labelledby="test3-trigger">
        <div class="form-group">
        <label for="exampleInputFile">Christian</label>
        <div class="input-group">
        <div class="custom-file">
        <input type="file" class="custom-file-input" id="exampleInputFile">
        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
        </div>
        <div class="input-group-append">
        <span class="input-group-text">Upload</span>
        </div>
        </div>
        </div>
        <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
        <button type="submit" class="btn btn-primary">Submit</button>

    </div>

    <div id="test4" class="content" role="tabpanel" aria-labelledby="test4-trigger">
        <div class="form-group">
        <label for="exampleInputFile">Christian</label>
        <div class="input-group">
        <div class="custom-file">
        <input type="file" class="custom-file-input" id="exampleInputFile">
        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
        </div>
        <div class="input-group-append">
        <span class="input-group-text">Upload</span>
        </div>
        </div>
        </div>
        <button class="btn btn-primary" onclick="stepper.previous()">Previous</button>
        <button type="submit" class="btn btn-primary">Submit</button>

    </div>



    </div>
    </div>
    </div>


    </div>

    </div>
    </div>



















    <script>

      // BS-Stepper Init
      document.addEventListener('DOMContentLoaded', function () {
        window.stepper = new Stepper(document.querySelector('.bs-stepper'))
      })

      // DropzoneJS Demo Code Start
      Dropzone.autoDiscover = false

      // Get the template HTML and remove it from the doumenthe template HTML and remove it from the doument
      var previewNode = document.querySelector("#template")
      previewNode.id = ""
      var previewTemplate = previewNode.parentNode.innerHTML
      previewNode.parentNode.removeChild(previewNode)

      var myDropzone = new Dropzone(document.body, { // Make the whole body a dropzone
        url: "/target-url", // Set the url
        thumbnailWidth: 50,
        thumbnailHeight: 50,
        parallelUploads: 20,
        previewTemplate: previewTemplate,
        autoQueue: false, // Make sure the files aren't queued until manually added
        previewsContainer: "#previews", // Define the container to display the previews
        clickable: ".fileinput-button" // Define the element that should be used as click trigger to select files.
      })

      myDropzone.on("addedfile", function(file) {
        // Hookup the start button
        file.previewElement.querySelector(".start").onclick = function() { myDropzone.enqueueFile(file) }
      })

      // Update the total progress bar
      myDropzone.on("totaluploadprogress", function(progress) {
        document.querySelector("#total-progress .progress-bar").style.width = progress + "%"
      })

      myDropzone.on("sending", function(file) {
        // Show the total progress bar when upload starts
        document.querySelector("#total-progress").style.opacity = "1"
        // And disable the start button
        file.previewElement.querySelector(".start").setAttribute("disabled", "disabled")
      })

      // Hide the total progress bar when nothing's uploading anymore
      myDropzone.on("queuecomplete", function(progress) {
        document.querySelector("#total-progress").style.opacity = "0"
      })

      // Setup the buttons for all transfers
      // The "add files" button doesn't need to be setup because the config
      // `clickable` has already been specified.
      document.querySelector("#actions .start").onclick = function() {
        myDropzone.enqueueFiles(myDropzone.getFilesWithStatus(Dropzone.ADDED))
      }
      document.querySelector("#actions .cancel").onclick = function() {
        myDropzone.removeAllFiles(true)
      }
      // DropzoneJS Demo Code End
    </script>




