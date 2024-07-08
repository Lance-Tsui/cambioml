document.getElementById('fileToUpload').addEventListener('change', function() {
    console.log("File input changed!"); // Check if this logs in the console
    var fileInput = this;
    var fileNameDisplay = document.getElementById('fileName');
    if (fileInput.files.length > 0) {
        var fileName = fileInput.files[0].name;
        fileNameDisplay.textContent = fileName; // Display the file name
    } else {
        fileNameDisplay.textContent = ''; // Clear the display if no file is selected
    }
});
