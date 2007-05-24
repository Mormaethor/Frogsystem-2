//Einfachen Code einf�gen (B,I,U, etc.) => Keine Abfrage
function insert(eName, aTag, eTag) {
  var input = document.getElementById(eName);
  input.focus();
  /* f�r Internet Explorer */
  if(typeof document.selection != 'undefined') {
    /* Einf�gen des Formatierungscodes */
    var range = document.selection.createRange();
    var insText = range.text;
    range.text = aTag + insText + eTag;
    /* Anpassen der Cursorposition */
    range = document.selection.createRange();
    if (insText.length == 0) {
      range.move('character', -eTag.length);
    } else {
      range.moveStart('character', aTag.length + insText.length + eTag.length);
    }
    range.select();
  }
  /* f�r neuere auf Gecko basierende Browser */
  else if(typeof input.selectionStart != 'undefined')
  {
    /* Einf�gen des Formatierungscodes */
    var start = input.selectionStart;
    var end = input.selectionEnd;
    var insText = input.value.substring(start, end);
    input.value = input.value.substr(0, start) + aTag + insText + eTag + input.value.substr(end);
    /* Anpassen der Cursorposition */
    var pos;
    if (insText.length == 0) {
      pos = start + aTag.length;
    } else {
      pos = start + aTag.length + insText.length + eTag.length;
    }
    input.selectionStart = pos;
    input.selectionEnd = pos;
  }
  /* f�r die �brigen Browser */
  else
  {
    /* Abfrage der Einf�geposition */
    var pos = input.value.length;
    /* Einf�gen des Formatierungscodes */
    var insText = prompt("Bitte gib den zu formatierenden Text ein:");
    input.value = input.value.substr(0, pos) + aTag + insText + eTag + input.value.substr(pos);
  }
}

//Mittel Komplexen Code einf�gen (IMG, CIMG, etc.) => Abfrage bei nicht Markiertem Text
function insert_mcom(eName, aTag, eTag, Frage, Vorgabe) {
  var input = document.getElementById(eName);
  input.focus();
  /* f�r Internet Explorer */
  if(typeof document.selection != 'undefined') {
    /* Einf�gen des Formatierungscodes */
    var range = document.selection.createRange();
    var insText = range.text;
    if (insText.length == 0) {
      /* Ermittlung des einzuf�genden Textes*/
      insText = prompt(Frage, Vorgabe);
      if (insText == null) {
        insText = "";
      }
    }
    range.text = aTag + insText + eTag;
    /* Anpassen der Cursorposition */
    range = document.selection.createRange();
    if (insText.length == 0) {
      range.move('character', -eTag.length);
    } else {
      range.moveStart('character', aTag.length + insText.length + eTag.length);
    }
    range.select();
  }
  /* f�r neuere auf Gecko basierende Browser */
  else if(typeof input.selectionStart != 'undefined')
  {
    /* Einf�gen des Formatierungscodes */
    var start = input.selectionStart;
    var end = input.selectionEnd;
    var insText = input.value.substring(start, end);
    if (insText.length == 0) {
      /* Ermittlung des einzuf�genden Textes*/
      insText = prompt(Frage, Vorgabe);
      if (insText == null) {
        insText = "";
      }
    }
    input.value = input.value.substr(0, start) + aTag + insText + eTag + input.value.substr(end);
    /* Anpassen der Cursorposition */
    var pos;
    if (insText.length == 0) {
      pos = start + aTag.length;
    } else {
      pos = start + aTag.length + insText.length + eTag.length;
    }
    input.selectionStart = pos;
    input.selectionEnd = pos;
  }
  /* f�r die �brigen Browser */
  else
  {
    /* Abfrage der Einf�geposition */
    var pos = input.value.length;
    /* Einf�gen des Formatierungscodes */
    var insText = prompt(Frage, Vorgabe);
    if (insText == null) {
      insText = "";
    }
    input.value = input.value.substr(0, pos) + aTag + insText + eTag + input.value.substr(pos);
  }
}

//Komplexen Code einf�gen (FONT, SIZE, COLOR, etc.) => Abfrage wird immer durchgef�hrt
function insert_com(eName, Tag, Frage, Vorgabe) {
  var input = document.getElementById(eName);
  input.focus();
  /* Ermittlung des einzuf�genden Textes*/
  var attText = prompt(Frage, Vorgabe);
  if (attText == null) {
    attText = "";
  }
  /* f�r Internet Explorer */
  if(typeof document.selection != 'undefined') {
    /* Einf�gen des Formatierungscodes */
    var range = document.selection.createRange();
    var insText = range.text;
    range.text = "["+Tag+"="+attText+"]"+ insText +"["+Tag+"]";
    /* Anpassen der Cursorposition */
    range = document.selection.createRange();
    if (insText.length == 0) {
      range.move('character', -(Tag.length + 2));
    } else {
      range.moveStart('character', Tag.length + 3 + attText.length + insText.length + Tag.length + 2);
    }
    range.select();
  }
  /* f�r neuere auf Gecko basierende Browser */
  else if(typeof input.selectionStart != 'undefined')
  {
    /* Einf�gen des Formatierungscodes */
    var start = input.selectionStart;
    var end = input.selectionEnd;
    var insText = input.value.substring(start, end);
    input.value = input.value.substr(0, start) +"["+Tag+"="+attText+"]"+ insText +"["+Tag+"]"+ input.value.substr(end);
    /* Anpassen der Cursorposition */
    var pos;
    if (insText.length == 0) {
      pos = start + Tag.length + 3 + attText.length;
    } else {
      pos = start + Tag.length + 3 + attText.length + insText.length + Tag.length + 2;
    }
    input.selectionStart = pos;
    input.selectionEnd = pos;
  }
  /* f�r die �brigen Browser */
  else
  {
    /* Abfrage der Einf�geposition */
    var pos = input.value.length;
    /* Einf�gen des Formatierungscodes */
    var insText = prompt("Bitte gib den zu formatierenden Text ein:");
    input.value = input.value.substr(0, pos) +"["+Tag+"="+attText+"]"+ insText +"["+Tag+"]"+ input.value.substr(pos);
  }
}