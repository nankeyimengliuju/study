
var evtSource = new EventSource("http://localhost/app/index.php?i=1&c=entry&m=ewei_shopv2&do=mobile&r=qt.tosent");




evtSource . addEventListener( 'foo' , function (event)
{postMessage(event.data) } , false ) ;