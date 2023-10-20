document.getElementById("featuredImage").addEventListener("change", function() {
    var file = this.files[0];
    var reader = new FileReader();

    reader.onloadend = function() {
        document.getElementById("previewImage").src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        document.getElementById("previewImage").src = "";
    }
});
