    <!DOCTYPE html>
    <html>
    <head>
    <title>Монитор</title>
    <script>
    const PI=3.14159265359;
    const PLANETS_COUNT=100;

    let x = [];
    let y = [];
    let angle = [];
    let step = [];
    const farbe =['rgb(195,195,195);', 'rgb(185,122,87);', 'rgb(0,162,232);', 'rgb(185,122,87);','rgb(185,122,87);','rgb(153,217,234);','rgb(0,162,232);','rgb(195,195,195);'];

    function draw_planet(id, cx, cy, x, y, angle, fg, bg) { 
      var el = document.getElementById(id);
      var ctx = el.getContext('2d');
      let nx = (x * Math.cos(angle*(PI/180))) - (y * Math.sin(angle*(PI/180)));
      let ny = (x * Math.cos(angle*(PI/180))) + (y * Math.sin(angle*(PI/180)));
      ctx.beginPath();
      ctx.strokeStyle = fg;
      ctx.fillStyle = bg;
      ctx.arc(cx + nx, cy + ny, 4, 0, Math.PI * 2);
      ctx.stroke();

    }

    function init() {
      for(let planets=0; planets<PLANETS_COUNT; planets++) {
        if(planets > 0) { x[planets] = x[planets-1]+5; y[planets]=y[planets-1]+5; }
        else { x[planets] = 30; y[planets]=30; }
      }

      for(let planets=0; planets<PLANETS_COUNT; planets++) { angle[planets] = Math.random() * 50; step[planets] = 1 + Math.random() * 4; }
    }

    function animate() {
        var el = document.getElementById('planet');
        var ctx = el.getContext('2d');
        ctx.clearRect(0, 0, 200, 200);
        ctx.beginPath();
        ctx.strokeStyle = '#fff';
        ctx.arc(100, 100, 20, 0, Math.PI * 2);
        ctx.stroke();
        ctx.fill();

        for(planets=0; planets<PLANETS_COUNT; planets++) {
          angle[planets] += step[planets];
          if(angle[planets] >= 359) angle[planets] = 0;
          draw_planet('planet', 100, 100, x[planets], y[planets], angle[planets], '#fff', farbe[planets]);
        }
    }

    window.onload = function() {
      init();
      setInterval(function(){ animate(); }, 0);
    }
    </script>
    <style>
    .monitor { border:20px solid #EEE; width:200px; height:200px; border-radius:3px; }
    .display { box-shadow:inset 0px 0px 3px #EEE; background-color:#000; color:lightgray; word-break:break-all; font-family:monospace; font-size:14px; width:200px; height:200px; }
    .lamp { position:relative; left:180px; top:10px; width:15px; height:2px; background-color:#0F0; box-shadow:0px 0px 5px #0F0; }
    </style>
    </head>
    <body>
      <div class="monitor">
        <div class="display">
          <canvas id="planet" width="200px" height="200px">
          </canvas>
        </div>
        <div class="lamp">&nbsp;</div>
    </body>
    </html>
