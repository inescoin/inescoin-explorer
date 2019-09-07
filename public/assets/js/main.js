// Copyright 2019 The Inescoin developers.
// - Mounir R'Quiba
// Licensed under the GNU Affero General Public License, version 3.

var truncate = function (fullStr, strLen, separator) {
    if (fullStr.length <= strLen) return fullStr;

    separator = separator || '...';

    var sepLen = separator.length;
    var charsToShow = strLen - sepLen;
    var frontChars = Math.ceil(charsToShow / 2);
    var backChars = Math.floor(charsToShow / 2);

    return fullStr.substr(0, frontChars) + separator + fullStr.substr(fullStr.length - backChars);
};


function truncateAll() {
	var elementsToTruncate = document.querySelectorAll(".truncate");
	for (var i = 0; i < elementsToTruncate.length; i++) {
		elementsToTruncate[i].innerHTML = truncate(elementsToTruncate[i].innerHTML, 12);
		elementsToTruncate[i].style.visibility = 'visible';
	}
}

truncateAll();
