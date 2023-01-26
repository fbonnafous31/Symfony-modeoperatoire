function myFunction() { // Get the text field
    var copyText = document.getElementById("TextToCopy");
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    navigator.clipboard.writeText(copyText.value);
}