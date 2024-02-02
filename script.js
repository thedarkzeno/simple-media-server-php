function uploadFile() {
    var file = document.getElementById("fileToUpload").files[0];
    var formData = new FormData();
    formData.append("fileToUpload", file);
    formData.append("submit", true); // Simulate the submit POST variable

    var xhr = new XMLHttpRequest();
    xhr.open("POST", "upload.php", true);

    xhr.upload.onprogress = function(e) {
        if (e.lengthComputable) {
            var percentComplete = (e.loaded / e.total) * 100;
            document.getElementById("progressBar").style.width = percentComplete + '%';
        }
    };

    xhr.onload = function() {
        if (xhr.status == 200) {
            document.getElementById("status").innerHTML = "Upload complete!";
            window.location.href = "index.php"; // Redirect on successful upload
        } else {
            document.getElementById("status").innerHTML = "Error during file upload.";
        }
    };

    xhr.send(formData);
}