document.getElementById("company-logo").addEventListener("change", function() {
    var file = this.files[0];
    var reader = new FileReader();

    reader.onloadend = function() {
        document.getElementById("previewLogo").src = reader.result;
    };

    if (file) {
        reader.readAsDataURL(file);
    } else {
        document.getElementById("previewLogo").src = "";
    }
});
