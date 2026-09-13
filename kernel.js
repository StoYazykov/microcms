function r(a) {
window.location.href=a;
}
function g(a) {
return document.getElementById(''+a);
}
function bbth(t) {
var a={
'[[': '[',
']]': ']',
/*'<': '&lt;',
'>': '&gt;',
'"': '&quote;',
"'": '&#039;',
'&': '&amp;',*/
"[b]": "<b>",
"[/b]": "</b>",
"[i]": "<i>",
"[-]": '<div class="center">',
"[/-]": '</div>',
"[/i]": "</i>",
"[code]": '<pre class="cod">',
"[/code]": '</pre>',
"[---]": "<hr>",
"\n": "<br>",
'[img]': '<img src="',
'[/img]': '">'
};
for (var k in a) {
t=t.split(k).join(a[k]);
};
t=t.replace(/\[button="([^"]*)"(?:\s+([^\s\]]*))?(?:\s+([^\s\]]*))?\](.*?)\[\/button\]/g,
function(match, url, color, bg, text) {
var style='';
if(color) style+='color:'+color+';';
if(bg) style+='background:'+bg+';';
return '<button onclick="r(\''+ url+'\')" style="'+style+'">'+text+'</button>';
}
);
return t;
}
function lp() {
var i=g('e').value;
g('p').innerHTML=bbth(i);
}
function bolditalic(a) {
var ta=g('e'), s=ta.selectionStart, e=ta.selectionEnd, t=ta.value;
ta.value=t.substring(0, s)+"["+a+"]"+t.substring(s, e)+"[/"+a+"]"+t.substring(e);
if(s==e) ta.selectionStart=ta.selectionEnd=s+2+a.length;
ta.focus();
lp();
}
function insbutt() {
var b=g('temp'), t='<table align="center"><tr><td><label><input type="radio" name="mode" checked="" value="u">Внешний URL</label></td><td><label><input type="radio" '; 
if(b.innerHTML) {
b.innerHTML='';
return;
}
t+='name="mode" value="p">Переход на страницу</label></td></tr><tr><td><b>URL/Имя страницы:&nbsp;</b></td><td><input type="text" id="url"></td></tr><tr><td><b>Надпись';
t+=' на кнопке:&nbsp;</b></td><td><input type="text" id="name"></td></tr><tr><td><b>Цвет текста:&nbsp;</b></td><td><input type="text" id="fg"></td></tr><tr><td><b>Цвет'; t+=' фона:&nbsp;</b></td><td><input type="text" id="bg"></td></tr><tr><td></td><td><button class="sbtn" onclick="subbtn()">Добавить!</button></td></tr></table>';
b.innerHTML=t;
}
function subbtn() {
var u=g('url').value, na=g('name').value, Z=g('e'), I=Z.value, S=Z.selectionStart, Q=document.querySelector('input[name="mode"]:checked').value;
var FG=g('fg').value, BG=g('bg').value;
if(Q=='p') u='/?page='+u;
Z.value=I.substring(0, S)+'[button="'+u+'" '+FG+' '+BG+']'+na+'[/button]'+I.substring(S);
Z.focus();
lp();
g('temp').innerHTML='';
}
function insimage() {
var Y=g('temp'), F='<button><label for="iu">Загрузить картинку</label></button><span id="file_n" style="margin-left: 10px;">Картинка не выбрана</span><form';
F+=' action="upload.php" method="post" enctype="multipart/form-data"><input type="file" name="uf" id="iu" style="display:none;" accept="image/*"';
F+=' onchange="g(\'file_n\').textContent=this.files[0].name;uploadimage()"></form>';
if(Y.innerHTML) {
Y.innerHTML='';
}
Y.innerHTML=F;
}
function uploadimage() {
var FI=g('iu').files[0];
if(!FI) return;
var FD=new FormData();
FD.append("uf", FI);
fetch("upload.php", {
method: "POST",
body: FD
})
.then(function(resp) { return resp.text(); })
.then(function(FN) {
var TA=g('e');
var S=TA.selectionStart;
var I=TA.value;
var IT='[img]/upload/'+FN+'[/img]';
TA.value=I.substring(0, S)+IT+I.substring(S);
lp();
g('temp').innerHTML='';
})
.catch(function(err) {
console.error("Ошибка:", err);
});
}
function uploadaudio() {
var FI=g('iu').files[0];
if(!FI) return;
var FD=new FormData();
FD.append("uf", FI);
fetch("upload.php", {
method: "POST",
body: FD
})
.then(function(resp) { return resp.text(); })
.then(function(FN) {
var TA=g('e');
var S=TA.selectionStart;
var I=TA.value;
var IT='[audio="/upload/'+FN+'"][/audio]';
TA.value=I.substring(0, S)+IT+I.substring(S);
lp();
})
.catch(function(err) {
console.error("Ошибка:", err);
});
}
function insaudio() {
var Y=g('temp'), F='<button><label for="iu">Выбрать аудио</label></button><span id="file_n" style="margin-left: 10px;">Аудиофайл не выбран</span><form'; 
F+=' action="upload.php" method="post" enctype="multipart/form-data"><input type="file" accept="audio/*" name="uf" id="iu" style="display:none;"';
F+=' onchange="g(\'file_n\').textContent=this.files[0].name;uploadaudio()">';
F+='</form>';
if(Y.innerHTML) {
Y.innerHTML='';
}
Y.innerHTML=F;
}
function subaudio() {
var u=g('url').value, na=g('name').value, Z=g('e'), I=Z.value, S=Z.selectionStart;
Z.value=I.substring(0, S)+'[audio="'+u+'"]'+na+'[/audio]'+I.substring(S);
Z.focus();
lp();
g('temp').innerHTML='';
}
function invaudio(a) {
var A=g('p_'+a);
var IA=g('play_'+a);
if(A.paused) {
IA.src='pause.svg';
A.play();
} else {
IA.src='play.svg';
A.pause();
}
}
function ptupd(a) {
var PL=g('p_'+a);
g('seek_'+a).value=PL.currentTime;
g('ct_'+a).textContent=ft(PL.currentTime);
}
function ptmeta(a) {
g('seek_'+a).max=g('p_'+a).duration;
g('tt_'+a).textContent=ft(g('p_'+a).duration);
}
function ft(a) {
var SECS=~~(a%60);
return ~~(a/60)+':'+(SECS<10?'0':'')+SECS;
}
function pte(a) {
g('p_'+a).currentTime=g('seek_'+a).value=0;
g('p_'+a).pause();
g('play_'+a).src='play.svg';
}
function plmov(a) {
g('p_'+a).currentTime=+(g('seek_'+a).value);
}
