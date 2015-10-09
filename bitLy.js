var XMLHttpRequestObject = false;
var obj_bitly;

if (window.XMLHttpRequest) {
	XMLHttpRequestObject = new XMLHttpRequest();
} else if (window.ActiveXObject) {
	XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
	document.write('ActiveXObject</br>');
}

function getdata(target) {
	var link = document.getElementById('shortUrl').value;
			
	if (XMLHttpRequestObject) {
		dataSource = "linkProcessor.py?long_url=" + link;
		obj_bitly = document.getElementById(target);
		XMLHttpRequestObject.open("GET", dataSource);
		XMLHttpRequestObject.onreadystatechange = handler_shortener;
		XMLHttpRequestObject.send(null);
	}
}

	function handler_shortener() {
	if (XMLHttpRequestObject.readyState == 4 ||
		XMLHttpRequestObject.status == 200) {
			obj_bitly.value = XMLHttpRequestObject.responseText;        
	}
}