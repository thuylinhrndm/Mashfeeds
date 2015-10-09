var XMLHttpRequestObject = false;
var obj;

if (window.XMLHttpRequest) {
    XMLHttpRequestObject = new XMLHttpRequest();
} else if (window.ActiveXObject) {
    XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
}

function getData(divID) {
    if (XMLHttpRequestObject) {
		var note = document.getElementById('everTa').value;
        obj = document.getElementById(divID);
        XMLHttpRequestObject.open("GET", 'taTest.rb?everTa=' + note);
        XMLHttpRequestObject.onreadystatechange = handlerEvernote;
        XMLHttpRequestObject.send(null);
    }
}
function handlerEvernote() {
		if (XMLHttpRequestObject.readyState == 4 ||
			XMLHttpRequestObject.status == 200) {
				document.getElementById('everTa').value='';
				obj.innerHTML = "<br /> Note Saved successfully!";   
		}
	}