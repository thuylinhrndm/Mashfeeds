
	var XMLHttpRequestObject = false;
	var obj;

	if (window.XMLHttpRequest) {
		XMLHttpRequestObject = new XMLHttpRequest();
	} else if (window.ActiveXObject) {
		XMLHttpRequestObject = new ActiveXObject("Microsoft.XMLHTTP");
	}	
	function get_data(target) {
		var tweet = document.getElementById('twitter').value;

		if (XMLHttpRequestObject) {
			dataSource = "twitter5.rb?twitter=" + tweet;
			obj = document.getElementById(target);
			XMLHttpRequestObject.open("GET", dataSource);
			XMLHttpRequestObject.onreadystatechange = handler;
			XMLHttpRequestObject.send(null);
		}
	}

	function handler() {
		if (XMLHttpRequestObject.readyState == 4 ||
			XMLHttpRequestObject.status == 200) {
				document.getElementById('twitter').value='';
				obj.innerHTML = XMLHttpRequestObject.responseText;        
		}
	}	

	function limitText(limitField, limitCount, limitNum) {
		if (limitField.value.length > limitNum) {
			limitField.value = limitField.value.substring(0, limitNum);
		} else {
			limitCount.value = limitNum - limitField.value.length;
		}
	}

	function remove_file(target1)  {
	    document.getElementById("responseMsg").value = "";

	}
	