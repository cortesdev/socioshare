// Register facebook page bottom-child - Parse error
// var d = document.getElementById('fb-page');
// d.parentNode.appendChild(d);

// Register facebook page bottom-child - Hack
$("#primary .fb-page").each(function(){
    $(this).appendTo($(this).parent());
});

// Register facebook div after body
document.body.innerHTML += '<div id="fb-root"></div>';

// Facebook SDK  
(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s) 
  js.src = "//connect.facebook.net/pt_BR/sdk.js#xfbml=1&version=v2.5&appId=193867577452345";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

// Responsive Iframes Jquery solution - responsive-iframes.css
// https://gist.github.com/aarongustafson/1313517

function adjustIframes()
{
  $('iframe').each(function(){
    var
    $this       = $(this),
    proportion  = $this.data( 'proportion' ),
    w           = $this.attr('width'),
    actual_w    = $this.width();
    
    if ( ! proportion )
    {
        proportion = $this.attr('height') / w;
        $this.data( 'proportion', proportion );
    }
  
    if ( actual_w != w )
    {
        $this.css( 'height', Math.round( actual_w * proportion ) + 'px' );
    }
  });
}
$(window).on('resize load',adjustIframes);