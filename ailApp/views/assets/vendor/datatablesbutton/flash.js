/*!
 Flash export buttons for Buttons and DataTables.
 2015-2017 SpryMedia Ltd - datatables.net/license

 ZeroClipbaord - MIT license
 Copyright (c) 2012 Joseph Huckaby
*/
(function(g){"function"===typeof define&&define.amd?define(["jquery","datatables.net","datatables.net-buttons"],function(q){return g(q,window,document)}):"object"===typeof exports?module.exports=function(q,r){q||(q=window);r&&r.fn.dataTable||(r=require("datatables.net")(q,r).$);r.fn.dataTable.Buttons||require("datatables.net-buttons")(q,r);return g(r,q,q.document)}:g(jQuery,window,document)})(function(g,q,r,z){function M(a){for(var b="";0<=a;)b=String.fromCharCode(a%26+65)+b,a=Math.floor(a/26)-1;
return b}function t(a,b,c){var d=a.createElement(b);c&&(c.attr&&g(d).attr(c.attr),c.children&&g.each(c.children,function(f,e){d.appendChild(e)}),null!==c.text&&c.text!==z&&d.appendChild(a.createTextNode(c.text)));return d}function S(a,b){var c=a.header[b].length;a.footer&&a.footer[b].length>c&&(c=a.footer[b].length);for(var d=0,f=a.body.length;d<f;d++){var e=a.body[d][b];e=null!==e&&e!==z?e.toString():"";-1!==e.indexOf("\n")?(e=e.split("\n"),e.sort(function(n,l){return l.length-n.length}),e=e[0].length):
e=e.length;e>c&&(c=e);if(40<c)return 52}c*=1.3;return 6<c?c:6}function N(a){G===z&&(G=-1===J.serializeToString(g.parseXML(A["xl/worksheets/sheet1.xml"])).indexOf("xmlns:r"));g.each(a,function(b,c){if(g.isPlainObject(c))N(c);else{if(G){var d=c.childNodes[0],f,e=[];for(f=d.attributes.length-1;0<=f;f--){var n=d.attributes[f].nodeName;var l=d.attributes[f].nodeValue;-1!==n.indexOf(":")&&(e.push({name:n,value:l}),d.removeAttribute(n))}f=0;for(n=e.length;f<n;f++)l=c.createAttribute(e[f].name.replace(":",
"_dt_b_namespace_token_")),l.value=e[f].value,d.setAttributeNode(l)}c=J.serializeToString(c);G&&(-1===c.indexOf("<?xml")&&(c='<?xml version="1.0" encoding="UTF-8" standalone="yes"?>'+c),c=c.replace(/_dt_b_namespace_token_/g,":"));c=c.replace(/<([^<>]*?) xmlns=""([^<>]*?)>/g,"<$1 $2>");a[b]=c}})}var w=g.fn.dataTable,m={version:"1.0.4-TableTools2",clients:{},moviePath:"",nextId:1,$:function(a){"string"==typeof a&&(a=r.getElementById(a));a.addClass||(a.hide=function(){this.style.display="none"},a.show=
function(){this.style.display=""},a.addClass=function(b){this.removeClass(b);this.className+=" "+b},a.removeClass=function(b){this.className=this.className.replace(new RegExp("\\s*"+b+"\\s*")," ").replace(/^\s+/,"").replace(/\s+$/,"")},a.hasClass=function(b){return!!this.className.match(new RegExp("\\s*"+b+"\\s*"))});return a},setMoviePath:function(a){this.moviePath=a},dispatch:function(a,b,c){(a=this.clients[a])&&a.receiveEvent(b,c)},log:function(a){console.log("Flash: "+a)},register:function(a,
b){this.clients[a]=b},getDOMObjectPosition:function(a){var b={left:0,top:0,width:a.width?a.width:a.offsetWidth,height:a.height?a.height:a.offsetHeight};""!==a.style.width&&(b.width=a.style.width.replace("px",""));""!==a.style.height&&(b.height=a.style.height.replace("px",""));for(;a;)b.left+=a.offsetLeft,b.top+=a.offsetTop,a=a.offsetParent;return b},Client:function(a){this.handlers={};this.id=m.nextId++;this.movieId="ZeroClipboard_TableToolsMovie_"+this.id;m.register(this.id,this);a&&this.glue(a)}};
m.Client.prototype={id:0,ready:!1,movie:null,clipText:"",fileName:"",action:"copy",handCursorEnabled:!0,cssEffects:!0,handlers:null,sized:!1,sheetName:"",glue:function(a,b){this.domElement=m.$(a);a=99;this.domElement.style.zIndex&&(a=parseInt(this.domElement.style.zIndex,10)+1);var c=m.getDOMObjectPosition(this.domElement);this.div=r.createElement("div");var d=this.div.style;d.position="absolute";d.left="0px";d.top="0px";d.width=c.width+"px";d.height=c.height+"px";d.zIndex=a;"undefined"!=typeof b&&
""!==b&&(this.div.title=b);0!==c.width&&0!==c.height&&(this.sized=!0);this.domElement&&(this.domElement.appendChild(this.div),this.div.innerHTML=this.getHTML(c.width,c.height).replace(/&/g,"&amp;"))},positionElement:function(){var a=m.getDOMObjectPosition(this.domElement),b=this.div.style;b.position="absolute";b.width=a.width+"px";b.height=a.height+"px";0!==a.width&&0!==a.height&&(this.sized=!0,b=this.div.childNodes[0],b.width=a.width,b.height=a.height)},getHTML:function(a,b){var c="",d="id="+this.id+
"&width="+a+"&height="+b;if(navigator.userAgent.match(/MSIE/)){var f=location.href.match(/^https/i)?"https://":"http://";c+='<object classid="clsid:D27CDB6E-AE6D-11cf-96B8-444553540000" codebase="'+f+'download.macromedia.com/pub/shockwave/cabs/flash/swflash.cab#version=10,0,0,0" width="'+a+'" height="'+b+'" id="'+this.movieId+'" align="middle"><param name="allowScriptAccess" value="always" /><param name="allowFullScreen" value="false" /><param name="movie" value="'+m.moviePath+'" /><param name="loop" value="false" /><param name="menu" value="false" /><param name="quality" value="best" /><param name="bgcolor" value="#ffffff" /><param name="flashvars" value="'+
d+'"/><param name="wmode" value="transparent"/></object>'}else c+='<embed id="'+this.movieId+'" src="'+m.moviePath+'" loop="false" menu="false" quality="best" bgcolor="#ffffff" width="'+a+'" height="'+b+'" name="'+this.movieId+'" align="middle" allowScriptAccess="always" allowFullScreen="false" type="application/x-shockwave-flash" pluginspage="http://www.macromedia.com/go/getflashplayer" flashvars="'+d+'" wmode="transparent" />';return c},hide:function(){this.div&&(this.div.style.left="-2000px")},
show:function(){this.reposition()},destroy:function(){var a=this;this.domElement&&this.div&&(g(this.div).remove(),this.div=this.domElement=null,g.each(m.clients,function(b,c){c===a&&delete m.clients[b]}))},reposition:function(a){a&&((this.domElement=m.$(a))||this.hide());if(this.domElement&&this.div){a=m.getDOMObjectPosition(this.domElement);var b=this.div.style;b.left=""+a.left+"px";b.top=""+a.top+"px"}},clearText:function(){this.clipText="";this.ready&&this.movie.clearText()},appendText:function(a){this.clipText+=
a;this.ready&&this.movie.appendText(a)},setText:function(a){this.clipText=a;this.ready&&this.movie.setText(a)},setFileName:function(a){this.fileName=a;this.ready&&this.movie.setFileName(a)},setSheetData:function(a){this.ready&&this.movie.setSheetData(JSON.stringify(a))},setAction:function(a){this.action=a;this.ready&&this.movie.setAction(a)},addEventListener:function(a,b){a=a.toString().toLowerCase().replace(/^on/,"");this.handlers[a]||(this.handlers[a]=[]);this.handlers[a].push(b)},setHandCursor:function(a){this.handCursorEnabled=
a;this.ready&&this.movie.setHandCursor(a)},setCSSEffects:function(a){this.cssEffects=!!a},receiveEvent:function(a,b){a=a.toString().toLowerCase().replace(/^on/,"");switch(a){case "load":this.movie=r.getElementById(this.movieId);if(!this.movie){var c=this;setTimeout(function(){c.receiveEvent("load",null)},1);return}if(!this.ready&&navigator.userAgent.match(/Firefox/)&&navigator.userAgent.match(/Windows/)){c=this;setTimeout(function(){c.receiveEvent("load",null)},100);this.ready=!0;return}this.ready=
!0;this.movie.clearText();this.movie.appendText(this.clipText);this.movie.setFileName(this.fileName);this.movie.setAction(this.action);this.movie.setHandCursor(this.handCursorEnabled);break;case "mouseover":this.domElement&&this.cssEffects&&this.recoverActive&&this.domElement.addClass("active");break;case "mouseout":this.domElement&&this.cssEffects&&(this.recoverActive=!1,this.domElement.hasClass("active")&&(this.domElement.removeClass("active"),this.recoverActive=!0));break;case "mousedown":this.domElement&&
this.cssEffects&&this.domElement.addClass("active");break;case "mouseup":this.domElement&&this.cssEffects&&(this.domElement.removeClass("active"),this.recoverActive=!1)}if(this.handlers[a])for(var d=0,f=this.handlers[a].length;d<f;d++){var e=this.handlers[a][d];if("function"==typeof e)e(this,b);else if("object"==typeof e&&2==e.length)e[0][e[1]](this,b);else if("string"==typeof e)q[e](this,b)}}};m.hasFlash=function(){try{return new ActiveXObject("ShockwaveFlash.ShockwaveFlash"),!0}catch(a){if(navigator.mimeTypes&&
navigator.mimeTypes["application/x-shockwave-flash"]!==z&&navigator.mimeTypes["application/x-shockwave-flash"].enabledPlugin)return!0}return!1};q.ZeroClipboard_TableTools=m;var O=function(a,b){b.attr("id");b.parents("html").length?a.glue(b[0],""):setTimeout(function(){O(a,b)},500)},T=function(a){var b="Sheet1";a.sheetName&&(b=a.sheetName.replace(/[\[\]\*\/\\\?:]/g,""));return b},H=function(a,b){b=b.match(/[\s\S]{1,8192}/g)||[];a.clearText();for(var c=0,d=b.length;c<d;c++)a.appendText(b[c])},P=function(a){return a.newline?
a.newline:navigator.userAgent.match(/Windows/)?"\r\n":"\n"},Q=function(a,b){var c=P(b);a=a.buttons.exportData(b.exportOptions);var d=b.fieldBoundary,f=b.fieldSeparator,e=new RegExp(d,"g"),n=b.escapeChar!==z?b.escapeChar:"\\",l=function(u){for(var x="",B=0,h=u.length;B<h;B++)0<B&&(x+=f),x+=d?d+(""+u[B]).replace(e,n+d)+d:u[B];return x},E=b.header?l(a.header)+c:"";b=b.footer&&a.footer?c+l(a.footer):"";for(var C=[],p=0,v=a.body.length;p<v;p++)C.push(l(a.body[p]));return{str:E+C.join(c)+b,rows:C.length}},
I={available:function(){return m.hasFlash()},init:function(a,b,c){m.moviePath=w.Buttons.swfPath;var d=new m.Client;d.setHandCursor(!0);d.addEventListener("mouseDown",function(f){c._fromFlash=!0;a.button(b[0]).trigger();c._fromFlash=!1});O(d,b);c._flash=d},destroy:function(a,b,c){c._flash.destroy()},fieldSeparator:",",fieldBoundary:'"',exportOptions:{},title:"*",messageTop:"*",messageBottom:"*",filename:"*",extension:".csv",header:!0,footer:!1},J="";J="undefined"===typeof q.XMLSerializer?new function(){this.serializeToString=
function(a){return a.xml}}:new XMLSerializer;var G,A={"_rels/.rels":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/officeDocument" Target="xl/workbook.xml"/></Relationships>',"xl/_rels/workbook.xml.rels":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Relationships xmlns="http://schemas.openxmlformats.org/package/2006/relationships"><Relationship Id="rId1" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/worksheet" Target="worksheets/sheet1.xml"/><Relationship Id="rId2" Type="http://schemas.openxmlformats.org/officeDocument/2006/relationships/styles" Target="styles.xml"/></Relationships>',
"[Content_Types].xml":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><Types xmlns="http://schemas.openxmlformats.org/package/2006/content-types"><Default Extension="xml" ContentType="application/xml" /><Default Extension="rels" ContentType="application/vnd.openxmlformats-package.relationships+xml" /><Default Extension="jpeg" ContentType="image/jpeg" /><Override PartName="/xl/workbook.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet.main+xml" /><Override PartName="/xl/worksheets/sheet1.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.worksheet+xml" /><Override PartName="/xl/styles.xml" ContentType="application/vnd.openxmlformats-officedocument.spreadsheetml.styles+xml" /></Types>',
"xl/workbook.xml":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><workbook xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships"><fileVersion appName="xl" lastEdited="5" lowestEdited="5" rupBuild="24816"/><workbookPr showInkAnnotation="0" autoCompressPictures="0"/><bookViews><workbookView xWindow="0" yWindow="0" windowWidth="25600" windowHeight="19020" tabRatio="500"/></bookViews><sheets><sheet name="" sheetId="1" r:id="rId1"/></sheets></workbook>',
"xl/worksheets/sheet1.xml":'<?xml version="1.0" encoding="UTF-8" standalone="yes"?><worksheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:r="http://schemas.openxmlformats.org/officeDocument/2006/relationships" xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006" mc:Ignorable="x14ac" xmlns:x14ac="http://schemas.microsoft.com/office/spreadsheetml/2009/9/ac"><sheetData/><mergeCells count="0"/></worksheet>',"xl/styles.xml":'<?xml version="1.0" encoding="UTF-8"?><styleSheet xmlns="http://schemas.openxmlformats.org/spreadsheetml/2006/main" xmlns:mc="http://schemas.openxmlformats.org/markup-compatibility/2006" mc:Ignorable="x14ac" xmlns:x14ac="http://schemas.microsoft.com/office/spreadsheetml/2009/9/ac"><numFmts count="6"><numFmt numFmtId="164" formatCode="#,##0.00_- [$$-45C]"/><numFmt numFmtId="165" formatCode="&quot;£&quot;#,##0.00"/><numFmt numFmtId="166" formatCode="[$€-2] #,##0.00"/><numFmt numFmtId="167" formatCode="0.0%"/><numFmt numFmtId="168" formatCode="#,##0;(#,##0)"/><numFmt numFmtId="169" formatCode="#,##0.00;(#,##0.00)"/></numFmts><fonts count="5" x14ac:knownFonts="1"><font><sz val="11" /><name val="Calibri" /></font><font><sz val="11" /><name val="Calibri" /><color rgb="FFFFFFFF" /></font><font><sz val="11" /><name val="Calibri" /><b /></font><font><sz val="11" /><name val="Calibri" /><i /></font><font><sz val="11" /><name val="Calibri" /><u /></font></fonts><fills count="6"><fill><patternFill patternType="none" /></fill><fill><patternFill patternType="none" /></fill><fill><patternFill patternType="solid"><fgColor rgb="FFD9D9D9" /><bgColor indexed="64" /></patternFill></fill><fill><patternFill patternType="solid"><fgColor rgb="FFD99795" /><bgColor indexed="64" /></patternFill></fill><fill><patternFill patternType="solid"><fgColor rgb="ffc6efce" /><bgColor indexed="64" /></patternFill></fill><fill><patternFill patternType="solid"><fgColor rgb="ffc6cfef" /><bgColor indexed="64" /></patternFill></fill></fills><borders count="2"><border><left /><right /><top /><bottom /><diagonal /></border><border diagonalUp="false" diagonalDown="false"><left style="thin"><color auto="1" /></left><right style="thin"><color auto="1" /></right><top style="thin"><color auto="1" /></top><bottom style="thin"><color auto="1" /></bottom><diagonal /></border></borders><cellStyleXfs count="1"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" /></cellStyleXfs><cellXfs count="61"><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="2" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="3" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="4" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="5" borderId="0" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="0" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="2" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="3" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="4" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="1" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="2" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="3" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="4" fillId="5" borderId="1" applyFont="1" applyFill="1" applyBorder="1"/><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment horizontal="left"/></xf><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment horizontal="center"/></xf><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment horizontal="right"/></xf><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment horizontal="fill"/></xf><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment textRotation="90"/></xf><xf numFmtId="0" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyAlignment="1"><alignment wrapText="1"/></xf><xf numFmtId="9"   fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="164" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="165" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="166" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="167" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="168" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="169" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="3" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/><xf numFmtId="4" fontId="0" fillId="0" borderId="0" applyFont="1" applyFill="1" applyBorder="1" xfId="0" applyNumberFormat="1"/></cellXfs><cellStyles count="1"><cellStyle name="Normal" xfId="0" builtinId="0" /></cellStyles><dxfs count="0" /><tableStyles count="0" defaultTableStyle="TableStyleMedium9" defaultPivotStyle="PivotStyleMedium4" /></styleSheet>'},
R=[{match:/^\-?\d+\.\d%$/,style:60,fmt:function(a){return a/100}},{match:/^\-?\d+\.?\d*%$/,style:56,fmt:function(a){return a/100}},{match:/^\-?\$[\d,]+.?\d*$/,style:57},{match:/^\-?£[\d,]+.?\d*$/,style:58},{match:/^\-?€[\d,]+.?\d*$/,style:59},{match:/^\([\d,]+\)$/,style:61,fmt:function(a){return-1*a.replace(/[\(\)]/g,"")}},{match:/^\([\d,]+\.\d{2}\)$/,style:62,fmt:function(a){return-1*a.replace(/[\(\)]/g,"")}},{match:/^[\d,]+$/,style:63},{match:/^[\d,]+\.\d{2}$/,style:64}];w.Buttons.swfPath="//cdn.datatables.net/buttons/"+
w.Buttons.version+"/swf/flashExport.swf";w.Api.register("buttons.resize()",function(){g.each(m.clients,function(a,b){b.domElement!==z&&b.domElement.parentNode&&b.positionElement()})});w.ext.buttons.copyFlash=g.extend({},I,{className:"buttons-copy buttons-flash",text:function(a){return a.i18n("buttons.copy","Copy")},action:function(a,b,c,d){if(d._fromFlash){this.processing(!0);a=d._flash;var f=Q(b,d);c=b.buttons.exportInfo(d);var e=P(d);f=f.str;c.title&&(f=c.title+e+e+f);c.messageTop&&(f=c.messageTop+
e+e+f);c.messageBottom&&(f=f+e+e+c.messageBottom);d.customize&&(f=d.customize(f,d,b));a.setAction("copy");H(a,f);this.processing(!1);b.buttons.info(b.i18n("buttons.copyTitle","Copy to clipboard"),b.i18n("buttons.copySuccess",{_:"Copied %d rows to clipboard",1:"Copied 1 row to clipboard"},data.rows),3E3)}},fieldSeparator:"\t",fieldBoundary:""});w.ext.buttons.csvFlash=g.extend({},I,{className:"buttons-csv buttons-flash",text:function(a){return a.i18n("buttons.csv","CSV")},action:function(a,b,c,d){a=
d._flash;var f=Q(b,d);c=b.buttons.exportInfo(d);b=d.customize?d.customize(f.str,d,b):f.str;a.setAction("csv");a.setFileName(c.filename);H(a,b)},escapeChar:'"'});w.ext.buttons.excelFlash=g.extend({},I,{className:"buttons-excel buttons-flash",text:function(a){return a.i18n("buttons.excel","Excel")},action:function(a,b,c,d){this.processing(!0);a=d._flash;var f=0,e=g.parseXML(A["xl/worksheets/sheet1.xml"]),n=e.getElementsByTagName("sheetData")[0];c={_rels:{".rels":g.parseXML(A["_rels/.rels"])},xl:{_rels:{"workbook.xml.rels":g.parseXML(A["xl/_rels/workbook.xml.rels"])},
"workbook.xml":g.parseXML(A["xl/workbook.xml"]),"styles.xml":g.parseXML(A["xl/styles.xml"]),worksheets:{"sheet1.xml":e}},"[Content_Types].xml":g.parseXML(A["[Content_Types].xml"])};var l=b.buttons.exportData(d.exportOptions),E,C,p=function(h){E=f+1;C=t(e,"row",{attr:{r:E}});for(var k=0,F=h.length;k<F;k++){var K=M(k)+""+E,y=null;if(null===h[k]||h[k]===z||""===h[k])if(!0===d.createEmptyCells)h[k]="";else continue;h[k]="function"===typeof h[k].trim?h[k].trim():h[k];for(var L=0,U=R.length;L<U;L++){var D=
R[L];if(h[k].match&&!h[k].match(/^0\d+/)&&h[k].match(D.match)){y=h[k].replace(/[^\d\.\-]/g,"");D.fmt&&(y=D.fmt(y));y=t(e,"c",{attr:{r:K,s:D.style},children:[t(e,"v",{text:y})]});break}}y||("number"===typeof h[k]||h[k].match&&h[k].match(/^-?\d+(\.\d+)?$/)&&!h[k].match(/^0\d+/)?y=t(e,"c",{attr:{t:"n",r:K},children:[t(e,"v",{text:h[k]})]}):(D=h[k].replace?h[k].replace(/[\x00-\x09\x0B\x0C\x0E-\x1F\x7F-\x9F]/g,""):h[k],y=t(e,"c",{attr:{t:"inlineStr",r:K},children:{row:t(e,"is",{children:{row:t(e,"t",{text:D})}})}})));
C.appendChild(y)}n.appendChild(C);f++};g("sheets sheet",c.xl["workbook.xml"]).attr("name",T(d));d.customizeData&&d.customizeData(l);var v=function(h,k){var F=g("mergeCells",e);F[0].appendChild(t(e,"mergeCell",{attr:{ref:"A"+h+":"+M(k)+h}}));F.attr("count",F.attr("count")+1);g("row:eq("+(h-1)+") c",e).attr("s","51")},u=b.buttons.exportInfo(d);u.title&&(p([u.title],f),v(f,l.header.length-1));u.messageTop&&(p([u.messageTop],f),v(f,l.header.length-1));d.header&&(p(l.header,f),g("row:last c",e).attr("s",
"2"));for(var x=0,B=l.body.length;x<B;x++)p(l.body[x],f);d.footer&&l.footer&&(p(l.footer,f),g("row:last c",e).attr("s","2"));u.messageBottom&&(p([u.messageBottom],f),v(f,l.header.length-1));p=t(e,"cols");g("worksheet",e).prepend(p);v=0;for(x=l.header.length;v<x;v++)p.appendChild(t(e,"col",{attr:{min:v+1,max:v+1,width:S(l,v),customWidth:1}}));d.customize&&d.customize(c,d,b);N(c);a.setAction("excel");a.setFileName(u.filename);a.setSheetData(c);H(a,"");this.processing(!1)},extension:".xlsx",createEmptyCells:!1});
w.ext.buttons.pdfFlash=g.extend({},I,{className:"buttons-pdf buttons-flash",text:function(a){return a.i18n("buttons.pdf","PDF")},action:function(a,b,c,d){this.processing(!0);a=d._flash;c=b.buttons.exportData(d.exportOptions);var f=b.buttons.exportInfo(d),e=b.table().node().offsetWidth,n=b.columns(d.columns).indexes().map(function(l){return b.column(l).header().offsetWidth/e});a.setAction("pdf");a.setFileName(f.filename);H(a,JSON.stringify({title:f.title||"",messageTop:f.messageTop||"",messageBottom:f.messageBottom||
"",colWidth:n.toArray(),orientation:d.orientation,size:d.pageSize,header:d.header?c.header:null,footer:d.footer?c.footer:null,body:c.body}));this.processing(!1)},extension:".pdf",orientation:"portrait",pageSize:"A4",newline:"\n"});return w.Buttons});