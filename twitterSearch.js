var XMLHttpRequestObject = false;
var obj;

if (window.XMLHttpRequest) {
	XMLHttpRequestObject = new XMLHttpRequest();
} else if (window.ActiveXObject) {
	XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
	document.write('ActiveXObject</br>');
}

function getTweets(target) {
	var search_terms = document.getElementById('shortUrl').value;
			
	if (XMLHttpRequestObject) {
		dataSource = "twitterSearch.php?keyword=" + search_terms;
		obj = document.getElementById(target);
		XMLHttpRequestObject.open("GET", dataSource);
		XMLHttpRequestObject.onreadystatechange = handler_twitter;
		XMLHttpRequestObject.send(null);
	}
}

	function handler_twitter() {
	if (XMLHttpRequestObject.readyState == 4 ||
		XMLHttpRequestObject.status == 200) {
			obj.innerHTML = XMLHttpRequestObject.responseText;        
	}
}